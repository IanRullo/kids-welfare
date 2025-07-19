<?php
require_once '../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Correct key name from form
    $requestId = $_POST['requestId'];

    // Fetch the adoption request
    $request = mysqli_query($conn, "SELECT * FROM adoption_requests WHERE request_id = '$requestId'");
    if (!$request || mysqli_num_rows($request) === 0) {
        die("Request not found.");
    }

    $reqData = mysqli_fetch_assoc($request);
    $parentName = $reqData['parent_name'];
    $childId = $reqData['child_id'];

    // Get user_id from user table using name (not recommended, but if needed, be strict)
    $userQuery = mysqli_query($conn, "SELECT user_id FROM user WHERE CONCAT(first_name, ' ', last_name) = '$parentName'");
    if (!$userQuery || mysqli_num_rows($userQuery) === 0) {
        die("User not found.");
    }

    $userRow = mysqli_fetch_assoc($userQuery);
    $userId = $userRow['user_id'];

    // Reject the request
    $update = mysqli_query($conn, "UPDATE adoption_requests SET status = 'rejected' WHERE request_id = '$requestId'");
    if (!$update) {
        die("Failed to update request status.");
    }

    // Send notification
    $message = "Your adoption request for child ID $childId has been rejected.";
    $notify = mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ('$userId', '$message')");
    if (!$notify) {
        die("Failed to send notification.");
    }

    // Redirect back or show success message
    header("Location: ../manage_request.php?status=rejected");
    exit;
}
?>
