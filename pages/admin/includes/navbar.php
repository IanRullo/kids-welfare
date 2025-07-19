<?php

$user_id = $_SESSION['user_id'] ?? 0;
$role = $_SESSION['role'] ?? '';
$first_name = $_SESSION['first_name'] ?? '';
$last_name = $_SESSION['last_name'] ?? '';
?>

<?php if ($role == "admin") { ?>

<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <i class="fa fa-child fa-2x fa-fw ps-1" style="color: black;"></i>
    <a href="index.php" class="logo d-flex align-items-center">
      <img src="" alt=""  class="me-2">
      <span class="d-none d-lg-block fw-bold" style="color: black;">Kids Welfare</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn" style="color:black;"></i>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <!-- Notifications -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell-fill" style="color: black"></i>
          <span class="badge m-2 badge-number bg-primary">
            <?php
              $notificationQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM adoption_requests WHERE status = 'pending'");
              $count_notificationQuery = mysqli_fetch_assoc($notificationQuery);
              echo $count_notificationQuery['total'] ?? 0;
              
            ?>
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            <?php if (($count_notificationQuery['total'] ?? 0) == 0) { ?>
              <li class="dropdown-item text-center">
                <i class="bi bi-exclamation-circle text-warning"></i> No notifications
              </li>
            <?php } else { ?>
              <i class="bi bi-bell text-primary"></i> You have <?php echo $count_notificationQuery['total']; ?> adoption request(s)

              <li class="dropdown-footer text-center">
                <a href="notification.php">
                  <span class="badge rounded-pill p-2 bg-primary">View All</span>
                </a>
              </li>
            <?php } ?>
          </li>
        </ul>
      </li>

      <!-- Profile -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon pe-4" href="#" data-bs-toggle="dropdown">
          <img src="../assets/img/users.png" class="rounded-circle" style="width:30px; height:30px;">
          <span class="text-uppercase" style="color: black;"><strong><?php echo $role; ?></strong></span>
          <i class="bi bi-chevron-down ms-auto" style="color: black;"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li>
            <a class="dropdown-item d-flex align-items-center">
              <i class="bi bi-person-fill"></i>
              <span><?php echo $first_name . " " . $last_name; ?></span>
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

<?php } ?>