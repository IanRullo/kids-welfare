<?php

$user_id = $_SESSION['user_id'] ?? 0;
$role = $_SESSION['role'] ?? '';
$first_name = $_SESSION['first_name'] ?? '';
$last_name = $_SESSION['last_name'] ?? '';
?>

<?php

if ($role == "parent") {

  $user_id = $_SESSION['user_id'];

  // Mark single notification as read if POST
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notif_id'])) {
    $notif_id = $_POST['notif_id'];
    $stmt = $conn->prepare("UPDATE notifications SET status = 'read' WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $notif_id, $user_id);
    $stmt->execute();
    exit;
  }

  // Count unread notifications
  $notificationQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM notifications WHERE user_id = '$user_id' AND status = 'unread'");
  $notifData = mysqli_fetch_assoc($notificationQuery);
  $notifCount = $notifData['total'] ?? 0;
?>
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <i class="fa fa-child fa-2x fa-fw ps-1" style="color: black;"></i>
    <a href="index.php" class="logo d-flex align-items-center">
      <span class="d-none d-lg-block" style="color: black;">Kids Welfare</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn" style="color:black;"></i>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <!-- Notifications -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon pe-1" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell" style="font-size: 1.5rem; color: black;"></i>
          <?php if ($notifCount > 0): ?>
            <span class='badge bg-danger badge-number m-2'><?= $notifCount ?></span>
          <?php endif; ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            You have <?= $notifCount ?> unread notification(s)
          </li>
          <li><hr class="dropdown-divider"></li>
          <?php
          $notifList = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id = '$user_id' ORDER BY created_at DESC LIMIT 5");
          if (mysqli_num_rows($notifList) > 0) {
            while ($row = mysqli_fetch_assoc($notifList)) {
              $notifId = $row['id'];
              $message = htmlspecialchars($row['message'], ENT_QUOTES);
              $createdAt = $row['created_at'];
              $isUnread = $row['status'] === 'unread' ? "fw-bold" : "";
              echo "
              <li class='notification-item $isUnread' data-id='{$notifId}' data-message=\"{$message}\">
                <i class='bi bi-info-circle text-primary'></i>
                <div>
                  <h6 class='$isUnread'>{$row['message']}</h6>
                  <p><small class='text-muted'>{$createdAt}</small></p>
                </div>
              </li>
              <hr class='dropdown-divider'>";
            }
          } else {
            echo "<li class='dropdown-item text-center text-muted'>No recent notifications</li>";
          }
          ?>
          <li class="dropdown-footer">
            <a href="../includes/manage_request.php">View All Notifications</a>
          </li>
        </ul>
      </li>

      <!-- Profile -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon pe-4" href="#" data-bs-toggle="dropdown">
          <img src="../assets/img/users.png" class="rounded-circle" style="width:30px; height:30px;">
          <span class="text-uppercase" style="color: black;"><strong><?= htmlspecialchars($role); ?></strong></span>
          <i class="bi bi-chevron-down ms-auto" style="color: black;"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li>
            <a class="dropdown-item d-flex align-items-center">
              <i class="bi bi-person-fill"></i>
              <span><?= htmlspecialchars($first_name . " " . $last_name); ?></span>
            </a>
          </li>
          <hr class="dropdown-divider">
          <li>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <i class="bi bi-lock-fill"></i>
              <span>Change Password</span>
            </a>
          </li>
          <hr class="dropdown-divider">
          <li>
            <a class="dropdown-item d-flex align-items-center" href="/kids/auth/logout.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</header>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll(".notification-item").forEach(item => {
  item.addEventListener("click", function () {
    const notifId = this.getAttribute("data-id");
    const message = this.getAttribute("data-message");

    Swal.fire({
      title: 'Notification',
      text: message,
      icon: 'info',
      confirmButtonText: 'OK',
      confirmButtonColor: '#3085d6'
    }).then(() => {
      fetch(window.location.href, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `notif_id=${notifId}`
      }).then(() => {
        location.reload(); // Refresh to update the badge count
      });
    });
  });
});
</script>
<?php } ?>