<html>
<head>
	<title>Success</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<p>Success! <?php 
		if(!empty($input['fname'])) {
			echo $input['fname'].' '.$input['lname'].' has';
		}
		else {
			echo 'Selected records have';
		}
	?> been edited.</p>
	<a href="<?php echo URL::to('home/index') ?>">Return to Full Roster.</a></br>
	@include('home.footer')
</body>
</html>