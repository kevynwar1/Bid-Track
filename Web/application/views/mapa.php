<?php
	$latitude  = $coordenadas['results'][0]['geometry']['location']['lat'];
	$longitude = $coordenadas['results'][0]['geometry']['location']['lng'];
?>

<div id="map"></div>

<script type="text/javascript">
	function initMap() {
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: <?= $latitude; ?>, lng: <?= $longitude; ?>},
			zoom: 17
		});

		var location = new google.maps.LatLng(<?= $latitude; ?>, <?= $longitude; ?>);
		var marker = new google.maps.Marker({
			map: map,
			draggable: true,
		});
		marker.setPosition(location);
	}
</script>