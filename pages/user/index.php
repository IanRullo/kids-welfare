<?php
require_once '../../config/config.php';

$email = $_SESSION['email'] ?? '';
$role = $_SESSION['role'] ?? '';
$last_name = $_SESSION['last_name'] ?? '';
$first_name = $_SESSION['first_name'] ?? '';
$user_id = $_SESSION['user_id'] ?? 0;

// Count queries
$child = mysqli_query($conn, "SELECT * FROM children");
$count_child = mysqli_num_rows($child);

$user = mysqli_query($conn, "SELECT * FROM user");
$count_user = mysqli_num_rows($user);

$fostercare = mysqli_query($conn, "SELECT * FROM fostercare");
$count_fostercare = mysqli_num_rows($fostercare);

$notification = mysqli_query($conn, "SELECT * FROM adoption_requests WHERE status = 'pending'");
$count_notification = mysqli_num_rows($notification);

$notifications = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id = '$user_id'");
$count_notifications = mysqli_num_rows($notifications);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once "includes/header.php"; ?>
</head>
<body style="background-color: #fff">

<!-- Header -->
<?php include_once "includes/navbar.php"; ?>

<!-- Sidebar -->
<?php include_once "includes/side_nav.php"; ?>

<!-- Main Content -->
<?php echo "<!-- DEBUG USER ID: $user_id -->"; ?>

<?php include_once "includes/home.php"; ?>

<!-- Footer / Scripts -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>

<script>
const searchForm = document.getElementById('searchForm');
const searchInput = document.getElementById('searchInput');
const searchResults = document.getElementById('searchResults');

searchInput?.addEventListener('input', function() {
  const formData = new FormData(searchForm);
  fetch('search.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    searchResults.innerHTML = data;
  })
  .catch(error => {
    console.error('Error:', error);
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