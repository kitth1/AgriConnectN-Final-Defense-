<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- jQuery and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
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

<!-- Sidebar -->
<div class="sidebar">
    <h2>Admin Page</h2>
    <!-- Sidebar links -->
    <a href="user_profile.php">Register New Technician</a><br>
    <a href="/AgriConnectN/register_farmer.php">Register New Farmer</a><br>
    <a href="/AgriConnectN/inventory.php">Check inventory</a><br>
    <a href="/AgriConnectN/admin_map.php">Check AGRI MAP</a><br>
    <a href="/AgriConnectN/logout_form.php">Logout</a><br>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="dashboard-box">
        <h2>Dashboard</h2><br>

        <!-- Search bar -->
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search by farm or crop name...">
            <button type="submit" class="btn btn-primary" onclick="searchTable()">Search</button>
        </div>

        <!-- Buttons -->
        <div style="text-align: right; margin-bottom: 20px;">
            <a href="/AgriConnectN/admin_report_ff.php" class="btn btn-primary">Print Report</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCropModal">Register Crop</button>
        </div>
        <div style="text-align: left; margin-bottom: 20px;">
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
                    <th>AREA (hectars)</th>
                    <th>BARANGAY</th>
                    <th>FARM STATUS <br>Active (check)</th>
                    <th>CROP LIST</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
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

                $sql = "SELECT * FROM farmer_acc2 ORDER BY barangay ASC";

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
                            <td>$row[f_area]</td>
                            <td>$row[barangay]</td>
                            <td>
                                <input type='checkbox' class='status-checkbox' onchange='updateStatus({$row["ID"]}, this)' {$isChecked}>
                            </td>
                            <td>"; // Start of the cell for crop list

                    // Fetch and display crop list for each farm
                    $sqlCrops = "SELECT crop_name FROM crop_list WHERE farm_n = '{$row["farm_n"]}'";
                    $resultCrops = $conn->query($sqlCrops);

                    if ($resultCrops->num_rows > 0) {
                        echo "<button type='button' class='btn btn-link' data-toggle='modal' data-target='#cropListModal' onclick='displayCropList(\"{$row["farm_n"]}\")'>View Crops</button>";
                    
                    
                    } else {
                        echo "<a href='/AgriConnectN/add_crop.php'>Add Crop on the Map</a><br>";
                    }

                    echo "</td>"; // End of the cell for crop list
                    echo "
                        <td>
        
                       
                        <button class='btn delete-btn' data-id='{$row["ID"]}' data-toggle='modal' data-target='#deleteConfirmationModal'>Delete</button>
                          </tr>";
                }
                

                $conn->close();
                ?>
            </tbody>
        </table>


        <div id="no-data-message" style="display: none;">No data retrieved.</div>


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
                                (td[5].textContent || td[5].innerText) + " " +
                                (td[6].textContent || td[6].innerText) + " " +
                                (td[7].textContent || td[7].innerText) + " " +
                                (td[8].textContent || td[8].innerText) + " " +
                                (td[9].textContent || td[9].innerText) + " " +
                                (td[10].textContent || td[10].innerText);
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

    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this farm?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Yes</button>
            </div>
        </div>
    </div>
</div>



<!-- Crop List Modal -->
<div class="modal fade" id="cropListModal" tabindex="-1" role="dialog" aria-labelledby="cropListModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="cropListModalBody">
        <!-- Print Button -->
        <button type="button" class="btn btn-success mb-3" onclick="printCropList()">Print Crop List</button>

        <!-- Table for displaying crops -->
        <table class="table table-hover" id="cropListTable">
          <thead>
            <tr>
              <th scope="col">Crop Name</th>
              <th scope="col">Status</th>
              <th scope="col">Crop History</th>
              <th scope="col">Action</th> <!-- Placeholder for action buttons like 'Update Status' -->
            </tr>
          </thead>
          <tbody>
            <!-- Dynamically inserted rows will go here -->
            <!-- PHP or JavaScript code should dynamically insert rows here based on the fetched data -->
            <?php
            // Assuming $cropList is already populated with crops from the database
            // Similar PHP snippet as before for displaying crops
            ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
function printCropList() {
  var divToPrint = document.getElementById('cropListTable');
  var htmlToPrint = '' +
    '<style type="text/css">' +
    'table th, table td {' +
    'border:1px solid #ddd;' +
    'padding;0.5em;' +
    '}' +
    '</style>';
  htmlToPrint += divToPrint.outerHTML;
  var newWin = window.open("");
  newWin.document.write(htmlToPrint);
  newWin.print();
  newWin.close();
}
</script>





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
        xhttp.open("GET", "fetch_crop_list.php?farmName=" + farmName, true);
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

<!-- Add Crop Modal -->
<div class="modal fade" id="addCropModal" tabindex="-1" role="dialog" aria-labelledby="addCropModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCropModalLabel">Add Crop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCropForm">
                    <div class="form-group">
                        <label for="cropName">Crop Name:</label>
                        <input type="text" class="form-control" id="crop_name" name="crop_name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submit">Save Crop</button>
            </div>
        </div>
    </div>
    <script>
document.getElementById('submit').addEventListener('click', function() {
    var cropName = document.getElementById('crop_name').value;
    
    var formData = new FormData();
    formData.append('crop_name', cropName);

    fetch('insert_crop.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert(data.message);
            // Close the modal if desired and reset the form
            $('#addCropModal').modal('hide');
            document.getElementById('addCropForm').reset();
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>


</div>