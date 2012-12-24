(function() {
	$.ajax({
		url: 'http://localhost:8888/GitHub/ITP404-Final/public/home/transition_ajax',
		data: {
			grad_sem_id: global_grad_sem_id,
			grad_year: global_grad_year
		},
		dataType: 'json',
		success: function(response) {
			var content = 'Select graduating brothers:<br><form>';
			for (var i = 0; i < response.length; i++) {
				content += '<input type="checkbox" name="'+response[i].bro_id+'"> ';
				content += response[i].bro_fname+' '+response[i].bro_lname+'<br>'
				console.log(response[i]);
			};
			content += '<input type="submit" value="Change to Alumni Status"></form>';
			$('#transition_results').html(content);
		},
		error: function(err1, err2, err3) {
			console.log(err1, err2, err3);
		}
	});
})();