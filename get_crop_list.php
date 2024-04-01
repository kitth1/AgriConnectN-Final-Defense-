<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faccount";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch crop names
$sql = "SELECT crop_name FROM crop_list_encode ORDER BY crop_name";
$result = $conn->query($sql);

$crops = [];
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $crops[] = $row['crop_name'];
    }
    // Return JSON array of crop names
    echo json_encode($crops);
} else {
    echo json_encode([]);
}
$conn->close();
?>
