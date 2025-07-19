<?php
require_once '../../../config/config.php';
session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = intval($_GET['id']);

    $update = mysqli_query($conn, "UPDATE user SET is_verified = 1 WHERE user_id = $user_id");

    if ($update) {
        $_SESSION['success'] = "User verified successfully!";
    } else {
        $_SESSION['error'] = "Failed to verify user. Please try again.";
    }
} else {
    $_SESSION['error'] = "Invalid request.";
}

header("Location: ../unverified_user.php");
exit();
