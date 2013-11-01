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
	
if($_POST["user"]){
	$user = $_POST["user"];
	session_start();
	$_SESSION["user"] = $user;
	echo 1;
}else{
	echo 2;
}
?>