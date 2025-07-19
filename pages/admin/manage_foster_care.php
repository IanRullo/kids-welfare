<!DOCTYPE html>
<?php
  require_once '../../config/config.php';

   // Make sure session is started
  $email = $_SESSION['email'];
  $role = $_SESSION['role']; 
  $last_name = $_SESSION['last_name']; 
  $first_name = $_SESSION['first_name']; 

  $child = mysqli_query($conn, "SELECT * FROM children");
  $count_child = mysqli_num_rows($child);

  $fostercare = mysqli_query($conn, "SELECT * FROM fostercare");
  $count_fostercare = mysqli_num_rows($fostercare);

  $allocation = mysqli_query($conn, 
    "SELECT a.allocation_id, c.first_name AS child_first_name, c.last_name AS child_last_name, 
            c.gender, c.dob, c.address, f.foster_name, f.region, f.district, f.ward, a.allocation_date 
     FROM allocations a 
     JOIN fostercare f ON a.foster_id = f.foster_id 
     JOIN children c ON a.child_id = c.child_id");

  $count_allocation = mysqli_num_rows($allocation);
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
          <h5 class="card-title">TOTAL NUMBER OF CHILDREN: <b><?php echo $count_child; ?></b></h5>

          <!-- Table for Fostercare -->
          <h5 class="card-title">Fostercare: <b><?php echo $count_fostercare; ?></b></h5>
          <table class="table datatable table-bordered toggle-circle mb-0" id="demo-foo-filtering">
            <thead>
              <tr>
                <th>#</th>
                <th>Foster Name</th>
                <th>Region</th>
                <th>District</th>
                <th>Ward</th>
                <th>Foster Start Date</th>
                <th>Foster End Date</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; while ($row = mysqli_fetch_array($fostercare)) { ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['foster_name']; ?></td>
                <td><?php echo $row['region']; ?></td>
                <td><?php echo $row['district']; ?></td>
                <td><?php echo $row['ward']; ?></td>
                <td><?php echo $row['foster_start_date']; ?></td>
                <td><?php echo $row['foster_end_date']; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

          <!-- Table for Allocation -->
          <h5 class="card-title">Allocations: <b><?php echo $count_allocation; ?></b></h5>
          <table class="table datatable table-bordered toggle-circle mb-0" id="demo-foo-filtering">
            <thead>
              <tr>
                <th>#</th>
                <th>Child First Name</th>
                <th>Child Last Name</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Address</th>
                <th>Foster Name</th>
                <th>Region</th>
                <th>District</th>
                <th>Ward</th>
                <th>Allocation Date</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; while ($row = mysqli_fetch_array($allocation)) { ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['child_first_name']; ?></td>
                <td><?php echo $row['child_last_name']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['dob']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['foster_name']; ?></td>
                <td><?php echo $row['region']; ?></td>
                <td><?php echo $row['district']; ?></td>
                <td><?php echo $row['ward']; ?></td>
                <td><?php echo $row['allocation_date']; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

          <!-- Count of Children in Foster Care by Region -->
          <?php
            $region_counts = mysqli_query($conn, 
              "SELECT f.region, COUNT(*) AS child_count 
               FROM fostercare f 
               JOIN allocations a ON f.foster_id = a.foster_id 
               GROUP BY f.region");
          ?>
          <h5 class="card-title">Number of Children in Foster Care by Region</h5>
          <table class="table datatable table-bordered toggle-circle mb-0" id="demo-foo-filtering">
            <thead>
              <tr>
                <th>Region</th>
                <th>Number of Children</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_array($region_counts)) { ?>
              <tr>
                <td><?php echo $row['region']; ?></td>
                <td><?php echo $row['child_count']; ?></td>
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
