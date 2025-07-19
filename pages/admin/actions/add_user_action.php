<?php
require_once '../../../config/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Sanitize and validate input data
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $errors = [];
    if (empty($firstname)) $errors[] = "Firstname is required.";
    if (empty($lastname)) $errors[] = "Lastname is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($mobile) || !preg_match('/^[0-9]{10}$/', $mobile)) $errors[] = "Valid 10-digit mobile number is required.";
    if (empty($gender)) $errors[] = "Gender is required.";
    if (empty($password)) $errors[] = "Password is required.";
    if (empty($role)) $errors[] = "Role is required.";

    if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert data into database
        $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, phone, gender, password,role) VALUES (?, ?, ?, ?, ?, ?,?)");
        if ($stmt === false) {
            $_SESSION['error'] = "Database error: Unable to prepare statement";
        } else {
            $stmt->bind_param("sssssss", $firstname, $lastname, $email, $mobile, $gender, $hashed_password,$role);
            if ($stmt->execute()) {
                $_SESSION['success'] = "User Added successful!";
            } else {
                $_SESSION['error'] = "Database error: Unable to execute statement";
            }
            $stmt->close();
        }
    } else {
        $_SESSION['error'] = implode('<br>', $errors);
    }

    // Redirect to the registration page or a success page
    header("Location: ../add_user.php");
    exit();
}
?>
