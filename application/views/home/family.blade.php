<html>
<head>
	<title>Family Profile</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<h1><?php echo Roster::getFamilyById(Input::get('family_id')) ?></h1>
    <div id='chart-div'></div>

	<script type='text/javascript' src='https://www.google.com/jsapi'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script>
    	var global_family_id = <?php echo Input::get('family_id') ?>
    </script>
	<script type='text/javascript' src="<?php echo URL::to_asset('js/orgchart.js') ?>"></script>
	@include('home.footer')
</body>
</html>