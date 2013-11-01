window.onload = function(){
	$("#user1").bind("click",function(){
		$.ajax({
			type:"post",
			url:"./login.php",
			data:"&user="+1,
			success:
				function(returnKey){
					if(returnKey == 1){
						window.location.href = "home.php";
					}else{
						alert("猫猫登录失败");
					}
				}
		});
	});
	$("#user2").bind("click",function(){
		$.ajax({
			type:"post",
			url:"./login.php",
			data:"&user="+2,
			success:
				function(returnKey){
					if(returnKey == 1){
						window.location.href = "home.php";
					}else{
						alert("汤圆登录失败");
					}
				}
		});
	});
}