
<?php
session_start();
include_once("conn.php");

// Ensure that there's a logged-in tech account
if (!isset($_SESSION['tech_username'])) {
    // redirect to login page if not logged in
    header('Location: tech_login.php');
    exit();
}

$errorMessage = "";
$successMessage = "";
$barangay = $_SESSION['tdesignation']; // Get the barangay from the session

// Fetch farm names from the specific barangay of the logged-in tech account
$farmNames = array();
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $farm_name = $_POST["farm_name"];
    $week_report = $_POST["week_report"];
    $date = $_POST["date"];

    if (empty($farm_name) || empty($week_report) || empty($date)) {
        $errorMessage = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO agusipan_report (farm_name, week_report, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $farm_name, $week_report, $date);
        if ($stmt->execute()) {
            $successMessage = "Report added successfully!";
            header('Refresh: 0'); // Refresh the page to show the updated report list
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Week Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            font-family: 'Roboto', sans-serif;
            background: #f6f6f6;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }

        h2 {
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .form-control, .btn, .btn-cancel {
            font-size: 16px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            width: 100%;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .btn-cancel {
            background-color: #f44336;
            color: white;
            border: none;
        }

        .btn-cancel:hover {
            background-color: #d32f2f;
        }

        .form-group > div {
            flex: 1;
            min-width: 120px;
            margin-right: 20px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px; /* Add spacing below form actions */
        }

        /* Adjusting print button spacing */
        .print-button-container {
            text-align: right;
            margin-top: 20px; /* Space above the print button */
            margin-bottom: 40px; /* Additional space below the print button */
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            .form-group > div {
                margin-right: 0;
            }

            .form-actions, .print-button-container {
                flex-direction: column;
            }

            .btn, .btn-cancel {
                width: auto;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Add Weekly Report</h2>
    <a href="Agusipan_print_report.php" class="btn"> Print Report </a>
    <?php if (!empty($errorMessage)) echo "<p style='color:red;'>$errorMessage</p>"; ?>
    <?php if (!empty($successMessage)) echo "<p style='color:green;'>$successMessage</p>"; ?>
    <form method="POST">
        <div class="form-group">
            <div>
               <br> <label>Farm Name</label>
                <select name="farm_name" class="form-control" required>
                    <option value="">Select Farm Name</option>
                    <?php foreach ($farmNames as $name): ?>
                        <option value="<?php echo htmlspecialchars($name); ?>"><?php echo htmlspecialchars($name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div>
                <label>Week Report</label>
                <textarea name="week_report" class="form-control" rows="4" required placeholder="Enter weekly report details"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div>
                <label>Date Reported</label>
                <input type="date" class="form-control" name="date" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn">Submit</button>
            <button type="button" class="btn btn-cancel" onclick="window.location.href='tech_acc.php';">Cancel</button>
        </div>
    </form>

    
</div>

<!-- Modal Structure -->
<div id="successModal" class="modal" style="display: none;">
  <div class="modal-content">
    <span class="close-button" onclick="closeModal()">&times;</span>
    <p>Report added successfully!</p>
  </div>
</div>

</body>
</html>
