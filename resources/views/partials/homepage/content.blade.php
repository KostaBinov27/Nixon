<div class="heroImage">
    <div class="colorLayout">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h1>Shopping online feels easeier and more fun</h1>
                    <p>Nixon is an online buying and selling site that has millions of online stores and sells various kinds of products to meet your needs.</p>
                    <a href="<?php echo get_site_url(); ?>/shop"><button type="button" class="btn btn-primary btnHero">SHOP</button></a>
                </div>
                <!-- <div class="col-lg-8"> -->
                    <!-- <img src="<?php// echo get_site_url(); ?>/wp-content/uploads/2019/12/headerImage.png" class="img-fluid"> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>


<?php

$query = new WC_Product_Query( array(
    'limit' => 4,
    'return' => 'ids'
) );
$products = $query->get_products(); ?>
<div class="container">
    <h2 class="text-center mt-5 packageText mb-5">See What is New</h2>
    <div class="row">
        <div class="woocommerce homepage">
            <ul class="products columns-4">
                <?php
                foreach ($products as $product){ ?>
                    <li class="product type-product post-<?php echo $product ?>">
                        <a href="<?php echo get_permalink( $product ); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                            <?php echo get_the_post_thumbnail( $product,  array(300,300) ); ?>
                            <h2 class="woocommerce-loop-product__title"><?php echo get_the_title($product); ?></h2>
                        </a>
                        <div class="buttonWrapHomepage">
                            <a href="<?php echo get_permalink( $product ); ?>">
                                <button type="button" class="btn btn-primary btnHomeBuyNow">Buy Now</button>
                            </a>
                        </div>
                    </li>
                <?php
                } ?>
            </ul>
        </div>
    </div>
</div>

<div class="container d-none">
    <h2 class="text-center mt-5 packageText">Find your perfect package</h2>
    <div class="row mt-5">
        <div class="col-lg-4 mx-auto">
            <div class="card profile-card-3">
                <div class="background-block">
                    <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2019/12/photo-1486406146926-c627a92ad1ab.jpg" alt="profile-sample1" class="background">
                </div>
                <div class="profile-thumb-block">
                    <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="profile-image" class="profile">
                </div>
                <div class="card-content">
                <h2>Wnat to Sell?<small></small></h2>
                    <div class="icon-block">
                        <a href="#"><button type="button" class="btn btn-primary btnCards">Register as Seller</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mx-auto">
            <div class="card profile-card-3">
                <div class="background-block">
                    <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2019/12/Texas-Buildings-Wallpaper.jpg" alt="profile-sample1" class="background">
                </div>
                <div class="profile-thumb-block">
                    <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="profile-image" class="profile">
                </div>
                <div class="card-content">
                <h2>Wnat to Buy?<small></small></h2>
                    <div class="icon-block">
                        <a href="#"><button type="button" class="btn btn-primary btnCards">Register as Customer</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>