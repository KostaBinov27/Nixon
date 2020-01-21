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

<div class="container">
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
                                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">First Name</label>
                                <input type="text" class="form-control" id="" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Last Name</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Address</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Date of Birth</label>
                                <input type="date" class="form-control" id="inputAddress2" placeholder="27.11.1980">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Country</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Macedonia">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">City</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Skopje">
                            </div>
                        </div>
                        <div class="form-row mt-5">
                            <button type="submit" class="btn btn-primary loginBTN mx-auto">UPDATE</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <form>
                        <h2>Add New Product</h2>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Product Name</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="" required>
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
                                <input type="text" class="form-control" id="inputAddress2" placeholder="e.g. 5.19" required>
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
                                    <label for="upload" class="file-upload__label">Css only file upload button</label>
                                    <input id="upload" class="file-upload__input" type="file" name="file-upload">
                                </div>
                            </div>
                            <!-- <div class="form-group col-md-6">
                                <label for="inputAddress2">Sale price (€)</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="e.g. 2.10 or leave blank">
                            </div> -->
                        </div>
                        <div class="form-row mt-5">
                            <button type="submit" class="btn btn-primary loginBTN mx-auto">Submit for Review</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="v-pills-new-product" role="tabpanel" aria-labelledby="v-pills-settings-tab">New Product</div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">3</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">4</div>
            </div>
        </div>
    </div>
</div>