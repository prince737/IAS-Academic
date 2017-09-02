function initMap() {
        var uluru = {lat: 22.507947, lng: 88.367640};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
		  center: uluru
		  
          
        });
		var marker = new google.maps.Marker({
          position: uluru,
          map: map,
        });
		
		var uluru1 = {lat: 22.507947, lng: 88.367640};
        var map1 = new google.maps.Map(document.getElementById('map1'), {
          zoom: 10,
          center: uluru1
		  
        });

		var marker1 = new google.maps.Marker({
          position: uluru1,
          map: map1,
        });
		
		
		var uluru3 = {lat: 24.098559, lng: 88.255973};
        var map3 = new google.maps.Map(document.getElementById('map3'), {
          zoom: 10,
          center: uluru3
		  
        });

		var marker3 = new google.maps.Marker({
          position: uluru3,
          map: map3,
        });
		
		
      }
	  
	  