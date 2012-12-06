<html>
<head>
	<title>Admin Portal</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<h1>Admin Portal</h1>
	<?php 
		if(isset($_REQUEST['pass']) && $_REQUEST['pass'] == 'logout') {
			echo 'Successfully logged out.';
		}
	?>
	<p>Please enter the administrative password below:</p>
	<form action='' method='post'>
			<input type='password' name='pass' />
			<input type='submit' value='Submit'>
	</form>
	@include('home.footer')
</body>
</html>