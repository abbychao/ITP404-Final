<html>
<head>
	<title>Delta Sigma Pi Roster</title>
	<link rel="stylesheet" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	<h1>Delta Sigma Pi Roster</h1>
	<p>
		<span><?php 
			if($loggedin) {
				echo 'Currently logged in.';
			} else {
				echo 'Not currently logged in. <a href="'.$login_url.'">Login now.</a>';
			}
		?></span>
		<span><?php echo $query ?></span><br>
		<span><?php echo count($results) ?> records shown.</span><br>
		<a href="<?php echo URL::to('home/search') ?>">Search for Members</a> | 
		<a href="<?php echo URL::to('home/add') ?>">Add New Member</a> |
		<a href="<?php echo URL::to('home/index') ?>">Show All Members</a>	
	</p>
	<div id="results">
		<table>
			<th>Name</th><th>Pledge Semester</th><th>Grad Semester</th><th>Status</th>
			<th>Family</th><th>Big Bro</th><th>LinkedIn</th><th>Action</th>
			<?php foreach($results as $bro) : ?>
				<tr>
					<td><?php echo $bro->bro_fname.' '.$bro->bro_lname; ?></td>
					<td><?php echo $bro->pc_sem.' '.$bro->pc_year; ?></td>
					<td><?php echo $bro->grad_sem.' '.$bro->grad_year; ?></td>
					<td><?php echo $bro->status_name; ?></td>
					<td><?php echo $bro->family_name; ?></td>
					<td><?php echo Roster::getNameById($bro->bigbro_id); ?></td>
					<td><?php
						if(!empty($bro->linkedin)) {
							echo "<a href='".$bro->linkedin."'>Link</a>";
						}
					?></td>
					<td>
						<a href="<?php echo URL::to('home/view') ?>?bro_id=<?php echo $bro->bro_id ?>">View</a>						
						<a href="<?php echo URL::to('home/edit') ?>?bro_id=<?php echo $bro->bro_id ?>">Edit</a>
						<a href="<?php echo URL::to('home/delete') ?>?bro_id=<?php echo $bro->bro_id ?>">Delete</a>
					</td>
				</tr>
			<?php endforeach ?>
		</table>	
	</div>
</body>
</html>