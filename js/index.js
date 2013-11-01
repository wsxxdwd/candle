window.onload = function(){
	$("#post").bind("click",function(){
		var motion = $("#motion").val();
		var com_motion = $("#com_motion").val();
		var content = $("#content").val();
		switch(motion){
			case "感动":
			case "高兴":
			case "期待":
				var type = "success";
				break;
			case "生气":
			case "痛苦":
				var type = "error";
				break;
			case "失望":
			case "难过":
				var type = "warning";
				break;
			case "淡定":
			case "想念":
			default:
				var type = "info";
				break;
		}
		if(content){
			$.ajax({
				type:"post",
				url:"./post.php",
				data:"&com_motion="+com_motion+"&motion="+motion+"&content="+content+"&time="+showDate(),
				success:
				function(returnKey){
					if(returnKey == 1){
						if(com_motion){
							$("#feedList").prepend('<tr class="'+type+'"><td>'+user+" "+com_motion+" 地说: <b>"+content+'</b>  <i>发布于'+showDate()+'</i></td></tr>');
						}else{
							$("#feedList").prepend('<tr class="'+type+'"><td>'+user+" "+motion+" 地说: <b>"+content+'</b>  <i>发布于'+showDate()+'</i></td></tr>');
						}
                    $("#content").attr("value","");
					if($.browser.msie){
						$("#content").attr("value","");
					}
					$("#count").html('我们已经发布了'+(++count)+'句话!');
					}else{
						alert("没有发送成功,可能是网不好,如果多试几遍都不行就没办法了,给我发个短信吧");
					}
				}
			});
		}else{
			alert("不能什么也不说吧?");
		}
	});
}
function showDate(){
	var today = new Date();
    var weekday=new Array(7);
    weekday[0]="星期日"
	weekday[1]="星期一"
	weekday[2]="星期二"
	weekday[3]="星期三"
	weekday[4]="星期四"
	weekday[5]="星期五"
	weekday[6]="星期六"                                       
    var y=today.getFullYear()+"年";
    var month=today.getMonth()+1+"月";
    var td=today.getDate()+"日";
    var d=weekday[today.getDay()];
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds(); 
	return y+month+td+" "+d+" "+h+":"+m+":"+s;
}