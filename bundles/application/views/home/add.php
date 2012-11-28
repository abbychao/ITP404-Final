<html>
<head>
	<title>Add New Member</title>
</head>
<body>
	<h1>Add New Member</h1>
	<form action="<?php echo URL::to('home/added') ?>" method="post">
		First Name: <input type='text' name='fname' /><br>
		Last Name: <input type='text' name='lname' /><br>
		Status: <select name='status_id'>
			<?php foreach ($options['statuses'] as $status) : ?>
				<option name='status_id' value='<?php echo $status->status_id ?>'><?php echo $status->status_name ?></option>
			<?php endforeach ?>
		</select><br>
		Pledge Class: <select name='pc_sem_id'>
			<?php foreach ($options['semesters'] as $semester) : ?>
				<option name='pc_sem_id' value='<?php echo $semester->semester_id ?>'><?php echo $semester->semester_name ?></option>
			<?php endforeach ?>
		</select>
		<input type='text' name='pc_year'><br>
		Graduation: <select name='grad_sem_id'>
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
		LinkedIn: <input type='text' name='linkedin' /><br>
		<input type="submit" value="Add New Member" />
	</form>
</body>
</html>