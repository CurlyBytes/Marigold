function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(100);
        
    // Multiple markers location, latitude, and longitude
    var markers = [
        <?php if($propose_branch !== null){ 
            foreach($propose_branch as $propose_branchrow){
                //echo '["'.$row['name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.$row['icon'].'"],'; 
                echo '["'.$propose_branchrow->BranchName.'", '.$propose_branchrow->Latitude.', '.$propose_branchrow->Latitude.', "'. base_url() . '/assets/theme-demo/img/lightblue-pin-min.png' .'"],'; 
            } 
        } 
        ?>
    ];
                        
    // Info window content
    var infoWindowContent = [
        <?php if($propose_branch !== null){ 
            foreach($propose_branch as $propose_branchrow){  ?>
                ['<div class="info_content">' +
                '<h3><?php echo $propose_branchrow->BranchName; ?></h3>' +
                '<p><?php echo $propose_branchrow->BranchName; ?></p>' + '</div>'],
        <?php } 
        } 
        ?>
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
			icon: markers[i][3],
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
}

// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);