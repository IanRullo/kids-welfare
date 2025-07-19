<!DOCTYPE html>
<?php
  require_once '../../config/config.php';

   // Make sure session is started
  $email = $_SESSION['email'];
  $role = $_SESSION['role']; 
  $last_name = $_SESSION['last_name']; 
  $first_name = $_SESSION['first_name']; 

  $user = mysqli_query($conn, "SELECT * FROM user");
  $count_user = mysqli_num_rows($user);

  $social_workers_admins_police = mysqli_query($conn, "SELECT * FROM user WHERE role IN ('social_worker', 'admin', 'police')");
  $count_sap = mysqli_num_rows($social_workers_admins_police);

  $parents = mysqli_query($conn, "SELECT * FROM user WHERE role = 'parent'");
  $count_parents = mysqli_num_rows($parents);

  $notification = mysqli_query($conn, "SELECT * FROM adoption_requests WHERE status = 'pending'");
  $count_notification = mysqli_num_rows($notification);
?>
<html lang="en">
<head>
   <?php
        include_once "includes/header.php";
   ?>
</head>

<body>
<!-- ======= Header ======= -->
<?php
  include_once "includes/navbar.php";
?>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<?php
  include_once "includes/side_nav.php";
?>
<!-- End Sidebar-->

<!-- Main -->
<main class="main" id="main">
<section class="section">
  <div class="row pt-5">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">TOTAL NUMBER OF USER: <b><?php echo $count_user; ?></b></h5>

          <!-- Table for Social Workers, Admins, and Police -->
          <h5 class="card-title">Social Workers, Admins, and Police: <b><?php echo $count_sap; ?></b></h5>
          <table class="table datatable table-bordered toggle-circle mb-0" id="demo-foo-filtering">
            <thead>
              <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; while ($row = mysqli_fetch_array($social_workers_admins_police)) { ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </td>
              <td>
                  <?php if ($role == "admin") { ?>
                  <a title="Click to edit the Student" href="kids_update.php?id=<?php echo $row['user_id']; ?>">
                    <button class="btn btn-warning btn-mk btn-sm" style="background-color:#F4D03F; color:black"><i class="fa fa-edit fa-lg"></i> Edit</button>
                  </a>
                  <a title="Click to delete the Student" href="deleteUser.php?id=<?php echo $row['user_id']; ?>">
                    <button class="btn btn-mk btn-sm" style="background-color:#E74C3C; color:white"><i class="fa fa-trash fa-lg"></i> Delete</button>
                  </a>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

          <!-- Table for Parents -->
          <h5 class="card-title">Parents: <b><?php echo $count_parents; ?></b></h5>
          <table class="table datatable table-bordered toggle-circle mb-0" id="demo-foo-filtering">
            <thead>
              <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; while ($row = mysqli_fetch_array($parents)) { ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td>
                <?php if ($role == "admin") { ?>
                  <a title="Click to edit the Student" href="kids_update.php?id=<?php echo $row['user_id']; ?>">
                    <button class="btn btn-warning btn-mk btn-sm" style="background-color:#F4D03F; color:black"><i class="fa fa-edit fa-lg"></i> Edit</button>
                  </a>
                  <a title="Click to delete the Student" href="deleteUser.php?id=<?php echo $row['user_id']; ?>">
                    <button class="btn btn-mk btn-sm" style="background-color:#E74C3C; color:white"><i class="fa fa-trash fa-lg"></i> Delete</button>
                  </a>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
</main>
<!-- End Main -->
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

<style>
  .btn-mk {
    padding: 6px 6px;
    font-size: 8px;
  }
</style>
</body>
</html>
