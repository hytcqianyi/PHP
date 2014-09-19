<?php
  
  session_start();
?>

<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
	<title></title>
</head>
<body>
      
      <form id="foreground" action="index.php" method="post">
        <div id="foretop">
          <span class="forelogin">登陆</span>
          <span class="line">/</span>
          <span class="foreregister">注册</span>
        </div>
        <!-- <div id="forebottom" class="denglu">
          <div id="bot">
            <div class="foreid"><input name="userid" type="text" id="txtUserid" /></div>
            <div class="forepwd"><input name="userpwd" type="password" id="txtUserPwd" /></div>
            <div class="foredenglu"><input type="submit" value="登录" /></div>
          </div>
        </div> -->
        <div id="forenewbottom" class="zhuce">
          <div id="bott">
             <div class="foreidR">
                
                <input name="userid" type="text" id="txtUserid" />
             </div>
          </div>
        </div>
      </form>

<?php
  $info = isset($_POST["error"])?$_POST["error"]:"";//isset判断error是否存在
  $logout=isset($_POST["logout"])?$_POST["logout"]:"";
  if($info == "wrongpwd"){
 	 //$js='alert("fail to login")';
 	  echo "<script>tiao();</script>";
   }
   if($logout == "yes"){
      unset($_SESSION["wodeid"]);
      unset($_SESSION["wodenicheng"]);

      //
   }
?>
   

</body>
</html>