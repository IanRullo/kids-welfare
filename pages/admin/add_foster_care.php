<?php

require_once '../../config/config.php';

$email = $_SESSION['email'];
$role = $_SESSION['role']; 
$last_name = $_SESSION['last_name']; 
$first_name = $_SESSION['first_name'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch regions
$region_sql = "SELECT id, name FROM region ORDER BY name ASC";
$region_result = $conn->query($region_sql);

// Fetch districts
$district_sql = "SELECT id, name FROM district ORDER BY name ASC";
$district_result = $conn->query($district_sql);

// Fetch wards
$ward_sql = "SELECT id, name FROM ward ORDER BY name ASC";
$ward_result = $conn->query($ward_sql);

$notification = mysqli_query($conn,"SELECT * FROM adoption_requests WHERE status = 'pending'");
$count_notification = mysqli_num_rows($notification);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "includes/header.php"; ?>
</head>

<body>
    <?php include_once "includes/navbar.php"; ?>
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <?php include_once "includes/side_nav.php"; ?>
    <!-- End Sidebar-->
    <!--main-->
    <main class="main" id="main">
    <section class="section">
        <div class="row" style="margin-top: 15px">
            <div class="col-lg-12">
                <div class="card shadow p-2 mb-2 bg-white rounded">
                    <div class="card-body">
                        <h5 class="card-title pt-2">ADD FOSTERCARE</h5>

                        <center>
                            <?php if (isset($_SESSION['success'])) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"><?php echo $_SESSION['success']; ?></i>
                                </div>
                                <?php unset($_SESSION['success']); } ?>

                            <?php if (isset($_SESSION['error'])) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-octagon me-1"><?php echo $_SESSION['error']; ?></i>
                                </div>
                                <?php unset($_SESSION['error']); } ?>
                        </center>

                        <!-- Browser Default Validation -->
                        <form class="row g-3" autocomplete="off" action="actions/add_fostercare_action.php" method="POST" enctype="multipart/form-data">
                            <div class="col-md-4">
                                <label class="form-label">Foster Name</label>
                                <input type="text" class="form-control" name="foster_name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Region</label>
                                <select class="form-control" name="region" required>
                                    <?php while ($row = $region_result->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">District</label>
                                <select class="form-control" name="district" required>
                                    <?php while ($row = $district_result->fetch_assoc()) { ?>
                                        <option><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Ward</label>
                                <select class="form-control" name="ward" required>
                                    <?php while ($row = $ward_result->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Foster Start Date</label>
                                <input type="date" class="form-control" name="foster_start_date" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Foster End Date (Optional)</label>
                                <input type="date" class="form-control" name="foster_end_date">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Child ID (Optional)</label>
                                <input type="number" class="form-control" name="child_id">
                            </div>
                            <center>
                                <div class="col-12">
                                    <button class="btn btn-success btn-lg bi bi-sd-card-fill" type="submit" name="submit"> Save</button>
                                </div>
                            </center>
                        </form>
                        <!-- End Browser Default Validation -->
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
</html>
