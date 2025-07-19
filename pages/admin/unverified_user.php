<?php
session_start();
require_once '../../config/config.php';

// Hakikisha admin tu anaweza kuona
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Fetch all unverified users
$result = mysqli_query($conn, "SELECT * FROM user WHERE is_verified = 0 ORDER BY user_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>New Unverified Users</title>
  <?php include_once "includes/header.php"; ?>

  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .table thead th {
      position: sticky;
      top: 0;
      background-color: #343a40;
      color: #fff;
      z-index: 10;
    }

    .btn-mk {
      padding: 6px 10px;
      font-size: 12px;
      border-radius: 5px;
    }

    .card-title {
      font-size: 20px;
      font-weight: bold;
      color: #444;
      margin-bottom: 15px;
    }

    .table-responsive {
      max-height: 400px;
      overflow-y: auto;
    }
  </style>
</head>

<body>
  <?php include_once "includes/navbar.php"; ?>
  <?php include_once "includes/side_nav.php"; ?>

  <main class="main" id="main">
    <section class="section mt-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">New Unverified Users</h5>

          <?php if (mysqli_num_rows($result) > 0): ?>
          <div class="table-responsive">
            <table class="table table-sm table-hover table-striped align-middle text-center">
              <thead class="table-dark">
                <tr>
                  <th>#</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Gender</th>
                  <th>DOB / Age</th>
                  <th>Marital Status</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; while ($user = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                  <td><?= htmlspecialchars($user['email']); ?></td>
                  <td><?= htmlspecialchars($user['phone']); ?></td>
                  <td><?= htmlspecialchars($user['gender']); ?></td>
                  <td>
                    <?php
                      $ageText = 'N/A';
                      if (!empty($user['dob']) && $user['dob'] != '0000-00-00') {
                          try {
                              $dob = new DateTime($user['dob']);
                              $today = new DateTime();
                              $age = $today->diff($dob)->y;
                              $ageText = htmlspecialchars($user['dob']) . " ({$age} yrs)";
                          } catch (Exception $e) {
                              $ageText = 'Invalid DOB';
                          }
                      }
                      echo $ageText;
                    ?>
                  </td>
                  <td><?= htmlspecialchars($user['marital_status']); ?></td>
                  <td>
                    <span class="badge bg-info text-dark text-uppercase">
                      <?= htmlspecialchars($user['role']); ?>
                    </span>
                  </td>
                  <td>
                    <a href="actions/verify_user.php?id=<?= $user['user_id']; ?>" title="Verify User">
                      <button class="btn btn-success btn-mk">
                        <i class="fa fa-check-circle"></i> Verify
                      </button>
                    </a>
                    <a href="actions/delete_user.php?id=<?= $user['user_id']; ?>" title="Delete User" onclick="return confirm('Are you sure you want to delete this user?');">
                      <button class="btn btn-danger btn-mk">
                        <i class="fa fa-trash"></i> Delete
                      </button>
                    </a>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          <?php else: ?>
            <div class="alert alert-info text-center mt-3">
              No unverified users at the moment.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <?php if (isset($_SESSION['success'])): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Success',
      text: '<?= $_SESSION['success'] ?>',
      confirmButtonColor: '#3085d6'
    });
  </script>
  <?php unset($_SESSION['success']); endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '<?= $_SESSION['error'] ?>',
      confirmButtonColor: '#d33'
    });
  </script>
  <?php unset($_SESSION['error']); endif; ?>

  <!-- JS Scripts -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>
</html>
