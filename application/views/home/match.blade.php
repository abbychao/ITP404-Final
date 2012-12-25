<html>
<head>
	<title>Success</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<h1>Match LinkedIn Accounts</h1>
	<a href="<?php echo URL::to('home/index') ?>">Return to Full Roster.</a></br>
	@include('home.footer')
</body>
</html>