<html>
<head>
	<title>Search for Members</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<h1>Search for Member</h1>
	<form action="<?php echo URL::to('home/index') ?>" method="post">
		<input type='hidden' name='from_search' value='1'>
		First Name: <input type='text' name='fname' /><br>
		Last Name: <input type='text' name='lname' /><br>
		Status: <select name='status_id'>
			<option name='status_id' value=''></option>
			<?php foreach ($options['statuses'] as $status) : ?>
				<option name='status_id' value='<?php echo $status->status_id ?>'><?php echo $status->status_name ?></option>
			<?php endforeach ?>
		</select><br>
		Pledge Class: <select name='pc_sem_id'>
			<option name='pc_sem_id' value=''></option>
			<?php foreach ($options['semesters'] as $semester) : ?>
				<option name='pc_sem_id' value='<?php echo $semester->semester_id ?>'><?php echo $semester->semester_name ?></option>
			<?php endforeach ?>
		</select>
		<input type='text' name='pc_year'><br>
		Graduation: <select name='grad_sem_id'>
			<option name='grad_sem_id' value=''></option>
			<?php foreach ($options['semesters'] as $semester) : ?>
				<option name='grad_sem_id' value='<?php echo $semester->semester_id ?>'><?php echo $semester->semester_name ?></option>
			<?php endforeach ?>
		</select>
		<input type='text' name='grad_year'><br>
		Family: <select name='family_id'>
			<?php foreach ($options['families'] as $family) : ?>
				<option name='family_id' value='<?php echo $family->family_id ?>'><?php echo $family->family_name ?></option>
			<?php endforeach ?>
		</select><br>
		Big Bro: <select name='bigbro_id'>
			<option name='bigbro_id' value='0'></option>
			<?php foreach ($options['roster'] as $bro) : ?>
				<option name='bigbro_id' value='<?php echo $bro->bro_id ?>'><?php echo $bro->bro_fname.' '.$bro->bro_lname ?></option>
			<?php endforeach ?>
		</select><br>
		Industry:<select name='industry'>
			<?php foreach ($options['industries'] as $industry) : ?>
				<option name='industry' value='<?php echo $industry ?>'><?php echo $industry ?></option>
			<?php endforeach ?>
		</select><br>
		Location:<select name='location'>
			<?php foreach ($options['locations'] as $location) : ?>
				<option name='location' value='<?php echo $location ?>'><?php echo $location ?></option>
			<?php endforeach ?>
		</select><br>
		LinkedIn: <input type='text' name='linkedin' /><br>
		<input type="submit" value="Search" />
	</form>
	@include('home.footer')
</body>
</html>