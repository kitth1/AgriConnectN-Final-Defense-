// fetch_farms.php
<?php
session_start();
header('Content-Type: application/json');

// Include database connection
include_once("conn.php");

// Initialize an empty array for the response
$response = array('success' => false, 'farms' => array());

if (isset($_SESSION['ID'])) {
    $tech_id = $_SESSION['ID'];

    // Fetch barangay based on tech_id, then fetch farm names
    $barangay = ''; // Assume you fetch this based on $tech_id
    // Database query to fetch farm names based on barangay
    // This is a placeholder, replace with your actual query
    if ($stmt = $conn->prepare("SELECT farm_n FROM farmer_acc2 WHERE barangay = ?")) {
        $stmt->bind_param("s", $barangay);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $response['farms'][] = $row['farm_n'];
        }
        $response['success'] = true;
        $stmt->close();
    }
}

echo json_encode($response);
?>
