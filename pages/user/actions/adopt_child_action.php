<?php
require_once '../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debugging output to check POST data and session variables
    echo '<pre>';
    print_r($_POST);
    print_r($_SESSION);
    echo '</pre>';

    if (isset($_POST['parent_name']) && isset($_POST['contact_info']) && isset($_POST['address']) && isset($_POST['child_id'])) {
        $email = $_SESSION['email'] ?? '';
        $role = $_SESSION['role'] ?? ''; 
        $last_name = $_SESSION['last_name'] ?? ''; 
        $first_name = $_SESSION['first_name'] ?? '';

        // Get the input values
        $parent_name = $_POST['parent_name'];
        $contact_info = $_POST['contact_info'];
        $address = $_POST['address'];
        $child_id = $_POST['child_id'];

        if (empty($parent_name) || empty($contact_info) || empty($address) || empty($child_id)) {
            echo "All fields are required.";
            exit();
        }

        $query = "INSERT INTO adoption_requests (parent_name, contact_info, address, child_id, status) VALUES (?, ?, ?, ?, 'pending')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssi', $parent_name, $contact_info, $address, $child_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Adoption request sent successfully";
            // echo "Adoption request sent successfully!";
        } else {
            $_SESSION['error'] = "fail to send adoption request";
            // echo "Failed to send adoption request: " . $stmt->error;
        }
         
        header("Location: ../child_details.php");
        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid request: Missing POST data.";
    }
} else {
    echo "Invalid request: Not a POST request.";
}
?>
