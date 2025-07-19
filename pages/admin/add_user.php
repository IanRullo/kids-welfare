<!DOCTYPE html>
<?php
  require_once '../../config/config.php';
    $email = $_SESSION['email'];
    $role = $_SESSION['role']; 
    $last_name = $_SESSION['last_name']; 
    $fisrt_name = $_SESSION['first_name']; 

    $notification = mysqli_query($conn,"SELECT * FROM adoption_requests WHERE status = 'pending'");
    $count_notification = mysqli_num_rows($notification);
?>
<html lang="en">
<head>
<?php
  include_once "includes/header.php"
?>
</head>

<body style="background-color: #fff">
<!-- ======= Header ======= -->
<?php
  include_once "includes/navbar.php"
?>
<!-- End Header -->
<!-- ======= Sidebar ======= -->
<?php
  include_once "includes/side_nav.php"
?>
<!-- End Sidebar-->
<!--main-->
<main class="main" id="main">
<section class="section">
      <div class="row" style="margin-top:15px">
        <div class="col-lg-12">
          <div class="card shadow p-2 mb-2 bg-white rounded">
            <div class="card-body">
              <h5 class="card-title pt-2"> ADD USER </h5>

              <center>
                <?php if (isset($_SESSION['success'])){?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2">
                          <?php echo $_SESSION['success'] ?></i>
                      </div>
                <?php unset($_SESSION['success']); }?>

                <?php if (isset($_SESSION['login_error'])){?>
		                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1">
		                    <?php echo $_SESSION['error'] ?></i>
		                </div>
                <?php unset($_SESSION['error']); }?>
              </center>

             
              <!-- Browser Default Validation -->
              <form class="row g-3" autocomplete="off" action="actions/add_user_action.php" method="POST">
                <div class="col-md-4">
                  <label class="form-label">First name</label>
                  <input type="text" class="form-control"  name="firstname" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Last name</label>
                  <input type="text" class="form-control"  name="lastname" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Gender</label>
                  <select name="gender" class="form-control" required="gender">
                  <option value="">---Select Gender---</option>
					<option value="female">Female</option>
						<option value="male">Male</option>
					</select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control"  name="email" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Phone Number</label>
                  <input type="tel" class="form-control"  name="mobile" id="mobile" placeholder="Eg: 0686xxx..." pattern="[0-9]{10}" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control"  name="password"  required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">ROLE</label>
                  <select name="role" class="form-control">
                    <option value="">---Select Role---</option>
					<option value="admin">Admin</option>
					<option value="parent">Parent</option>
                    <option value="police">Police</option>
					<option value="social_worker">Social Worker</option>
					</select>
                </div>
                <center>
                <div class="col-12">
                  <button class="btn btn- btn-success btn-lg bi bi-sd-card-fill" type="submit" name="submit"> Save</button>
                </div>
                </center>
              </form>
              <!-- End Browser Default Validation -->

            </div>
          </div>

        </div>
</main>
<!-- End #main -->
     <!-- logout script after 60sec -->
     <script>
    let timer;

    function resetTimer() {
        clearTimeout(timer);
        timer = setTimeout(() => {
            window.location.href = "../../auth/logout.php";
        }, 60000); // 60 seconds
    }

    // Events that reset the timer
    window.onload = resetTimer;
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;
  </script>

<!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.min.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script> 
</body>
<style>
</style>
</html>
