<?php
header('Content-Type: application/json'); // Specify the type of data expected to be returned

$servername = "localhost";
$username = "yourUsername"; // Change this to your actual username
$password = "yourPassword"; // Change this to your actual password
$dbname = "faccount"; // Make sure the database name is correct

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT crop_name FROM crop_list_encode ORDER BY crop_name";
$result = $conn->query($sql);

$crops = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $crops[] = $row["crop_name"];
    }
} else {
    echo json_encode(["error" => "No crops found"]);
    exit;
}

echo json_encode($crops);

$conn->close();
?>
