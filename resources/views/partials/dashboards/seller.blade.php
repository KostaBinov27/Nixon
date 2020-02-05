<?php
GLOBAL $conn;
GLOBAL $connWP;
global $WCMp;

// print_r($WCMp);
$sql = "SELECT * FROM wp_users WHERE ID = '".$_SESSION['userID']."'";
$result_user = mysqli_query($connWP, $sql);
$userInfo = $result_user -> fetch_assoc();

$userInfo_meta = get_user_meta( $_SESSION['userID']);
$vendor = get_wcmp_vendor($_SESSION['userID']);

// print_r($vendor);

if (isset($_POST['addNewProduct'])) {

        $current_date = date("Y-m-d");
        $post_id = wp_insert_post(array(
            'post_title' => $_POST['productName'],
            'post_author' => $_SESSION['userID'],
            'post_type' => 'product',
            'post_status' => 'publish', 
            'post_content' => $_POST['product_description']
        ));
        
        $product = new WC_Product_Simple($post_id);
        $product->save();

        wp_set_object_terms($post_id, $_SESSION['userID'], 'dc_vendor_shop ');

        sleep(2);
        // Get latest ID from wp_posts (the id of the current inserted product)
        $sql = "SELECT * FROM wp_posts WHERE ID = (SELECT MAX(ID) FROM wp_posts)";
        $result = mysqli_query($connWP, $sql);
        $row = $result -> fetch_assoc();
        $latestID = $row['ID'];

        update_post_meta( $latestID, '_regular_price', ''.$_POST['regularPrice'].'' );
        update_post_meta( $latestID, '_stock_status', 'instock' );
        update_post_meta( $latestID, '_downloadable', 'yes' );
        update_post_meta( $latestID, '_price', ''.$_POST['regularPrice'].'' );
        update_post_meta( $latestID, '_commission_per_product', '0' );
        update_post_meta( $latestID, '_download_limit', '-1' );
        update_post_meta( $latestID, '_download_expiry', '-1' );  


        if ( !empty($_FILES['image']['name']) && empty($_FILES['image_hiden'])) {
            $dirPath = getcwd();
            require_once( $dirPath . '/wp-admin/includes/image.php' );

            require_once( $dirPath . '/wp-admin/includes/file.php' );
        
            require_once( $dirPath . '/wp-admin/includes/media.php' );
                        
            // Get the path to the upload directory. 
            // If it was uploaded to WP, wp_upload_dir() does the job
            $filename = $_FILES['image'];
            // print_r($filename);
            $wp_upload_dir = wp_upload_dir();
            $full_path = $wp_upload_dir['path'] . $filename['name'];
            // Check the type of file. We'll use this as the 'post_mime_type'.
            $filetype = wp_check_filetype(basename($full_path), null);
            // Prepare an array of post data for the attachment.
            $attachment = array(
                'guid'           => $wp_upload_dir['url'] . '/' . basename($full_path), 
                'post_mime_type' => $filetype['type'],
                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename($full_path) ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );
            // Insert the attachment.
            $attachment_id = media_handle_upload( 'image', $latestID );

            update_post_meta( $latestID, '_thumbnail_id', ''.$attachment_id.'' );
        }

        sleep(3);
        
        if ( !empty($_FILES['product_file_custom']['name']) && empty($_FILES['product_file_hiden'])) {
            $dirPath = getcwd();
            require_once( $dirPath . '/wp-admin/includes/image.php' );

            require_once( $dirPath . '/wp-admin/includes/file.php' );
        
            require_once( $dirPath . '/wp-admin/includes/media.php' );
                        
            // Get the path to the upload directory. 
            // If it was uploaded to WP, wp_upload_dir() does the job
            $filename = $_FILES['product_file_custom'];
            $wp_upload_dir = wp_upload_dir();
            $full_path = $wp_upload_dir['path'] . $filename['name'];
            // Check the type of file. We'll use this as the 'post_mime_type'.
            $filetype = wp_check_filetype(basename($full_path), null);
            // Prepare an array of post data for the attachment.
            $attachment = array(
                'guid'           => $wp_upload_dir['url'] . '/' . basename($full_path), 
                'post_mime_type' => $filetype['type'],
                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename($full_path) ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );
            // Insert the attachment.
            $attachment_id = media_handle_upload( 'product_file_custom', $latestID );
            
            //This is my custom function which returns attachment id after file upload

            $file_name = $filename['name'];
            $file_url  = wp_get_attachment_url( $attachment_id );
            $download_id = md5( $file_url );

            // Creating an empty instance of a WC_Product_Download object
            $pd_object = new WC_Product_Download();

            // Set the data in the WC_Product_Download object
            $pd_object->set_id( $download_id );
            $pd_object->set_name( $file_name );
            $pd_object->set_file( $file_url );

            // Get an instance of the WC_Product object (from a defined product ID)
            $product = wc_get_product( $latestID ); // <=== Be sure it's the product ID

            // Get existing downloads (if they exist)
            $downloads = $product->get_downloads();

            // Add the new WC_Product_Download object to the array
            $downloads[$download_id] = $pd_object;

            // Set the complete downloads array in the product
            $product->set_downloads($downloads);
            $product->save(); // Save the data in database
        }

        wp_set_object_terms($latestID, absint($vendor->term_id), $WCMp->taxonomy->taxonomy_name);
    }

    $sql = "SELECT * FROM wp_usermeta WHERE user_id = '".$_SESSION['userID']."' AND meta_key = 'wp_capabilities'";
    $result = mysqli_query($connWP, $sql);
    $row = $result -> fetch_assoc();
    
    $sellerPendingActivation = 0;
    if ($row['meta_value'] == 'a:1:{s:17:"dc_pending_vendor";b:1;}'){
        $sellerPendingActivation = 1;
    }
?>
 
<div class="heroImageBuyerDashboard">
    <div class="colorLayout">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h1>Welcome to you profile</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //print_r($_SESSION); ?>
<div class="container">
    <div class="row mt-5">
        <?php if ($success){ ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
        <?php } else if ($info) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $info; ?>
            </div>
       <?php } ?>
    </div>
    <div class="row mt-5">
        <div class="col-lg-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Account/Billing Details</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Add New Product</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-new-product" role="tab" aria-controls="v-pills-profile" aria-selected="false">My Products</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Resset Password</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Deactivate Account</a>
            </div>
        </div>
        <div class="col-lg-8 mx-auto">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <form>
                        <h2>Edit Account/Billing Details</h2>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" id="inputEmail4" value="<?php print_r($userInfo['user_email']); ?>" disabled placeholder="Email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">First Name</label>
                                <input type="text" class="form-control" id="" value="<?php print_r($userInfo_meta['first_name'][0]); ?>" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Last Name</label>
                                <input type="email" class="form-control" value="<?php print_r($userInfo_meta['last_name'][0]); ?>" id="inputEmail4" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Address</label>
                                <input type="text" class="form-control" id="inputAddress2" value="<?php print_r($userInfo_meta['billing_address_1'][0]); ?>"  placeholder="Apartment, studio, or floor">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Country</label>
                                <input type="text" class="form-control" id="inputAddress2" value="<?php print_r($userInfo_meta['billing_country'][0]); ?>" placeholder="Macedonia">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">City</label>
                                <input type="text" class="form-control" id="inputAddress2" value="<?php print_r($userInfo_meta['billing_city'][0]); ?>" placeholder="Skopje">
                            </div>
                        </div>
                        <div class="form-row mt-5">
                            <button type="submit" class="btn btn-primary loginBTN mx-auto">UPDATE</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <?php if ($sellerPendingActivation == 1) { ?>
                        <div class="alert alert-warning" role="alert">
                            Your account is still in review. Once your account is activated you will be able to post your products.
                        </div>
                    <?php } else { ?>
                        <form method="POST" enctype="multipart/form-data">
                            <h2>Add New Product</h2>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Product Name</label>
                                    <input type="text" class="form-control" name="productName" id="inputEmail4" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Product Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="product_description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAddress2">Regular price (€)</label>
                                    <input type="text" class="form-control" id="inputPrice" name="regularPrice" placeholder="e.g. 5.19" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress2">Sale price (€)</label>
                                    <input type="text" class="form-control" id="inputAddress2" placeholder="e.g. 2.10 or leave blank">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAddress2">Upload Product Image</label>
                                    
                                    <br>
                                    <div class="file-upload">
                                        <label for="upload" class="file-upload__label">Upload Product Picture</label>
                                        <input id="upload" name="image" class="file-upload__input" type="file">
                                        <input type="hidden" name="image_hiden" multiple="false" />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress2">Upload Product Image</label>
                                    
                                    <br>
                                    <div class="file-upload">
                                        <label for="uploadFile" class="file-upload__label">Upload Product Picture</label>
                                        <input id="uploadFile" name="product_file_custom" class="file-upload__input" type="file">
                                        <input type="hidden" name="product_file_hiden" multiple="false" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mt-5">
                                <button type="submit" name="addNewProduct" class="btn btn-primary loginBTN mx-auto">Submit for Review</button>
                            </div>
                        </form>
                    <?php } ?>
                </div>
                <div class="tab-pane fade" id="v-pills-new-product" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <?php if ($sellerPendingActivation == 1) { ?>
                        <div class="alert alert-warning" role="alert">
                            Your account is still in review. Once your account is activated you will be able to post your products.
                        </div>
                    <?php } else { ?>
                        <table class="table table-striped" id="example"></table>
                    <?php } ?>    
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">3</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">4</div>
            </div>
        </div>
    </div>
</div>

<?php
$sql = "SELECT * FROM wp_posts WHERE post_author = '".$_SESSION['userID']."' AND post_type = 'product'";
$result = mysqli_query($connWP, $sql);

while ($row = $result->fetch_assoc()) {
    $dbData[] = $row;
}

$dataJson = json_encode( $dbData ); ?>

<script>
jQuery(document).ready(function($){
  var dataSet = <?php echo $dataJson; ?>;
  var dataDB = [];
  
  Object.keys(dataSet).forEach(function(key) {
    dataDB.push(dataSet[key]);
  });
    $('#example').DataTable( {
        "data": dataDB,
        "columns": [
            { "title": "Product Title",
              "data": "post_title" },
            { "title": "Posted Date",
              "data": "post_date" },
            { "title": "Product Status",
              "data": "post_status" }
        ]
    } );
} );
</script>