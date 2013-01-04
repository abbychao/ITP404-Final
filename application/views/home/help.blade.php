<html>
<head>
	<title>Help</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<h1>How to Maintain This Site</h1>
	<p>TBU</p>
	<div id="accordion">
		<?php if($_SESSION['admin']['add']) { ?>
			<div class="title">Adding Brothers</div>
			<div class="content">TBU</div>
		<?php } ?>
		<?php if($_SESSION['admin']['edit']) { ?>
			<div class="title">Editing Brothers</div>
			<div class="content">TBU</div>
		<?php } ?>
		<?php if($_SESSION['admin']['edit_multiple']) { ?>
			<div class="title">Connecting LinkedIn Accounts</div>
			<div class="content">TBU</div>
		<?php } ?>
		<?php if($_SESSION['admin']['edit_multiple']) { ?>
			<div class="title">Transitioning Graduating Brothers</div>
			<div class="content">
				<ol>
					<li>Select the graduating class by searching a specific graduation semester.</li>
					<li>Click the "Transition to Alumni" button that appears on the upper left. (This button 
						<i>only</i> appears after searching for a particular graduation semester.)</li>
					<li>Confirm that you want to transition this class.</li>
					<li>Done!</li>
				</ol>
			</div>
		<?php } ?>
		<?php if($_SESSION['admin']['edit_structure']) { ?>
			<div class="title">Managing Families</div>
			<div class="content">TBU</div>
		<?php } ?>
	</div>
	<br>
	<a href="<?php echo URL::to('home/index') ?>">Return to Full Roster.</a></br>
	@include('home.footer')
	<script type="text/javascript" src="<?php echo URL::to_asset('js/jquery-1.8.3.js') ?>"></script>
	<script type="text/javascript" src="<?php echo URL::to_asset('js/accordion.js') ?>"></script></body>
</html>