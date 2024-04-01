<?php
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

$farmName = isset($_GET['farmName']) ? $_GET['farmName'] : 'Default Farm Name';

// Adjusted SQL query to select date_planted
$sql = "SELECT id, crop_name, crop_status, date_planted FROM crop_list WHERE farm_n = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $farmName);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($farmName); ?> - Crop List</title>
    <h1><?php echo htmlspecialchars($farmName); ?></h1>
    
    
    <style>
        /* Add your CSS styles here */
    </style>
    
</head>
<body>


    <table class='table'>
        <thead>
            <tr>
                <th>Crop Name</th>
                <th>Status</th>
                <th>Date Planted</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["crop_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["crop_status"]) . "</td>";
                    $datePlanted = $row["date_planted"] ? date('Y-m-d', strtotime($row["date_planted"])) : 'Not available';
                    echo "<td>" . htmlspecialchars($datePlanted) . "</td>";
                    echo "<td><a class='btn btn-primary' href='/AgriConnectN/update_crop_tech.php?ID=" . $row["id"] . "'>Update</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No crops found for this farm.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Check if the 'message' query parameter is set
    if(isset($_GET['message'])) {
        $message = $_GET['message'];
        
        if($message == 'deleted') {
            echo "<p>Crop has been successfully deleted.</p>";
        } elseif($message == 'error') {
            echo "<p>An error occurred while trying to delete the crop.</p>";
        }
    }
    ?>
    
</body>
</html>
