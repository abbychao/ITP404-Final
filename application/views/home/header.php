<?php Admin::start() ?>
<a href="<?php echo URL::to('home') ?>">
	<img src="<?php echo URL::to_asset('img/header940-large1.png') ?>" id="header_logo">
</a>
<div id="menu">
	<ul>
		<li><span id='page_name'>Delta Sigma Pi Roster</span></li>
		<?php if($_SESSION['loggedin']) { ?>		
			<li><a href="#">My Account</a>
				<ul>
						<?php if($_SESSION['admin']['add']) { ?>
						<li><a href="<?php echo URL::to('home/add') ?>">Add Bro</a></li>
						<li><a href="<?php echo URL::to('home/edit_all') ?>">Edit Bros</a></li>
						<li><a href="<?php echo URL::to('home/edit_families') ?>">Edit Families</a></li>
						<li><a href="<?php echo URL::to('home/transition') ?>">Transition</a></li>
						<?php } ?>
						<li><a href="<?php echo URL::to('home/login').'?logout=true' ?>">Log out</a></li>
				</ul>
			</li>
		<?php } else { ?>
			<li><a href="<?php echo URL::to('home/login') ?>">Login</a></li>
		<?php } ?>
		<li><a href="<?php echo URL::to('home/map') ?>">Map</a></li>
		<li><a href="<?php echo URL::to('home/search') ?>">Search</a>
			<ul><li id='searchbar'>
				<form action='<?php echo URL::to('home/index') ?>' method='post'>
					<input type='hidden' name='from_search' value='1'>
					<input type='text' name='query'>
					<input type='submit' value='Search'>
				</form>
			</li></ul>
		</li>
		<li><a href="#">Family Trees</a>
			<ul><?php
				foreach ($options['families'] as $family) {
					if($family->family_id != 1) {
						echo '<li><a href="'.URL::to('home/family').'?family_id='
						.$family->family_id.'">'.$family->family_name.'</a></li>';
					}
				}
			?></ul>
		</li>
	</ul>
</div>
<br><br><br>
