<?php
GLOBAL $conn;
GLOBAL $connWP;

if (isset($_POST['userRegisterBTN'])){
    // $sql = "SELECT * FROM seller_users WHERE email_address = '".$_POST['userEmailAddress']."'";
    // $result = mysqli_query($conn, $sql);

    // if ($result->num_rows == 1) {
    //     $info = "There is already user with this email address. Please <a href='/login'>login</a>";
    // } else {
    //     $pass = md5($_POST['userPasswordRetype']);
    //     $dateOfBirth = $_POST['userYear'].'-'.$_POST['userMonth'].'-'.$_POST['userDay'];
    //     $sql = "INSERT INTO seller_users (email_address, user_password, firstName, firstName date_of_birth, user_address, city, country, paypal_email) VALUES ('".$_POST['userEmailAddress']."', '".$pass."', '".$_POST['userFistName']."', '".$_POST['userLastName']."', '". $dateOfBirth ."', '".$_POST['userAddress']."', '".$_POST['userCity']."', '".$_POST['userCountry']."', '".$_POST['userEmailAddressPayPal']."')";
        
    //     if (mysqli_query($conn, $sql)) {
    //         header("Location: http://google.com");
    //     } else {
    //         $info = "There was some error. Please contact us on <a href='mailto:john@doe.com' class='alert-link'>john@doe.com</a>";
    //     }
    // }

    $sql = "SELECT * FROM wp_users WHERE user_email = '".$_POST['userEmailAddress']."'";
    $result = mysqli_query($connWP, $sql);

    if ($result->num_rows == 1) {
        $info = "There is already user with this email address. Please <a href='/login'>login</a>";
    } else {
        if ($_POST['userPasswordRetype'] == $_POST['userPassword']){
            $pass = md5($_POST['userPasswordRetype']);
            $dateOfBirth = $_POST['userYear'].'-'.$_POST['userMonth'].'-'.$_POST['userDay'];
            $sql = "INSERT INTO wp_users (user_login, user_pass, user_nicename, user_email, display_name) VALUES ('".$_POST['userFistName']."', '".$pass."', '".$_POST['userFistName']."', '".$_POST['userEmailAddress']."', '".$_POST['userFistName']."')";
            
            if (mysqli_query($connWP, $sql)) {
                header("Location: http://google.com");
            } else {
                $info = "There was some error. Please contact us on <a href='mailto:john@doe.com' class='alert-link'>john@doe.com</a>";
            }

            sleep(1);

            $sql = "SELECT * FROM wp_users WHERE user_email = '".$_POST['userEmailAddress']."'";
            $result = mysqli_query($connWP, $sql);
            $rezultat = $result -> fetch_assoc();
            $newUserID = $rezultat['ID']; 

            $sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('".$newUserID."', 'billing_email', '".$_POST['userEmailAddressPayPal']."')";
            $result = mysqli_query($connWP, $sql);

            $sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('".$newUserID."', 'first_name', '".$_POST['userFistName']."')";
            $result = mysqli_query($connWP, $sql);

            $sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('".$newUserID."', 'last_name', '".$_POST['userLastName']."')";
            $result = mysqli_query($connWP, $sql);
            
            $sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('".$newUserID."', 'nickname', '".$_POST['userFistName']."')";
            $result = mysqli_query($connWP, $sql);
            
            $sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('".$newUserID."', 'billing_first_name', '".$_POST['userFistName']."')";
            $result = mysqli_query($connWP, $sql);

            $sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('".$newUserID."', 'billing_last_name', '".$_POST['userLastName']."')";
            $result = mysqli_query($connWP, $sql);
            
            $sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('".$newUserID."', 'billing_address_1', '".$_POST['userAddress']."')";
            $result = mysqli_query($connWP, $sql);
            
            $sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('".$newUserID."', 'billing_city', '".$_POST['userCity']."')";
            $result = mysqli_query($connWP, $sql);
            
            $sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('".$newUserID."', 'billing_country', '".$_POST['userCountry']."')";
            $result = mysqli_query($connWP, $sql);
            
            $sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('".$newUserID."', 'wp_capabilities', 'a:1:{s:17:\"dc_pending_vendor\";b:1;}')";
            $result = mysqli_query($connWP, $sql);
            
            $dateOfBirth = $_POST['userYear'].'-'.$_POST['userMonth'].'-'.$_POST['userDay'];
            $sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('".$newUserID."', 'billing_email', '".$_POST['userEmailAddressPayPal']."')";
            $result = mysqli_query($connWP, $sql);

        } else {
            $info = "Password do not match!";
        }
        
    }
}
?>
<div class="container wrapCustom">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="formLogin">
                <div class="form-header-design">
                    <h3>Register as Seller</h3>
                </div>
                <div class="form-design">
                    <form action="" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" name="userEmailAddress" id="inputEmail4" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" name="userPassword" id="inputPassword4" placeholder="Password" required>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputPassword4reenter">Re-enter Password</label>
                            <input type="password" class="form-control" name="userPasswordRetype" id="inputPassword4reenter" placeholder="Password" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" name="userFistName" id="firstName" placeholder="First Name" required>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" name="userLastName" id="lastName" placeholder="Last Name" required>
                            </div>
                        </div>
                        <!-- <label>Date of Birth</label>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" name="userDay" id="inputPassword4" placeholder="DD" required>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" name="userMonth" id="monthBirth" placeholder="MM" required>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" name="userYear" id="yearBirth" placeholder="YYYY" required>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" name="userAddress" id="inputAddress" placeholder="1234 Main St" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                                <input type="text" class="form-control" name="userCity" id="inputCity" required>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputState">Country</label>
                            <select id="inputState" name="userCountry" class="form-control" required>
                                <option value="" selected="selected">Select Country</option> 
                                <option value="United States">United States</option> 
                                <option value="United Kingdom">United Kingdom</option> 
                                <option value="Afghanistan">Afghanistan</option> 
                                <option value="Albania">Albania</option> 
                                <option value="Algeria">Algeria</option> 
                                <option value="American Samoa">American Samoa</option> 
                                <option value="Andorra">Andorra</option> 
                                <option value="Angola">Angola</option> 
                                <option value="Anguilla">Anguilla</option> 
                                <option value="Antarctica">Antarctica</option> 
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option> 
                                <option value="Argentina">Argentina</option> 
                                <option value="Armenia">Armenia</option> 
                                <option value="Aruba">Aruba</option> 
                                <option value="Australia">Australia</option> 
                                <option value="Austria">Austria</option> 
                                <option value="Azerbaijan">Azerbaijan</option> 
                                <option value="Bahamas">Bahamas</option> 
                                <option value="Bahrain">Bahrain</option> 
                                <option value="Bangladesh">Bangladesh</option> 
                                <option value="Barbados">Barbados</option> 
                                <option value="Belarus">Belarus</option> 
                                <option value="Belgium">Belgium</option> 
                                <option value="Belize">Belize</option> 
                                <option value="Benin">Benin</option> 
                                <option value="Bermuda">Bermuda</option> 
                                <option value="Bhutan">Bhutan</option> 
                                <option value="Bolivia">Bolivia</option> 
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
                                <option value="Botswana">Botswana</option> 
                                <option value="Bouvet Island">Bouvet Island</option> 
                                <option value="Brazil">Brazil</option> 
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
                                <option value="Brunei Darussalam">Brunei Darussalam</option> 
                                <option value="Bulgaria">Bulgaria</option> 
                                <option value="Burkina Faso">Burkina Faso</option> 
                                <option value="Burundi">Burundi</option> 
                                <option value="Cambodia">Cambodia</option> 
                                <option value="Cameroon">Cameroon</option> 
                                <option value="Canada">Canada</option> 
                                <option value="Cape Verde">Cape Verde</option> 
                                <option value="Cayman Islands">Cayman Islands</option> 
                                <option value="Central African Republic">Central African Republic</option> 
                                <option value="Chad">Chad</option> 
                                <option value="Chile">Chile</option> 
                                <option value="China">China</option> 
                                <option value="Christmas Island">Christmas Island</option> 
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
                                <option value="Colombia">Colombia</option> 
                                <option value="Comoros">Comoros</option> 
                                <option value="Congo">Congo</option> 
                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
                                <option value="Cook Islands">Cook Islands</option> 
                                <option value="Costa Rica">Costa Rica</option> 
                                <option value="Cote D'ivoire">Cote D'ivoire</option> 
                                <option value="Croatia">Croatia</option> 
                                <option value="Cuba">Cuba</option> 
                                <option value="Cyprus">Cyprus</option> 
                                <option value="Czech Republic">Czech Republic</option> 
                                <option value="Denmark">Denmark</option> 
                                <option value="Djibouti">Djibouti</option> 
                                <option value="Dominica">Dominica</option> 
                                <option value="Dominican Republic">Dominican Republic</option> 
                                <option value="Ecuador">Ecuador</option> 
                                <option value="Egypt">Egypt</option> 
                                <option value="El Salvador">El Salvador</option> 
                                <option value="Equatorial Guinea">Equatorial Guinea</option> 
                                <option value="Eritrea">Eritrea</option> 
                                <option value="Estonia">Estonia</option> 
                                <option value="Ethiopia">Ethiopia</option> 
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
                                <option value="Faroe Islands">Faroe Islands</option> 
                                <option value="Fiji">Fiji</option> 
                                <option value="Finland">Finland</option> 
                                <option value="France">France</option> 
                                <option value="French Guiana">French Guiana</option> 
                                <option value="French Polynesia">French Polynesia</option> 
                                <option value="French Southern Territories">French Southern Territories</option> 
                                <option value="Gabon">Gabon</option> 
                                <option value="Gambia">Gambia</option> 
                                <option value="Georgia">Georgia</option> 
                                <option value="Germany">Germany</option> 
                                <option value="Ghana">Ghana</option> 
                                <option value="Gibraltar">Gibraltar</option> 
                                <option value="Greece">Greece</option> 
                                <option value="Greenland">Greenland</option> 
                                <option value="Grenada">Grenada</option> 
                                <option value="Guadeloupe">Guadeloupe</option> 
                                <option value="Guam">Guam</option> 
                                <option value="Guatemala">Guatemala</option> 
                                <option value="Guinea">Guinea</option> 
                                <option value="Guinea-bissau">Guinea-bissau</option> 
                                <option value="Guyana">Guyana</option> 
                                <option value="Haiti">Haiti</option> 
                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
                                <option value="Honduras">Honduras</option> 
                                <option value="Hong Kong">Hong Kong</option> 
                                <option value="Hungary">Hungary</option> 
                                <option value="Iceland">Iceland</option> 
                                <option value="India">India</option> 
                                <option value="Indonesia">Indonesia</option> 
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
                                <option value="Iraq">Iraq</option> 
                                <option value="Ireland">Ireland</option> 
                                <option value="Israel">Israel</option> 
                                <option value="Italy">Italy</option> 
                                <option value="Jamaica">Jamaica</option> 
                                <option value="Japan">Japan</option> 
                                <option value="Jordan">Jordan</option> 
                                <option value="Kazakhstan">Kazakhstan</option> 
                                <option value="Kenya">Kenya</option> 
                                <option value="Kiribati">Kiribati</option> 
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
                                <option value="Korea, Republic of">Korea, Republic of</option> 
                                <option value="Kuwait">Kuwait</option> 
                                <option value="Kyrgyzstan">Kyrgyzstan</option> 
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
                                <option value="Latvia">Latvia</option> 
                                <option value="Lebanon">Lebanon</option> 
                                <option value="Lesotho">Lesotho</option> 
                                <option value="Liberia">Liberia</option> 
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
                                <option value="Liechtenstein">Liechtenstein</option> 
                                <option value="Lithuania">Lithuania</option> 
                                <option value="Luxembourg">Luxembourg</option> 
                                <option value="Macao">Macao</option> 
                                <option value="North Macedonia">North Macedonia</option> 
                                <option value="Madagascar">Madagascar</option> 
                                <option value="Malawi">Malawi</option> 
                                <option value="Malaysia">Malaysia</option> 
                                <option value="Maldives">Maldives</option> 
                                <option value="Mali">Mali</option> 
                                <option value="Malta">Malta</option> 
                                <option value="Marshall Islands">Marshall Islands</option> 
                                <option value="Martinique">Martinique</option> 
                                <option value="Mauritania">Mauritania</option> 
                                <option value="Mauritius">Mauritius</option> 
                                <option value="Mayotte">Mayotte</option> 
                                <option value="Mexico">Mexico</option> 
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
                                <option value="Moldova, Republic of">Moldova, Republic of</option> 
                                <option value="Monaco">Monaco</option> 
                                <option value="Mongolia">Mongolia</option> 
                                <option value="Montserrat">Montserrat</option> 
                                <option value="Morocco">Morocco</option> 
                                <option value="Mozambique">Mozambique</option> 
                                <option value="Myanmar">Myanmar</option> 
                                <option value="Namibia">Namibia</option> 
                                <option value="Nauru">Nauru</option> 
                                <option value="Nepal">Nepal</option> 
                                <option value="Netherlands">Netherlands</option> 
                                <option value="Netherlands Antilles">Netherlands Antilles</option> 
                                <option value="New Caledonia">New Caledonia</option> 
                                <option value="New Zealand">New Zealand</option> 
                                <option value="Nicaragua">Nicaragua</option> 
                                <option value="Niger">Niger</option> 
                                <option value="Nigeria">Nigeria</option> 
                                <option value="Niue">Niue</option> 
                                <option value="Norfolk Island">Norfolk Island</option> 
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option> 
                                <option value="Norway">Norway</option> 
                                <option value="Oman">Oman</option> 
                                <option value="Pakistan">Pakistan</option> 
                                <option value="Palau">Palau</option> 
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
                                <option value="Panama">Panama</option> 
                                <option value="Papua New Guinea">Papua New Guinea</option> 
                                <option value="Paraguay">Paraguay</option> 
                                <option value="Peru">Peru</option> 
                                <option value="Philippines">Philippines</option> 
                                <option value="Pitcairn">Pitcairn</option> 
                                <option value="Poland">Poland</option> 
                                <option value="Portugal">Portugal</option> 
                                <option value="Puerto Rico">Puerto Rico</option> 
                                <option value="Qatar">Qatar</option> 
                                <option value="Reunion">Reunion</option> 
                                <option value="Romania">Romania</option> 
                                <option value="Russian Federation">Russian Federation</option> 
                                <option value="Rwanda">Rwanda</option> 
                                <option value="Saint Helena">Saint Helena</option> 
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                                <option value="Saint Lucia">Saint Lucia</option> 
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
                                <option value="Samoa">Samoa</option> 
                                <option value="San Marino">San Marino</option> 
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                                <option value="Saudi Arabia">Saudi Arabia</option> 
                                <option value="Senegal">Senegal</option> 
                                <option value="Serbia and Montenegro">Serbia and Montenegro</option> 
                                <option value="Seychelles">Seychelles</option> 
                                <option value="Sierra Leone">Sierra Leone</option> 
                                <option value="Singapore">Singapore</option> 
                                <option value="Slovakia">Slovakia</option> 
                                <option value="Slovenia">Slovenia</option> 
                                <option value="Solomon Islands">Solomon Islands</option> 
                                <option value="Somalia">Somalia</option> 
                                <option value="South Africa">South Africa</option> 
                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
                                <option value="Spain">Spain</option> 
                                <option value="Sri Lanka">Sri Lanka</option> 
                                <option value="Sudan">Sudan</option> 
                                <option value="Suriname">Suriname</option> 
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
                                <option value="Swaziland">Swaziland</option> 
                                <option value="Sweden">Sweden</option> 
                                <option value="Switzerland">Switzerland</option> 
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option> 
                                <option value="Taiwan, Province of China">Taiwan, Province of China</option> 
                                <option value="Tajikistan">Tajikistan</option> 
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
                                <option value="Thailand">Thailand</option> 
                                <option value="Timor-leste">Timor-leste</option> 
                                <option value="Togo">Togo</option> 
                                <option value="Tokelau">Tokelau</option> 
                                <option value="Tonga">Tonga</option> 
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option> 
                                <option value="Tunisia">Tunisia</option> 
                                <option value="Turkey">Turkey</option> 
                                <option value="Turkmenistan">Turkmenistan</option> 
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
                                <option value="Tuvalu">Tuvalu</option> 
                                <option value="Uganda">Uganda</option> 
                                <option value="Ukraine">Ukraine</option> 
                                <option value="United Arab Emirates">United Arab Emirates</option> 
                                <option value="United Kingdom">United Kingdom</option> 
                                <option value="United States">United States</option> 
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
                                <option value="Uruguay">Uruguay</option> 
                                <option value="Uzbekistan">Uzbekistan</option> 
                                <option value="Vanuatu">Vanuatu</option> 
                                <option value="Venezuela">Venezuela</option> 
                                <option value="Viet Nam">Viet Nam</option> 
                                <option value="Virgin Islands, British">Virgin Islands, British</option> 
                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
                                <option value="Wallis and Futuna">Wallis and Futuna</option> 
                                <option value="Western Sahara">Western Sahara</option> 
                                <option value="Yemen">Yemen</option> 
                                <option value="Zambia">Zambia</option> 
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row mb-5">
                        <div class="form-group col-md-12">
                                <label>PayPal Email Address</label>
                                <input type="email" class="form-control" name="userEmailAddressPayPal" id="payPalEmail" placeholder="john@doe.com" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck" required>
                                        <label class="form-check-label" for="gridCheck" >
                                            I have business PayPal account
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck" required>
                                        <label class="form-check-label" for="gridCheck" >
                                            I consent to terms and privacy policy
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($info){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $info; ?>
                            </div>
                        <?php } ?>
                        <button type="submit" name="userRegisterBTN" class="btn btn-primary loginBTN">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>