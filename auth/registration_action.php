<?php
require_once '../config/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $terms = isset($_POST['terms']) ? $_POST['terms'] : null;

    $errors = [];

    // Validate fields
    if (empty($firstname)) $errors[] = "Firstname is required.";
    if (empty($lastname)) $errors[] = "Lastname is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($mobile) || !preg_match('/^[0-9]{10}$/', $mobile)) $errors[] = "Valid 10-digit mobile number is required.";
    if (empty($gender)) $errors[] = "Gender is required.";
    if (empty($password)) $errors[] = "Password is required.";
    if (empty($confirm_password)) $errors[] = "Confirm password is required.";
    if ($password !== $confirm_password) $errors[] = "Passwords do not match.";
    if (empty($marital_status)) $errors[] = "Marital status is required.";
    if (empty($dob)) $errors[] = "Date of birth is required.";
    if (!$terms) $errors[] = "You must accept the Terms and Conditions.";

    // Check if email exists
    $check_stmt = $conn->prepare("SELECT user_id FROM user WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $errors[] = "An account with this email already exists.";
    }
    $check_stmt->close();

    // Register if no errors
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $role = 'parent';
        $is_verified = 0;

        $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, phone, gender, dob, marital_status, password, role, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
            $_SESSION['error'] = "Database error: Unable to prepare statement.";
        } else {
            $stmt->bind_param("sssssssssi", $firstname, $lastname, $email, $mobile, $gender, $dob, $marital_status, $hashed_password, $role, $is_verified);
            if ($stmt->execute()) {
                $_SESSION['success'] = "Registration successful! Please wait for admin approval.";
            } else {
                $_SESSION['error'] = "Database error: Unable to execute statement.";
            }
            $stmt->close();
        }
    } else {
        $_SESSION['error'] = implode("<br>", $errors);
    }

    header("Location: ../registration.php");
    exit();
}
?>
