<?php
   session_start();
   include_once "ez_sql_core.php";//调用已有的php
   include_once "ez_sql_mysql.php";
   $flag = isset($_POST["flag"])?$_POST["flag"]:"";//取出当前标记
   $msg = isset($_POST["msg"])?$_POST["msg"]:"";//取出聊天内容
   $curuserid = isset($_SESSION["wodeid"])?$_SESSION["wodeid"]:"";//取出当前登陆者的id
   $receiveid = isset($_POST["receiveid"])?$_POST["receiveid"]:"";//取出当前接收者的id
   $setreadSenderid = isset($_POST["setreadSenderid"])?$_POST["setreadSenderid"]:"";//取出未读消息发送者的id

   $db=new ezSQL_mysql();
   // $curUserID=isset($_SESSION["wodeid"])?$_SESSION["wodeid"]:"";
   // if($curUserID==""){
   //   echo 'need login';
   //   die();
   // }

   if($flag=="sendMsg")
    {
      $sql="insert into messageinfo(id,msgContent,msgSender,msgReceiver,msgSendTime,msgState)";
      $sql .="values(null,'$msg',$curuserid,$receiveid,now(),'unread')";
      $res=$db->query($sql);
      if(!$res)
      {
        echo "fail";
      }
      else{
        echo "ok";
      }
      die();
    }

    //get unread msg of currend user.
    if($flag=="getUnreadMsg" )//如果接收到未读消息
    {
      if ($curuserid == "" ) {
        echo "need login";
        header("location:login.php");
        die();
      }
       $sql="select * from messageinfo,userinfo where messageinfo.msgSender=userinfo.id and msgReceiver =".$curuserid." and msgState='unread'";
       $res=$db->get_results($sql);
       if($res){
         echo json_encode($res);//转化成json格式（数据格式）
       }else{
        echo "fail";
       }
    }
    if($flag=="setreadMsg" )//设置已读消息
    {
      if ($curuserid == "" ) {
        echo "need login";
        header("location:login.php");
        die();
      }
       $sql="update messageinfo set msgState='read' where msgSender='$setreadSenderid' and msgReceiver='$curuserid'";
       $res=$db->query($sql);
       if($res){
         echo "ok";//转化成json格式（数据格式）
       }else{
        echo "fail";
       }
    }
?>