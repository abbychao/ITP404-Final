<html>
<head>
	<title>View Member Profile</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<h1><?php echo $bro->bro_fname ?> <?php echo $bro->bro_lname ?></h1>
	<?php if($_SESSION['admin']['edit']) { echo '<p><a href="'.URL::to('home/edit').'?bro_id='.$bro->bro_id.'">Edit Profile</a></p>'; } ?>
	<img src="<?php echo $bro->photo_url ?>"><br>
	<label>Status:</label>
		<a href="<?php echo URL::to('home/index').'?from_search=true&status_id='.$bro->status_id ?>">
			<?php echo $bro->status_name; ?>
		</a><br>
	<label>Pledge Class:</label>
		<a href="<?php echo URL::to('home/index').'?from_search=true&pc_sem_id='
			.$bro->pc_sem_id.'&pc_year='.$bro->pc_year ?>">
			<?php echo $bro->pc_sem.' '.$bro->pc_year; ?>
		</a><br>
	<label>Graduation:</label>
		<a href="<?php echo URL::to('home/index').'?from_search=true&grad_sem_id='
			.$bro->grad_sem_id.'&grad_year='.$bro->grad_year ?>">
			<?php echo $bro->grad_sem.' '.$bro->grad_year; ?>
		</a><br>
	<label>Family:</label>
		<a href="<?php echo URL::to('home/family').'?family_id='.$bro->family_id ?>">
			<?php echo $bro->family_name; ?>
		</a><br>
	<label>Big Bro:</label>
		<a href="<?php echo URL::to('home/view').'?bro_id='.$bro->bigbro_id ?>">
			<?php echo Roster::getNameById($bro->bigbro_id); ?>
		</a><br>
	<label>Email:</label><a href="mailto:<?php echo $bro->email ?>"><?php echo $bro->email ?></a>
	<br><br>
	<label>Headline:</label> <?php echo $bro->headline ?><br>
	<label>Industry:</label> <?php echo $bro->industry ?><br>
	<label>Location:</label> <?php echo $bro->location ?><br>
	<label>LinkedIn:</label> <?php if($bro->linkedin) { ?><a href="<?php echo $bro->linkedin ?>">Link</a><br> <?php } ?>
	<br><br>
	@include('home.footer')
</body>
</html>