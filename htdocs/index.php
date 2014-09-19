<?php
   include_once "include/ez_sql_core.php";//调用已有的php
   include_once "include/ez_sql_mysql.php";
  // session_start();
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
         $_SESSION["wodeshuoshuo"]=$res->userTalk;
         $mytx="select userHeadImage from userinfo where id=".$userid;
         $myn="select userNickname from userinfo where id=".$userid;
         $mytouxiang=$db->get_row($mytx);
         $myname=$db->get_row($myn);
         // echo "success to login !welcome" .$res->userNickname;
      }
   }
   else{}
  
   //当过段时间，刷新页面

   $curid=isset($_SESSION["wodeid"])?$_SESSION["wodeid"]:"";
   //isset判断wodeid是否存在，如果存在，则赋值给curid，不存在，则将“ ”赋值给$curid;
   $curnicheng=isset($_SESSION["wodenicheng"])?$_SESSION["wodenicheng"]:"";
   $curshuoshuo=isset($_SESSION["wodeshuoshuo"])?$_SESSION["wodeshuoshuo"]:"";
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
  <meta charset="utf-8" >
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.js"></script>
   <!-- <script type="text/javascript" src="js/chat.js"></script> -->
  <script type="text/javascript" src="js/index.js"></script>
  <title>web chat</title>
</head>
<body>
     <div id="left">
       <a href="login.php?logout=yes">logout</a>
       <div id="personalinfo">
         <?php
           echo "<li class='mymessage'>
                       <img src='$mytouxiang->userHeadImage' class='myHeadImage' curHeadImageUrl='".$mytouxiang->userHeadImage."'/>
                       <div class='myxinxi'>
                         <div class='mynicheng' curname='".$myname->userNickname."' curid='$userid'>$curnicheng</div>
                         <div class='myaltermes'>修改</div>
                         <div class='myshuoshuo'>$curshuoshuo</div>
                       </div>
                </li>";
         ?>
       </div>
       <div id="friendList">
      <ul id="onlinefriendslist">
       <?php
         $db=new ezSQL_mysql();//,userinfo.userTalk
         $res=$db->get_results("select userinfo.userTalk,userinfo.id,userinfo.userState,userinfo.userNickname,userinfo.userHeadImage,friendsinfo.friendNoteName from userinfo,friendsinfo where userinfo.id=friendsinfo.friendid and friendsinfo.userid=$curid");
         $onlineHtml="";
         $offlineHtml="";
         
         if($res)
         {
            foreach ($res as $friend) {
               $curHeadImageUrl=$friend->userHeadImage;
               $curfriNickName=$friend->userNickname;
               $curfriState=$friend->userState;
               $curfrinotename=$friend->friendNoteName;
               $curfrishusohuo=$friend->userTalk;
             
               if($friend->userState=="online"){
                  $onlineHtml .="
                  <li friendid='$friend->id' friendNoteName='$friend->friendNoteName' class='friendli' istalking='no'>
                     <img src='$curHeadImageUrl' class='friHeadImage onlinePic' />
                     <span class='friendName'>$friend->friendNoteName</span>
                     <span class='xiugaifriend'>修改</span>
                     <span class='friendshuoshuo'>$friend->userTalk</span>
                     <div class='msghistory'></div>
                  </li>";//<span class='friendshuoshuo'>$friend->userTalk</span>
                  //<span class='friendzhuangtai'>$friend->userState</span>
               }else{
                  $offlineHtml .="<li friendid='$friend->id' friendNoteName='$friend->friendNoteName' class='friendli' istalking='no'>
                                     <img src='$curHeadImageUrl' class='friHeadImage offlinePic' />
                                     <span class='friendName'>$friend->friendNoteName</span>
                                    
                                     <span class='friendzhuangtai'>$friend->userState</span>
                                  </li>";// <span class='friendshuoshuo'>$friend->userTalk</span>
               }
               
               // echo "<li class='friendli' isopen='close' istalking='yes'>
               //         <img src='$curHeadImageUrl' class='friHeadImage' />
               //         <div class='message'>
               //           <div class='mesnicheng'>$curfrinotename</div>
               //           <div class='messtate'>$curfriState</div>
               //           <div class='messhuoshuo'>$curfrishusohuo</div>
               //         </div>
               //       </li>";
            }
         }
         echo $onlineHtml;
       ?>       
      </ul> 
      <ul id="offlineFriendList">
       <?php
        echo $offlineHtml;
       ?>
       </ul> 
       </div>
    </div>
    <div id="right">
        <div id="chatdiv" curid="">
          <div id="chatTitle"></div>
          <span class="close">关闭</span>
          <div id="chatHistory" class="talkContent">
         
          </div>
          <div id="chatMsg">
             <div class="biaoqing"></div>
             <input class="textMsg" type="text" placeholder="输入消息……" />
                <div class="btnSend">Send</div>
          </div>
        </div>
       
        <div id="info" curuserid="<?php echo $curid;?>"></div>
        <div id="show"></div>

        <div id="altermessbox">
        <?php
          echo " <div class='alterTitle'>修改个人信息</div>
                 <div class='closealter'>关闭</div>
                 <div class='alterContent'>
                    <div class='alterContentL'>
                      <div class='loginerdiv'>
                        <span class='loginername'>昵称：</span>
                        <input type='text' class='loginernicheng' value='".$myname->userNickname."'>
                      </div>
                      <div class='loginerdiv'>
                         <span class='loginershuoshuo'>说说：</span>
                         <input type='text' class='loginershuo' value='".$curshuoshuo."'>
                      </div>
                      <div class='makesure'><button class='makealteration' >确认修改</button></div>
                    </div>
                    <div class='alterContentR'>
                      <div class='touxiang'><img src='$mytouxiang->userHeadImage' class='myHeadImage-alter' curHeadImageUrl='".$mytouxiang->userHeadImage."'/></div>
                      <button class='choose'>选择文件</button>
                    </div>
                 </div>";
        ?>
        </div>
       
    </div>

     <!-- <div style="width:700px;height:600px;float:right;position:relative;margin-right:100px;">
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
     </div> -->

      
</body>
</html>