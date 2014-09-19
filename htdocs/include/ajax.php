<?php
   session_start();
   include_once "ez_sql_core.php";//调用已有的php
   include_once "ez_sql_mysql.php";

   $flag = isset($_POST["flag"])?$_POST["flag"]:"";//取出当前标记
   $msg = isset($_POST["msg"])?$_POST["msg"]:"";//取出聊天内容
   $curuserid = isset($_SESSION["wodeid"])?$_SESSION["wodeid"]:"";//取出当前登陆者的id
   $receiveid = isset($_POST["receiveid"])?$_POST["receiveid"]:"";//取出当前接收者的id
   $setreadSenderid = isset($_POST["setreadSenderid"])?$_POST["setreadSenderid"]:"";//取出未读消息发送者的id
  // $userid = isset($_POST["userid"])?$_POST["userid"]:"";
   //$userpwd = isset($_POST["userpwd"])?$_POST["userpwd"]:"";
   $mynewname=isset($_POST["mynewname"])?$_POST["mynewname"]:"";
   $mynewshuoshuo=isset($_POST["mynewshuoshuo"])?$_POST["mynewshuoshuo"]:"";
   $id=isset($_POST["id"])?$_POST["id"]:"";
   $name=isset($_POST["name"])?$_POST["name"]:"";

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
    
    if($flag=="altermessage")//修改个人信息
    {
      $sql ="update userinfo set userNickname='$mynewname', userTalk='$mynewshuoshuo' where id='$curuserid'";
      $res =$db->query($sql);
       if(!$res){
         //echo "fail";
       }else {
         //echo "ok";
       }
        die();

    }

     if($flag=="getnewmessage")//修改列表
    {
      $sql ="select id,userNickname,userTalk from userinfo where id in(select friendid from friendsinfo where userid='$curuserid')";
      $res =$db->get_results($sql);
       if(!$res){
         echo "fail";
       }else {
        //print_r($res);
        echo json_encode($res);
       }
        die();

    }
     
     //修改好友的备注
     if($flag=='alterfriend'){
      $sql="update friendsinfo set friendNoteName='$name' where id='$id'";
      $res=$db->query($sql);
      if(!$res){
         echo "fail";
       }else {
         echo "ok";
       }
        die();
     }


    
  //   if ($flag == "checkSession") {
  //   $res = (isset($_SESSION["wodeid"]))?$_SESSION["wodeid"]:"";
  //   $nickName = (isset($_SESSION["wodenicheng"]))?$_SESSION["wodenicheng"]:"";
    
  //   if ($res == "") {
  //     echo "no";
  //   }else{
      
  //     $data["id"] = $res;
  //     $data["name"] = $nickName;
  //     echo json_encode($data);
  //   }
  //   die();

  //   }

  // if ($flag == "clearSession") {
  //   //unse the sessions
  //   unset($_SESSION["wodeid"]);
  //   unset($_SESSION["wodenicheng"]);
  //   die();
  // }

  // if ($flag == "checkUser" && $userid != "" && $userpwd != "") {
  //   //connact to the db and check userid & pwd
  //   $_SESSION["wodeid"] = "1";
  //   $_SESSION["wodenicheng"] = "Jim Green";
  //   echo "right";
    
  //   die();
  // }

?>