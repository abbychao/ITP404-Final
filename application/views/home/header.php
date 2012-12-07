<?php 
	if(!isset($_SESSION['admin'])) {
		$_SESSION['admin'] = FALSE;
	}
?>
<a href="<?php echo URL::to('home') ?>"><img src="<?php echo URL::to_asset('img/header940-large1.png') ?>" id="header_logo"></a>
<div id="menu">
	<ul>
		<li><span id='page_name'>Delta Sigma Pi Roster</span></li>
		<?php if($_SESSION['admin']) { ?>		
			<li><a href="#">Admin</a>
				<ul>
						<li><a href="<?php echo URL::to('home/add') ?>">Add New</a></li>
						<li><a href="<?php echo URL::to('home/admin').'?pass=logout' ?>">Log out</a></li>
				</ul>
			</li>
		<?php } else {echo '<li><a></a></li>';} ?>
		<li><a href="<?php echo URL::to('home') ?>">Show All</a></li>
		<li><a href="<?php echo URL::to('home/search') ?>">Search</a></li>
		<li><a href="<?php echo URL::to('home/map') ?>">Map</a></li>
		<li><a href="#">Family Trees</a>
			<ul><?php
				foreach ($options['families'] as $family) {
					echo '<li><a href="'.URL::to('home/family').'?family_id='
					.$family->family_id.'">'.$family->family_name.'</a></li>';
				}
			?></ul>
		</li>

	</ul>
</div>
<br><br><br>
