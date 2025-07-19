<?php
require_once '../../config/config.php';


$email = $_SESSION['email'];
$role = $_SESSION['role'];
$last_name = $_SESSION['last_name'];
$first_name = $_SESSION['first_name'];

// Fetch all requests made by this user
$sql = "
    SELECT ar.*, af.*, c.first_name AS child_first_name, c.last_name AS child_last_name
    FROM adoption_requests ar
    LEFT JOIN adoption_form af ON ar.request_id = af.request_id
    LEFT JOIN children c ON ar.child_id = c.child_id
    WHERE ar.contact_info = ?
    ORDER BY ar.request_date DESC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<?php include_once "includes/navbar.php" ?>
<?php include_once "includes/side_nav.php" ?>

<main class="main" id="main">
    <section class="section">
        <div class="row p-3">
            <div class="col-xl-12">
                <div class="card shadow mb-5 bg-white rounded">
                    <div class="card-body pt-3">
                        <h5 class="card-title">My Adoption Requests</h5>
                        <?php if (isset($_SESSION['msg'])): ?>
                            <div class="alert alert-info"> <?= $_SESSION['msg']; unset($_SESSION['msg']); ?> </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Child</th>
                                        <th>Request Date</th>
                                        <th></th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $row['child_first_name'] . " " . $row['child_last_name'] ?></td>
                                            <td><?= $row['request_date'] ?></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" onclick='showParentDetails(<?= json_encode($row) ?>)'>View</button>
                                            </td>
                                            <td>
                                                <?php if ($row['status'] == 'pending'): ?>
                                                    <form method="POST" action="delete_request_user.php" onsubmit="return confirm('Are you sure you want to cancel this request?');">
                                                        <input type="hidden" name="request_id" value="<?= $row['request_id'] ?>"> 
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                    <button type="submit" class="btn btn-sm btn-danger ml-5">Cancel</button>
                                                    </form>
                                                <?php elseif ($row['status'] == 'approved'): ?>
                                                    <span class="badge bg-success">Approved</span>
                                                <?php elseif ($row['status'] == 'rejected'): ?>
                                                    <span class="badge bg-danger">Rejected</span>
                                                <?php endif; ?>
                                                
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Parent Info Modal -->
<div class="modal fade" id="parentModal" tabindex="-1" aria-labelledby="parentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-4">
      <div class="modal-header">
        <h5 class="modal-title" id="parentModalLabel">Adoption Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="parentDetailsContent"></div>
    </div>
  </div>
</div>

<script>
function showParentDetails(data) {
    const content = `
        <p><strong>National ID:</strong> ${data.national_id}</p>
        <p><strong>Job Title:</strong> ${data.job_title}</p>
        <p><strong>Reason for Adoption:</strong><br>${data.reason_for_adoption}</p>
        <p><strong>Social References:</strong><br>${data.social_references}</p>
        <p><strong>Submission Date:</strong> ${data.submission_date}</p>
        
    `;
    document.getElementById('parentDetailsContent').innerHTML = content;
    const modal = new bootstrap.Modal(document.getElementById('parentModal'));
    modal.show();
}
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
