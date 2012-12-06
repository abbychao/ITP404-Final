<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Map</title>
	<style>	#map {height: 600px; width:900px; margin:0 auto;} </style>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
</head>
<body>
	@include('home.header')
	<h1>Map</h1>

	<span id="errors"></span>
	<div id="map"></div>
	<!-- <div id="map-sidebar">
		<div id="map-search">Search Box</div>
		<div id="map-results">Results</div>
	</div> -->


	<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="<?php echo URL::to_asset('js/maps.js') ?>"></script>

	@include('home.footer')

</body>
</html>