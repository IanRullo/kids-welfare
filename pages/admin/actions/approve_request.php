<?php
require_once '../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestId = $_POST['requestId'];

    // Fetch the adoption request
    $request = mysqli_query($conn, "SELECT * FROM adoption_requests WHERE request_id = '$requestId'");
    if (!$request || mysqli_num_rows($request) === 0) {
        die("Request not found.");
    }

    $reqData = mysqli_fetch_assoc($request);
    $parentName = $reqData['parent_name'];
    $childId = $reqData['child_id'];

    // Match user by full name
    $userQuery = mysqli_query($conn, "SELECT user_id FROM user WHERE CONCAT(first_name, ' ', last_name) = '$parentName'");
    if (!$userQuery || mysqli_num_rows($userQuery) === 0) {
        die("User not found.");
    }

    $userRow = mysqli_fetch_assoc($userQuery);
    $userId = $userRow['user_id'];

    // Approve the request
    $update = mysqli_query($conn, "UPDATE adoption_requests SET status = 'approved' WHERE request_id = '$requestId'");
    if (!$update) {
        die("Failed to update request status.");
    }

    // Update child availability
    $updateChild = mysqli_query($conn, "UPDATE children SET available_for_adoption = 'No' WHERE child_id = '$childId'");
    if (!$updateChild) {
        die("Failed to update child availability.");
    }

    // Send notification
    $message = "Your adoption request for child ID $childId has been approved.";
    $notify = mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ('$userId', '$message')");
    if (!$notify) {
        die("Failed to send notification.");
    }

    // Redirect with success
    header("Location: ../manage_request.php?status=approved");
    exit;
}
?>
