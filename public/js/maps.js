(function() {

	var points = {
		los_angeles: [34.0522, -118.2428]
	};
	var los_angeles = new google.maps.LatLng(points.los_angeles[0], points.los_angeles[1]);

	var myOptions = {
		zoom: 4,
		center: los_angeles, // takes a LatLng object
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById('map'), myOptions);


	$.ajax({
		url: '../../public/home/map_ajax',
		data: {
			// user: user
		},
		dataType: 'json',
		success: function(response) {
			var i = 0;
			locations = getLocations(response);
			while(locations[i] != null){
				if(locations[i] != null) {
					var members = getMembersAtLocation(response, locations[i]);
					var content = "<div><font color='black'>";
					content += "In "+locations[i]+", there are "+countObj(members)+" people.";
					var j = 0;
					while(members[j] != null) {
						content += '<br>- ' + members[j].bro_fname + ' ' + members[j].bro_lname;
						j++;
					}
					content += "</font></div>";

					var address = locations[i].replace('Greater ','');
					address = address.replace(' Area','');

					(function(content) {
						$.ajax({
							url: '../../TinyGeocoder-master/create-api.php?q='+address,
							success: function(response) {
								var point = response.split(',');
								var latlng = new google.maps.LatLng(point[0],point[1]);
								var marker = new google.maps.Marker({
									position: latlng
								});
								var infowindow = new google.maps.InfoWindow({
									content: content
								});
								google.maps.event.addListener(marker,'click',function() {
									infowindow.open(map, marker);
								})
								marker.setMap(map);
							},
							error: function(err1, err2, err3) {
								console.log(err1, err2, err3);
							}
						});
					})(content)

				}
				i++;
			}
		},
		error: function(err1, err2, err3) {
			console.log(err1, err2, err3);
		}
	});

	function getLocations(members) {
		var results = Array();
		var i = 0;
		while(members[i] != null) {
			if(results.indexOf(members[i].location) == -1) {
				results.push(members[i].location);
			}
			i++;
		}
		return results;	
	}

	function getMembersAtLocation(members, location) {
		var results = Array();

		var i = 0;
		while(members[i] != null) {
			if(members[i].location != '' && location.indexOf(members[i].location) != -1) {
				results.push(members[i]);
			}
			i++;
		}
		return results;
	}

	function countObj(a) {
		var count = 0;
		for (i in a) {
			if(a.hasOwnProperty(i)) {
				count++;
			}
		}
		return count;
	}

})();