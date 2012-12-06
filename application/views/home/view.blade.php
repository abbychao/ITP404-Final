<html>
<head>
	<title>View Member Profile</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<h1><?php echo $bro->bro_fname ?> <?php echo $bro->bro_lname ?></h1>
	<?php if($_SESSION['admin']) { echo '<p><a href="'.URL::to('home/edit').'?bro_id='.$bro->bro_id.'">Edit Profile</a></p>'; } ?>
	<img src="<?php echo $bro->photo_url ?>"><br>
	<span class='label'>Status:</span>
		<a href="<?php echo URL::to('home/index').'?from_search=true&status_id='.$bro->status_id ?>">
			<?php echo $bro->status_name; ?>
		</a><br>
	<span class='label'>Pledge Class:</span>
		<a href="<?php echo URL::to('home/index').'?from_search=true&pc_sem_id='
			.$bro->pc_sem_id.'&pc_year='.$bro->pc_year ?>">
			<?php echo $bro->pc_sem.' '.$bro->pc_year; ?>
		</a><br>
	<span class='label'>Graduation:</span>
		<a href="<?php echo URL::to('home/index').'?from_search=true&grad_sem_id='
			.$bro->grad_sem_id.'&grad_year='.$bro->grad_year ?>">
			<?php echo $bro->grad_sem.' '.$bro->grad_year; ?>
		</a><br>
	<span class='label'>Family:</span>
		<a href="<?php echo URL::to('home/family').'?family_id='.$bro->family_id ?>">
			<?php echo $bro->family_name; ?>
		</a><br>
	<span class='label'>Big Bro:</span></span>
		<a href="<?php echo URL::to('home/view').'?bro_id='.$bro->bigbro_id ?>">
			<?php echo Roster::getNameById($bro->bigbro_id); ?>
		</a><br>
	<br>
	<span class='label'>Headline:</span></span></span> <?php echo $bro->headline ?><br>
	<span class='label'>Industry:</span></span> <?php echo $bro->industry ?><br>
	<span class='label'>Location:</span> <?php echo $bro->location ?><br>
	<span class='label'>LinkedIn:</span> <?php if($bro->linkedin) { ?><a href="<?php echo $bro->linkedin ?>">Link</a><br> <?php } ?>
	<br><br>
	@include('home.footer')
</body>
</html>