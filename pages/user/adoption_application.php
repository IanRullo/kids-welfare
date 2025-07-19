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
<div class="container d-flex justify-content-center" style="margin-top: 6rem">
        <div class="w-75" id="dashboardSection">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg p-2 text-center">
                        <h4>Welcome, <?php echo $fisrt_name . " " . $last_name; ?> </h4>
                        <p>Manage your adoption process easily.</p>
                        <button class="btn btn w-100" id="openAdoption" style="background-color: #89CFF0;">Adoption Application</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center" id="adoptionSteps" style="display: none;">
            <div class="col-md-12">
                <div class="card shadow-lg p-1 text-center">
                    <h4 class="text-center">Adoption Process Steps</h4>
                    <ul class="list-group mt-3">
                        <li class="list-group-item d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-check-fill step-icon me-3"></i>
                            Step 1: Fill Personal Information
                        </li>
                        <li class="list-group-item d-flex align-items-center justify-content-center">
                            <i class="bi bi-file-earmark-arrow-up-fill step-icon me-3"></i>
                            Step 2: Upload Required Documents
                        </li>
                        <li class="list-group-item d-flex align-items-center justify-content-center">
                            <i class="bi bi-send-fill step-icon me-3"></i>
                            Step 3: Submit Application for Review
                        </li>
                        <li class="list-group-item d-flex align-items-center justify-content-center">
                            <i class="bi bi-shield-check step-icon me-3"></i>
                            Step 4: Await Approval and Final Verification
                        </li>
                    </ul>
                    <a href="children_list.php" class="btn btn mt-3 w-100" style="background-color: #89CFF0;">Start Adoption Process</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#openAdoption").click(function() {
                $("#dashboardSection").hide();
                $("#adoptionSteps").fadeIn();
            });
        });
    </script>

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
<style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .step-icon {
            font-size: 3rem;
            color: #007bff;
        }
    </style>
</html>
