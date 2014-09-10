<!DOCTYPE html>
<html>
<head>
	<title>Web Chat</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<div class="test">
		<input class="input">
		<button>确定</button>
		<?php 
			include('include/Db.php');
		 	$dbClass=new DB();
		 	$dbClass->connect('localhost','root','123','mynewsql');
		 	//$query="SELECT * FROM 'userinfo' WHERE 1=1";
		 	$sql = "SELECT * from userinfo WHERE 1=1";
		 	

		 	//插入1
			//$mydata = array('userName'=>'地道');
			//print_r($mydata);
			//$dbClass->insert("userinfo",$mydata);

		 	//插入2
		 	 //$sqln = "INSERT INTO userinfo('userName') VALUES ('人间道')";
		 	 //$sqln = "INSERT INTO userinfo(userName) VALUES ('人间道')";
		 	 //$dbClass->query($sqln);
		 	 
			$rt=$dbClass->get_all($sql);
			//print_r($rt);//显示数组
			 while(list($index,$content)=each($rt)) {//读取二维数组
	             while(list($key,$val)=each($content)) {
	 	?>
	 		<div class="data">
	 		<?php
	 			if($key=="userName")
	 			{
	 				echo "$key: ";
	           	 	echo "$val";
	 			}       	 
	           	 ?>
	           	 </div>	
	           	 <?php
	        	}
	        }
	 	?>
	</div>

</body>
</html>