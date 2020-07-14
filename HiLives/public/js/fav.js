$(document).ready(function(){
	$(".fav").click(function(){
		var id = this.id;

		$.ajax({
			url: 'scripts/update_fav.php',
			type: 'POST',
			data: {id:id},
			dataType: 'json',

			success:function(data){
				var text = data['text'];
				$("#"+id).html(text);
			}
		});
	});
});

$(document).ready(function(){
	$(".fav_emp").click(function(){
		var id = this.id;

		$.ajax({
			url: 'scripts/update_fav_emp.php',
			type: 'POST',
			data: {id:id},
			dataType: 'json',

			success:function(data){
				var text = data['text'];
				$("#"+id).html(text);
			}
		});
	});
});