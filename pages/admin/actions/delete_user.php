
<?php
 require_once '../config/config.php'; 

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']); // Sanitize input to prevent SQL injection

    // Perform the deletion query
    $sql = "DELETE FROM user WHERE user_id = $id";
    $result = $conn->query($sql);

    if ($result) {
        // Deletion successful
        header("location: views/manage_user.php"); // Redirect to the appropriate page after deletion
        exit();
    } else {
        // Deletion failed
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // ID parameter not provided or invalid
    echo "Invalid request.";
}
?>

