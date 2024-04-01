<?php
// Assuming you've already established a connection to your database

// Prepare and execute query to fetch only active farms
$stmt = $conn->prepare("SELECT ID, farm_n, latitude, longitude FROM farmer_acc2 WHERE active = 1");
$stmt->execute();

// Fetch all results
$farms = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return results as JSON
header('Content-Type: application/json');
echo json_encode(["status" => "success", "farms" => $farms]);
?>
