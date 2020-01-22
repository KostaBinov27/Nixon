<?php
GLOBAL $conn;
GLOBAL $connWP;

    if (isset($_POST['login_seller'])) {
        $sql = "SELECT * FROM wp_users WHERE user_email = '".$_POST['emailSeller']."'";
        $result = mysqli_query($connWP, $sql);
        if ($result->num_rows == 1) {
            $rezultat = $result -> fetch_assoc();
            $_SESSION['userID'] = $rezultat['ID'];
            $_SESSION['userName'] = $rezultat['display_name'];
            $_SESSION['loggedIn'] = 1;
            $_SESSION['userEmail'] = $rezultat['user_email'];
            header('Location: http://localhost/nixon/seller-dashboard/');
        }
    }
?>

<div class="container wrapCustom">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="formLogin">
                <div class="form-header-design">
                    <h3>Login</h3>
                </div>
                <div class="form-design">
                    <form method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="emailSeller" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password_seller" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <a href="#" class="txt1">Forgot Password?</a>
                        </div>
                        <button type="submit" name="login_Client" name="login_seller" class="btn btn-primary loginBTN">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>