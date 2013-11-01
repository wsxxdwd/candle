<?php
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
	$query = mysql_query("SELECT COUNT(ID) FROM feed");
	$feed_num = mysql_result($query, 0);
	session_start();
	if($_POST['com_user']){
		$user = 1;
		$_SESSION["user"] = 1;
	}else{
		$user = $_SESSION["user"];
	}
	if(mysql_query("INSERT INTO login (user) VALUES ('$user')")){
	}else{
		echo "登录记录错误!";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Candle</title> 
	<link rel="stylesheet" href="css/index.css" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	
	<div id="main">
		<div id="title">
			<h1><?php 
				if($user == 1){
					echo "猫猫--Candle";
					echo '<script language="javascript">var user = "猫猫";</script>';
				}else if($user == 2){
					echo "汤圆--Flame";
					echo '<script language="javascript">var user = "汤圆";</script>';
				}
				echo '<script language="javascript">var count = '.$feed_num.';</script>';
			?>
			</h1>
			<blockquote>Sweat night,you and me.</blockquote>
			<h4 id="count">我们已经发布了<?php echo $feed_num;?>句话!</h4>
		</div>
		<form action="post.php" method="post" target="myIframe">
			<iframe name="myIframe" style="display: none;"></iframe>
			<select name="motion" id="motion" >
				<option value="高兴">高兴</option>
				<option value="淡定">淡定</option>
				<option value="生气">生气</option>
				<option value="难过">难过</option>
				<option value="失望">失望</option>
				<option value="想念">想念</option>
				<option value="感动">感动</option>
				<option value="期待">期待</option>
				<option value="痛苦">痛苦</option>
			</select>
			<label>自定义感情状态 :<input type="text" name="com_motion" id="com_motion"></input></label>
			<textarea id="content" name="content"></textarea>
			<input type="button" id="post" value="发送" class="btn btn-block btn-primary"></input>
			<input type="submit" class="btn btn-block" value="猫猫兼容发送/刷新" onclick="window.location.href = './home.php'">
		</form>
		<div id="foo">
		<table class="table" id="feedList">
				<tbody>
			<?php 
				$sql = mysql_query("SELECT * FROM feed ORDER BY ID DESC");
				while($row = mysql_fetch_array($sql)){
					$content = $row['content'];
					$motion = $row['motion'];
					$time = $row['time'];
					if($row['user']==1){
						$post_user = '猫猫';
					}else if($row['user']==2){
						$post_user = '汤圆';
					}
					switch($motion){
						
						case "感动":
						case "高兴":
						case "期待":
							$type = "success";
							break;
						case "生气":
						case "痛苦":
							$type = "error";
							break;
						case "失望":
						case "难过":
							$type = "warning";
							break;
						case "淡定":
						case "想念":
						default:
							$type = "info";
							break;
					}
					echo '<tr class="'.$type.'"><td>'.$post_user." ".$motion." 地说: <b>".$content.'</b>  <i>发布于'.$time.'</i></td></tr>';
				}
			?>
			</tbody>
		</table>
		</div>
		
	</div>
</body>