<html>
<head>
	<title>Transition</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<h1>Semester-End Transition</h1>
	What is the current semester?
	<form action="" method="">
		<select name='grad_sem_id'>
			<?php foreach ($options['semesters'] as $semester) : ?>
				<option name='grad_sem_id' value='<?php echo $semester->semester_id ?>'>
					<?php echo $semester->semester_name ?>
				</option>
			<?php endforeach ?>
		</select>
		<input type='text' name='grad_year'><input type='submit' value='Submit'><br>
	</form>
	<div id="transition_results"></div>
	<br><a href="<?php echo URL::to('home/index') ?>">Return to Full Roster.</a></br>
	@include('home.footer')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script>
    	var global_grad_sem_id = ''+<?php echo Input::get('grad_sem_id') ?>;
    	var global_grad_year = ''+<?php echo Input::get('grad_year') ?>;
    </script>
    <script type='text/javascript' src="<?php echo URL::to_asset('js/transition.js') ?>"></script>
</body>
</html>