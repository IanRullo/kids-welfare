<?php
session_start(); // Hakikisha session inaanzishwa

require_once '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login_error'] = "Invalid email address.";
        header('Location: ../login.php');
        exit();
    }

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    if (!$stmt) {
        $_SESSION['login_error'] = "Database error. Please try again.";
        header('Location: ../login.php');
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user with email exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Check if password is correct
        if (password_verify($password, $user['password'])) {

            // Check if account is verified
            if ((int)$user['is_verified'] === 0) {
                $_SESSION['login_error'] = "Account not verified yet. Please wait for admin approval.";
                header('Location: ../login.php');
                exit();
            }

            // Set user session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];

            // Redirect based on user role
            switch ($user['role']) {
                case 'admin':
                    header('Location: ../pages/admin/index.php');
                    break;
                case 'parent':
                    header('Location: ../pages/user/index.php');
                    break;
                case 'social_worker':
                    header('Location: ../pages/social_worker/index.php');
                    break;
                case 'police':
                    header('Location: ../pages/police/index.php');
                    break;
                default:
                    $_SESSION['login_error'] = "Access denied: Unknown role.";
                    header('Location: ../login.php');
                    break;
            }
            exit();
        } else {
            // Password mismatch
            $_SESSION['login_error'] = "Incorrect username or password.";
            header('Location: ../login.php');
            exit();
        }
    } else {
        // No user with provided email
        $_SESSION['login_error'] = "Incorrect username or password.";
        header('Location: ../login.php');
        exit();
    }
}
