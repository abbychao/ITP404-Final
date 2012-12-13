<html>
<head>
	<title>Login Portal</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<h1>Login Portal</h1>
	<?php 
		if(isset($_REQUEST['logout'])) {
			echo 'Successfully logged out.';
		}
		if(isset($_REQUEST['pass'])) {
			echo 'Please try again.';
		}
	?>
	<p>Please log in below:</p>
	<form action='' method='post'>
		<input type='text' name='username' />
		<input type='password' name='pass' />
		<input type='submit' value='Submit'>
	</form>
	@include('home.footer')
</body>
</html>