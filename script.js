var map;
var markers = [];

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 10.7240, lng: 122.4563 },
        zoom: 12
    });

    fetchAndDisplayFarmers();
}

function addMarker(farm) {
    var position = new google.maps.LatLng(farm.latitude, farm.longitude);
    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title: farm.farm_n
    });
    markers.push(marker);
}

function fetchAndDisplayFarmers() {
    // Assuming your PHP script is named get_farmer_data.php and is located at the server root
    fetch('get_farmer_locations.php')
        .then(response => response.json())
        .then(farms => {
            farms.forEach(addMarker);
        })
        .catch(error => console.error('Error fetching farmer data:', error));
}

window.onload = initMap;