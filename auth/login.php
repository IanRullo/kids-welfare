
<div id="login" class="row d-flex justify-content-center mt-5">
    <div class="col-md-4 pt-5">
        <div class="card" style="box-shadow:10px 10px 35px #888888;">
            <div class="card-body text-center">

                <!-- General Error Message -->
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php } ?>

                <!-- Success Message -->
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php } ?>

                <!-- Login Error -->
                <?php if (isset($_SESSION['login_error'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        <?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
                    </div>
                <?php } ?>

                <!-- Login Form -->
                <form method="POST" action="auth/server.php" autocomplete="off">
                    <div class="form-group mb-3 position-relative">
                        <input type="email" name="email" placeholder="Enter Email" class="form-control" required>
                        <i class="fa fa-envelope fa-lg fa-fw position-absolute" style="right: 10px; top: 10px;" aria-hidden="true"></i>
                    </div>
                    <div class="form-group mb-3 position-relative">
                        <input type="password" name="password" placeholder="Enter Password" class="form-control" required>
                        <i class="fa fa-key fa-lg fa-fw position-absolute" style="right: 10px; top: 10px;" aria-hidden="true"></i>
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" name="login" value="LOGIN" class="btn btn-block" style="background-color:cornflowerblue; color:white">
                    </div>

                    <div class="form-group">
                        Don't have an account? <a href="registration.php" style="color: dodgerblue;">Sign Up</a>
                    </div>
                    <div class="text-center">
                        <a href="#" style="color: dodgerblue;">Forgot your password?</a>
                    </div>
                </form>
                <!-- End Form -->

            </div>
        </div>
    </div>
</div>
