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
<!-- Main Content -->
<div class="main-content">

<div class="sidebar">
<a href="/AgriConnectN/logout_form.php">Logout</a>
   
    <a href="/AgriConnectN/Bagumbayan_report.php" class="btn btn-primary">Create Survey Report</a>
</div>

    <div class="dashboard-box">
        <h2>BARANGAY BAGUMBAYAN</h2><br>

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
    </div>
        <!-- PHP Section for fetching farmer data and crop list -->
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "faccount";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM farmer_acc2 WHERE barangay= 'Bagumbayan' ORDER BY f_lastname ASC";

        $result = $conn->query($sql);

        if(!$result) {
            die("invalid query: " . $conn->error);
        }

        while($row = $result->fetch_assoc()) {
            $isChecked = $row['status'] == 'Active' ? 'checked' : '';

            echo "<tr>
                    <td>$row[f_lastname]</td>
                    <td>$row[f_firstname]</td>
                    <td>$row[f_middlei]</td>
                    <td>$row[age]</td>
                    <td>$row[sex]</td>
                    <td>$row[contact]</td>
                    <td>$row[farm_n]</td>
                    
                    <td>"; // Start of the cell for crop list

            // Fetch and display crop list for each farm
            $sqlCrops = "SELECT crop_name FROM crop_list WHERE farm_n = '{$row["farm_n"]}'";
            $resultCrops = $conn->query($sqlCrops);

            if ($resultCrops->num_rows > 0) {
                echo "<button type='button' class='btn btn-link' data-toggle='modal' data-target='#cropListModal' onclick='displayCropList(\"{$row["farm_n"]}\")'>View Crops</button>";
            } else {
                echo "No crops found for this farm.";
            }

            echo "</td>"; // End of the cell for crop list
            echo "
                  </tr>";
        }

        $conn->close();
        ?>
    </tbody>
</table>

<!-- JavaScript for Search Functionality -->

   <script>
    function searchTable() {
        var input, filter, table, tr, i;
        input = document.getElementById("search-input");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            // Get the text content for the relevant columns in each row
            let isMatch = Array.from(tr[i].getElementsByTagName("td")).some((td, index) => {
                // Assuming indices for First Name, Last Name, Farm Name, Age, and Sex are 0, 1, 6, 3, and 4 respectively
                if ([0, 1, 6, 3, 4].includes(index)) {
                    return (td.textContent || td.innerText).toUpperCase().indexOf(filter) > -1;
                }
                return false;
            });

            // Show or hide the row based on whether there's a match
            tr[i].style.display = isMatch ? "" : "none";
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
xhttp.open("GET", "Bagumbayan_fetch_crop_list.php?farmName=" + farmName, true);
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

</body>
</html>
