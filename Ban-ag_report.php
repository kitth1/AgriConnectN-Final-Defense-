<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Page</title>
    <style>
   /* Import a Google Font */
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

body, html {
    font-family: 'Roboto', sans-serif;
    background: #f6f6f6; /* Light background to soothe the eyes */
    color: #333; /* Keep text readable */
    line-height: 1.6;
}

.container {
    width: 90%;
    max-width: 1000px;
    margin: 2rem auto;
    padding: 2rem;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}

.table th, .table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 2px solid #e7e7e7; /* Subtle borders for the table */
}

.table th {
    background-color: #4CAF50; /* A green shade that goes with the farm theme */
    color: white;
    font-weight: 700;
}

.table tr:nth-child(even) {
    background-color: #f9f9f9; /* Alternating row colors for better readability */
}

/* Style for the dropdown and buttons */
    .form-control, .btn, .btn-cancel {
    font-size: 16px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 10px;
    width: 100%; /* Full width */
}

.form-control[rows] {
    resize: none; /* Prevent textarea from being resizable */
}

.btn {
            
    background-color: #4CAF50; /* Green */
    color: white;
    border: none;
}

.btn:hover {
    background-color: #45a049; /* Darker green on hover */
}

.btn-cancel {
    background-color: #f44336; /* Red */
    color: white;
    border: none;
}

.btn-cancel:hover {
    background-color: #d32f2f; /* Darker red on hover */
}

.form-group {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.form-group > div {
    flex: 1;
    min-width: 120px; /* Minimum width of form elements */
    margin-right: 20px; /* Spacing between form elements */
}

.form-group > div:last-child {
    argin-right: 0;
}

.form-actions {
    display: flex;
    gap: 10px; /* Adjust the space between buttons as needed */
}

/* If you want the buttons to be side by side without any space */
.form-actions .btn {
    flex-grow: 1; /* This will make the buttons expand to fill the space */
    margin-right: 10px; /* Adjust or remove this as needed */
}

/* Remove the margin from the last button so there is no extra space on the right */
.form-actions .btn:last-child {
    margin-right: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 95%;
    }
}

    </style>

</head>
<body>
    <div class="container my-5">
        <h2></h2>
        
        <a href="Ban-ag_print_report.php" class="btn"> Print Report </a>

        <br>
        <table class="table">
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>FARM NAME</th>
                    <th>WEEK REPORT</th>
                    <th>DATE REPORTED</th>
                    <th>UPDATE</th>
                </tr>  
            </thead> 
            <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "faccount";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM banan_report";
                    $result = $conn->query($sql);

                    if(!$result) {
                        die("invalid query: " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            
                        <td>$row[farm_name]</td>
                        <td>$row[week_report]</td>
                        <td>$row[date]</td>
                        <td>
                        <a class='btn btn-primary btn-sm' href='/AgriConnectN/Ban-ag_delete_report.php?ID=$row[ID]'> delete </a>
                        </td>
                    </tr>
                        ";
                    }
                    
                    ?>

            </tbody>
        </table>
    </div>  
</body>
</html>

<?php
    include_once("conn.php");
    session_start();

    $farm_name = "";
    $week_report = "";
    $date = "";
    $errorMessage = "";
    $successMessage = "";

    // Fetch farm names from Agutayan barangay
    $farmNames = array();
    $sql = "SELECT farm_n FROM farmer_acc WHERE barangay = 'Ban-ag'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $farmNames[] = $row['farm_n'];
        }
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $farm_name = $_POST["farm_name"];
        $week_report = $_POST["week_report"];
        $date = $_POST["date"];

        if (empty($farm_name) || empty($week_report) || empty($date)) {
            $errorMessage = "All fields are required.";
        } else {
            $stmt = $conn->prepare("INSERT INTO banan_report (farm_name, week_report, date) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $farm_name, $week_report, $date);
            if ($stmt->execute()) {
                $successMessage = "Report added successfully!";
                header('location:Ban-ag_report.php');
                exit;
            } else {
                $errorMessage = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    }

    $conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Week Report</title>
</head>
<body>
    <div class="container">
        <h2>Add Weekly Report</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "<p style='color:red;'>$errorMessage</p>";
        }
        if (!empty($successMessage)) {
            echo "<p style='color:green;'>$successMessage</p>";
        }
        ?>
        <form method="POST">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Farm Name</label>
                <div class="col-sm-6">
                    <select name="farm_name" class="form-control" required>
                        <option value="">Select Farm Name</option>
                        <?php foreach ($farmNames as $name): ?>
                            <option value="<?php echo htmlspecialchars($name); ?>"><?php echo htmlspecialchars($name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Week Report</label>
                <div class="col-sm-9">
                    <textarea name="week_report" class="form-control" rows="4" required placeholder="Enter weekly report details"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date Reported</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date" required>
                </div> 
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-green">Submit</button>
                <button type="button" class="btn btn-cancel" onclick="location.href='/AgriConnectN/Ban-ag_page.php'">Cancel</button>
            </div>
        </form>
    </div>

</body>
</html>

