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
<!-- Include header.php: useful for meta tags, stylesheets, or scripts -->
<?php include_once "includes/header.php"; ?>
</head>

<body style="background-color: #fff">

<!-- Include navbar.php:  -->
<?php
  include_once "includes/navbar.php"
?>

<!-- Include sidenav.php:  -->
<?php
  include_once "includes/side_nav.php"
?>

<!--main-->
<main class="main" id="main">
<section class="section">
      <div class="row" style="margin-top:15px">
        <div class="col-lg-12">
          <div class="card shadow p-2 mb-2 bg-white rounded">
            <div class="card-body">
              <h5 class="card-title pt-2"> ADD CHILDREN </h5>

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
              <form class="row g-3" autocomplete="off" action="actions/add_child_action.php" method="POST" enctype="multipart/form-data">
                <div class="col-md-4">
                  <label class="form-label">First name</label>
                  <input type="text" class="form-control"  name="fname" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Last name</label>
                  <input type="text" class="form-control"  name="lname" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Gender</label>
                  <select name="gender" class="form-control" required="gender">
										<option value="female">Female</option>
										<option value="male">Male</option>
									</select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Date of birth</label>
                  <input type="date" class="form-control"  name="dob" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Address</label>
                  <input type="text" class="form-control"  name="address" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Guide or Relative Phone number</label>
                  <input type="phone" class="form-control"  name="guide" placeholder="Eg: 0686xxx..." required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">  School Name</label>
                  <input type="text" class="form-control"  name="sname">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Class Level</label>
                  <input type="text" class="form-control"  name="clevel">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Passport</label>
                  <input type="file" name="file" id="file" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Report</label>
                  <textarea type="textarea" class="form-control"  name="report" required></textarea>
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
