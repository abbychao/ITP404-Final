<html>
<head>
	<title>Delta Sigma Pi Roster</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<div id='content'>
		<span><?php echo $query ?></span><br>
		<span><?php echo count($results) ?> records shown.</span><br>
	</div>
	<br>
	<div id="results">
		<table>
			<th>Name</th><th>Pledge Semester</th><th>Grad Semester</th><th>Status</th>
			<th>Family</th><th>Big Bro</th><th>Connect</th>
			<?php if($_SESSION['loggedin']) { echo '<th>Action</th>'; } ?>
			<?php foreach($results as $bro) : ?>
				<tr>
					<td>
						<a href="<?php echo URL::to('home/view') ?>?bro_id=<?php echo $bro->bro_id ?>">
							<?php echo $bro->bro_fname.' '.$bro->bro_lname; ?>
						</a>
					</td>
					<td>
						<a href="<?php echo URL::to('home/index').'?from_search=true&pc_sem_id='
							.$bro->pc_sem_id.'&pc_year='.$bro->pc_year ?>">
							<?php echo $bro->pc_sem.' '.$bro->pc_year; ?>
						</a>
					</td>
					<td>
						<a href="<?php echo URL::to('home/index').'?from_search=true&grad_sem_id='
							.$bro->grad_sem_id.'&grad_year='.$bro->grad_year ?>">
							<?php echo $bro->grad_sem.' '.$bro->grad_year; ?>
						</a>
					</td>
					<td>
						<a href="<?php echo URL::to('home/index').'?from_search=true&status_id='.$bro->status_id ?>">
							<?php echo $bro->status_name; ?>
						</a>
					</td>
					<td>
						<a href="<?php echo URL::to('home/family').'?family_id='.$bro->family_id ?>">
							<?php echo $bro->family_name; ?>
						</a>
					</td>
					<td>
						<a href="<?php echo URL::to('home/view').'?bro_id='.$bro->bigbro_id ?>">
							<?php echo Roster::getNameById($bro->bigbro_id); ?>
						</a>
					</td>
					<td><?php
						if(!empty($bro->linkedin)) {
							echo "<a href='".$bro->linkedin."'>LinkedIn</a>";
						}
					?></td>
					<?php if($_SESSION['loggedin']) { ?>		
						<td>
							<?php if($_SESSION['admin']['edit']) { ?>
							<a href="<?php echo URL::to('home/edit') ?>?bro_id=<?php echo $bro->bro_id ?>">Edit</a>
							<?php } ?>
							<?php if($_SESSION['admin']['delete']) { ?>
							<a href="<?php echo URL::to('home/delete') ?>?bro_id=<?php echo $bro->bro_id ?>">Delete</a>
							<?php } ?>
						</td>
					<?php } ?>
				</tr>
			<?php endforeach ?>
		</table>	
	</div>
	@include('home.footer')
</body>
</html>