<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report Page</title>
    <style>
    /* General Style Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f9f9f9;
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

    .container {
        max-width: 90%;
        margin: 20px auto;
        padding: 20px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #003300;
        text-align: center;
        margin-bottom: 20px;
    }

/* Additional styles for buttons */
.btn {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 16px; /* Adjust font size to your preference */
    padding: 10px 15px; /* Adjust padding to your preference */
    border: none; /* Remove border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    margin-left: 8px; /* Space between buttons */
    text-align: center; /* Center text inside buttons */
    text-decoration: none;
}

/* Additional hover effect for buttons */
.btn:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow on hover */
    transform: translateY(-2px); /* Slightly raise the button on hover */
}

/* Specific styles for the cancel button */
.btn.cancel {
    background-color: #d9534f; /* Red background color */
    color: white; /* White text color */
}

.btn.cancel:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow on hover */
    transform: translateY(-2px); /* Slightly raise the button on hover */
}

/* Specific styles for the print button */
.btn.print {
    background-color: #5cb85c; /* Green background color */
    color: white; /* White text color */
}

/* Align buttons to the right */
.btn-container {
    text-align: left;
    margin-top: 20px; /* Space above the button container */
}

    .table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #006400;
        color: white;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            width: 95%;
        }

        .btn {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
    }

/* Print-specific styles */
@media print {
    body, html {
        background: none;
        -webkit-print-color-adjust: exact; /* Ensures that background color and images are printed */
    }

    .container {
        box-shadow: none;
        margin: 0;
        width: auto;
        max-width: 100%;
    }

    .table th, .table td {
        border: 1px solid #000; /* Ensures the table borders are visible when printed */
    }

    .table th {
        background-color: #fff; /* Removes the background color */
        color: #000; /* Sets the text color to black */
    }

    .btn, .no-print, .search-bar{
        display: none; /* Hide elements that shouldn't be printed */
    }


@media (max-width: 768px) {
    .container {
        width: 95%;
        max-width: none;
    }
}
}
</style>

<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc"; 
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;      
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>


</head>
<body>
    <div class="container my-5">
        <h2>FARM REPORT</h2>
        <div class="btn-container">
        <a href="admin_page.php" class="btn cancel">Cancel</a>  
        <button class="btn print" onclick="window.print()">Print Report</button>
        <br><br>
        <table class="table border=1">
            
        <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search by farm or crop name...">
                <button type="submit" class="btn btn-search" onclick="searchTable()">Search</button>
            </div>
            <thead>
                <tr>
                    <th>LAST NAME</th>
                    <th>FIRST NAME</th>
                    <th>MIDDLE INITIAL</th>
                    <th>AGE</th>
                    <th>SEX</th>
                    <th>FARM NAME</th>
                    <th>FARM STATUS</th>
                    <th>AREA (hectars)</th>
                    <th>BARANGAY</th>
                    <th>CONTACT</th>
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

                    $sql = "SELECT * FROM farmer_acc2 ORDER BY barangay ASC";
                
                    $result = $conn->query($sql);

                    if(!$result) {
                        die("invalid query: " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>

                        <td>$row[f_lastname]</td>
                        <td>$row[f_firstname]</td>
                        <td>$row[f_middlei]</td>
                        <td>$row[age]</td>
                        <td>$row[sex]</td>
                        <td>$row[farm_n]</td>
                        <td>$row[status]</td>
                        <td>$row[f_area]</td>
                        <td>$row[barangay]</td>
                        <td>$row[contact]</td>
                    
                    </tr>
                        ";
                    }
                    
                    ?>
                
            </tbody>
        </table>
    </div>

    <div id="no-data-message" style="display: none;">No data retrieved.</div>

        
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
            // Assuming indices for Last Name, First Name, Farm Name, Barangay, and Crop List are 0, 1, 6, 7, and 9 respectively
            if (td.length > 9) { // Check if row has enough columns
                textContent = (td[0].textContent || td[0].innerText) + " " +
                                (td[1].textContent || td[1].innerText) + " " +
                                (td[5].textContent || td[5].innerText) + " " +
                                (td[6].textContent || td[6].innerText) + " " +
                                (td[8].textContent || td[8].innerText) + " " +
                                (td[3].textContent || td[3].innerText); // Include Sex column (assuming index 3)
            }

            // Hide the row if none of the specified columns contain the search query
            if (textContent.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                found = true; // Matching data found
            } else {
                tr[i].style.display = "none";
            }
        }

        // If no matching data was found, display a message
        if (!found) {
            var noDataMessage = document.getElementById("no-data-message");
            if (noDataMessage) {
                noDataMessage.style.display = "block";
            }
        } else {
            // If matching data was found, ensure the no-data message is hidden
            var noDataMessage = document.getElementById("no-data-message");
            if (noDataMessage) {
                noDataMessage.style.display = "none";
            }
        }
    }
</script>

</body>
</html>
