<!-- Include Bootstrap CSS (Ensure this is in the <head>) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<?php
  $current = basename($_SERVER['PHP_SELF']);
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow navbar-light bg-light sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <i class="fas fa-heart-circle-bolt me-2"></i>KIDS WELFARE
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center justify-content-center <?php if($current == 'index.php') echo 'active'; ?>" href="index.php">
            <i class="fas fa-home me-2"></i>Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center justify-content-center <?php if($current == 'registration.php') echo 'active'; ?>" href="registration.php">
            <i class="fas fa-user-plus me-2"></i>Register
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center justify-content-center <?php if($current == 'login.php') echo 'active'; ?>" href="login.php">
            <i class="fas fa-sign-in-alt me-2"></i>Login
          </a>
        </li>
      </ul>
      <button class="btn btn-outline-secondary btn-sm ms-auto d-flex align-items-center" onclick="toggleLanguage()">
        <i class="fas fa-globe me-2" style="color: #3b82f6;"></i>
        <span id="lang-label">EN</span>
      </button>
    </div>
  </div>
</nav>


<!-- Include Bootstrap JS (Ensure this is before closing </body> tag) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
