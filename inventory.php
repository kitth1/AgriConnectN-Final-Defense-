<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Page</title>

    <head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
    </div>
    <div class="modal-body">
    <?php
require 'conn.php'; // Assume 'db.php' is your database connection file

// Initialize variables
$farmerNames = [];
$crops = [];
$inventoryData = []; // Array to hold inventory data

// Fetch farmer names
$sqlFarmer = "SELECT f_firstname, f_lastname FROM farmer_acc2 ORDER BY f_firstname ASC";
$resultFarmer = $conn->query($sqlFarmer);
if ($resultFarmer->num_rows > 0) {
    while ($rowFarmer = $resultFarmer->fetch_assoc()) {
        $farmerNames[] = $rowFarmer['f_firstname'] . ' ' . $rowFarmer['f_lastname'];
    }
}

// Fetch crop names
$sqlCrops = "SELECT DISTINCT crop_name FROM crop_list_encode ORDER BY crop_name ASC";
$resultCrops = $conn->query($sqlCrops);
if ($resultCrops->num_rows > 0) {
    while ($rowCrop = $resultCrops->fetch_assoc()) {
        $crops[] = $rowCrop['crop_name'];
    }
}
$showSuccessMessage = false; // Flag to track submission status

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $fname = $conn->real_escape_string($_POST['fname']);
    $cropseed_n = $conn->real_escape_string($_POST['cropseed_n']);
    $quantity = intval($_POST['quantity']);
    $date = $conn->real_escape_string($_POST['date']);

    // Insert into database
    $sqlInsert = "INSERT INTO distribute (fname, cropseed_n, quantity, date) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sqlInsert)) {
        $stmt->bind_param("ssis", $fname, $cropseed_n, $quantity, $date);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

}

// Fetch updated inventory data
$sqlInventory = "SELECT * FROM distribute ORDER BY fname ASC";
$resultInventory = $conn->query($sqlInventory);
if ($resultInventory->num_rows > 0) {
    while ($rowInventory = $resultInventory->fetch_assoc()) {
        $inventoryData[] = $rowInventory;
    }
}

$conn->close();
?>
        <h2>Add to Inventory</h2>

        <div class="container my-5">
        <?php if ($showSuccessMessage): ?>
            <div class="alert alert-success" role="alert">
                Action was successful!
            </div>
        <?php endif; ?>
        <form method="POST">
        <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Farmer Name</label>
                <div class="col-sm-6">
                    <select name="fname" class="form-control" required>
                        <option value="">Select Farmer Name</option>
                        <?php foreach ($farmerNames as $farmerName): ?>
                            <option value="<?php echo htmlspecialchars($farmerName); ?>">
                                <?php echo htmlspecialchars($farmerName); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div> 
            </div>
           
            <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Crop Name</label>
    <div class="col-sm-6">
        <div class="select-wrapper">
            <select name="cropseed_n" class="form-control">
                <option value="">Select Crop Name</option>
                <?php foreach ($crops as $crop): ?>
                    <option value="<?php echo htmlspecialchars($crop); ?>"><?php echo htmlspecialchars($crop); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div><br>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quantity / sack</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" name="quantity" required placeholder="ex. 100" value="<?php echo $quantity; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date Process</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" name="date" required value="<?php echo $date; ?>">
                </div> 
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input type="submit" name="submit" value="Submit" class="btn submit-btn">
            <button type="button" class="btn cancel-btn" onclick="document.getElementById('myModal').style.display='none'">Close</button>
        </div>
         </div>
        </form>
    </div>
      </form>
    </div>
  </div>
</div>

    <style>
        /* General reset and base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body, html {
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
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
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

.table th, .table td {
    padding: 0.5rem;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table th {
    background-color: #006400;
    color: white;
}

.table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table tr:hover {
    background-color: #ddd; /* Lighter grey background when hovered */
}

/* Form Styles */
.form-control {
    width: 100%;
    padding: 0.5rem;
    margin-bottom: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.select-wrapper {
    position: relative;
}

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
.btn,
.form-btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-align: center;
    display: inline-block;
    text-decoration: none;
}
    

/* Specific styles for the submit button */
.submit-btn {
    background-color: #4CAF50; /* Green */
    color: white;
}

.submit-btn:hover {
    background-color: #45a049; /* Darker green */
}

/* Specific styles for the cancel button */
.cancel-btn {
    background-color: #f44336; /* Red */
    color: white;
}

.cancel-btn:hover {
    background-color: #d32f2f; /* Darker red */
}

.delete-btn {
    background-color: #f44336; /* Red */
    color: white;
}

.delete-btn:hover {
    background-color: #d32f2f; /* Darker red */
}
.custom-btn-style {
    background-color: #4CAF50; /* Green */
    color: white;
    border-radius: 4px; /* Optional: Rounds the button corners */
    /* Add any other styling you need */
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
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

  /* Styles for the search bar container */
  .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff; /* White background for the search bar */
            padding: 8px 12px;
            border-radius: 20px; /* Rounded corners for the search bar */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* subtle shadow for depth */
            margin-bottom: 20px; /* Space below the search bar */
            width: 100%; /* Full width */
            max-width: 400px; /* Maximum width of the search bar */
        }

        /* Styles for the search input field */
        #search-input {
            border: none;
            display: inline-block;
            padding: 10px 15px;
            outline: none;
            flex-grow: 1; /* Takes up available space */
            margin-right: 10px; /* Space between input and button */
            font-size: 16px; /* Font size */
        }

        /* Styles for the search button */
        .search-bar button {
            display: inline-block;
            padding: 10px 15px;
            margin-right: px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #5cb85c; /* Bootstrap's btn-success color */
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

    </style>

</head>
<body>
<div class="container my-5">
    
<a href="admin_page.php" class="btn custom-btn-style">Back to admin page</a><br><br><br>
    <div class="row mb-4">
        <div class="col-md-6">
           
        </div>
        <div class="col-md-6 text-right">
            <!-- Buttons aligned to the right -->
            <a href="print_report.php" class="btn custom-btn-style">Print Report</a>
            <button id="myBtn" class="btn custom-btn-style">Add to Inventory</button>
        </div>
    </div>

    <div class="col-md-6">
    <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search by farm or crop name...">
            <button type="submit" class="btn btn-primary" onclick="searchTable()">Search</button>
        </div>
</div>
    <!-- Your table and the rest of the HTML goes here -->
    
        <table class="table" border="1">
            
            <thead>
                <tr>
                    <th>FARMER NAME</th>
                    <th>CROP / SEED NAME</th>
                    <th>QUANTITY / sack</th>
                    <th>DATE DISTRIBUTED</th>
                    <th></th>
                </tr>  
            </thead> 
            <tbody>
            </div>

                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "faccount";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM distribute ORDER BY fname ASC";
                    $result = $conn->query($sql);

                    if(!$result) {
                        die("invalid query: " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>

                        <td>$row[fname]</td>
                        <td>$row[cropseed_n]</td>
                        <td>$row[quantity]</td>
                        <td>$row[date]</td>
                        <td>
                        <a class='form-btn submit-btn' href='/AgriConnectN/update_inventory.php?ID=$row[ID]'> Update </a>
                        <a class='btn delete-btn' href='/AgriConnectN/delete_report.php?ID={$row["ID"]}'>Delete</a>
                        </td>
                    </tr>
                        ";
                    }
                    
                    ?>

<div id="no-data-message" style="display: none;">No data retrieved.</div>
            </tbody>
        </table>
    </div>  
</body>
</html>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<script>
    // Check if the flag for showing the success message is set to true
    <?php if ($showSuccessMessage): ?>
        // Display the alert message
        alert('Inventory added successfully!');
    <?php endif; ?>
</script>

        <script>
    function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search-input");
    filter = input.value.toUpperCase();
    table = document.querySelector(".table");
    tr = table.getElementsByTagName("tr");
    
    var found = false; // Variable to track if any matching data was found

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
        td = tr[i].getElementsByTagName("td");
        let textContent = "";
        // Assuming indices for Farmer Name, Crop/Seed Name, Quantity, and Date Distributed are 0, 1, 2, and 3 respectively
        if (td.length > 3) { // Check if row has enough columns
            textContent = (td[0].textContent || td[0].innerText) + " " +
                            (td[1].textContent || td[1].innerText) + " " +
                            (td[3].textContent || td[3].innerText);
        }

        // Check if any of the specified columns contain the search query
        if (textContent.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
            found = true; // Matching data found
        } else {
            tr[i].style.display = "none";
        }
    }

    // If no matching data was found, display a message
    var noDataMessage = document.getElementById("no-data-message");
    if (noDataMessage) {
        noDataMessage.style.display = found ? "none" : "block";
    }
}

</script>
