

<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
	<title></title>
</head>
<body>
     <form  action="index.php" method="get">
     	<input name="userid" type="text" id="txtUserid" />
     	<input name="userpwd" type="password" id="txtUserPwd" />
     	<!-- <input name="flag" type="text"/> -->
     	<input type="submit" value="登录" />
     </form>
<?php
  $info = isset($_GET["error"])?$_GET["error"]:"";//isset判断error是否存在
  if($info == "wrongpwd"){
 	$js='alert("fail to login")';
 	echo "<script>tiao();</script>";
   }
?>



</body>
</html>