<?php
	include_once "ez_sql_core.php";
	include_once "ez_sql_mysql.php";
	$db = new ezSQL_mysql();
	session_start();
	$curuserid=isset($_SESSION["curuserid"])?$_SESSION["curuserid"]:"";
	$curusername=isset($_SESSION["curusername"])?$_SESSION["curusername"]:"";
	$flag=isset($_POST["flag"])?$_POST["flag"]:"";
	$chatMsg=isset($_POST["chatMsg"])?$_POST["chatMsg"]:"";
	$chatMsg=str_replace("'","\'",$chatMsg);
	$receiverId=isset($_POST["receiverId"])?$_POST["receiverId"]:"";
	//发送信息
	if($flag=="sendMsg"){
		$sql="INSERT INTO messageinfo(msgContent,msgSender,msgReceiver) VALUES('$chatMsg', '$curuserid', '$receiverId')";
		$res=$db->query($sql);
		if($res){
			echo "ok";
		}else{
			echo "fail";
		}
	}
	//接受信息
	if($flag=="getunreadMsg"){
		$sql="SELECT * FROM messageinfo,userinfo where msgReceiver='".$curuserid."' and msgState='unread' and userinfo.id=messageinfo.msgSender";
		$res=$db->get_results($sql);
		if($res){
			echo json_encode($res);
		}else{
			echo "fail";
		}
	}
	//将信息设为已读
	if($flag=="setRead"){
		$sql="UPDATE messageinfo SET msgState='read' WHERE msgReceiver = '".$curuserid."'";
		$res=$db->query($sql);
		if($res){
			echo "ok";
		}else{
			echo "fail";
		}
	}
?>