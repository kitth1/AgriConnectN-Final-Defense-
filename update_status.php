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

// Get ID and status from the request
$ID = $_GET['id'];
$status = $_GET['status'] === 'Active' ? 'Active' : 'Inactive'; // Sanitize input

// Update the status in the database
$sql = "UPDATE farmer_acc2 SET status = ? WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $ID);

if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

<?php
                        // Assuming $row is your current row in the loop
                        $isChecked = $row['status'] === 'Active' ? 'checked' : '';
                        ?>
                        
<script>
// Assuming each marker stored in markersByFarm includes farm ID
function refreshMarkersForFarmStatusChange(farmId, isActive) {
    // Trigger a re-fetch of crops or adjust visibility based on local state
    fetchAndDisplayCrops(); // Re-fetch crop data to update markers based on the new farm statuses
}

// Adjust updateStatus function to trigger map refresh on status change
function updateStatus(id, checkbox) {
    var newStatus = checkbox.checked ? 'Active' : 'Inactive';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'update_status.php?id=' + id + '&status=' + newStatus, true);
    xhr.onload = function() {
        if (this.status == 200) {
            console.log('Status updated successfully');
            // Assuming you can map from farm ID to farm_n or have the farm_n available here
            refreshMarkersForFarmStatusChange(id, checkbox.checked);
        }
    };
    xhr.send();
}


</script>
