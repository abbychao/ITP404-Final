<html>
<head>
	<title>Edit Member Profile</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<h1>Edit Member Profile</h1>
	<form action="<?php echo URL::to('home/edited') ?>" method="post">
		<input type='hidden' name='bro_id' value='<?php echo $bro->bro_id ?>'>
		First Name: <input type='text' name='fname' value='<?php echo $bro->bro_fname ?>' /><br>
		Last Name: <input type='text' name='lname' value='<?php echo $bro->bro_lname ?>' /><br>
		Status: <select name='status_id'>
			<option name='status_id' value='<?php echo $bro->status_id ?>'><?php echo $bro->status_name ?></option>
			<option name='status_id' value='0'></option>
			<?php foreach ($options['statuses'] as $status) : ?>
				<option name='status_id' value='<?php echo $status->status_id ?>'><?php echo $status->status_name ?></option>
			<?php endforeach ?>
		</select><br>
		Pledge Class: <select name='pc_sem_id'>
			<option name='pc_sem_id' value='<?php echo $bro->pc_sem_id ?>'><?php echo $bro->pc_sem ?></option>
			<option name='pc_sem_id' value='0'></option>
			<?php foreach ($options['semesters'] as $semester) : ?>
				<option name='pc_sem_id' value='<?php echo $semester->semester_id ?>'><?php echo $semester->semester_name ?></option>
			<?php endforeach ?>
		</select>
		<input type='text' name='pc_year' value='<?php echo $bro->pc_year ?>'><br>
		Graduation: <select name='grad_sem_id'>
			<option name='grad_sem_id' value='<?php echo $bro->grad_sem_id ?>'><?php echo $bro->grad_sem ?></option>
			<option name='grad_sem_id' value='0'></option>
			<?php foreach ($options['semesters'] as $semester) : ?>
				<option name='grad_sem_id' value='<?php echo $semester->semester_id ?>'><?php echo $semester->semester_name ?></option>
			<?php endforeach ?>
		</select>
		<input type='text' name='grad_year' value='<?php echo $bro->grad_year ?>' ><br>
		Family: <select name='family_id'>
			<option name='family_id' value='<?php echo $bro->family_id ?>'><?php echo $bro->family_name ?></option>
			<?php foreach ($options['families'] as $family) : ?>
				<option name='family_id' value='<?php echo $family->family_id ?>'><?php echo $family->family_name ?></option>
			<?php endforeach ?>
		</select><br>
		Big Bro: <select name='bigbro_id'>
			<option name='bigbro_id' value='<?php echo $bro->bigbro_id ?>'><?php echo Roster::getNameById($bro->bigbro_id) ?></option>
			<option name='bigbro_id' value='0'></option>
			<?php foreach ($options['roster'] as $bigbro) : ?>
				<option name='bigbro_id' value='<?php echo $bigbro->bro_id ?>'><?php echo $bigbro->bro_fname.' '.$bigbro->bro_lname ?></option>
			<?php endforeach ?>
		</select><br>
		LinkedIn: <input type='text' name='linkedin' value='<?php echo $bro->linkedin ?>' /><br>
		<input type="submit" value="Submit Edits" />
	</form>
	@include('home.footer')
</body>
</html>