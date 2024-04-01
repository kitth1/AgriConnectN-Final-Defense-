<?php
// Fetch the farm name from the GET request
$farmName = isset($_GET['farmName']) ? $_GET['farmName'] : '';

// Database connection variables
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

// SQL to fetch crop list for the specified farm
$sql = "SELECT id, crop_name, crop_status FROM crop_list WHERE farm_n = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $farmName);

// Execute and bind result
$stmt->execute();
$result = $stmt->get_result();

// Start table HTML
echo "<table class='table'>";
echo "<thead><tr><th>Crop Name</th><th>Status</th><th>Action</th></tr></thead>";
echo "<tbody>";

// Check if there are results and output each row
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Correctly concatenate the row id into the Update button's href attribute
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["crop_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["crop_status"]) . "</td>";
        // Correctly fixed the Update button link
        echo "<td><a class='btn btn-primary' href='/AgriConnectN/Agutayan_update.php?ID=" . $row["id"] . "'>Update</a></td>";
        echo "</tr>";
    }
} else {
    // If no results, display a message in a single row
    echo "<tr><td colspan='3'>No crops found for this farm.</td></tr>";
}

// Close table HTML
echo "</tbody></table>";

// Close connection
$stmt->close();
$conn->close();
?>
