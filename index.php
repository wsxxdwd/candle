<?php
session_start();
if(isset($_SESSION["user"])){
  //注销返回首页时 终结SESSION["id"]
  unset($_SESSION["user"]);
}
 //php环境编码
    header("Content-Type:text/html;charset=utf-8");

    //链接数据库
    $link = mysql_connect("localhost","root","");
    if(!$link)  
    {  
       echo "mysql connect failed";
    }	

    //设置数据库编码	
    mysql_query("set names utf8");
    
    //选择数据库
    mysql_select_db("candle",$link); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Candle</title> 
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
</head>
<body style="padding:10%;">
	<h1>Candle</h1>
	<input type="button" class="btn btn-block btn-primary" id="user1" value="猫猫"></input>
	<input type="button" class="btn btn-block" id="user2" value="汤圆"></input>
	<form action="home.php" method="post">
		<input type="hidden" name="com_user" value="1">
		<input type="submit" class="btn btn-block btn-primary" value="猫猫兼容模式">
	</form>
	<?php
		$sql = mysql_query("SELECT * FROM login ORDER BY ID DESC");
		$flag = 3;
		while($row = mysql_fetch_array($sql)){
			if($flag){
				$user = $row["user"];
				$time = $row["time"];
				if($user==1){
					$name = '猫猫';
				}else if($user==2){
					$name = '汤圆';
				}
				if($flag == 3){
					$flag = $user;
					
					echo "<p>$name 最后登录时间:  $time</p>";
				}else if($flag != $user){
					echo "<p>$name 最后登录时间:$time</p>";
					$flag = 0;
				}
			}
		}
	?>
</body>