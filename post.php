<?php
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
	
	session_start();
	$user = $_SESSION["user"];
	
	if($_POST["motion"]&&$_POST["content"]){
		$c = $_POST["content"];
		if($_POST["com_motion"]){
			$m = $_POST["com_motion"];
		}else{
			$m = $_POST["motion"];
		}
		if($_POST["time"]){
			$t = $_POST["time"];
		}else{
			$week = array('星期天','星期一','星期二','星期三','星期四','星期五','星期六');
			$my_t=getdate(date("U"));
			$t = $my_t['year'].'年'.$my_t['mon'].'月'.$my_t['mday'].'日 '.$week[$my_t['wday']].' '.$my_t['hours'].':'.$my_t['minutes'].':'.$my_t['seconds'];
		}
		
		if(mysql_query("INSERT INTO feed (content,motion,user,time) VALUES ('$c','$m','$user','$t')")){
		  echo 1;
		}else{
			echo 2;
		}
	}
?>