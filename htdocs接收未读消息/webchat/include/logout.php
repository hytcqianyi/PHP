<?php
	include_once "ez_sql_core.php";
	include_once "ez_sql_mysql.php";
	$db=new ezSQL_mysql();
	session_start();
	$userid=isset($_POST["userid"])?$_POST["userid"]:"";
	$changeloginsql="UPDATE userinfo SET userState = '在线' WHERE id = '"+$userid+"'";
	$db->query($changeloginsql);
	unset($_SESSION["curuserid"]);
	unset($_SESSION["curusername"]);
	header("location:../login.php");
?>