$(function(){
	$("button").click(function(){
		var username=$(".input").val();
		$.ajax({
			url:"ws/webChat.php",
			type:"POST",
			data:{name:username},
			success:function(res){
				alert(res);
			}
		});
	});
	
});