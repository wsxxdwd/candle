<?php
 //php��������
    header("Content-Type:text/html;charset=utf-8");

    //�������ݿ�
    $link = mysql_connect("localhost","root","");
    if(!$link)  
    {  
       echo "mysql connect failed";
    }	

    //�������ݿ����	
    mysql_query("set names utf8");
    
    //ѡ�����ݿ�
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