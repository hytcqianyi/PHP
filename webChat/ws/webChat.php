<?php
	$name=isset($_POST["name"])?$_POST["name"]:"";
	if($name=="")
	{
		echo "请输入用户名";
		die();
	}
	if($name!="")
	{
		include('../include/Db.php');
	 	$dbClass=new DB();
	 	$dbClass->connect('localhost','root','123','mynewsql');
	 	$mydata = array('userName'=>$name);
	 	$dbClass->insert("userinfo",$mydata);
	 	echo "查询结果请刷新";
	 	die();
	}
	
?>