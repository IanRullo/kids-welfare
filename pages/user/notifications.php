<?php
include '../connection/conn.php';

$email = $_SESSION['email'];
$role = $_SESSION['role'];
$last_name = $_SESSION['last_name'];
$first_name = $_SESSION['first_name'];

$sql = "
    SELECT ar.*, af.*, c.first_name AS child_first_name, c.last_name AS child_last_name
    FROM adoption_requests ar
    LEFT JOIN adoption_form af ON ar.request_id = af.request_id
    LEFT JOIN children c ON ar.child_id = c.child_id
    WHERE ar.status = 'pending'
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "config/header.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php include_once "config/nav.php" ?>
<?php include_once "config/sidenav.php" ?>

<main class="main" id="main">
    <section class="section">
        <div class="row p-3">
            <div class="col-xl-12">
                <div class="card shadow mb-5 bg-white rounded">
                    <div class="card-body pt-3">
                        <h5 class="card-title">Adoption Requests</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Parent Name</th>
                                        <th>Contact Info</th>
                                        <th>Child</th>
                                        <th>Request Date</th>
                                        <th>View Form</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['parent_name']) ?></td>
                                            <td><?= htmlspecialchars($row['contact_info']) ?></td>
                                            <td><?= $row['child_first_name'] . " " . $row['child_last_name'] ?></td>
                                            <td><?= $row['request_date'] ?></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" 
                                                        onclick='showParentDetails(<?= json_encode($row) ?>)'>
                                                    View
                                                </button>
                                            </td>
                                            <td>
                                                <form method="POST" class="d-inline approval-form">
                                                    <input type="hidden" name="requestId" value="<?= $row['request_id'] ?>">
                                                    <button type="button" class="btn btn-success btn-sm approve-btn">Approve</button>
                                                </form>
                                                <form method="POST" class="d-inline denial-form">
                                                    <input type="hidden" name="requestId" value="<?= $row['request_id'] ?>">
                                                    <button type="button" class="btn btn-danger btn-sm deny-btn">Deny</button>
                                                </form>
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
        <h5 class="modal-title" id="parentModalLabel">Parent Details</h5>
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
        <p>
            <strong>Documents:</strong><br>
            <a href="../uploads/${data.income_proof}" download>Download Income Proof</a><br>
            <a href="../uploads/${data.sworn_affidavit}" download>Download Sworn Affidavit</a>
        </p>
    `;
    document.getElementById('parentDetailsContent').innerHTML = content;
    const modal = new bootstrap.Modal(document.getElementById('parentModal'));
    modal.show();
}

// SweetAlert2 for Approve
document.querySelectorAll('.approve-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        Swal.fire({
            title: 'Approve Request?',
            text: "This action will approve the adoption request.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#198754'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = this.closest('.approval-form');
                form.action = 'approveRequest.php';
                form.submit();
            }
        });
    });
});

// SweetAlert2 for Deny
document.querySelectorAll('.deny-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        Swal.fire({
            title: 'Deny Request?',
            text: "This action will deny the adoption request.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, deny it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = this.closest('.denial-form');
                form.action = 'denyRequest.php';
                form.submit();
            }
        });
    });
});
</script>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
