jQuery(document).ready(function(){
	$('#accordion .title').click(function() {
		$(this).next().toggle('slow');
		return false;
	}).next().hide();
});