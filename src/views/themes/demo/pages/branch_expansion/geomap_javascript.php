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
                '<img src="uploads/files/<?php echo $propose_branchrow->PhotoName; ?>" width="300" height="150" class="" alt="">' + + 
                '<h3><?php echo $propose_branchrow->BranchName; ?></h3>' +
                '<h5><b>Latitude: </b><?php echo $propose_branchrow->Latitude; ?></h5>' + 
                '<h5><b>Longtitude: </b><?php echo $propose_branchrow->Longtitude; ?></h5>' + 
                '<h5><b>Region Name: </b><?php echo $propose_branchrow->RegionName; ?></h5>' + 
                '<h5><b>District Name: </b><?php echo $propose_branchrow->DistrictName; ?></h5>' + 
                '<h5><b>Area Name: </b><?php echo $propose_branchrow->AreaName; ?></h5>' + 
                '<h5><b>Branch Name: </b><?php echo $propose_branchrow->BranchName; ?></h5>' + 
                '<h5><b>Ratings: </b><?php echo $propose_branchrow->Ratings; ?></h5>' + 
                '<h5><b>RentalPrice: </b><?php echo $propose_branchrow->RentalPrice; ?></h5>' +     
                '</div>'],
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



