<?php
// get_farmer_locations.php
header('Content-Type: application/json');

// Database configuration
$host = 'localhost';
$dbname = 'faccount';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute query to fetch only active farms
    $stmt = $conn->prepare("SELECT ID, farm_n, latitude, longitude FROM farmer_acc2 WHERE status = 'active'");
    $stmt->execute();

    // Set the resulting array to associative
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
