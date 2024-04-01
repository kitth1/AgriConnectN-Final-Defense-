<!DOCTYPE html>
<html>
<head>
    <title>Farmer Locations Map</title>
    <head>
        <!-- Metadata for responsive design and character setting -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!-- Page Title -->
        <title>AgriConnect Map</title>
    
        <!-- Google Maps API -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqzh32K6FXy0xKEpbWwVp2Eqw6OLgR5cY&callback=initMap" async defer></script>
    
        <!-- Custom styles -->
        <style>
      /* Main styles */
      body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2; /* Light gray background for a modern look */
        }

        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px; /* Fixed width for a modern look */
            height: 100%;
            background-color: #006400; /* Dark green background */
            color: white; /* White text color */
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1); /* Softer shadow */
            z-index: 5;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

/* Header styles */
.sidebar h1 {
    font-size: 30px;
    text-align: center; /* Center align the h1 title */
    width: 100%; /* Ensure the full width of the sidebar is available for centering */
    margin-bottom: 20px;
    margin-top: 10px; /* You can adjust the margin-top to align it as needed */
}

.sidebar h3 {
    text-align: center;
    margin-top: 10px; /* or whatever value that works for you */
}

        /* Legend and Info Panel styles */
        .info-panel, #legend-panel {
            color: #333; /* Set text color to black */
            background-color: #fff;
            padding: 15px;
            margin-top: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            padding-top: 10px; /* Reduce the top padding to bring content closer to the top */
        }

        .info-panel:hover, #legend-panel:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }

        /* Info Panel and Legend Panel heading styles */
        .info-panel h3, #legend-panel h3 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Legend icon styles */
        .legend-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            margin-right: 5px;
            vertical-align: middle;
        }

        /* Style for lists in the legend */
        #legend-panel ul {
            font-weight: bold; /* Makes text bold */
            text-align: center;
            padding: 0;
        }

        #legend-panel li {
            display: inline-block; /* Align list items side by side */
            padding: 5px 10px; /* Adjust padding as needed */
        }

/* Ensure the '•' before the list items are centered with the text */
#legend-panel li::before {
    text-align: center;
    vertical-align: middle;
}

        /* Button styles */
        .btn {
            background-color: #367C39;
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: block;
            margin-bottom: 20px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2e623d;
        }

        /* Map styles */
        #map {
            position: absolute;
            left: 290px;
            right: 0;
            top: 0;
            bottom: 0;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .sidebar, #map {
                width: 100%;
                left: 0;
            }
            .sidebar {
                padding: 10px;
                position: relative;
            }
            .form-control, .btn {
                margin-left: 0;
                margin-right: 0;
            }
            .info-panel, #legend-panel {
                border-left: none;
                border-top: 5px solid #4CAF50;
                box-shadow: none;
            }
        }

        /* Form control styles */
        .form-control {
            width: 100%;
            margin-bottom: 5px;
            border-radius: 5px;
            font-size: 16px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #c3eccb;
        }

        .sidebar input[type="text"] {
                width: calc(100% - 20px); /* Adjust width to fit inside sidebar */
                margin-bottom: 5px; /* Smaller margin */
                padding: 5px 10px; /* Smaller padding */
                font-size: 14px; /* Smaller font size */
            }

            .sidebar button {
                width: 100%; /* Full width */
                padding: 5px 0; /* Smaller padding */
                font-size: 14px; /* Smaller font size */
            }
        </style>
        </style>
</head>
<body>
</head>
<body>
        <div class="sidebar">
        <h1>Agri Map</h1>

        
    <a class='btn' href='/AgriConnectN/admin_page.php'> ADMIN PAGE </a>


    </header>
    <label for="cropNameSelect">Crop Name</label>
    <select name="crop_name" id="cropNameSelect" class="form-control">
  <option value=""> Select Crop Name </option>
        <?php
        $host = 'localhost';
        $dbname = 'faccount'; // Your database name
        $user = 'root'; // Your database username
        $pass = ''; // Your database password

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query('SELECT DISTINCT crop_name FROM crop_list_encode ORDER BY crop_name ASC');

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value=\"" . htmlspecialchars($row['crop_name']) . "\">" . htmlspecialchars($row['crop_name']) . "</option>";
            }
        } catch (PDOException $e) {
            error_log("Connection error: " . $e->getMessage());
            echo "<option disabled>Error loading crops</option>"; // Show a user-friendly error message
        }
        ?>
          </select><br>

    <label for="cropStatusSelect">Crop Status</label>
    <select name="crop_status" id="cropStatusSelect" class="form-control">
    <option value=""> Select Crop Status </option>
        <option value="seedling"> Seedling </option>
        <option value="sprouting"> Sprouting </option>
        <option value="ripening"> Ripening </option>
        <option value="harvesting"> Harvesting </option>
        <option value="withered"> Withered </option>
            </select>

            <div id="legend-panel">
        <h3>Crop Status Legend</h3>
        <ul>
            <img src="https://www.dropbox.com/scl/fi/7cmb9wpj2tu8y7e0zj32s/seedling.jpg?rlkey=f2soc6zsryqp55azm84nkf6ps&raw=1" alt="Seedling" class="legend-icon"/> Seedling</li><br>
            <br><img src="https://www.dropbox.com/scl/fi/l3r3wxpeya3w7t6mre0la/sprouting.jpg?rlkey=exgigjj9q837nqeqaad4bc0hc&raw=1" alt="Sprouting" class="legend-icon"/> Sprouting</li><br>
            <br><img src="https://www.dropbox.com/scl/fi/2zaocbu7n2hcmfdwthqwm/ripening.jpg?rlkey=xk4hs5v4d1bi0cr98dquhwy9r&raw=1" alt="Ripening" class="legend-icon"/> Ripening</li><br>
            <br><img src="https://www.dropbox.com/scl/fi/ipkj4s92q4gfzyze998do/harvesting.jpg?rlkey=anvlghst546st6y38fb02rv94&raw=1" alt="Harvesting" class="legend-icon"/> Harvesting</li><br>
            <br><img src="https://www.dropbox.com/scl/fi/x4e7j9twva3gg0o1cpt3k/withered.jpg?rlkey=44u61qxroyzv7z4sjvjypmmx7&raw=1" alt="Withered" class="legend-icon"/> Withered</li><br>
        </ul>
  </div>
  

    <div id="info-panel" class="info-panel">
        <h3>Information Panel</h3>
    </div>
</div>
</div>
<div id="map"></div>
    
    
    <!---FUNCTIONS APPLY TO THE MAP-->

    <script>
        var map;
        var markers = [];
        var infoWindow;
        var statusIcons = {
    "seedling": "https://dl.dropboxusercontent.com/scl/fi/a7dg21u2qagj6gsduq98l/seedling.png?rlkey=qdfgovmv78ittcofqb6h758lx&dl=0", 
    "sprouting": "https://dl.dropboxusercontent.com/scl/fi/sl1oawhtlje6zn7zd9oi9/sprouting.png?rlkey=iikvc7qc6t4omdhcpb9g54c9m&dl=0",
    "ripening": "https://dl.dropboxusercontent.com/scl/fi/1vd2ruzanzwuyn8pu152z/ripening.png?rlkey=uodcl7u3d316oqtlzvj6m8h68&dl=0",
    "harvesting": "https://dl.dropboxusercontent.com/scl/fi/urqfkrzc2mjtnk0gstukg/harvesting.png?rlkey=ep8y3sssp0lzfnyxwkcn8q71m&dl=0",
    "withered": "https://dl.dropboxusercontent.com/scl/fi/mt8w9jmj295fi1vdk3hrd/withered.png?rlkey=6p1p4061fgjbzp7be1lc41kix&dl=0",
    "default": "https://dl.dropboxusercontent.com/s/abcd1234/default.jpg"
};


    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 10.821896, lng: 122.533459 },
            zoom: 13.2
    });
        
    nfoWindow = new google.maps.InfoWindow();
        
     fetchAndDisplayCrops();
}
        
        // Function to add a marker for each crop on the map
        // Global object to store markers by farm ID
        var markersByFarm = {};
        
        function addMarker(crop) {
            var position = { lat: parseFloat(crop.crop_lat), lng: parseFloat(crop.crop_lng) };
            var iconUrl = statusIcons[crop.crop_status] || statusIcons['default']; // Fetch the icon based on crop status
        
            // Define the icon with a custom smaller size
            var icon = {
                url: iconUrl, // URL of the image
                scaledSize: new google.maps.Size(70, 85), // Adjusted smaller size of the marker
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(10, 7.5) // Adjusted anchor point for the smaller icon
            };
        
            var marker = new google.maps.Marker({
                position: position,
                map: map,
                title: crop.crop_name,
                icon: icon // Use the customized icon with scaled size
            });
        
            markers.push(marker); // Add the new marker to the array of markers
        
            marker.addListener('click', () => {
                showInfoPanel(crop); // Show details of the crop in the info panel when the marker is clicked
            });
        }
        
        
        
        // Function to show/hide markers based on farm status
        function updateMarkerVisibility(farm_n, isVisible) {
            if (markersByFarm[farm_n]) {
                markersByFarm[farm_n].forEach(function(marker) {
                    marker.setMap(isVisible ? map : null);
                });
            }
        }
        
        function fetchStatusIcons() {
            fetch('status_icon.json') // Adjust the path to where your JSON file is hosted
                .then(response => response.json())
                .then(data => {
                    statusIcons = data;
                })
                .catch(error => console.error('Error fetching status icons:', error));
        }
        async function initMapAndIcons() {
            await fetchStatusIcons(); // Wait for icons to be fetched
            fetchAndDisplayCrops();   // Then display crops
        }
        
        async function fetchStatusIcons() {
    try {
        // Append a timestamp to the URL to prevent caching
        const response = await fetch('status_icon.json?' + new Date().getTime());
        statusIcons = await response.json();
    } catch (error) {
        console.error('Error fetching status icons:', error);
    }
}
        initMapAndIcons();
        
        
        // Call this function early in your script or before adding markers
        fetchStatusIcons();
        
        function updateAllMarkerIcons() {
    markers.forEach(marker => {
        const newIcon = statusIcons[marker.getTitle()] || statusIcons['default'];
        marker.setIcon(newIcon);
    });
}
        // Example usage:
        // updateMarkerIcon(marker, 'ripening'); // Assuming 'marker' is a Google Maps Marker object
        
        document.getElementById('cropNameSelect').addEventListener('change', filterAndUpdateMap);
        document.getElementById('cropStatusSelect').addEventListener('change', filterAndUpdateMap);
        
        // This function is called whenever the selection changes
        function filterAndUpdateMap() {
            // Fetch and display crops based on the current selection
            fetchAndDisplayCrops();
        }
        
        function fetchAndDisplayCrops() {
            fetch('get_crops.php') // Adjust this to your actual data source URL
            .then(response => response.json())
            .then(crops => {
                const selectedCropName = document.getElementById('cropNameSelect').value;
                const selectedCropStatus = document.getElementById('cropStatusSelect').value;
        
                // Clear all existing markers
                markers.forEach(marker => marker.setMap(null));
                markers = []; // Reset the markers array
        
                // Filter crops based on the dropdown selections
                crops.forEach(crop => {
                    if ((selectedCropName === '' || crop.crop_name === selectedCropName) &&
                        (selectedCropStatus === '' || crop.crop_status === selectedCropStatus)) {
                        addMarker(crop); // Add a marker for each matching crop
                    }
                });
            })
            .catch(error => console.error('Error fetching crop data:', error));
        }
        
        // Function to display information about the crop in an info panel
        function showInfoPanel(crop) {
            var infoPanel = document.getElementById('info-panel');
            var content = `
                <div>
                    <h3>Farm Name: ${crop.farm_n}</h3>
                    <h4>Barangay: ${crop.barangay}</h4>
                    <p>Farmer Name: ${crop.f_firstname} ${crop.f_lastname}</p>
                    <p>Crop Name: ${crop.crop_name}</p>
                    <p>Crop Status: ${crop.crop_status}</p>
                    <p>Contact: ${crop.contact}</p>
                    <p>Planted: ${timeSincePlanted(crop.date_planted)}</p>
                </div>
            `;
            infoPanel.innerHTML = content;
        }
        
        
        function timeSincePlanted(datePlanted) {
            const plantedDate = new Date(datePlanted);
            const now = new Date();
            const differenceInTime = now.getTime() - plantedDate.getTime();
            const days = differenceInTime / (1000 * 3600 * 24);
            if (days < 30) {
                return `${Math.round(days)} days ago`;
            } else if (days < 365) {
                return `${Math.round(days / 30)} months ago`;
            } else {
                return `${Math.round(days / 365)} years ago`;
            }
        }
        

function getDaysOld(datePlanted) {
    const plantedDate = new Date(datePlanted);
    const now = new Date();
    const difference = now.getTime() - plantedDate.getTime();
    const daysOld = Math.floor(difference / (1000 * 60 * 60 * 24));
    return daysOld;
}

// Call this function early in your script or before adding markers
fetchStatusIcons();


// Helper function to calculate days since the crop was planted
function getDaysOld(datePlanted) {
    const plantedDate = new Date(datePlanted);
    const now = new Date();
    const difference = now - plantedDate;
    const daysOld = Math.floor(difference / (1000 * 60 * 60 * 24));
    return daysOld;
}


// Function to calculate days since the crop was planted
function getDaysOld(datePlanted) {
    const plantedDate = new Date(datePlanted);
    const now = new Date();
    return Math.floor((now - plantedDate) / (1000 * 60 * 60 * 24));
}

        
        window.onload = initMap;
        


        
            </script>
            
        
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqzh32K6FXy0xKEpbWwVp2Eqw6OLgR5cY&callback=initMap" async defer></script>
        </body>
        </html>
        