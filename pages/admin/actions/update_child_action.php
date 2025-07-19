<?php
require_once '../../config/config.php'; 

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Sanitize and validate input values
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $guide = mysqli_real_escape_string($conn, $_POST['guide']);
    $sname = mysqli_real_escape_string($conn, $_POST['sname']);
    $clevel = mysqli_real_escape_string($conn, $_POST['clevel']);
    $report = mysqli_real_escape_string($conn, $_POST['report']);

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file_name = strtolower($_FILES['file']['name']);
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        $prefix = 'kids_welfare' . md5(time() * rand(1, 9999));
        $file_name_new = $prefix . $file_ext;
        $path = '../uploads/' . $file_name_new;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
            // File uploaded successfully, proceed with database insertion
            $sql = "UPDATE children SET first_name=?, last_name=?, gender=?, dob=?, address=?, guide=?, school_name=?, class_level=?, file=?, report=? WHERE child_id=?";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssssssss", $fname, $lname, $gender, $dob, $address, $guide, $sname, $clevel, $path, $report, $_POST['child_id']);
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['success'] = "Kid information updated successfully";
                } else {
                    $_SESSION['error'] = "Error executing update query";
                }
                mysqli_stmt_close($stmt);
            } else {
                $_SESSION['error'] = "Error preparing update statement";
            }
        } else {
            $_SESSION['error'] = "Error moving uploaded file";
        }
    } else {
        $_SESSION['error'] = "Error uploading file";
    }
}

// Redirect to the appropriate page after processing
header("Location: views/update_child.php");
exit();
?>
