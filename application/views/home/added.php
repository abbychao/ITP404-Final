<html>
<head>
	<title>Success</title>
</head>
<body>
	<p>Success! <?php echo $input['fname'].' '.$input['lname'] ?> has been added.</p>
	<a href="<?php echo URL::to('home/add') ?>">Add Another.</a><br>
	<a href="<?php echo URL::to('home/index') ?>">Return to Full Roster.</a></br>
</body>
</html>