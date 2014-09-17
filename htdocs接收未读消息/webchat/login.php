<?php
	include_once "include/ez_sql_core.php";
	include_once "include/ez_sql_mysql.php";
	session_start();
	$userid=isset($_POST["userid"])?$_POST["userid"]:"";
	$userpwd=isset($_POST["userpwd"])?$_POST["userpwd"]:"";
	if($userid!="" && $userpwd!=""){
		$db= new ezSQL_mysql();
		$sql= "select * from userinfo where id='".$userid."' and userpwd='".$userpwd."'";
		$res= $db->get_row($sql);
		if(!$res){
			//echo "fail login";
		}else{
			//echo " welcome  ".$res->userNickname;		
			$_SESSION["curuserid"]=$userid;
			$_SESSION["curusername"]=$res->userNickname;
			$changeloginsql="UPDATE userinfo SET userState = '在线' WHERE id = '".$userid."'";
			$db->query($changeloginsql);
			header("location:index.php?username=".$res->userNickname);
		}
	}
	//$curuserid=isset($_SESSION["curuserid"])?$_SESSION["curuserid"]:"";
	//$curusername=isset($_SESSION["curusername"])?$_SESSION["curusername"]:"";
	//if($curuserid!=""){
		//header("location:index.php?username=".$curusername);
	//}	
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/login.css"> 
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
	<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
	<title>登录</title>
</head>
<body  onselectstart="return false;" style="-moz-user-select:none;" >
	<div class="bg"></div>
	<div class="header">
		<div class="headerWrapper">
			<a class="headerlogo">
				<i class="icon headerlogoImg "></i>
				<i class="icon headerlogoWord "></i>
			</a>
			<div class="headerNav">
				<span>探索一下</span>
			</div>
			<div class="headerNav headerNavSpecial">
				<span>问道</span>
				<i class="icon wendaoImg "></i>
			</div>
			<div class="headerNav right">
				<span>关于我们</span>
			</div>
		</div>
	</div>
	<div class="mainBody">
		<div class="mainWrapper">
			<div class="mainContent" contentid="0">
				<div class="mainContentBg"></div>
				<div class="mainContentWrapper1">
					<h1>从这里开始</h1>
					<h2>@Xing的家</h2>
					<h3>提出「让人们分享未来梦想」的想法。我们已经浪费了太多时间关注琐碎的事情。但是我们可以随时选择自己的人生：创造全新的事物。</h3>
				</div>
			</div>
			<div class="mainContent" contentid="1">
				<div class="mainContentBg"></div>
				<div class="mainContentWrapper1">
					<h1>你想成为一个什么样的人</h1>
					<h2>@枫林</h2>
					<h3>深夜工作，提出了第一个名字 「十日后」。每个人只有一次二十三岁，我们不想等待未来的到来。</h3>
				</div>
			</div>
			<div class="mainContent" contentid="2">
				<div class="mainContentBg"></div>
				<div class="mainContentWrapper1">
					<h1>你在和我开玩笑吗</h1>
					<h2>@枫林</h2>
					<h3>首次技术启动会议，但是两个技术人员直接消失。这不重要。重要的是，十年后，那次会议现场的所有人会变成什么样？</h3>
				</div>
			</div>
			<div class="mainContent" contentid="3">
				<div class="mainContentBg"></div>
				<div class="mainContentWrapper1">
					<h1>我是希尔瑞斯</h1>
					<h2>@枫林</h2>
					<h3>更大的团队聚齐了见面。生活不该是浪费时间于自己不热爱的事物。这次，我们要做一件不一样的事。</h3>
				</div>
			</div>
			<div class="mainContent" contentid="4">
				<div class="mainContentBg"></div>
				<div class="mainContentWrapper1">
					<h1>冒险一次</h1>
					<h2>@北京西路</h2>
					<h3>杀不死我的只能使我更强，在一个新地方继续原先的旅程。多少个梦想才能击败现实？冒险一次。</h3>
				</div>
			</div>
			<div class="mainContent active" contentid="5" style="left:1366px;">
				<div class="mainContentBg"></div>
				<div class="mainContentWrapper">
					<div class="mainContentWrapperLeft">
						<h1>十年后，你会成为怎样的人？</h1>
						<h2>「十年后」是一个关于未来的匿名社交网络。在这里，你可以自由地分享关于未来与梦想的真实想法，并探索其他人的梦想，以及背后的故事。</h2>
						<div class="mcwLeftNav">
							<a class="mcwLeftNavBtn">进站探索一下</a>
							<span>或者</span>
							<i class="icon mcwLeftNavTiaoIcon"></i>
						</div>
						<div class="mcwLeftSearch">
							<input type="text" class="mcwLeftSearchInput" placeHolder="搜索你的梦想">
							<i class="icon mcwLeftSearchIcon"></i>
						</div>
					</div>
					<div class="mainContentWrapperRight">
						<form action="login.php" method="POST" class="loginForm">
							<input name="userid" type="text" autocomplete="off" placeholder="请输入ID">
							<input name="userpwd" type="text" autocomplete="off" placeholder="请输入密码">
							<div class="loginOptions">
								<div class="loginOptionsLeft">
									<div class="loginOptionsLeftBox"></div>
									<span class="loginOptionsLeftLabel">下次自动登录</span>
								</div>
								<span class="loginOptionsRight loginOptionsNavLabel">忘记密码?</span>
							</div>
							<input type="submit" value="登录">
							<span class="loginFormBottom loginOptionsNavLabel">立即注册>></span>
						</form>
					</div>
				</div>
			</div>
			<div class="mainContent" contentid="6">
				<div class="mainContentBg"></div>
				<div class="mainContentWrapper">
					<div class="mainContentWrapperLeft">
						<h1>「记录」日志和想法</h1>
						<h2>你可以基于每个「梦想」随时记录瞬间的想法，或者通过撰写日志记录更丰富深刻的思考。</h2>
					</div>
					<div class="mainContentWrapperRight">
						<div class="img_intro img_intro1"></div>
					</div>
				</div>
			</div>
			<div class="mainContent" contentid="7">
				<div class="mainContentBg"></div>
				<div class="mainContentWrapper">
					<div class="mainContentWrapperLeft">
						<h1>「存录」站内外资料</h1>
						<h2>你可以将站内的资料（别人发表的日志）以及站外的资料（任何你感兴趣的网页）存录到自己的盒子里，并通过方便的文件夹功能对资料进行分类整理。</h2>
					</div>
					<div class="mainContentWrapperRight">
						<div class="img_intro img_intro2"></div>
					</div>
				</div>
			</div>
			<div class="mainContent" contentid="8">
				<div class="mainContentBg"></div>
				<div class="mainContentWrapper">
					<div class="mainContentWrapperLeft">
						<h1>「搜索」感兴趣的主题</h1>
						<h2>你可以在搜索框中输入关于各个「梦想」主题或领域的关键词，并搜索到相关的最有价值的梦想、资料、以及「十年后」用户。</h2>
					</div>
					<div class="mainContentWrapperRight">
						<div class="img_intro img_intro3"></div>
					</div>
				</div>
			</div>
			<div class="mainContent" contentid="9">
				<div class="mainContentBg"></div>
				<div class="mainContentWrapper">
					<div class="mainContentWrapperLeft">
						<h1>「关注」有想法的人并与之互动</h1>
						<h2>你也可以在「十年后」关注任何有想法、有趣的人！他们可以来自你从推荐功能「概率」看到的各种有趣动态，也可以来自你主动的搜索动作。</h2>
					</div>
					<div class="mainContentWrapperRight">
						<div class="img_intro img_intro4"></div>
					</div>
				</div>
			</div>
			<div class="mainContent" contentid="10">
				<div class="mainContentBg"></div>
				<div class="mainContentWrapper">
					<div class="mainContentWrapperLeft">
						<h1>添加「梦想」</h1>
						<h2>点击时间轴左边的十字图标即可添加梦想，我们叫「梦想」。只需填入该「梦想」的名称，对该「梦想」的描述，以及预期的实现时间，就可成功创建。</h2>
					</div>
					<div class="mainContentWrapperRight">
						<div class="img_intro img_intro5"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="mainBodyNavigation">
			<div class="navbackground">
				<div class="navtimeline"></div>
				<div class="icon navtimelineBar"></div>
				<div class="navTimeBottom">
						<div class="navTimeBottomTop"></div>
				</div>
			</div>
			<div class="navWrapper">
<!-- 				<div class="navTimeBeside">
					<div class="navTimeBottom">
						<div class="navTimeBottomTop"></div>
					</div>
				</div> -->
				<div class="navTimeMiddle">
				    <div class="navTimeContent">
				   		<div class="mark success" navid="0" style="left:0px;">
				    		<div class="icon flag " style="top:40px;">
				    			<div class="flagContent">
				    				<i class="icon icon_success"></i>
				    				<div class="navtimeTitle">从这里开始</div>
				    			</div>
				    		</div>
				    		<div class="line"></div>
				    	</div>
				    	<div class="mark success" navid="1" style="left:40px;">
				    		<div class="icon flag " style="top:90px;">
				    			<div class="flagContent">
				    				<i class="icon icon_success"></i>
				    				<div class="navtimeTitle">你想成为一个什么样的人</div>
				    			</div>
				    		</div>
				    		<div class="line"></div>
				    	</div>
				    	<div class="mark success" navid="2" style="left:110px;">
				    		<div class="icon flag " style="top:0px;">
				    			<div class="flagContent">
				    				<i class="icon icon_success"></i>
				    				<div class="navtimeTitle" >你在和我开玩笑吗</div>
				    			</div>
				    		</div>
				    		<div class="line"></div>
				    	</div>
				    	<div class="mark success" navid="3" style="left:160px;">
				    		<div class="icon flag " style="top:50px;">
				    			<div class="flagContent">
				    				<i class="icon icon_success"></i>
				    				<div class="navtimeTitle">我是希尔瑞斯</div>
				    			</div>
				    		</div>
				    		<div class="line"></div>
				    	</div>
				    	<div class="mark success" navid="4" style="left:190px;">
				    		<div class="icon flag " style="top:100px;">
				    			<div class="flagContent">
				    				<i class="icon icon_success"></i>
				    				<div class="navtimeTitle">冒险一次</div>
				    			</div>
				    		</div>
				    		<div class="line"></div>
				    	</div>



				    	<div class="mark underway selected" navid="5" style="left:606px;">
				    		<div class="icon flag " style="top:60px;">
				    			<div class="flagContent">
				    				<i class="icon icon_underway"></i>
				    				<div class="navtimeTitle">今天你加入我们</div>
				    			</div>
				    		</div>
				    		<div class="line"></div>
				    	</div>
				    	<div class="mark underway" navid="6" style="left:640px;">
				    		<div class="icon flag " style="top:5px;">
				    			<div class="flagContent">
				    				<i class="icon icon_underway"></i>
				    				<div class="navtimeTitle">「记录」日志和想法</div>
				    			</div>
				    		</div>
				    		<div class="line"></div>
				    	</div>
				    	<div class="mark underway" navid="7" style="left:680px;">
				    		<div class="icon flag " style="top:105px;">
				    			<div class="flagContent">
				    				<i class="icon icon_underway"></i>
				    				<div class="navtimeTitle">「存录」站内外资料</div>
				    			</div>
				    		</div>
				    		<div class="line"></div>
				    	</div>
				    	<div class="mark underway" navid="8" style="left:800px;">
				    		<div class="icon flag " style="top:40px;">
				    			<div class="flagContent">
				    				<i class="icon icon_underway"></i>
				    				<div class="navtimeTitle">「搜索」感兴趣的主题</div>
				    			</div>
				    		</div>
				    		<div class="line"></div>
				    	</div>
				    	<div class="mark underway" navid="9" style="left:840px;">
				    		<div class="icon flag " style="top:90px;">
				    			<div class="flagContent">
				    				<i class="icon icon_underway"></i>
				    				<div class="navtimeTitle">「关注」有想法的人并与之互动</div>
				    			</div>
				    		</div>
				    		<div class="line"></div>
				    	</div>
				    	<div class="mark underway" navid="10" style="left:900px;">
				    		<div class="icon flag " style="top:0px;">
				    			<div class="flagContent">
				    				<i class="icon icon_underway"></i>
				    				<div class="navtimeTitle">添加「梦想」</div>
				    			</div>
				    		</div>
				    		<div class="line"></div>
				    	</div>
				    </div>
					<div class="navTimeBottom">
						<div class="navTimeBottomTop"></div>
						<div class="showMonth">
							<div class="navtimeMon">一月</div>
							<div class="navtimeMon">二月</div>
							<div class="navtimeMon">三月</div>
							<div class="navtimeMon">四月</div>
							<div class="navtimeMon">五月</div>
							<div class="navtimeMon">六月</div>
							<div class="navtimeMon">七月</div>
							<div class="navtimeMon">八月</div>
							<div class="navtimeMon">九月</div>
							<div class="navtimeMon">十月</div>
							<div class="navtimeMon" style="text-indent:-18px;">十一月</div>
							<div class="navtimeMon" style="text-indent:-18px;">十二月</div>
						</div>
					</div>
				</div>
<!-- 				<div class="navTimeBeside">
					<div class="navTimeBottom">
						<div class="navTimeBottomTop"></div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</body>
</html>