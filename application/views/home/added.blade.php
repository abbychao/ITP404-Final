<html>
<head>
	<title>Success</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<p>Success! <?php echo $input['fname'].' '.$input['lname'] ?> has been added.</p>
	<a href="<?php echo URL::to('home/add') ?>">Add Another.</a><br>
	<a href="<?php echo URL::to('home/index') ?>">Return to Full Roster.</a></br>
	@include('home.footer')
</body>
</html>