<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faccount";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT cl.crop_name, cl.crop_status, cl.date_planted, cl.crop_lat, cl.crop_lng, cl.farm_n, f.contact, f.status, f.f_lastname, f.f_firstname, f.barangay 
            FROM crop_list cl
            JOIN farmer_acc2 f ON cl.farm_n = f.farm_n
            WHERE f.status = 'Active'";
            
    $result = $conn->query($sql);
    
    $crops = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $crops[] = $row;
        }
    }
    
    echo json_encode($crops);
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
$conn->close();
?>
