<html>
<head>
	<title>Delta Sigma Pi Roster</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/home.css') ?>">
</head>
<body>
	@include('home.header')
	<div id='content'>
		<span><?php echo count($results) ?> records shown.</span><br>
	</div>
	<br>
	<div id="results">
		<form action="<?php echo URL::to('home/edited_all') ?>" method="post">
			<table>
				<th>Name</th><th>Email</th><th>LinkedIn</th>
				<?php $i = 0; ?>
				<?php foreach($results as $bro) : ?>
					<tr>
						<td>
							<input type="hidden" name="bro_id<?php echo $i ?>" value="<?php echo $bro->bro_id ?>">
							<?php echo $bro->bro_fname.' '.$bro->bro_lname ?>
						</td>
						<td><input type="text" size="50" name="email<?php echo $i ?>" value="<?php echo $bro->email ?>"></td>
						<td><input type="text" size="50" name="linkedin<?php echo $i ?>" value="<?php echo $bro->linkedin ?>"></td>
					</tr>
					<?php $i++ ?>
				<?php endforeach ?>
			</table>
			<input type="submit" value="Submit Changes" >
		</form>
	</div>
	@include('home.footer')
</body>
</html>