<?php
   session_start();
   include_once "ez_sql_core.php";//调用已有的php
   include_once "ez_sql_mysql.php";
   $flag = isset($_POST["flag"])?$_POST["flag"]:"";
   $msg = isset($_POST["msg"])?$_POST["msg"]:"";
   $senderid = isset($_POST["senderid"])?$_POST["senderid"]:"";
   $receiveid = isset($_POST["receiveid"])?$_POST["receiveid"]:"";

   $db=new ezSQL_mysql();
   // $curUserID=isset($_SESSION["wodeid"])?$_SESSION["wodeid"]:"";
   // if($curUserID==""){
   //   echo 'need login';
   //   die();
   // }

   if($flag=="sendMsg")
    {
      $sql="insert into messageinfo(id,msgContent,msgSender,msgReceiver,msgSendTime,msgState)";
      $sql .="values(null,'$msg',$senderid,$receiveid,now(),'unread')";
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
    if($flag=="getUnreadMsg" )
    {
      if ($curUserID == "" ) {
        echo "need login";
        die();
      }
       $sql="select * from messageinfo where msgReceiver =$curUserID and magState='unread'";
       $res=$db->get_results($sql);

      echo json_encode($res);
     

    }
    
?>