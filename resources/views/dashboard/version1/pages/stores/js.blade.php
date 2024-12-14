<script src="https://maps.googleapis.com/maps/api/js?key={{ getGooglePlaceApi() }}&libraries=places"></script>

<script>

    let map;
    let marker;

    function initAutocomplete() {

        initMap();

        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                return;
            }

            let latitude = place.geometry.location.lat();
            let longitude = place.geometry.location.lng();

            console.log("Latitude", latitude);
            console.log("Longitude", longitude);

            document.getElementById('latitude').value  = latitude;
            document.getElementById('longitude').value = longitude;

            // Update the map and marker to the new location
            map.setCenter({ lat: latitude, lng: longitude });
            marker.setPosition({ lat: latitude, lng: longitude });
        });
    }

    google.maps.event.addDomListener(window, 'load', initAutocomplete);

    function initMap() {

        let constLatitude = {{ $latitude }};
        let constLongitude = {{ $longitude }};

        console.log('Latitude', constLatitude,"Longitude", constLongitude);

        // Default location (e.g., Central Park, New York)
        const defaultLocation = { lat: constLatitude, lng: constLongitude };

        map = new google.maps.Map(document.getElementById('map'), {
            center: defaultLocation,
            zoom: 19
        });

        marker = new google.maps.Marker({
            position: defaultLocation,
            map: map
        });
    }
</script>
