<!DOCTYPE html>
<html lang="en">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faccount";

$conn = new mysqli($servername, $username, $password, $dbname);

$ID = "";
$fname = "";
$cropseed_n = "";
$quantity = "";
$date = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["ID"])) {
        header('location:inventory.php');
        exit;
    }

    $ID = $_GET['ID'];

    $sql = "SELECT * FROM distribute WHERE ID = $ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header('location:inventory.php');
        exit;
    }

    $fname = $row["fname"];
    $cropseed_n = $row["cropseed_n"];
    $quantity = $row["quantity"];
    $date = $row["date"];
} else {

    $ID = $_POST["ID"];
    $fname = $_POST["fname"];
    $cropseed_n = $_POST["crop_name"]; // Change crop_name to cropseed_n
    $quantity = $_POST["quantity"];
    $date = $_POST["date"];

    do {
        if (empty($ID) || empty($fname) || empty($cropseed_n) || empty($quantity || empty($date))) {
            $errorMessage = "ALL the fields are required";
            break;
        }

        $sql = "UPDATE distribute " .
            "SET fname = '$fname', cropseed_n = '$cropseed_n', quantity = '$quantity', date = '$date'" .
            "WHERE ID = $ID";

        $result = $conn->query($sql);

        if (!$result) {
            echo 'invalid query' . $conn->error;
            break;
        }
        header('location: inventory.php?success=true');
exit;
    } while (true);
}

// SQL to fetch crop names
$sql = "SELECT DISTINCT crop_name FROM crop_list_encode ORDER BY crop_name ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $crops[] = $row['crop_name']; // Add crop name to crops array
    }
} else {
    echo "0 results";
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory</title>
    <style>
        /* General reset and base styles */
        /* Styles omitted for brevity */
    </style>

</head>
    <style>
        /* General reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f9f9;
        }

        /* Main container styles */
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Typography */
        h2 {
            text-align: center;
            margin-bottom: 1rem;
            color: #333;
        }

        /* Table Styles */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 0.5rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border: 1px solid #ddd; /* This adds a light grey border */
        }

        .table th {
            background-color: #4CAF50;
            color: white;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Form Styles */
        .form-control {
            display: block;
            width: 100%;
            padding: 8px 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #4CAF50; /* Green to match your theme */
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.25); /* Light green glow */
        }

        .select-wrapper {
            position: relative;
            display: block;
            width: 100%;
            height: 38px; /* Match the height of your form inputs */
            line-height: 38px;
            overflow: hidden;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .select-wrapper select {
            width: 100%;
            height: 38px;
            background-color: transparent;
            border: none;
            padding: 5px 10px;
            margin: 0;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            font-size: 16px;
            color: #333;
            outline: none;
        }

        /* Add a custom arrow indicator */
        .select-wrapper::after {
            content: '▼';
            position: absolute;
            top: 0;
            right: 10px;
            pointer-events: none;
            color: #333;
            font-size: 16px;
            line-height: 38px;
        }

        select.form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 2rem;
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 8px 15px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            transition: all 0.3s ease;
            cursor: pointer;
            outline: none;
        }

        .btn-submit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-cancel {
            background-color: #f44336;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Wrapping buttons next to each other */
        .button-group {
            display: flex;
            justify-content: flex-start; /* Adjust this as needed */
            gap: 10px; /* Space between buttons */
        }

        /* Ensuring the buttons do not wrap on smaller screens */
        .button-group .btn {
            white-space: nowrap;
        }

        .d-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 10px;
        }

        /* For medium screens and up, use flexbox to put buttons in a row */
        @media (min-width: 768px) {
            .d-md-flex {
                display: flex;
                justify-content: flex-end;
            }

            .gap-2 {
                gap: 0.5rem; /* Adjust the gap between buttons */
            }

            .justify-content-md-end {
                justify-content: flex-end;
            }
        }

    </style>

</head>

<body>
    <div class="container my-5">
        <h2>Update Inventory</h2>
        <form method="POST">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>">
            <div class="row mb-3">
                <div class="form-container">
                    <label class="col-sm-3 col-form-label">Farmer Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="fname" required placeholder="Last, First, Initial" value="<?php echo $fname; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Crop Name</label>
                    <div class="col-sm-6">
                        <div class="select-wrapper">
                            <select name="crop_name" class="form-control">
                                <option value="">Select Crop Name</option>
                                <?php foreach ($crops as $crop): ?>
                                    <option value="<?php echo htmlspecialchars($crop); ?>" <?php if($crop == $cropseed_n) echo 'selected="selected"'; ?>><?php echo htmlspecialchars($crop); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Quantity</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="quantity" required placeholder="ex. 20" value="<?php echo $quantity; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date Reported</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" name="date" value="<?php echo $date; ?>">
                    </div>
                </div>
                <br>
                <div class="button-group">
                    <input type="submit" name="submit" value="Submit" class="btn btn-submit">
                    <a href="/AgriConnectN/inventory.php" class="btn btn-cancel">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Check if the URL contains a success parameter indicating a successful update
        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');

        // If success parameter is present and equals 'true', show the success message
        if (success === 'true') {
            alert('Inventory updated successfully!');
        }
    </script>

</body>
</html>
