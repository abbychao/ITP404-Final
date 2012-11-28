<!doctype html>
<html>
<head>
	<title>Delta Sigma Pi Roster</title>
	<link rel="stylesheet" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	<h1>Delta Sigma Pi Roster</h1>
	<p><a href="<?php echo URL::to('add') ?>">Add New Member</a></p>
	<div id="results">
		<table>
			<th>Name</th><th>Pledge Semester</th><th>Grad Semester</th><th>Status</th><th>Family</th><th>Big Bro</th>
			<?php foreach($results as $bro) : ?>
				<tr>
					<td><?php echo $bro->bro_fname.' '.$bro->bro_lname; ?></td>
					<td><?php echo $bro->pc_sem.' '.$bro->pc_year; ?></td>
					<td><?php echo $bro->grad_sem.' '.$bro->grad_year; ?></td>
					<td><?php echo $bro->status_name; ?></td>
					<td><?php echo $bro->family_name; ?></td>
				</tr>
			<?php endforeach ?>
		</table>	
	</div>
</body>
</html>