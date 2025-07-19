<?php
  include '../connection/conn.php';
  
  $email = $_SESSION['email'];
  $role = $_SESSION['role']; 
  $last_name = $_SESSION['last_name']; 
  $fisrt_name = $_SESSION['first_name']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php
        include_once "config/header.php"
   ?>
</head>
<body>
<!-- ======= Header ======= -->
<?php
  include_once "config/nav.php"
?>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<?php
  include_once "config/sidenav.php"
?>
<!-- End Sidebar-->

<!--main-->
<main class="main" id="main">
<section class="section">
      <div class="row" style="margin-top:15px">
      
          <?php 
              $id = $_GET['id'];
              $id = $conn->real_escape_string($id); // Sanitize input to prevent SQL injection

              $sql = "SELECT * FROM children WHERE child_id = $id";
              $result= $conn->query($sql);

              $i=1; while ($row = mysqli_fetch_array($result)) 
          {?> 
        <div class="col-lg-12">
          <div class="card shadow p-3 mb-5 bg-white rounded">
            <div class="card-body">
              <h5 class="card-title"> EDIT CHILD DETAILS</h5>

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
              <form class="row g-3" autocomplete="off" action="kids_update_action.php" method="POST" enctype="multipart/form-data">
                <div class="col-md-4">
                  <label class="form-label">First name</label>
                  <input type="text" class="form-control"  name="fname" value="<?php echo $row['first_name']; ?>" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Last name</label>
                  <input type="text" class="form-control"  name="lname" value="<?php echo $row['last_name']; ?>" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Gender</label>
                  <select class="form-select" name="gender"  required>
                    <option><?php echo $row['gender']; ?></option>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Date of birth</label>
                  <input type="date" class="form-control"  name="dob" value="<?php echo $row['dob']; ?>" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Address</label>
                  <input type="text" class="form-control"  name="address" value="<?php echo $row['address']; ?>" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Guide or Relative Phone number</label>
                  <input type="phone" class="form-control"  name="guide" value="<?php echo $row['guide']; ?>" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">  School Name</label>
                  <input type="text" class="form-control"  name="sname" value="<?php echo $row['school_name']; ?>">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Class Level</label>
                  <input type="text" class="form-control"  name="clevel" value="<?php echo $row['class_level']; ?>">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Passport</label>
                  <input type="file" name="file" id="file" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Report</label>
                  <textarea type="textarea" class="form-control"  name="report" required><?php echo $row['report']; ?></textarea>
                </div>
                <center>
                <div class="col-12">
                  <button class="btn btn- btn-success btn-lg bi bi-sd-card-fill" type="submit" name="submit"> Save Change</button>
                </div>
                </center>
              </form>
              <!-- End Browser Default Validation -->

            </div>
          </div>
          <?php }
			?>

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
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
    
</body>
<style>
  .btn-mk{
    padding: 6px 6px;
    font-size: 8px;
    border-radius: ;
   
  }
</style>
</html>

