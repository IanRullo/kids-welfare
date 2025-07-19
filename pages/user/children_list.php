<!DOCTYPE html>
<?php

include '../../config/config.php';

    $email = $_SESSION['email'];
    $role = $_SESSION['role']; 
    $last_name = $_SESSION['last_name']; 
    $fisrt_name = $_SESSION['first_name']; 

    
    $notification = mysqli_query($conn,"SELECT * FROM adoption_requests WHERE status = 'pending'");
    $count_notification = mysqli_num_rows($notification);


if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || !isset($_SESSION['last_name']) || !isset($_SESSION['first_name'])) {
    echo "Please log in first.";
    exit();
}

// Fetch the list of children available for adoption
$query = "SELECT 
            children.child_id,
            children.first_name, 
            children.last_name, 
            children.gender, 
            children.dob, 
            children.file, 
            children.address,
            children.guide,
            children.available_for_adoption,
            fostercare.foster_name AS name, 
            fostercare.region, 
            fostercare.district,
            fostercare.ward
          FROM 
            children
          JOIN 
            allocations ON children.child_id = allocations.child_id
          JOIN 
            fostercare ON allocations.foster_id = fostercare.foster_id
          WHERE 
            children.available_for_adoption = 'Yes'";

$child_result = mysqli_query($conn, $query);
$count_child = mysqli_num_rows($child_result);

?>
<html lang="en">
<head>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<?php include_once "includes/navbar.php" ?>
<?php include_once "includes/side_nav.php" ?>

<main class="main" id="main">
    <section class="section">
        <div class="row pt-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">TOTAL NUMBER OF CHILDREN:<b> <?php echo $count_child; ?> </b> </h5>
                        <?php if (isset($_SESSION['success'])){?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2">
                          <?php echo $_SESSION['success'] ?></i>
                      </div>
                <?php unset($_SESSION['success']); }?>
                        <table class="table datatable table-bordered toggle-circle mb-0" id="demo-foo-filtering">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <!-- <th>Last Name</th> -->
                                <!-- <th>Gender</th> -->
                                <th>Dob</th>
                                <th>Fostercare</th>
                                <th>Region</th>
                                <th>District</th>
                                <!-- <th>Ward</th> -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; while ($row = mysqli_fetch_array($child_result)) { ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <!-- <td><?php echo $row['last_name']; ?></td> -->
                                    <!-- <td><?php echo $row['gender']; ?></td> -->
                                    <td><?php echo $row['dob']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['region']; ?></td>
                                    <td><?php echo $row['district']; ?></td>
                                    <!-- <td><?php echo $row['ward']; ?></td> -->
                                    <td><?php echo $row['available_for_adoption']; ?></td>
                                    <td>
                                    
                                       <a title="Click to edit the Student" href="child_details.php?id=<?php echo $row['child_id']; ?>">
                                          <button class="btn btn-success btn-mk btn-sm" style="background-color:#27AE60 ; color:white"><i class="fa fa-search fa-lg"></i> View</button>
                                       </a>
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
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
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
        border-radius: 4px;
    }
</style>
</body>
</html>
