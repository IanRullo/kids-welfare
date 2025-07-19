<?php
require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $user_email = $_SESSION['email'];

    // Hakikisha hili ombi linamilikiwa na user huyu na status bado ni pending
    $check_sql = "SELECT * FROM adoption_requests WHERE request_id = ? AND contact_info = ? AND status = 'pending'";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("is", $request_id, $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Futa form kwenye adoption_form ikiwa ipo
        $delete_form = "DELETE FROM adoption_form WHERE request_id = ?";
        $stmt1 = $conn->prepare($delete_form);
        $stmt1->bind_param("i", $request_id);
        $stmt1->execute();

        // Futa maombi kwenye adoption_requests
        $delete_request = "DELETE FROM adoption_requests WHERE request_id = ?";
        $stmt2 = $conn->prepare($delete_request);
        $stmt2->bind_param("i", $request_id);

        if ($stmt2->execute()) {
            $_SESSION['msg'] = "Adoption request deleted successfully.";
        } else {
            $_SESSION['msg'] = "Failed to delete the request.";
        }
    } else {
        $_SESSION['msg'] = "Invalid request or not allowed.";
    }
} else {
    $_SESSION['msg'] = "Invalid access.";
}

header("Location: views/manage_request.php");
exit();
