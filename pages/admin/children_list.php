<!DOCTYPE html>
<?php
  require_once '../../config/config.php';
  
  $email = $_SESSION['email'];
  $role = $_SESSION['role']; 
  $last_name = $_SESSION['last_name']; 
  $fisrt_name = $_SESSION['first_name']; 
?>

<?php  
	$child = mysqli_query($conn,"SELECT * FROM children");
    $count_child = mysqli_num_rows($child);

    $user = mysqli_query($conn,"SELECT * FROM user");
    $count_user = mysqli_num_rows($user);

    $notification = mysqli_query($conn,"SELECT * FROM adoption_requests WHERE status = 'pending'");
    $count_notification = mysqli_num_rows($notification);
?>
<html lang="en">
<head>
   <?php
        include_once "includes/header.php"
   ?>
</head>

<body>
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
      <div class="row pt-5">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">TOTAL NUMBER OF CHILDREN:<b> <?php echo $count_child; ?> </b> </h5>
              <!-- Table with stripped rows -->
              <table class="table datatable table-bordered toggle-circle mb-0" id="demo-foo-filtering">
                <thead>
                  <tr>
                    <th>
                      <span class="text-underline">#</span>
                    </th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Parent Phone</th>
                    <th>Age</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      <?php $i=1; while ($row = mysqli_fetch_array($child)){ ?>
                    <td><?php echo $i++;  ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['guide']; ?></td>
                      <td><?php $dateFromMysql = $row['dob']; $year =  date("Y", strtotime($row['dob'])); $currentYear = date("Y"); $age = $currentYear - $year; ?>  <?php echo $age ?> yr old</td>
                    <td>
                      <a title="Click to edit the Student" href="child_details.php?id=<?php echo $row['child_id']; ?>">
                        <button class="btn btn-success btn-mk btn-sm" style="background-color:#27AE60 ; color:white"><i class="fa fa-search fa-lg"></i> View</button>
                      </a>
                      <?php if($role == "admin"){?>
                      <a title="Click to edit the Student" href="kids_update.php?id=<?php echo $row['child_id']; ?>">
                        <button class="btn btn-warning btn-mk btn-sm" style="background-color:#F4D03F; color:black" ><i class="fa fa-edit fa-lg"></i> Edit</button>
                      </a>
                      <a title="Click to edit the Student" href="delete_kids.php?id=<?php echo $row['child_id']; ?>">
                        <button class="btn btn-mk btn-sm" style="background-color:#E74C3C; color:white"><i class="fa fa-trash fa-lg" ></i> Delete</button>
                      </a>
                    <?php } ?>
                    <?php if($role == "parent"){?>
                      <a title="Click to adopt the Child" href="adopt_child_direct.php?id=<?php echo $row['child_id']; ?>">
                        <button class="btn btn-primary btn-mk btn-sm"><i class="fa fa-user-plus fa-lg"></i> Adopt</button>
                      </a>
                    <?php } ?>
                  </tr>
                  <?php }
                  ?>
                  </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
  </section>
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
  .btn-mk{
    padding: 6px 6px;
    font-size: 8px;
    border-radius: ;
   
  }

</style>
</html>

