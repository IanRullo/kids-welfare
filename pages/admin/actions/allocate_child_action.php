<?php
session_start();
require_once '../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $child_id = $_POST['child_id'];
    $foster_id = $_POST['foster_id'];
    $allocation_date = date('Y-m-d');

    // Check if already allocated
    $check_query = "SELECT * FROM allocations WHERE child_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $child_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $_SESSION['error'] = "This child is already allocated to a foster care center.";
    } else {
        // Insert allocation
        $insert_query = "INSERT INTO allocations (child_id, foster_id, allocation_date) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("iis", $child_id, $foster_id, $allocation_date);

        if ($insert_stmt->execute()) {
            // Update child status
            $update_query = "UPDATE children SET status = 'allocated' WHERE child_id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("i", $child_id);
            $update_stmt->execute();
            $update_stmt->close();

            $_SESSION['success'] = "Child allocated successfully!";
        } else {
            $_SESSION['error'] = "Failed to allocate child: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    }

    $check_stmt->close();
    $conn->close();

    header("Location: ../child_details.php?id=$child_id");
    exit();
}
?>
