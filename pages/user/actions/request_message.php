<?php

require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && isset($_POST['request_id'])) {
        $action = $_POST['action'];
        $request_id = $_POST['request_id'];

        // Validate admin role
        if ($_SESSION['role'] != 'admin') {
            $message = "Access denied.";
            header("Location: views/adoption_requests.php?message=" . urlencode($message));
            exit();
        }

        // Fetch the adoption request details
        $query = "SELECT * FROM adoption_requests WHERE request_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $request_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $adoption_request = $result->fetch_assoc();
        $stmt->close();

        if (!$adoption_request) {
            $message = "Adoption request not found.";
            header("Location: ../adoption_requests.php?message=" . urlencode($message));
            exit();
        }

        // Set status and message based on the action
        if ($action == 'approve') {
            $status = 'approved';
            $message = "Thank you for adopting a child. Please visit our foster care with your National ID.";
        } elseif ($action == 'deny') {
            $status = 'denied';
            $message = "Sorry! You can't adopt this child at this time.";
        } else {
            $message = "Invalid action.";
            header("Location: ../adoption_requests.php?message=" . urlencode($message));
            exit();
        }

        // Update the status of the adoption request
        $query = "UPDATE adoption_requests SET status = ? WHERE request_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $status, $request_id);

        if ($stmt->execute()) {
            $message = "Adoption request has been $status. " . $message;
        } else {
            $message = "Failed to update adoption request: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();

        // Redirect back to the adoption requests page with the message
        header("Location: ../adoption_requests.php?message=" . urlencode($message));
        exit();
    } else {
        $message = "Invalid request.";
        header("Location: ../adoption_requests.php?message=" . urlencode($message));
        exit();
    }
} else {
    $message = "Invalid request.";
    header("Location: ../adoption_requests.php?message=" . urlencode($message));
    exit();
}
?>
