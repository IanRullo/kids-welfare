<?php
session_start();
include '../../config/config.php';

$email = $_SESSION['email'] ?? '';
$role = $_SESSION['role'] ?? '';
$last_name = $_SESSION['last_name'] ?? '';
$first_name = $_SESSION['first_name'] ?? '';

$id = intval($_GET['id'] ?? 0);

$childQuery = $conn->prepare("SELECT * FROM children WHERE child_id = ?");
$childQuery->bind_param("i", $id);
$childQuery->execute();
$childResult = $childQuery->get_result();

$notification = $conn->query("SELECT * FROM adoption_requests WHERE status = 'pending'");
$count_notification = $notification->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once "includes/header.php"; ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<main class="main" id="main">
<?php include_once "includes/navbar.php"; ?>
<?php include_once "includes/side_nav.php"; ?>
  <section class="section">
    <div class="row p-3">
      <?php while ($row = $childResult->fetch_assoc()) { ?>
        <div class="col-xl-10">
          <div class="card shadow mb-4">
            <div class="card-body">
              <h5 class="card-title"><b>Child Details</b></h5>
              <img src="../image/<?php echo $row['file']; ?>" style="border-radius: 5px; width:120px; height:120px;">
              <div class="pt-3">
                <p><b>Full Name:</b> <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
                <p><b>Gender:</b> <?php echo $row['gender']; ?></p>
                <p><b>DOB:</b> <?php echo $row['dob']; ?> 
                  (<?php echo date("Y") - date("Y", strtotime($row['dob'])); ?> years old)
                </p>
                <p><b>Address:</b> <?php echo $row['address']; ?></p>
                <p><b>School:</b> <?php echo $row['school_name']; ?></p>
                <p><b>Class:</b> <?php echo $row['class_level']; ?></p>
                <p><b>Parent Phone:</b> <?php echo $row['guide']; ?></p>
                <p><b>Report:</b> <?php echo $row['report']; ?></p>

                <?php if ($role == "admin") { ?>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#fosterModal"
                          data-child-id="<?php echo $row['child_id']; ?>" data-child-name="<?php echo $row['first_name'] . ' ' . $row['last_name']; ?>">
                    Allocate to Foster
                  </button>
                <?php } elseif ($role == "parent") { ?>
                  <button class="btn btn-success adopt-btn" data-toggle="modal" data-target="#adoptModal"
                          data-child-id="<?php echo $row['child_id']; ?>">
                    Adopt Child
                  </button>
                <?php } ?>
              </div>
            </div>
          </div>

          <!-- Foster Allocations Table -->
          <div class="card">
            <div class="card-body">
              <h5>Foster Allocations</h5>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Foster Name</th><th>Region</th><th>District</th><th>Ward</th><th>Start</th><th>End</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $alloc = $conn->prepare("SELECT * FROM fostercare WHERE child_id = ?");
                  $alloc->bind_param("i", $row['child_id']);
                  $alloc->execute();
                  $allocResult = $alloc->get_result();

                  while ($a = $allocResult->fetch_assoc()) {
                    echo "<tr>
                            <td>{$a['foster_name']}</td>
                            <td>{$a['region']}</td>
                            <td>{$a['district']}</td>
                            <td>{$a['ward']}</td>
                            <td>{$a['foster_start_date']}</td>
                            <td>" . ($a['foster_end_date'] ?: 'Ongoing') . "</td>
                          </tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>
</main>

<!-- SweetAlert Alert Block -->
<?php if (isset($_SESSION['success'])): ?>
<script>
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: '<?php echo $_SESSION["success"]; ?>',
  confirmButtonColor: '#3085d6',
  timer: 3000
});
</script>
<?php unset($_SESSION['success']); endif; ?>

<?php if (isset($_SESSION['error'])): ?>
<script>
Swal.fire({
  icon: 'error',
  title: 'Error',
  text: '<?php echo $_SESSION["error"]; ?>',
  confirmButtonColor: '#d33',
  timer: 4000
});
</script>
<?php unset($_SESSION['error']); endif; ?>

<!-- Modals and Scripts -->
<!-- Foster Modal (Admin) -->
<div class="modal fade" id="fosterModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form method="POST" action="actions/allocate_child_action.php" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Allocate Child to Foster</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="child_id" id="modalFosterChildId">
        <div class="form-group">
          <label>Child Name</label>
          <input type="text" class="form-control" id="modalFosterChildName" readonly>
        </div>
        <div class="form-group">
          <label>Select Foster Care</label>
          <select name="foster_id" class="form-control" required>
            <?php
            $fosters = $conn->query("SELECT * FROM fostercare");
            while ($f = $fosters->fetch_assoc()) {
              echo "<option value='{$f['foster_id']}'>{$f['foster_name']}</option>";
            }
            ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Allocate</button>
      </div>
    </form>
  </div>
</div>

<!-- Adoption Modal (Parent) -->
<div class="modal fade" id="adoptModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form method="POST" action="adoption_request_action.php" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adoption Application</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="child_id" id="modalAdoptChildId">
        <input type="hidden" name="parent_name" value="<?php echo htmlspecialchars($first_name . ' ' . $last_name); ?>">
        <input type="hidden" name="contact_info" value="<?php echo htmlspecialchars($email); ?>">
        <input type="hidden" name="address" value="Some Address">

        <div class="form-group">
          <label>National ID</label>
          <input type="file" name="national_id" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Job Title</label>
          <input type="text" name="job_title" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Income Proof</label>
          <input type="file" name="income_proof" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Sworn Affidavit</label>
          <input type="file" name="sworn_affidavit" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Reason for Adopting</label>
          <textarea name="reason" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label>Social References</label>
          <textarea name="references" class="form-control" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Submit Application</button>
      </div>
    </form>
  </div>
</div>

<!-- Extra Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('#fosterModal').on('show.bs.modal', function (event) {
    const btn = $(event.relatedTarget);
    $('#modalFosterChildId').val(btn.data('child-id'));
    $('#modalFosterChildName').val(btn.data('child-name'));
  });

  $('.adopt-btn').on('click', function () {
    $('#modalAdoptChildId').val($(this).data('child-id'));
  });

  // Auto logout timer
  let timer;
  function resetTimer() {
    clearTimeout(timer);
    timer = setTimeout(() => {
      window.location.href = "../../auth/logout.php";
    }, 60000);
  }
  window.onload = resetTimer;
  document.onmousemove = resetTimer;
  document.onkeypress = resetTimer;
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
