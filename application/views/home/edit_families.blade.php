<html>
<head>
	<title>Edit Families</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<h1>Manage Families</h1>
	<a href='<?php echo URL::to_asset('css/home.css') ?>'>Link</a>
	Please select one of the following options:
	<div id="accordion">
		<div class="title">Add New Family</div>
		<div class="content">
			<form action="<?php echo URL::to('home/add_family') ?>" method="post">
			New Family Name: <input type='text' name='new_family_name'><br>
			<input type='submit' value='Add New Family'>
			</form>
		</div>
		<div class="title">Change Family Name</div>
		<div class="content">
			<form action="<?php echo URL::to('home/edit_family_names') ?>" method="post">
			<div class="columns">
				<?php 
				$i = 0;
				foreach ($options['families'] as $family) {
					if($family->family_id != 1) {
						echo "<input type='hidden' name='family_id".$i."' value='".$family->family_id."'>";
						echo "<input type='text' name='family_name".$i."' value='$family->family_name'><br>";
						$i++;
					}
				}
				?>
			</div>
			<input type='submit' value='Submit Edits'>
			</form>
		</div>
		<div class="title">Merge Families</div>
		<div class="content">
			<i>Note: Merged families take the family name listed earlier in the alphabet.</i>
			<form action="<?php echo URL::to('home/merge_families') ?>" method="post">
			<div class="columns">
				<?php
				foreach ($options['families'] as $family) {
					if($family->family_id != 1) {
						echo "<input type='checkbox' name='$family->family_id' value='$family->family_id'>$family->family_name<br>";
					}
				}
				?>
			</div>
			<input type='submit' value='Merge Selected Families' id='submit-merge'>
			</form>	
		</div>
	</div>
	@include('home.footer')
	<script type="text/javascript" src="<?php echo URL::to_asset('js/jquery-1.8.3.js') ?>"></script>
	<script type="text/javascript" src="<?php echo URL::to_asset('js/accordion.js') ?>"></script>
	<script>
		$('#submit-merge').bind('click', function() {
			if($('input:checked').length != 2) {
				alert('Please select exactly two families to be merged.');
				console.log($('input:checked')[0]);
				return false;
			}
			return confirm('Are you sure you want to merge these families? This cannot be undone.');
		});
	</script>
</body>
</html>