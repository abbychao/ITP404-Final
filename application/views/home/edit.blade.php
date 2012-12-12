<html>
<head>
	<title>Edit Member Profile</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/autocomplete.css') ?>">
</head>
<body>
	@include('home.header')
	<h1>Edit Member Profile</h1>
	{{ $errors->has('fname') ? 'Please enter a first name.<br>' : ''}}
	{{ $errors->has('lname') ? 'Please enter a last name.<br>' : '' }}
	{{ $errors->has('pc_year') ? 'Please enter a 4-digit pledge year.<br>' : '' }}
	{{ $errors->has('grad_year') ? 'Please enter a 4-digit graduation year.<br>' : '' }}
	{{ $errors->has('linkedin') ? 'Please enter a valid LinkedIn URL.<br>' : '' }}
	<form action="<?php echo URL::to('home/edited') ?>" method="post">
		<input type='hidden' name='bro_id' value='<?php echo $bro->bro_id ?>'>
		<label>First Name:</label><input type='text' name='fname' value='<?php echo $bro->bro_fname ?>' /><br>
		<label>Last Name:</label><input type='text' name='lname' value='<?php echo $bro->bro_lname ?>' /><br>
		<label>Status:</label><select name='status_id'>
			<option name='status_id' value='<?php echo $bro->status_id ?>'><?php echo $bro->status_name ?></option>
			<?php foreach ($options['statuses'] as $status) : ?>
				<option name='status_id' value='<?php echo $status->status_id ?>'><?php echo $status->status_name ?></option>
			<?php endforeach ?>
		</select><br>
		<label>Pledge Class:</label><select name='pc_sem_id'>
			<option name='pc_sem_id' value='<?php echo $bro->pc_sem_id ?>'><?php echo $bro->pc_sem ?></option>
			<?php foreach ($options['semesters'] as $semester) : ?>
				<option name='pc_sem_id' value='<?php echo $semester->semester_id ?>'><?php echo $semester->semester_name ?></option>
			<?php endforeach ?>
		</select>
		<input type='text' name='pc_year' value='<?php echo $bro->pc_year ?>'><br>
		<label>Graduation:</label><select name='grad_sem_id'>
			<option name='grad_sem_id' value='<?php echo $bro->grad_sem_id ?>'><?php echo $bro->grad_sem ?></option>
				<?php foreach ($options['semesters'] as $semester) : ?>
				<option name='grad_sem_id' value='<?php echo $semester->semester_id ?>'><?php echo $semester->semester_name ?></option>
			<?php endforeach ?>
		</select>
		<input type='text' name='grad_year' value='<?php echo $bro->grad_year ?>' ><br>
		<label>Family:</label><select name='family_id'>
			<option name='family_id' value='<?php echo $bro->family_id ?>'><?php echo $bro->family_name ?></option>
			<?php foreach ($options['families'] as $family) : ?>
				<option name='family_id' value='<?php echo $family->family_id ?>'><?php echo $family->family_name ?></option>
			<?php endforeach ?>
		</select><br>
		<label>Big Bro:</label><select name='bigbro_id' id='combobox'>
			<option name='bigbro_id' value='<?php echo $bro->bigbro_id ?>'><?php echo Roster::getNameById($bro->bigbro_id) ?></option>
			<?php foreach ($options['roster'] as $bigbro) : ?>
				<option name='bigbro_id' value='<?php echo $bigbro->bro_id ?>'><?php echo $bigbro->bro_fname.' '.$bigbro->bro_lname ?></option>
			<?php endforeach ?>
		</select><br>
		<label>Email:</label><input type='text' name='email' value='<?php echo $bro->email ?>' /><br>
		<label>LinkedIn:</label><input type='text' name='linkedin' value='<?php echo $bro->linkedin ?>' /><br>
		<input type="submit" value="Submit Edits" />
	</form>
	@include('home.footer')
	<script type="text/javascript" src="<?php echo URL::to_asset('js/jquery-1.8.3.js') ?>"></script>
	<script type="text/javascript" src="<?php echo URL::to_asset('js/jquery-ui-1.9.2.custom.js') ?>"></script>
	<script type="text/javascript" src="<?php echo URL::to_asset('js/autocomplete.js') ?>"></script></body>
</html>