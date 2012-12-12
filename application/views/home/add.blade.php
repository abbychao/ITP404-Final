<html>
<head>
	<title>Add New Member</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/autocomplete.css') ?>">
</head>
<body>
@include('home.header')
<div id='container'>
	<h1>Add New Member</h1>
	{{ $errors->has('fname') ? 'Please enter a first name.<br>' : ''}}
	{{ $errors->has('lname') ? 'Please enter a last name.<br>' : '' }}
	{{ $errors->has('pc_year') ? 'Please enter a 4-digit pledge year.<br>' : '' }}
	{{ $errors->has('grad_year') ? 'Please enter a 4-digit graduation year.<br>' : '' }}
	{{ $errors->has('linkedin') ? 'Please enter a valid LinkedIn URL.<br>' : '' }}
	<form action="<?php echo URL::to('home/added') ?>" method="post">
		<label>First Name:</label> <input type='text' name='fname' /><br>
		<label>Last Name:</label> <input type='text' name='lname' /><br>
		<label>Status:</label> <select name='status_id'>
			<?php foreach ($options['statuses'] as $status) : ?>
				<option name='status_id' value='<?php echo $status->status_id ?>'><?php echo $status->status_name ?></option>
			<?php endforeach ?>
		</select><br>
		<label>Pledge Class:</label> <select name='pc_sem_id'>
			<?php foreach ($options['semesters'] as $semester) : ?>
				<option name='pc_sem_id' value='<?php echo $semester->semester_id ?>'><?php echo $semester->semester_name ?></option>
			<?php endforeach ?>
		</select>
		<input type='text' name='pc_year'><br>
		<label>Graduation:</label> <select name='grad_sem_id'>
			<?php foreach ($options['semesters'] as $semester) : ?>
				<option name='grad_sem_id' value='<?php echo $semester->semester_id ?>'><?php echo $semester->semester_name ?></option>
			<?php endforeach ?>
		</select>
		<input type='text' name='grad_year'><br>
		<label>Family:</label> <select name='family_id' id='family_id'>
			<?php foreach ($options['families'] as $family) : ?>
				<option name='family_id' value='<?php echo $family->family_id ?>'><?php echo $family->family_name ?></option>
			<?php endforeach ?>
		</select><br>
		<label>Big Bro:</label><select name='bigbro_id' id='combobox'>
			<option name='bigbro_id' value='0'></option>
			<?php foreach ($options['roster'] as $bro) : ?>
				<option name='bigbro_id' value='<?php echo $bro->bro_id ?>'><?php echo $bro->bro_fname.' '.$bro->bro_lname ?></option>
			<?php endforeach ?>
		</select><br>
		<label>Email:</label> <input type='text' name='email' /><br>
		<label>LinkedIn:</label> <input type='text' name='linkedin' /><br>
		<input type="submit" value="Add New Member" />
	</form>
</div>
@include('home.footer')
</body>
	<script type="text/javascript" src="<?php echo URL::to_asset('js/jquery-1.8.3.js') ?>"></script>
	<script type="text/javascript" src="<?php echo URL::to_asset('js/jquery-ui-1.9.2.custom.js') ?>"></script>
	<script type="text/javascript" src="<?php echo URL::to_asset('js/autocomplete.js') ?>"></script>
</html>