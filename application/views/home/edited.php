<html>
<head>
	<title>Success</title>
</head>
<body>
	<p>Success! <?php echo $input['fname'].' '.$input['lname'] ?> has been edited.</p>
	<a href="<?php echo URL::to('home/index') ?>">Return to Full Roster.</a></br>
</body>
</html>