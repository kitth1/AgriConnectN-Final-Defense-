<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // For localhost, the root password is often blank
$dbname = "faccount";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Data from the form (ensure validation and sanitization)
    $cropName = isset($_POST['crop_name']) ? $_POST['crop_name'] : '';

    // Prepare an insert statement
    $sql = "INSERT INTO crop_list_encode (crop_name) VALUES (?)";
    $stmt = $conn->prepare($sql);

    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("s", $cropName);

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Record inserted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
