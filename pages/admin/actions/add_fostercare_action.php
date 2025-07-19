<?php
require_once '../../../config/config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foster_name = $_POST['foster_name'];
    $region = $_POST['region'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $foster_start_date = $_POST['foster_start_date'];
    $foster_end_date = $_POST['foster_end_date'] ? $_POST['foster_end_date'] : NULL;
    $child_id = $_POST['child_id'] ? $_POST['child_id'] : NULL;

    // Start a transaction
    $conn->begin_transaction();

    try {
        if ($child_id !== NULL) {
            // Check if the child is already allocated to a foster care
            $check_query = "SELECT * FROM fostercare WHERE child_id = ? AND foster_end_date IS NULL";
            $stmt = $conn->prepare($check_query);
            $stmt->bind_param("i", $child_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // End the current allocation
                $end_allocation_query = "UPDATE fostercare SET foster_end_date = ? WHERE child_id = ? AND foster_end_date IS NULL";
                $end_stmt = $conn->prepare($end_allocation_query);
                $current_date = date('Y-m-d');
                $end_stmt->bind_param("si", $current_date, $child_id);
                $end_stmt->execute();
                $end_stmt->close();
            }
            $stmt->close();
        }

        // Insert new foster care allocation
        $insert_query = "INSERT INTO fostercare (child_id, foster_name, region, district, ward, foster_start_date, foster_end_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("issssss", $child_id, $foster_name, $region, $district, $ward, $foster_start_date, $foster_end_date);

        if ($insert_stmt->execute()) {
            // Update child status to 'allocated'
            $update_child_query = "UPDATE children SET status = 'allocated' WHERE child_id = ?";
            $update_child_stmt = $conn->prepare($update_child_query);
            $update_child_stmt->bind_param("i", $child_id);
            $update_child_stmt->execute();
            $update_child_stmt->close();

            $conn->commit();
            $_SESSION['success'] = "Foster care added and child allocated successfully!";
        } else {
            throw new Exception("Error: " . $insert_stmt->error);
        }

        $insert_stmt->close();
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error'] = $e->getMessage();
    }

    $conn->close();
    header('Location: ../add_foster_care.php'); // Redirect to a success page or back to the form
    exit();
}
?>
