<?php
  require_once '../../../config/config.php'; 
?>
<?php
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
        $path = '../../assets/uploads/' . $file_name_new;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
            // File uploaded successfully, proceed with database insertion
            $insert_children = mysqli_query($conn, "INSERT INTO children (first_name, last_name, gender, dob, address, guide, school_name, class_level, file, report) VALUES ('$fname', '$lname', '$gender', '$dob', '$address', '$guide', '$sname', '$clevel', '$path', '$report')");

            if ($insert_children) {
                $_SESSION['success'] = "Successfully added a new child to the database.";
            } else {
                $_SESSION['error'] = "Error inserting data into the database";
            }
        } else {
            $_SESSION['error'] = "Error moving uploaded file";
        }
    } else {
        $_SESSION['error'] = "Error uploading file";
    }
}

// Redirect to the appropriate page after processing
header("Location: ../add_child.php");
exit();
?>