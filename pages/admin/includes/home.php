<main class="main" id="main">
 <section class="section dashboard">
  <?php if ($role == "admin" || $role == "parent") {?> 
  <div class="row g-4 mt-1">
    
    <!-- Foster care -->
    <div class="col-xl-3 col-sm-6 col-12">
      <div class="card shadow-sm border-0 small-card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h5 class="fw-bold mb-1 text-primary"><?php echo $count_fostercare; ?></h5>
            <p class="mb-0 text-muted small">Foster Care</p>
          </div>
          <i class="fa fa-home fa-lg text-primary"></i>
        </div>
      </div>
    </div>

    <!-- Total Children -->
    <div class="col-xl-3 col-sm-6 col-12">
      <div class="card shadow-sm border-0 small-card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h5 class="fw-bold mb-1 text-warning"><?php echo $count_child; ?></h5>
            <p class="mb-0 text-muted small">Total Children</p>
          </div>
          <i class="fa fa-child fa-lg text-warning"></i>
        </div>
      </div>
    </div>

  <?php } ?>
  <?php if($role == "admin"){ ?>

    <!-- Total Users -->
    <div class="col-xl-3 col-sm-6 col-12">
      <div class="card shadow-sm border-0 small-card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h5 class="fw-bold mb-1 text-secondary"><?php echo $count_user; ?></h5>
            <p class="mb-0 text-muted small">Total Users</p>
          </div>
          <i class="fa fa-users fa-lg text-secondary"></i>
        </div>
      </div>
    </div>

    <!-- New Unverified Users (Clickable) -->
    <?php
      $unverified_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM user WHERE is_verified = 0");
      $unverified_count = mysqli_fetch_assoc($unverified_query)['total'];
    ?>
    <div class="col-xl-3 col-sm-6 col-12">
      <a href="unverified_user.php" style="text-decoration: none;">
        <div class="card shadow-sm border-0 small-card" style="cursor: pointer;">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h5 class="fw-bold mb-1 text-danger"><?php echo $unverified_count; ?></h5>
              <p class="mb-0 text-muted small">New Unverified Users</p>
            </div>
            <i class="fa fa-user-clock fa-lg text-danger"></i>
          </div>
        </div>
      </a>
    </div>

  <?php } ?>
</div>
</section>
</main>





