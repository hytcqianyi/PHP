<?php
   include_once "include/ez_sql_core.php";//调用已有的php
   include_once "include/ez_sql_mysql.php";
   session_start();
   $userid = isset($_POST["userid"])?$_POST["userid"]:"";//获取自己写的useid
   $userpwd = isset($_POST["userpwd"])?$_POST["userpwd"]:"";//获取自己写的userpwd

   if($userid != "" && $userpwd != "")//当所填写的id和pwd都不为空时
   {
      $db = new ezSQL_mysql();//连接数据库
      $sql="select * from userinfo where id='" . $userid . "'and userpwd='" . $userpwd . "'";//查询语句
      $res=$db->get_row($sql);
      //将查询的语句放到get_row里，使用get_row这个方法,把从数据库中查询的结果赋值给$res

      if(!$res)//数据库中查询的结果不匹配所填写的数据
      {
         header("location:login.php?error=wrongpwd");
         die();
      }
      else//数据库中查询的结果匹配所填写的数据
      {
         session_start();
         //告诉服务器使用session,一般来说，php是不会主动使用session的,是开启session功能。

         //将当前成功登录的人的消息写入到session中
         $_SESSION["wodeid"]=$userid;//写入的id放到session这个空间里
         $_SESSION["wodenicheng"]=$res->userNickname;
         $mytx="select userHeadImage from userinfo where id=".$userid;
         $mytouxiang=$db->get_row($mytx);
         // echo "success to login !welcome" .$res->userNickname;
      }
   }
   else{}
  
   //当过段时间，刷新页面

   $curid=isset($_SESSION["wodeid"])?$_SESSION["wodeid"]:"";
   //isset判断wodeid是否存在，如果存在，则赋值给curid，不存在，则将“ ”赋值给$curid;
   $curnicheng=isset($_SESSION["wodenicheng"])?$_SESSION["wodenicheng"]:"";
   echo "";
   if($curid == "")
   {
      header("location:login.php?error=needlogin");
      die();
   }
   else
   {
      //echo "welcome $curnicheng";
   }
   
?>

<!DOCTYPE <html>
<head>
  <link rel="stylesheet" type="text/css" href="css/index.css">
   <title>web chat</title>
</head>
<body>
     <a href="login.php?logout=yes">logout</a>
     <div id="personalinfo">
        <?php
           echo "<li class='mymessage'>
                       <img src='$mytouxiang->userHeadImage' class='myHeadImage' />
                       <div class='myxinxi'>
                         <div class='mynicheng'>$curnicheng</div>
                         <div class='myshuoshuo'>123</div>
                       </div>
                     </li>";
        ?>
     </div>
     <ul id="onlinefriendslist">
       <?php
         $db=new ezSQL_mysql();
         $res=$db->get_results("select userinfo.id,userinfo.userNickname,userinfo.userHeadImage,friendsinfo.friendNoteName from userinfo,friendsinfo where userinfo.id=friendsinfo.friendid and friendsinfo.userid=$curid");
         //$onlineHtml="";
         //$offlineHtml="";
         
         if($res)
         {
            foreach ($res as $friend) {
               $curHeadImageUrl=$friend->userHeadImage;
               $curfriNickName=$friend->userNickname;
              // $curNickname=$friend->userNickname
               // if($friend.userState=="online"){
               //    $onlineHtml .="<li class='friendli'><img src='$curHeadImageUrl' class='friHeadImage onlinePic' /></li>";
               // }else{
               //    $offlineHtml .="<li class='friendli'><img src='$curHeadImageUrl' class='friHeadImage offlinePic' /></li>";
               // }
               
               echo "<li class='friendli'>
                       <img src='$curHeadImageUrl' class='friHeadImage' />
                       <div class='message'>
                         <div class='mesnicheng'>$curfriNickName</div>
                         <div class='messhuoshuo'>123</div>
                       </div>
                     </li>";
            }
         }
         //echo $onlineHtml;
       ?> 
        
     </ul> 
     <!--  <ul id="offlineFriendList">
       <?php
      //  echo $offlineHtml;
       ?>
     </ul> -->
</body>
</html>