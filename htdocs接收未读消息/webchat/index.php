<?php
	include_once "include/ez_sql_core.php";
	include_once "include/ez_sql_mysql.php";
	$db = new ezSQL_mysql();
	session_start();
	$curuserid=isset($_SESSION["curuserid"])?$_SESSION["curuserid"]:"";
	$curusername=isset($_SESSION["curusername"])?$_SESSION["curusername"]:"";
	if($curuserid==""){
			header("location:login.php?error=needlogin");
			die();
	}else{
		$curuserinfo = $db->get_row("SELECT * FROM userinfo where id='".$curuserid."'");
	}
	$users = $db->get_results("SELECT * FROM friendsinfo,userinfo where friendsinfo.userid='".$curuserid."' and friendsinfo.friendid=userinfo.id order by userState");
	$allfriendCount=$db->get_var("select count(*) from friendsinfo,userInfo where userid='".$curuserid."' and friendsinfo.friendid=userinfo.id");
	$onlinefriendCount=$db->get_var("select count(*) from friendsinfo,userInfo where userid='".$curuserid."' and friendsinfo.friendid=userinfo.id and userinfo.userState='在线'");
	$friendlist="";
	 foreach ( $users as $user )
	 {
		$friendlist.= '<li class="listItem" id="friend-item-'.$user->id.'">';
		if($user->userState=='离线'){
			$friendlist.=	'<a href="#" class="avatar offline">';
		}else{
			$friendlist.=	'<a href="#" class="avatar">';
		}
		$friendlist.=    '<img src='.$user->userHeadImage.'>';
        $friendlist.= '	</a>';
        $friendlist.= '	<p class="memberNick">';
        $friendlist.= 		'<a>'.$user->friendNoteName.'</a>';
        $friendlist.= 		'<span>'.$user->userNickname.'</span>';
        $friendlist.= '	</p>';
        $friendlist.= '	<p class="memberMsg">';
        $friendlist.= 		'<span class="memberState">['.$user->userState.']</span>';
        $friendlist.= '		<span class="memberSignature"></span>';
        $friendlist.= '</p>';
        $friendlist.= '</li>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-Type" content="text/html" charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
	<title>webQQ</title>
</head>
<body class="black">
	<div id="bgAllImage">
		<img class="bgAllImage" src="css/images/02.jpg">
	</div>
	<div class="wrap">
		<div class="QQmainPanel">
			<div class="mainPanel">
				<div class="panelBodyContainer">
					<div class="panelBody">
						<div id="mainTopAll">
							<div class="accountHeader">
								<div class="avatarWrap">
									<img src="<?php
										echo $curuserinfo->userHeadImage;
									?>">
									<span class="iconState userOnlineState online_icon"></span>
								</div>
								<span class="textUserNick"><?php
										echo $curuserinfo->userNickname;
									?></span>
								<span class="textUserShuoShuo"> 小さな恋のうた</span>
								<div class="iconsList">
									<a href="" class="i_qzone">QQ空间</a>
									<a href="" class="i_mail">QQ邮箱</a>
									<a href="" class="i_weibo">腾讯微博</a>
									<a href="" class="i_video">腾讯视频</a>
									<a href="" class="i_qqwebsite">腾讯网</a>
									<a href="" class="i_music">QQ音乐</a>
									<a href="" class="i_wallet">QQ钱包</a>
									<a href="" class="i_pengyou">朋友网</a>
									<a href="" class="i_weiyun">微云</a>
								</div>
							</div>
						</div>
						<div id="menban"></div>
						<div class="panelHeader">
							<h1 id="headerTitle">会话</h1>
						</div>
						<div id="sousuoBar">
							<input type="text" placeHolder="                           搜索" class="sousuoText">
						</div>
						<div class="panel  panel-conversation selectPanel">
							<div class="panelBodyWrapper1">
								<div class="panelBodyWrapperBox">
									<div class="currentChatScrollArea">
										<ul class="currentChatList" id="conversationList">
											
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-contact">
							<div class="panelBodyWrapper1">
								<div class="panelBodyWrapperBox">
									<div class="currentChatScrollArea">
										<ul class="memberTabTitle">
											<li class="memberTitle member-friend memberTabSelected">好友</li>
											<li class="memberTitle member-group">群</li>
											<li class="memberTitle member-discuss">讨论组</li>
										</ul>
										<ul class="memberTabBody">
											<li class="memberTabBody-friend active">
												<ul class="memberList-friend">
													<li class="friendlist">
														<div class="friendlistTitle">
															<span class="friendlistName">新的朋友</span>
															<span class="onlinePercent">
																<?php
																	echo $onlinefriendCount.'/'.$allfriendCount;
																?>
															</span>
														</div>
														<ul class="friendlistBody">
															<?php
																echo "$friendlist";
															?>
														</ul>
													</li>
													<li class="friendlist">
														<div class="friendlistTitle">
															<span class="friendlistName">classmateV2.0</span>
															<span class="onlinePercent">3/3</span>
														</div>
														<ul class="friendlistBody">
															<li class="listItem" id="friend-item-12345211">
																<a href="#" class="avatar">
																	<img src="images/chenxiaodong.jpg">
																</a>
																<p class="memberNick"> 
																	<a>陈小东</a>
																	<span>(        小烦恼°)</span>
																</p>
																<p class="memberMsg">
																	<span class="memberState">[在线]</span>
																	<span class="memberSignature">
																		不要轻易让自己掉眼泪，你笑，全世界跟着笑。 你哭，全世界只有你一个人在哭。
																	</span>
																</p>
															</li>
															<li class="listItem"  id="friend-item-135433411">
																<a href="#" class="avatar">
																	<img src="images/friendAva3.jpg">
																</a>
																<p class="memberNick"> 
																	<a>陈雨田</a>
																	<span>(雨┪啲 ╲茚记)</span>
																</p>
																<p class="memberMsg">
																	<span class="memberState">[在线]</span>
																	<span class="memberSignature">
																		
																	</span>
																</p>
															</li>
															<li class="listItem"  id="friend-item-45134234">
																<a href="#" class="avatar">
																	<img src="images/wugang.jpg">
																</a>
																<p class="memberNick"> 
																	<a>吴刚</a>
																	<span>(Fanatic)</span>
																</p>
																<p class="memberMsg">
																	<span class="memberState">[在线]</span>
																	<span class="memberSignature">
																		You are everything that I used to want.  
																	</span>
																</p>
															</li>
														</ul>
													</li>
													<li class="friendlist">
														<div class="friendlistTitle">
															<span class="friendlistName">internet</span>
															<span class="onlinePercent">2/3</span>
														</div>
														<ul class="friendlistBody">
															<li class="listItem"  id="friend-item-434235123">
																<a href="#" class="avatar">
																	<img src="images/kagami.jpg">
																</a>
																<p class="memberNick">
																	<a>かがみ</a>
																	<span></span>
																</p>
																<p class="memberMsg">
																	<span class="memberState">[在线]</span>
																	<span class="memberSignature">
																		= =我要学洗衣服。此技能已点满者请务必私戳我！
																	</span>
																</p>
															</li>
															<li class="listItem"  id="friend-item-123453522">
																<a href="#" class="avatar">
																	<img src="images/wanzi.jpg">
																</a>
																<p class="memberNick">
																	<a>   丸子啊  、</a>
																	<span></span>
																</p>
																<p class="memberMsg">
																	<span class="memberState">[在线]</span>
																	<span class="memberSignature">
																		我有一个金箍棒😄
																	</span>
																</p>
															</li>
															<li class="listItem"  id="friend-item-5634531231">
																<a href="#" class="avatar">
																	<img src="images/teemo.jpg">
																</a>
																<p class="memberNick">
																	<a>  teemoヽ</a>
																	<span></span>
																</p>
																<p class="memberMsg">
																	<span class="memberState">[离线]</span>
																	<span class="memberSignature">
																		可怜|老子今天不上班
																	</span>
																</p>
															</li>
														</ul>
													</li>
												</ul>
											</li>
											<li class="memberTabBody-group" >
												<ul class="currentChatList">
													<li class="listItem" id="group-item-787923641">
														<a href="#" class="avatar">
															<img src="images/qunPic1.jpg">
														</a>
														<p class="memberNick"> 
															<a>震哥班！幸福在前方！</a>
														</p>
														<p class="memberMsg"> </p>
													</li>
													<li class="listItem" id="group-item-42412312">
														<a href="#" class="avatar">
															<img src="images/qunPic2.jpg">
														</a>
														<p class="memberNick">
															<a>1103~淮师计科</a>  
															<p class="memberMsg">Hello world! </p>
														</p>
													</li>
													<li class="listItem"  id="group-item-1231245">
														<a href="#" class="avatar">
															<img src="images/getface.jpg">
														</a>
														<p class="memberNick">
															<a>淮师CSDN高校俱乐部</a>
														</p>
														<p class="memberMsg"></p>
													</li>
													<li class="listItem" id="group-item-2314141">
														<a href="#" class="avatar">
															<img src="images/getface.jpg">
														</a>
														<p class="memberNick">
														 	<a>Unity3D俱乐部</a>  
															<p class="memberMsg">Hello world! </p>
														</p>
													</li>
												</ul>
											</li>
											<li class="memberTabBody-discuss" ></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-plugin">
							<div class="panelBodyWrapper1">
								<div class="panelBodyWrapperBox">
									<div class="currentChatScrollArea">
										<ul id="plugin-list">
											<li id="qzone" class="plugin-Item">
												<div class="icon"></div>
												<a>QQ空间</a>
											</li>
											<li id="qmail" class="plugin-Item">
												<div class="icon"></div>
												<a>QQ邮箱</a>
											</li>
											<li id="qqportal" class="plugin-Item">
												<div class="icon"></div>
												<a>腾讯网</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-setup">
							<div class="panelBodyWrapper1">
								<div class="panelBodyWrapperBox">
									<div class="currentChatScrollArea">
										<div class="group">
											<div class="row row1">
												<div class="row1Left">
													<img src="images/avatarPic.jpg" class="avatar">
												</div>
												<div class="row1Middle">
													<p class="rowAvatarName">阿井在歇歇凉</p>
													<p class="rowAvatarCount">12580</p>
												</div>
												<div class="row1Right">
													<div class="onlineStateShowArea" state="show">
														<span class="online_icon iconState"></span>
														<div class="down_arrow"></div>
													</div>
													<ul class="changeOnlineIcon">
										                <li><i class="online_icon iconState"></i>在线</li>
										                <li><i class="callme_icon iconState"></i>Q我</li>
										                <li><i class="away_icon iconState"></i>离开</li>
										                <li><i class="busy_icon iconState"></i>忙碌</li>
										                <li><i class="silent_icon iconState"></i>静音</li>
										                <li><i class="hidden_icon iconState"></i>隐身</li>
										                <li><i class="offline_icon iconState"></i>离线</li>
										            </ul>
												</div>
											</div>
										</div>
										<div class="group">
											<div class="row row2">
												<span>个性签名：</span>
												 小さな恋のうた
											</div>
										</div>
										<div class="group">
											<div class="row row3">
												消息相关设置
												<span class="more_icon"></span>
											</div>
										</div>
										<div class="group">
											<div class="row row4" state="show">
												关于QQ
												<span class="more_icon"></span>
											</div>
										</div>
										<div class="group aboutqq">
											<div class="row row5">
												<div class="aboutqqrow">
													<span class="aboutqqrowbanben">当前版本</span>
													V1.0
												</div>
												<div class="aboutqqrow">
													  服务条款
												</div>
												<div class="aboutqqrow aboutqqrow3">
													帮助与反馈
													<span class="more_icon"></span>
												</div>
											</div>
										</div>
										<form action="include/logout.php" method="post" class="group">
											<input type="submit" value="退出当前账号" class="row loginout">
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panelFooter" >
					<nav id="navTab">
						<ul class="navTHead">
							<li id="conversation" class="navBtn navBtnSelected">
								<a href="#">
									<div class="icon"></div>
									<span>会话</span>
								</a>
								<div class="unreadMsgTip"></div>
							</li>
							<li id="contact" class="navBtn">
								<a href="#">
									<div class="icon"></div>
									<span>联系人</span>
								</a>
							</li>
							<li id="plugin" class="navBtn">
								<a href="#">
									<div class="icon"></div>
									<span>发现</span>
								</a>
							</li>
							<li id="setup" class="navBtn">
								<a href="#">
									<div class="icon"></div>
									<span>设置</span>
								</a>
							</li>
						</ul>
						<div class="changBg">
							<a href="##" class="change changBgFre" title="点击切换背景图片"></a>
							<a href="##" class="change changBgNext" title="点击切换背景图片"></a>
						</div>
						<div class="suggestion">
							<a href="#">意见反馈</a>
						</div>
					</nav>
				</div>
			</div>
		</div>
		<div id="talkContainer">
			<div id="chatPanel" curid="">
				<div id="panelHeader">
					<div id="panelLeftButton">
						<span id="panelLeftButtonI"></span>
					</div>
					<h1 id="panelTitle"></h1>
					<div id="panelRightButton">
						<span id="panelRightButtonI">关闭</span>
					</div>
				</div>	
				<ul class="pannelMenuList" isshow="false">
					<li>
						<div class="menuListIcon menuListIcon1"></div>
						<a class="menuListIcon1Words">QQ空间</a>
					</li>
					<li>
						<div class="menuListIcon menuListIcon2"></div>
						<a  class="menuListIcon2Words">详细资料</a>
					</li>
					<li>
						<div class="menuListIcon menuListIcon3"></div>
						<a class="menuListIcon3Words">聊天记录</a>
					</li>
				</ul>
				<div id="panelBodyWrapper">
					<div id="panelBodyBox" ></div>
					<div id="face_images" class="qq_face_area" style="height:0%">
						<ul class="btnsWrap">
						    <li class="selected" _index="0"></li>
						    <li _index="1" class=""></li>
						    <li _index="2" class=""></li>
						    <li _index="3" class=""></li>
						    <li _index="4" class=""></li>
						    <li _index="5" class=""></li>
					    </ul> 
					    <ul class="wrap" style="">
					        
					        <li class="faceIteam faceIteam1 selectedFace" cmd="chooseFace" style="width: 700px;">
						            
						        <i title="微笑" href="javascript:;"></i>
						            
						        <i title="撇嘴" href="javascript:;"></i>
						            
						        <i title="色" href="javascript:;"></i>
						            
						        <i title="发呆" href="javascript:;"></i>
						            
						        <i title="得意" href="javascript:;"></i>
						            
						        <i title="流泪" href="javascript:;"></i>
						            
						        <i title="害羞" href="javascript:;"></i>
						            
						        <i title="闭嘴" href="javascript:;"></i>
						            
						        <i title="睡" href="javascript:;"></i>
						            
						        <i title="大哭" href="javascript:;"></i>
						            
						        <i title="尴尬" href="javascript:;"></i>
						            
						        <i title="发怒" href="javascript:;"></i>
						            
						        <i title="调皮" href="javascript:;"></i>
						            
						        <i title="呲牙" href="javascript:;"></i>
						            
						        <i title="惊讶" href="javascript:;"></i>
						            
						        <i title="难过" href="javascript:;"></i>
						            
						        <i title="酷" href="javascript:;"></i>
						            
						        <i title="冷汗" href="javascript:;"></i>
						            
						        <i title="抓狂" href="javascript:;"></i>
						            
						        <i title="吐" href="javascript:;"></i>
						            
						            <i title="delKey" href="javascript:;"></i>
					        </li>
					        
					        <li class="faceIteam faceIteam2" cmd="chooseFace" style="width: 700px;">
					            
						        <i title="偷笑" href="javascript:;"></i>
						            
						        <i title="可爱" href="javascript:;"></i>
						            
						        <i title="白眼" href="javascript:;"></i>
						            
						        <i title="傲慢" href="javascript:;"></i>
						            
						        <i title="饥饿" href="javascript:;"></i>
						            
						        <i title="困" href="javascript:;"></i>
						            
						        <i title="惊恐" href="javascript:;"></i>
						            
						        <i title="流汗" href="javascript:;"></i>
						            
						        <i title="憨笑" href="javascript:;"></i>
						            
						        <i title="大兵" href="javascript:;"></i>
						            
						        <i title="奋斗" href="javascript:;"></i>
						            
						        <i title="咒骂" href="javascript:;"></i>
						            
						        <i title="疑问" href="javascript:;"></i>
						            
						        <i title="嘘" href="javascript:;"></i>
						            
						        <i title="晕" href="javascript:;"></i>
						            
						        <i title="折磨" href="javascript:;"></i>
						            
						        <i title="衰" href="javascript:;"></i>
						            
						        <i title="骷髅" href="javascript:;"></i>
						            
						        <i title="敲打" href="javascript:;"></i>
						            
						        <i title="再见" href="javascript:;"></i>
						            
						            <i title="delKey" href="javascript:;"></i>
					        </li>
					        
					        <li class="faceIteam faceIteam3" cmd="chooseFace" style="width: 700px;">
					            
						        <i title="擦汗" href="javascript:;"></i>
						            
						        <i title="抠鼻" href="javascript:;"></i>
						            
						        <i title="鼓掌" href="javascript:;"></i>
						            
						        <i title="糗大了" href="javascript:;"></i>
						            
						        <i title="坏笑" href="javascript:;"></i>
						            
						        <i title="左哼哼" href="javascript:;"></i>
						            
						        <i title="右哼哼" href="javascript:;"></i>
						            
						        <i title="哈欠" href="javascript:;"></i>
						            
						        <i title="鄙视" href="javascript:;"></i>
						            
						        <i title="委屈" href="javascript:;"></i>
						            
						        <i title="快哭了" href="javascript:;"></i>
						            
						        <i title="阴险" href="javascript:;"></i>
						            
						        <i title="亲亲" href="javascript:;"></i>
						            
						        <i title="吓" href="javascript:;"></i>
						            
						        <i title="可怜" href="javascript:;"></i>
						            
						        <i title="菜刀" href="javascript:;"></i>
						            
						        <i title="西瓜" href="javascript:;"></i>
						            
						        <i title="啤酒" href="javascript:;"></i>
						            
						        <i title="篮球" href="javascript:;"></i>
						            
						        <i title="乒乓" href="javascript:;"></i>
						            
						            <i title="delKey" href="javascript:;"></i>
					        </li>
					        
					        <li class="faceIteam faceIteam4" cmd="chooseFace" style="width: 700px;">
					            
						        <i title="咖啡" href="javascript:;"></i>
						            
						        <i title="饭" href="javascript:;"></i>
						            
						        <i title="猪头" href="javascript:;"></i>
						            
						        <i title="玫瑰" href="javascript:;"></i>
						            
						        <i title="凋谢" href="javascript:;"></i>
						            
						        <i title="示爱" href="javascript:;"></i>
						            
						        <i title="爱心" href="javascript:;"></i>
						            
						        <i title="心碎" href="javascript:;"></i>
						            
						        <i title="蛋糕" href="javascript:;"></i>
						            
						        <i title="闪电" href="javascript:;"></i>
						            
						        <i title="炸弹" href="javascript:;"></i>
						            
						        <i title="刀" href="javascript:;"></i>
						            
						        <i title="足球" href="javascript:;"></i>
						            
						        <i title="瓢虫" href="javascript:;"></i>
						            
						        <i title="便便" href="javascript:;"></i>
						            
						        <i title="月亮" href="javascript:;"></i>
						            
						        <i title="太阳" href="javascript:;"></i>
						            
						        <i title="礼物" href="javascript:;"></i>
						            
						        <i title="拥抱" href="javascript:;"></i>
						            
						        <i title="强" href="javascript:;"></i>
						            
						            <i title="delKey" href="javascript:;"></i>
					        </li>
					        
					        <li class="faceIteam faceIteam5" cmd="chooseFace" style="width: 700px;">
					            
						        <i title="弱" href="javascript:;"></i>
						            
						        <i title="握手" href="javascript:;"></i>
						            
						        <i title="胜利" href="javascript:;"></i>
						            
						        <i title="抱拳" href="javascript:;"></i>
						            
						        <i title="勾引" href="javascript:;"></i>
						            
						        <i title="拳头" href="javascript:;"></i>
						            
						        <i title="差劲" href="javascript:;"></i>
						            
						        <i title="爱你" href="javascript:;"></i>
						            
						        <i title="NO" href="javascript:;"></i>
						            
						        <i title="OK" href="javascript:;"></i>
						            
						        <i title="爱情" href="javascript:;"></i>
						            
						        <i title="飞吻" href="javascript:;"></i>
						            
						        <i title="跳跳" href="javascript:;"></i>
						            
						        <i title="发抖" href="javascript:;"></i>
						            
						        <i title="怄火" href="javascript:;"></i>
						            
						        <i title="转圈" href="javascript:;"></i>
						            
						        <i title="磕头" href="javascript:;"></i>
						            
						        <i title="回头" href="javascript:;"></i>
						            
						        <i title="跳绳" href="javascript:;"></i>
						            
						        <i title="挥手" href="javascript:;"></i>
						            
						            <i title="delKey" href="javascript:;"></i>
					        </li>
					        
					        <li class="faceIteam faceIteam6" cmd="chooseFace" style="width: 700px;">
					            
						        <i title="激动" href="javascript:;"></i>
						            
						        <i title="街舞" href="javascript:;"></i>
						            
						        <i title="献吻" href="javascript:;"></i>
						            
						        <i title="左太极" href="javascript:;"></i>
						            
						        <i title="右太极" href="javascript:;"></i>
						            
						        <i title="双喜" href="javascript:;"></i>
						            
						        <i title="鞭炮" href="javascript:;"></i>
						            
						        <i title="灯笼" href="javascript:;"></i>
						            
						        <i title="发财" href="javascript:;"></i>
						            
						        <i title="K歌" href="javascript:;"></i>
						            
						        <i title="购物" href="javascript:;"></i>
						            
						        <i title="邮件" href="javascript:;"></i>
						            
						        <i title="帅" href="javascript:;"></i>
						            
						        <i title="喝彩" href="javascript:;"></i>
						            
						        <i title="祈祷" href="javascript:;"></i>
						            
						        <i title="爆筋" href="javascript:;"></i>
						            
						        <i title="棒棒糖" href="javascript:;"></i>
						            
						        <i title="喝奶" href="javascript:;"></i>
						            
						        <i title="下面" href="javascript:;"></i>
						            
						        <i title="香蕉" href="javascript:;"></i>
						            
						            <i title="delKey" href="javascript:;"></i>
					        </li>
					        
					    </ul>
					</div>
				</div>
				<div id="panelFooter">
					<div class="chat_toolbar">
						<div class="addFaceBtn" showstate="hide">
							<span class="addFaceBtnImg"></span>
						</div>
						<textarea class="chatInputArea" placeHolder="输入消息……"></textarea>
						<button class="sendMessageBtn">发送</button>
					</div>
				</div>
			</div>
			<div id="setupPanel">
				<div id="setuppanelHeader">
					<div id="setuppanelLeftButton">
						<span id="setuppanelLeftButtonI"></span>
						<a>设置</a>
					</div>
					<h1 id="setuppanelTitle">消息相关设置</h1>
				</div>	
				<div id="setuppanelBodyWrapper">
					<div id="setuppanelBodyBox">
						<div class="group">
							<div class="row setupRow1">
								<span class="lable">声音</span>
								<lable class="switch switch-white">
									<input type="checkBox" class="checkBoxStyle" checked>
									<span></span>
								</lable>
							</div>
							<div class="row setupRow2">
								<span class="lable">消息浮窗</span>
								<lable class="switch switch-white">
									<input type="checkBox" class="checkBoxStyle" checked>
									<span></span>
								</lable>
							</div>
						</div>
						<div class="group">
							<div class="row setupRow3">
								<p>
									<span class="lable">HTTPS</span>
									<lable class="switch switch-white">
										<input type="checkBox" class="checkBoxStyle" >
										<span></span>
									</lable>
								</p>
								<P >
									<span class="huanhangLable">使用 HTTPS 加密聊天内容</span>
								</P>
							</div>
						</div>
						<div class="group">
							<div class="row setupRow4">
								<span class="huanhangLable">按Ctrl+Enter键发送消息</span>
								<lable class="switch switch-white">
									<input type="checkBox" class="checkBoxStyle" >
									<span></span>
								</lable>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>