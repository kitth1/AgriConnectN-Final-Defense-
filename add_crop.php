<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: white;
  }

  .container {
    width: 48%;
    margin: 20px auto;
    background-color: lightgreen;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .form-group {
    margin-bottom: 15px;
  }

  label {
    display: block;
    margin-bottom: 5px;
  }

  .form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .form-btn {
    width: 100%;
    max-width: 400px;
    padding: 10px;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

.btn-submit {
    background-color: green;
    width: 100%;
    max-width: 400px;
    padding: 10px;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

.btn-cancel {
    background-color: red;
    width: 100%;
    max-width: 400px;
    padding: 10px;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

.btn-submit:hover {
    background-color: lightgreen;
}

.btn-cancel:hover {
    background-color: darkred;
}

.d-grid {
    display: flex;
    justify-content: center; /* Centers the buttons horizontally */
    gap: 10px; /* Maintains space between buttons */
    margin-top: 20px; /* Space above the button container */
  }

  .btn-submit, .btn-cancel {
    width: auto; /* Allows the buttons to size according to their content */
    /* Additional styling for buttons */
  }

  /* Adjusting the map size and alignment */
  #map {
    height: 200px; /* Adjusted height */
    width: 50%; /* Adjusted width */
    margin: 20px auto; /* Centers the map horizontally with automatic margins */
    border-radius: 4px;
    border: 1px solid #ccc;
    display: block; /* Ensures the map behaves as a block-level element */
  }

  @media (max-width: 768px) {
    #map {
      width: 100%; /* Makes the map full-width on smaller screens */
    }
  }

  .flex-container {
    display: flex;
    justify-content: space-between; /* Ensures space between the form and map */
    flex-wrap: wrap; /* Allows items to wrap as needed */
  }

  .form-container {
    flex: 1; /* Allows the container to grow */
    margin-right: 20px; /* Adds some space between the form and map */
  }

  .map-container {
    flex-basis: 400px; /* Gives the map container a base width but allows it to grow */
  }

  #map {
    width: 100%; /* Ensures the map occupies the full width of its container */
    height: 400px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }

  @media (max-width: 768px) {
    .flex-container {
      flex-direction: column; /* Stacks the containers on smaller screens */
    }
    .form-container, .map-container {
      width: 100%; /* Full width for each container */
      margin-right: 0; /* Removes the margin between form and map on small screens */
    }
  }


</style>


<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faccount";

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$farmNames = array();
$sqlFarm = "SELECT farm_n FROM  farmer_acc2  ";
$resultFarm = $conn->query($sqlFarm);
if ($resultFarm->num_rows > 0) {
    while($rowFarm = $resultFarm->fetch_assoc()) {
        $farmName = $rowFarm['farm_n'];
        $farmNames[] = $farmName;
    }
}

// PHP code to fetch barangay names and coordinates from brgy_location table
$barangayData = [];
$sql = "SELECT barangay_location, lat, lng FROM brgy_location";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    $barangayData[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $farm_n = $_POST["farm_n"];
    $crop_name = $_POST["crop_name"];
    $date_planted = $_POST["date_planted"];
    $crop_status = $_POST["crop_status"];
    $crop_lat = $_POST["crop_lat"];
    $crop_lng = $_POST["crop_lng"];

    // Prepare the initial crop history data
    $initialHistory = json_encode([
        ["status" => $crop_status, "date" => $date_planted]
    ]);

    // SQL statement to insert form data into the crop_list table, including initial crop history
    $stmt = $conn->prepare("INSERT INTO crop_list (farm_n, crop_name, date_planted, crop_status, crop_lat, crop_lng, crop_history) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssd", $farm_n, $crop_name, $date_planted, $crop_status, $crop_lat, $crop_lng, $initialHistory);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "New record created successfully";
        header('Location: admin_page.php'); // Redirect after successful insertion
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Crop</title>
</head>
<body>
    <div class="container my-5">
        <h2>Add Farmer Crop</h2>


        <form id="addCropForm" method="POST">

        <div class="form-group">
            <div class="col-sm-6">
              <select name="farm_n" class="form-control" required>
                        <option value="">Select Farm Name</option>
                        <?php foreach ($farmNames as $farmName): ?>
                            <option value="<?php echo htmlspecialchars($farmName); ?>">
                                <?php echo htmlspecialchars($farmName); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div> 
            </div>
            <?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Adjust according to your MySQL server settings
$dbname = "faccount";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$crops = []; // Array to hold crop names

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

$conn->close();
?>


            <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Crop Name</label>
    <div class="col-sm-6">
        <div class="select-wrapper">
            <select name="crop_name" class="form-control">
                <option value="">Select Crop Name</option>
                <?php foreach ($crops as $crop): ?>
                    <option value="<?php echo htmlspecialchars($crop); ?>"><?php echo htmlspecialchars($crop); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div><br>

            <div class="form-group">
    <label for="exampleFormControlInput1">Crop Status</label>
    <select name="crop_status" class="form-control" id="crop_status">
                <!-- Dropdown options -->
                <option value=""> Select Crop Status </option>
                    <option value="seedling"> Seedling </option>
                    <option value="sprouting"> Sprouting </option>
                    <option value="ripening"> Ripening </option>
                    <option value="harvesting"> Harvesting </option>
                    <option value="withered"> Withered</option>
            </select>
  </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date Planted</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" name="date_planted" required value="<?php echo $date_planted; ?>">
                </div> 
            </div>
            <br>
            <label class="col-sm-3 col-form-label">Farm/Crop Location</label>
            <select id="barangay_location" class="form-control" onchange="moveMarkerToSelectedBarangay()">
    <option value="">Select Barangay</option>
    <?php foreach ($barangayData as $barangay): ?>
        <option value='<?php echo json_encode($barangay); ?>'>
            <?php echo htmlspecialchars($barangay['barangay_location']); ?>
        </option>
    <?php endforeach; ?>
</select>
            </div>
            



            <script>
    var map;
    var marker;

    function initMap() {
        var initialLocation = {lat: 10.8062, lng: 122.5841};
        map = new google.maps.Map(document.getElementById('map'), {
            center: initialLocation,
            zoom: 12
        });

        marker = new google.maps.Marker({
            position: initialLocation,
            map: map,
            draggable: true
        });

        // Update hidden input fields on marker dragend
        google.maps.event.addListener(marker, 'dragend', function() {
            updateLocationInputs(marker.getPosition().lat(), marker.getPosition().lng());
        });
    }

    function updateLocationInputs(lat, lng) {
        document.getElementById('crop_lat').value = lat;
        document.getElementById('crop_lng').value = lng;
    }

    function moveMarkerToSelectedBarangay() {
        var barangaySelect = document.getElementById('barangay_location');
        var selectedBarangay = JSON.parse(barangaySelect.value);

        if (selectedBarangay && selectedBarangay.lat && selectedBarangay.lng) {
            var newPosition = new google.maps.LatLng(selectedBarangay.lat, selectedBarangay.lng);
            marker.setPosition(newPosition);
            map.setCenter(newPosition);
            updateLocationInputs(selectedBarangay.lat, selectedBarangay.lng);
        }
    }
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&libraries=places" async defer></script>


            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqzh32K6FXy0xKEpbWwVp2Eqw6OLgR5cY&callback=initMap&libraries=places" async defer></script>
            
            <div class="map-container">
            <div id="map" style="height: 400px; width: 50%;"></div>
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">
</div>

        
<!-- Barangay Dropdown -->
    </div>
    <div class="row mb-3">
    <div class="col-sm-6 offset-sm-3 d-grid gap-2 d-md-flex justify-content-md-end">
        <input type="submit" name="submit" value="Submit" class="btn btn-submit">
        <a class="btn btn-cancel" href="/AgriConnectN/admin_page.php" role="button">Cancel</a>
    </div>
</div>


<div>
<input type="hidden" name="crop_lat" id="crop_lat">
<input type="hidden" name="crop_lng" id="crop_lng">

    </div>
</div>
</div>
        </form>
    </div>

</body>
</html>         