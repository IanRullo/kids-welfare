<?php
require_once '../../../config/config.php';

// Sanitize and collect input
$child_id       = intval($_POST['child_id']);
$parent_name    = trim($_POST['parent_name']);
$contact_info   = trim($_POST['contact_info']);
$address        = trim($_POST['address']);
$job_title      = trim($_POST['job_title']);
$reason         = trim($_POST['reason']);
$references     = trim($_POST['references']);

// Function to handle file uploads
function uploadFile($fileField) {
    $uploadDir = '../../assets/img';
    $fileName = basename($_FILES[$fileField]['name']);
    $filePath = $uploadDir . time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $fileName);

    if (move_uploaded_file($_FILES[$fileField]['tmp_name'], $filePath)) {
        return $filePath;
    } else {
        return null;
    }
}

// Handle uploads
$national_id      = uploadFile('national_id');
$income_proof     = uploadFile('income_proof');
$sworn_affidavit  = uploadFile('sworn_affidavit');

if (!$national_id || !$income_proof || !$sworn_affidavit) {
    die("File upload failed. Please check your files and try again.");
}

// Step 1: Insert into adoption_requests
$stmt1 = $conn->prepare("INSERT INTO adoption_requests (parent_name, contact_info, address, child_id) VALUES (?, ?, ?, ?)");
$stmt1->bind_param("sssi", $parent_name, $contact_info, $address, $child_id);

if ($stmt1->execute()) {
    $request_id = $stmt1->insert_id;

    // Step 2: Insert into adoption_form
    $stmt2 = $conn->prepare("INSERT INTO adoption_form (
        request_id, national_id, job_title, income_proof, sworn_affidavit, reason_for_adoption, social_references
    ) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $stmt2->bind_param("issssss", $request_id, $national_id, $job_title, $income_proof, $sworn_affidavit, $reason, $references);
    
    if ($stmt2->execute()) {
        header("Location: ../child_details.php");
        exit();
    } else {
        echo "Error saving form details: " . $stmt2->error;
    }

    $stmt2->close();
} else {
    echo "Error creating adoption request: " . $stmt1->error;
}

$stmt1->close();
$conn->close();
?>
