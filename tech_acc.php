<?php
session_start();
?>
<!-- Main Content -->
<div class="main-content">
    <div class="sidebar">
        <a href="/AgriConnectN/logout_form.php">Logout</a>
        <a href="/AgriConnectN/Agusipan_report.php" class="btn btn-primary">Create Survey Report</a>
    </div>
    <h2>Crops in <?php echo htmlspecialchars($_SESSION['tdesignation']); ?></h2>
    <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search by farm or crop name...">
            <button type="submit" class="btn btn-primary" onclick="searchTable()">Search</button>
        </div>
    <!-- Farmer Table -->
    <table class="table">
        <thead>
            <tr>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>MIDDLE INITIAL</th>
                <th>AGE</th>
                <th>SEX</th>
                <th>CONTACT</th>
                <th>FARM NAME</th>
                <th>CROP LIST</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once("conn.php");

            if (!isset($_SESSION['tech_username'])) {
                header('Location: tech_acc.php');
                exit();
            }

            $barangay = $_SESSION['tdesignation']; // Use the barangay stored in session

            // Fetch farmers in the same barangay as the technician
            $stmt = $conn->prepare("SELECT * FROM farmer_acc2 WHERE barangay = ? ORDER BY f_lastname ASC, f_firstname ASC");
            $stmt->bind_param("s", $barangay);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Fetch and check if there are crops for each farm
                    $sqlCrops = "SELECT crop_name FROM crop_list WHERE farm_n = '" . $conn->real_escape_string($row["farm_n"]) . "'";
                    $resultCrops = $conn->query($sqlCrops);

                    // Prepare crop list content
                    $cropContent = "No crops found for this farm."; // Default message
                    if ($resultCrops->num_rows > 0) {
                        // If crops exist, prepare a button to view them
                        $cropContent = "<button type='button' class='btn btn-link' data-toggle='modal' data-target='#cropListModal' onclick='displayCropList(\"" . htmlspecialchars($row["farm_n"]) . "\")'>View Crops</button>";
                    }

                    echo "<tr>
                            <td>" . htmlspecialchars($row['f_lastname']) . "</td>
                            <td>" . htmlspecialchars($row['f_firstname']) . "</td>
                            <td>" . htmlspecialchars($row['f_middlei']) . "</td>
                            <td>" . htmlspecialchars($row['age']) . "</td>
                            <td>" . htmlspecialchars($row['sex']) . "</td>
                            <td>" . htmlspecialchars($row['contact']) . "</td>
                            <td>" . htmlspecialchars($row['farm_n']) . "</td>
                            <td>" . $cropContent . "</td> <!-- Display crops as a button or message -->
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No data found.</td></tr>";
            }

            $conn->close();
            ?>

<div id="no-data" style="display: none;">No data retrieved.</div>

        </tbody>
    </table>
</div>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

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

        /* Sidebar styles */
        .sidebar {
            background-color: #006400; /* Dark green background */
            color: white;
            padding: 20px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 200px; /* Sidebar width */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Higher z-index to ensure sidebar is on top */
        }

        .sidebar a {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            text-align: center;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #004d00;
        }

        .sidebar h2 {
            padding-bottom: 80px; /* Spacing below the Admin title */
        }

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

        /* Main content styles */
        .main-content {
            margin-left: 200px; /* Equal to sidebar width */
            padding: 20px;
            padding-top: 60px; /* Adjust if header height is changed */
        }

        /* Dashboard Box styles */
        .dashboard-box {
            background-color: #fff; /* White background for the box */
            border-radius: 8px; /* Rounded corners for the box */
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1); /* Shadow for depth */
            padding: 20px; /* Padding inside the box */
            margin-bottom: 20px; /* Space below the box */
        }

        /* Table styles */
        .table-container {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px; /* Space below the table */
            background-color: white;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        .table, .table th, .table td {
            border: 1px solid #ddd;
        }

        .table th, .table td {
            text-align: left;
            padding: 8px;
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

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin-right: px;
            border: none;
            border-radius: 5px;
            background-color: #5cb85c; /* Bootstrap's btn-success color */
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table .btn {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }

        .table .update-btn {
            padding: 4px 3px;
            background-color: #5cb85c; /* Green */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 5px;
        }

        .table .delete-btn {
            padding: 5px 10px;
            background-color: #d9534f; /* Red */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 5px;
        }

        /* Additional hover effect for buttons */
        .btn:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow on hover */
            transform: translateY(-2px); /* Slightly raise the button on hover */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: static;
                display: flex;
                overflow-x: auto;
                white-space: nowrap;
                z-index: 1000;
            }

            .main-content {
                margin-left: 0;
                padding-top: 20px;
            }

            .table {
                width: 100%;
            }
        }
    </style>

</head>
<body>

<script>
function displayCropList(farmName) {
    var barangay = "<?php echo addslashes($barangay); ?>"; // Output PHP variable into JS
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("cropListModalBody").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "fetch_crop_list_tech.php?farmName=" + farmName + "&barangay=" + barangay, true);
    xhttp.send();
}
</script>

<!-- JavaScript for Search Functionality -->

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
            // Assuming indices for Farmer Name, Farm Name, Age, Sex, Barangay, and Farm Status are 0, 1, 2, 3, 4, and 5 respectively
            if (td.length > 5) { // Check if row has enough columns
                textContent = (td[0].textContent || td[0].innerText) + " " +
                                (td[1].textContent || td[1].innerText) + " " +
                                (td[2].textContent || td[2].innerText) + " " +
                                (td[3].textContent || td[3].innerText) + " " +
                                (td[4].textContent || td[4].innerText) + " " +
                                (td[6].textContent || td[6].innerText);
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
        var noDataMessage = document.getElementById("no-data");
        if (noDataMessage) {
            noDataMessage.style.display = found ? "none" : "block";
        }
    }
</script>


</div>
</div>

<!-- Crop List Modal -->
<div class="modal fade" id="cropListModal" tabindex="-1" role="dialog" aria-labelledby="cropListModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="cropListModalLabel">Crop List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body" id="cropListModalBody">
        <!-- Updated part: Table for displaying crops -->
        <table class="table">
            <thead>
                <tr>
                    <th>Crop Name</th>
                    <th>Status</th>
                    <th>Action</th> <!-- Placeholder for action buttons like 'Update Status' -->
                </tr>
            </thead>
            <tbody>
                <!-- Dynamically inserted rows will go here -->
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>


<!-- Script for updating farm status -->
<script>
function updateStatus(id, checkbox) {
var status = checkbox.checked ? 'Active' : 'Inactive';
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // Status updated successfully
    }
};
xhttp.open("GET", "update_status.php?id=" + id + "&status=" + status, true);
xhttp.send();
}

function displayCropList(farmName) {
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("cropListModalBody").innerHTML = this.responseText;
    }
};
xhttp.open("GET", "Agusipan_fetch_crop_list.php?farmName=" + farmName, true);
xhttp.send();
}
</script>
<script>
// jQuery is already loaded in your project, so let's use it for simplicity
$(document).ready(function() {
var deleteId; // to store the ID of the farm to be deleted

// When a delete button is clicked, store the farm's ID and add it to the Yes button
$('#deleteConfirmationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    deleteId = button.data('id'); // Extract info from data-* attributes

    var modal = $(this);
    modal.find('#confirmDelete').data('id', deleteId); // Set data-id attribute for the Yes button
});

// When the Yes button is clicked, proceed with deletion
$('#confirmDelete').click(function() {
    var id = $(this).data('id'); // Retrieve the ID
    window.location.href = '/AgriConnectN/delete.php?ID=' + id; // Redirect for deletion
});
});
</script>

<script>
    function displayCropList(farmName) {
    var barangay = "<?php echo addslashes($barangay); ?>"; // Output PHP variable into JS
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("cropListModalBody").innerHTML = this.responseText;
        }
    };
    // Send the barangay as part of the request
    xhttp.open("GET", "fetch_crop_list_tech.php?farmName=" + farmName + "&barangay=" + barangay, true);
    xhttp.send();
}

    </script>

</body>
</html>
