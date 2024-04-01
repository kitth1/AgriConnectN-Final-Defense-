<style>
    body, html {
        font-family: 'Roboto', sans-serif;
        background: #f6f6f6;
        color: #333;
        margin: 0;
        padding: 0;
        line-height: 1.6;
    }

    .container {
        max-width: 1000px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #4CAF50;
    }

    .form-control, .btn {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .form-control {
        background-color: #f4f4f4;
    }

    .btn, .btn-print, .btn-secondary {
        padding: 10px;
        margin: 5px 0; /* Adjust spacing around buttons */
        width: calc(50% - 10px); /* Adjust width to sit side by side, accounting for margin */
        font-size: 16px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        display: inline-block; /* Ensure buttons sit side by side */
        text-align: center;
    }

    .btn-print {
        background-color: #4CAF50; /* Green color for the print button */
        color: white;
    }

    .btn-secondary {
        background-color: #f44336; /* Secondary button color, adjust as needed */
        color: white;
    }

    /* Hover effect for buttons */
    .btn:hover, .btn-print:hover, .btn-secondary:hover {
        opacity: 0.9;
    }

    @media print {
        .btn, .btn-print, .btn-secondary {
            display: none; /* Hide buttons when printing */
        }
        .table, .table * {
            visibility: visible;
        }
        .table {
            position: absolute;
            left: 0;
            top: 0;
        }
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th, .table td {
        text-align: left;
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #4CAF50;
        color: white;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        .table, .table * {
            visibility: visible;
        }
        .table {
            position: absolute;
            left: 0;
            top: 0;
        }
    }

    @media (max-width: 768px) {
        .container {
            width: 95%;
            margin: 10px auto;
            padding: 10px;
        }
    }
</style>

<?php
session_start();

// Include your database connection script
include_once("conn.php");

// Ensure there's a logged-in tech account
if (!isset($_SESSION['tech_username'])) {
    // Redirect to login page if not logged in
    header('Location: tech_login.php');
    exit();
}

$errorMessage = "";
$successMessage = "";
$barangay = $_SESSION['tdesignation']; // Get the barangay from the session

// Fetch farm names from the specific barangay of the logged-in tech account
$farmNames = array();
if ($conn) { // Check if the connection variable is truthy
    $sql = "SELECT farm_n FROM farmer_acc2 WHERE barangay = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $barangay);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $farmNames[] = $row['farm_n'];
        }
    }
    $stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form processing logic here
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content, including the <style> tag with your CSS -->
</head>
<body>
<div class="container">
    <h2>Add Weekly Report</h2>
    <?php if (!empty($errorMessage)) echo "<p style='color:red;'>$errorMessage</p>"; ?>
    <?php if (!empty($successMessage)) echo "<p style='color:green;'>$successMessage</p>"; ?>
    <form method="POST">
        <!-- Form inputs here -->
    </form>
    
    <button onclick="printTable()" class="btn-print">Print Reports</button>
    <button onclick="window.location.href='agusipan_report.php'" class="btn btn-secondary">Back</button>
    <table class="table">
        <thead>
            <tr>
                <th>Farm Name</th>
                <th>Week Report</th>
                <th>Date Reported</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($conn) { // Re-check if the connection is available
                $sql = "SELECT * FROM agusipan_report WHERE farm_name IN (SELECT farm_n FROM farmer_acc2 WHERE barangay = ?) ORDER BY date DESC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $barangay);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['farm_name']) . "</td>
                                <td>" . htmlspecialchars($row['week_report']) . "</td>
                                <td>" . htmlspecialchars($row['date']) . "</td>
                                <td><a href='Agusipan_delete_report.php?ID=" . $row['ID'] . "' class='btn btn-secondary'>Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No reports found.</td></tr>";
                }
                $stmt->close();
            }
            ?>
        </tbody>
    </table>
</div>

<script>
function printTable() {
    window.print();
}
</script>
</body>
</html>
