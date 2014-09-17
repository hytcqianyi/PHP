$(function(){
	//换背景
	$(".changBgFre").click(function(){
		picNum--;
		if(picNum<1){
			picNum=8;
		}
		$(".bgAllImage").attr("src",'css/images/0'+picNum+'.jpg');
	});
	$(".changBgNext").click(function(){
		picNum++;
		if(picNum>8){
			picNum=1;
		}
		$(".bgAllImage").attr("src",'css/images/0'+picNum+'.jpg');
	});


	//会话，联系人，控件，设置之间切换
	$(".navBtn").click(function(){
		var headerName=$(this).find("a span").html();
		$("#headerTitle").html(headerName);
		var btnName=$(this).attr("id");
		var curPanel=$(".navBtnSelected").attr("id");
		$(".panel-"+curPanel).hide();
		$(".navBtnSelected").find(".icon").css({
			"background-image":""
		});
		$(".navBtnSelected").removeClass("navBtnSelected");

		$(this).addClass("navBtnSelected");
		$(".panel-"+btnName).show();
		$(this).find(".icon").css({
			"background-image":'url("css/images/tab_icon_'+btnName+'_selected.png")'
		});
	});
	//在好友，群，讨论组之间切换
	$(".memberTitle").click(function(){
		var clickClass=$(this).attr("class");
		var clickClass0=clickClass.split(" ")[0];
		var clickClass1=clickClass.split(" ")[1];
		var clickClass2=clickClass.split(" ")[2];
		if(clickClass2==null){
			var memberTabBodyName=clickClass1.split("member-")[1]
			$(this).parent().parent().find(".active").removeClass("active");
			$(this).parent().parent().find(".memberTabBody-"+memberTabBodyName).addClass("active");
			$(".memberTabSelected").removeClass("memberTabSelected");
			$(this).addClass("memberTabSelected");
		}
		
	});
	//点到搜索框出现蒙版
	$(".sousuoText").click(function(){
		$("#menban").show();
		$("#sousuoBar").css({
			"z-index":"1000"
		});
		return false;
	});
	$(document).click(function(){
		$("#menban").hide();
		$("#sousuoBar").css({
			"z-index":""
		});
	});

	//点开好友分组里的好友
	$(".friendlistTitle").click(function(){
		var listState=$(this).parent().attr("class");
		if(listState!="friendlist"){
			$(this).parent().removeClass("active");
		}else{
			$(this).parent().addClass("active");
		}
	});
	//点击当前状态，显示状态列表
	$(".onlineStateShowArea").click(function(){
		var thisState=$(this).attr("state");
		if(thisState=="show"){
			$(".changeOnlineIcon").show();
			$(this).attr("state","hide");
			return false;
		}else{
			$(this).attr("state","show");
		}
	});
	//点击其他地方，聊天窗口的下拉菜单,状态列表消失
	$(document).click(function(){
		$(".onlineStateShowArea").attr("state","show");
		$(".changeOnlineIcon").hide();

		$(".pannelMenuList").slideUp();
		$(".pannelMenuList").attr("isshow","false");
	});
	///更改用户在线状态
	$(".changeOnlineIcon li").click(function(){
		var onlinestate=$(this).find(".iconState").attr("class").split(" iconState")[0];
		$(".onlineStateShowArea span").attr("class","iconState "+onlinestate);
		$(".avatarWrap span").attr("class","iconState userOnlineState "+onlinestate);
	});
	//弹出消息设置
	$(".row3").click(function(){
		$("#setupPanel").show();
	});
	$("#setuppanelLeftButton").click(function(){
		$("#setupPanel").hide();
	});
	$("#setupPanel").click(function(){
		$(this).css({"z-index":"10001"});
		$("#chatPanel").css({"z-index":"10000"});
	});
	$("#chatPanel").click(function(){
		$(this).css({"z-index":"10001"});
		$("#setupPanel").css({"z-index":"10000"});
	});



	//弹出版本信息
	$(".group .row4").click(function(){
		var state=$(this).attr("state");
		if(state=="show"){
			$(this).parent().next().show();
			$(this).find(".more_icon").css({
				"background-image":'url("css/images/open_arrow_fire.png")'
			});
			$(this).attr("state","hide");
		}else{
			$(this).parent().next().hide();
			$(this).find(".more_icon").css({
				"background-image":'url("css/images/open_arrow.png")'
			});
			$(this).attr("state","show");
		}
		
	});
	//弹出聊天窗口
	$(document).on("click",".listItem",function(){
		var curName=$(this).find(".memberNick a").html();
		var curIdName=$(this).attr("id");
		var curType=curIdName.split("-item-")[0];
		var curId=curIdName.split("-item-")[1];
		var chatMessage=$(this).find(".chatMessage").html();
		if(curType=="friend" || curType=="group"){
			 chatMessage=$("#chat-"+curIdName).find(".chatMessage").html();
			 if(chatMessage==null){
			 	chatMessage="";
			 	var curAvaImg=$(this).find(".avatar img").attr("src");
			 	var curAvaName=$(this).find(".memberNick a").html();
			 	var html="";
			 	html+='<li class="listItem listItem-chat" id="chat-'+curIdName+'">';	
			 	html+='		<a href="#" class="avatar">';
			 	html+='			<img src="'+curAvaImg+'">';
			 	html+='		</a>';
			 	html+='		<p class="memberNick">';
			 	html+='			<a>'+curAvaName+'</a>';
			 	html+='			<span></span>';
			 	html+='		</p>';
			 	html+='		<p class="memberMsg"> </p>';
			 	html+='		<div class="deleteConversation"></div>';
			 	html+='		<div class="chatMessage">';
			 	html+='		</div>';
			 	html+='</li>';	
			 	$("#panelBodyBox").stop().animate({"height":"440px"},800,function(){//打开新窗口，消除表情框
	  	  		$("#panelBodyBox").scrollTop($("#panelBodyBox")[0].scrollHeight); 
			  	  	}).animate();
			  	$("#face_images").stop().animate({"height":"0%"},1000);
			  	$(".addFaceBtn").attr("showstate","hide");

			 	$("#conversationList").prepend(html);
			 	$("#panelBodyBox").html(chatMessage);
				$("#panelTitle").html(curName);
			 	$("#chatPanel").attr("curid",curType+"-"+curId);
			 	$("#chatPanel").show();
			 	return;
			 }
		}else{
			var curhtml=$(this).html();
			var html="";
		 	html+='<li class="listItem listItem-chat" id="'+curIdName+'">';	
		 	html+=curhtml;
		 	html+='</li>';
		 	$("#conversationList").prepend(html);
		 	$(this).remove();
		 	$(".deleteConversation").stop().hide();
		}
		$("#panelBodyBox").stop().animate({"height":"440px"},800,function(){//打开新窗口，消除表情框
	  	  		$("#panelBodyBox").scrollTop($("#panelBodyBox")[0].scrollHeight-$("#panelBodyBox").height()); 
	  	  	}).animate();
	  	$("#face_images").stop().animate({"height":"0%"},1000);
	  	$(".addFaceBtn").attr("showstate","hide");

		$("#panelBodyBox").html(chatMessage);
		$("#panelTitle").html(curName);
		$("#chatPanel").attr("curid",curType.split("chat-")[1]+"-"+curId);
		$("#panelBodyBox").scrollTop($("#panelBodyBox")[0].scrollHeight-$("#panelBodyBox").height()); 
		$("#chatPanel").show();
		
	});
	$("#panelRightButtonI").click(function(){
		$("#chatPanel").hide();
	});



	//发送消息
	$(".sendMessageBtn").click(function(){
		var inputContent=$(".chatInputArea").val();
		if(inputContent!="" && inputContent!=null){
			send(inputContent);
		}else{

		}
	});

	//键盘事件
	$(document).keyup(function(e){
	    if (e.keyCode == 13) //enter键的ascII码为13
	    {
	    	$(".sendMessageBtn").trigger("click");
	    }
	});


	//聊天窗口的下拉菜单
	$("#panelLeftButton").click(function(){
		var showState=$(".pannelMenuList").attr("isshow");
		if(showState=="false"){
			var curChatPanelType=$("#chatPanel").attr("curid").split("-")[0];
			if(curChatPanelType=="group"){
				$(this).parent().parent().find(".menuListIcon1").css({"background-position": "0px 2px"});
				$(this).parent().parent().find(".menuListIcon1Words").html("群成员");
				$(this).parent().parent().find(".menuListIcon2Words").html("群资料");
			}else if(curChatPanelType=="friend"){
				$(this).parent().parent().find(".menuListIcon1").css({"background-position": "-128px 3px"});
				$(this).parent().parent().find(".menuListIcon1Words").html("QQ空间");
				$(this).parent().parent().find(".menuListIcon2Words").html("详细资料");
			}
			$(".pannelMenuList").slideDown();
			$(".pannelMenuList").attr("isshow","true");
			return false;
		}else if(showState=="true"){
			$(".pannelMenuList").slideUp();
			$(".pannelMenuList").attr("isshow","false");
		}
	});
	//删除图标
	// $(".listItem-chat").each(function(){
	 $(document).on("mouseover",".listItem-chat",function(){
		$(this).find(".deleteConversation").stop().show();
		return false;
	});
	  $(document).on("mouseout","body",function(){
		$(".deleteConversation").stop().hide();
	});


	  //发送表情--切换不同表情
	  $(".btnsWrap li").click(function(){
	  	  var indexNum=$(this).attr("_index");
	  	  $("#face_images .wrap").find(".selectedFace").removeClass("selectedFace");
	  	  indexNum++;
	  	  $("#face_images .btnsWrap").find(".selected").removeClass("selected");
	  	  $(this).addClass("selected");
	  	  $("#face_images .wrap").find(".faceIteam"+indexNum).addClass("selectedFace");	  	
	  });

	  $(".faceIteam i").click(function(){
	  	  var biaoqingming=$(this).attr("title");
	  	  var textContent=$(".chatInputArea").val();
	  	  if(biaoqingming=="delKey"){
	  	  	var textlength=textContent.length;
	  	  	textlength--;
	  	  	textContent=textContent.slice(0,textlength);
	  	  	$(".chatInputArea").val(textContent);
	  	  }else{
	  	  	$(".chatInputArea").val(textContent+"["+biaoqingming+"]");
	  	  }  
	  });
	  //弹出表情框
	  $(".addFaceBtn").click(function(){
	  	  if($(this).attr("showstate")=="hide"){
	  	  	$("#panelBodyBox").stop().animate({"height":"190px"},800,function(){
	  	  		$("#panelBodyBox").scrollTop($("#panelBodyBox")[0].scrollHeight); 
	  	  	}).animate();
	  	  	$("#face_images").stop().animate({"height":"80%"},1000);
	  	  	$(this).attr("showstate","show");
	  	  }else if($(this).attr("showstate")=="show"){
	  	  	$("#panelBodyBox").stop().animate({"height":"440px"},800,function(){
	  	  		$("#panelBodyBox").scrollTop($("#panelBodyBox")[0].scrollHeight); 
	  	  	}).animate();
	  	  	$("#face_images").stop().animate({"height":"0%"},1000);
	  	  	$(this).attr("showstate","hide");
	  	  }
	  });
	//删除会话
	$(document).on("click",".deleteConversation",function(){
		$(this).parent().remove();
		return false;
	});
	setInterval('showTalkTime()',60000);


	//拖动窗口
	$("#chatPanel").draggable({containment:"body",handle:"#panelHeader"});
	$("#setupPanel").draggable({containment:"body",handle:"#setuppanelHeader"});
	//$(".chatMessage").parent().draggable({connectToSortable:"#conversationList",revert:"invalid",containment:"#conversationList",axis:"y"});
		$("#conversationList").sortable({ revert:true,axis:"y"});
		$("ul,li").disableSelection();



	//php数据库相关
	//getunreadMsg();
	timeHandle=setInterval("getunreadMsg()",1000);
});


var showtalktime="y";
var picNum=2;
function showTalkTime(){
	showtalktime="y";
}

function send(c){
	var content=c;
	var length=content.length/3;
	for( var i=0;i<length;i++)
	{
			content=content.replace("[微笑]","<img src='images/biaoqing/14.gif' />");
			content=content.replace("[撇嘴]","<img src='images/biaoqing/1.gif' />");
			content=content.replace("[色]","<img src='images/biaoqing/2.gif' />");
			content=content.replace("[发呆]","<img src='images/biaoqing/3.gif' />");
			content=content.replace("[得意]","<img src='images/biaoqing/4.gif' />");
			content=content.replace("[流泪]","<img src='images/biaoqing/5.gif' />");
			content=content.replace("[害羞]","<img src='images/biaoqing/6.gif' />");
			content=content.replace("[闭嘴]","<img src='images/biaoqing/7.gif' />");
			content=content.replace("[睡]","<img src='images/biaoqing/8.gif' />");
			content=content.replace("[大哭]","<img src='images/biaoqing/9.gif' />");
			content=content.replace("[尴尬]","<img src='images/biaoqing/10.gif' />");
			content=content.replace("[发怒]","<img src='images/biaoqing/11.gif' />");
			content=content.replace("[调皮]","<img src='images/biaoqing/12.gif' />");
			content=content.replace("[呲牙]","<img src='images/biaoqing/13.gif' />");
			content=content.replace("[惊讶]","<img src='images/biaoqing/0.gif' />");
			content=content.replace("[难过]","<img src='images/biaoqing/15.gif' />");
			content=content.replace("[酷]","<img src='images/biaoqing/16.gif' />");
			content=content.replace("[冷汗]","<img src='images/biaoqing/96.gif' />");
			content=content.replace("[抓狂]","<img src='images/biaoqing/18.gif' />");
			content=content.replace("[吐]","<img src='images/biaoqing/19.gif' />");
			content=content.replace("[偷笑]","<img src='images/biaoqing/20.gif' />");
			content=content.replace("[可爱]","<img src='images/biaoqing/21.gif' />");
			content=content.replace("[白眼]","<img src='images/biaoqing/22.gif' />");
			content=content.replace("[傲慢]","<img src='images/biaoqing/23.gif' />");
			content=content.replace("[饥饿]","<img src='images/biaoqing/24.gif' />");
			content=content.replace("[困]","<img src='images/biaoqing/25.gif' />");
			content=content.replace("[惊恐]","<img src='images/biaoqing/26.gif' />");
			content=content.replace("[流汗]","<img src='images/biaoqing/27.gif' />");
			content=content.replace("[憨笑]","<img src='images/biaoqing/28.gif' />");
			content=content.replace("[大兵]","<img src='images/biaoqing/29.gif' />");
			content=content.replace("[奋斗]","<img src='images/biaoqing/30.gif' />");
			content=content.replace("[咒骂]","<img src='images/biaoqing/31.gif' />");
			content=content.replace("[疑问]","<img src='images/biaoqing/32.gif' />");
			content=content.replace("[嘘]","<img src='images/biaoqing/33.gif' />");
			content=content.replace("[晕]","<img src='images/biaoqing/34.gif' />");
			content=content.replace("[折磨]","<img src='images/biaoqing/35.gif' />");
			content=content.replace("[衰]","<img src='images/biaoqing/36.gif' />");
			content=content.replace("[骷髅]","<img src='images/biaoqing/37.gif' />");
			content=content.replace("[敲打]","<img src='images/biaoqing/38.gif' />");
			content=content.replace("[再见]","<img src='images/biaoqing/39.gif' />");
			content=content.replace("[擦汗]","<img src='images/biaoqing/97.gif' />");
			content=content.replace("[抠鼻]","<img src='images/biaoqing/98.gif' />");
			content=content.replace("[鼓掌]","<img src='images/biaoqing/99.gif' />");
			content=content.replace("[糗大了]","<img src='images/biaoqing/100.gif' />");
			content=content.replace("[坏笑]","<img src='images/biaoqing/101.gif' />");
			content=content.replace("[左哼哼]","<img src='images/biaoqing/102.gif' />");
			content=content.replace("[右哼哼]","<img src='images/biaoqing/103.gif' />");
			content=content.replace("[哈欠]","<img src='images/biaoqing/104.gif' />");
			content=content.replace("[鄙视]","<img src='images/biaoqing/105.gif' />");
			content=content.replace("[委屈]","<img src='images/biaoqing/106.gif' />");
			content=content.replace("[快哭了]","<img src='images/biaoqing/107.gif' />");
			content=content.replace("[阴险]","<img src='images/biaoqing/108.gif' />");
			content=content.replace("[亲亲]","<img src='images/biaoqing/109.gif' />");
			content=content.replace("[吓]","<img src='images/biaoqing/110.gif' />");
			content=content.replace("[可怜]","<img src='images/biaoqing/111.gif' />");
			content=content.replace("[菜刀]","<img src='images/biaoqing/112.gif' />");
			content=content.replace("[西瓜]","<img src='images/biaoqing/89.gif' />");
			content=content.replace("[啤酒]","<img src='images/biaoqing/113.gif' />");
			content=content.replace("[篮球]","<img src='images/biaoqing/114.gif' />");
			content=content.replace("[乒乓]","<img src='images/biaoqing/115.gif' />");
			content=content.replace("[咖啡]","<img src='images/biaoqing/60.gif' />");
			content=content.replace("[饭]","<img src='images/biaoqing/61.gif' />");
			content=content.replace("[猪头]","<img src='images/biaoqing/46.gif' />");
			content=content.replace("[玫瑰]","<img src='images/biaoqing/63.gif' />");
			content=content.replace("[凋谢]","<img src='images/biaoqing/64.gif' />");
			content=content.replace("[示爱]","<img src='images/biaoqing/116.gif' />");
			content=content.replace("[爱心]","<img src='images/biaoqing/66.gif' />");
			content=content.replace("[心碎]","<img src='images/biaoqing/67.gif' />");
			content=content.replace("[蛋糕]","<img src='images/biaoqing/53.gif' />");
			content=content.replace("[闪电]","<img src='images/biaoqing/54.gif' />");
			content=content.replace("[炸弹]","<img src='images/biaoqing/55.gif' />");
			content=content.replace("[刀]","<img src='images/biaoqing/56.gif' />");
			content=content.replace("[足球]","<img src='images/biaoqing/57.gif' />");
			content=content.replace("[瓢虫]","<img src='images/biaoqing/117.gif' />");
			content=content.replace("[便便]","<img src='images/biaoqing/59.gif' />");
			content=content.replace("[月亮]","<img src='images/biaoqing/75.gif' />");
			content=content.replace("[太阳]","<img src='images/biaoqing/74.gif' />");
			content=content.replace("[礼物]","<img src='images/biaoqing/69.gif' />");
			content=content.replace("[拥抱]","<img src='images/biaoqing/49.gif' />");
			content=content.replace("[强]","<img src='images/biaoqing/76.gif' />");
			content=content.replace("[弱]","<img src='images/biaoqing/77.gif' />");
			content=content.replace("[握手]","<img src='images/biaoqing/78.gif' />");
			content=content.replace("[胜利]","<img src='images/biaoqing/79.gif' />");
			content=content.replace("[抱拳]","<img src='images/biaoqing/118.gif' />");
			content=content.replace("[勾引]","<img src='images/biaoqing/119.gif' />");
			content=content.replace("[拳头]","<img src='images/biaoqing/120.gif' />");
			content=content.replace("[差劲]","<img src='images/biaoqing/121.gif' />");
			content=content.replace("[爱你]","<img src='images/biaoqing/122.gif' />");
			content=content.replace("[NO]","<img src='images/biaoqing/123.gif' />");
			content=content.replace("[OK]","<img src='images/biaoqing/124.gif' />");
			content=content.replace("[爱情]","<img src='images/biaoqing/42.gif' />");
			content=content.replace("[飞吻]","<img src='images/biaoqing/85.gif' />");
			content=content.replace("[跳跳]","<img src='images/biaoqing/43.gif' />");
			content=content.replace("[发抖]","<img src='images/biaoqing/41.gif' />");
			content=content.replace("[怄火]","<img src='images/biaoqing/86.gif' />");
			content=content.replace("[转圈]","<img src='images/biaoqing/125.gif' />");
			content=content.replace("[磕头]","<img src='images/biaoqing/126.gif' />");
			content=content.replace("[回头]","<img src='images/biaoqing/127.gif' />");
			content=content.replace("[跳绳]","<img src='images/biaoqing/128.gif' />");
			content=content.replace("[挥手]","<img src='images/biaoqing/129.gif' />");
			content=content.replace("[激动]","<img src='images/biaoqing/130.gif' />");
			content=content.replace("[街舞]","<img src='images/biaoqing/131.gif' />");
			content=content.replace("[献吻]","<img src='images/biaoqing/132.gif' />");
			content=content.replace("[左太极]","<img src='images/biaoqing/133.gif' />");
			content=content.replace("[右太极]","<img src='images/biaoqing/134.gif' />");
			content=content.replace("[双喜]","<img src='images/biaoqing/136.gif' />");
			content=content.replace("[鞭炮]","<img src='images/biaoqing/137.gif' />");
			content=content.replace("[灯笼]","<img src='images/biaoqing/138.gif' />");
			content=content.replace("[发财]","<img src='images/biaoqing/139.gif' />");
			content=content.replace("[K歌]","<img src='images/biaoqing/140.gif' />");
			content=content.replace("[购物]","<img src='images/biaoqing/141.gif' />");
			content=content.replace("[邮件]","<img src='images/biaoqing/142.gif' />");
			content=content.replace("[帅]","<img src='images/biaoqing/143.gif' />");
			content=content.replace("[喝彩]","<img src='images/biaoqing/144.gif' />");
			content=content.replace("[祈祷]","<img src='images/biaoqing/145.gif' />");
			content=content.replace("[爆筋]","<img src='images/biaoqing/146.gif' />");
			content=content.replace("[棒棒糖]","<img src='images/biaoqing/147.gif' />");
			content=content.replace("[喝奶]","<img src='images/biaoqing/148.gif' />");
			content=content.replace("[下面]","<img src='images/biaoqing/149.gif' />");
			content=content.replace("[香蕉]","<img src='images/biaoqing/150.gif' />");
	}
	var html="";
	var nowTime=new Date();
	if(showtalktime=="y"){
		var hour=nowTime.getHours()<10?"0"+nowTime.getHours():nowTime.getHours();
		var minute=nowTime.getMinutes()<10?"0"+nowTime.getMinutes():nowTime.getMinutes();
		var second=nowTime.getSeconds()<10?"0"+nowTime.getSeconds():nowTime.getSeconds();
		html+='<div class="chatTime">';
		html+='<span>'+hour+':'+minute+':'+second+'</span>';	
		html+='</div>';	
		showtalktime="n"	
	}
	var curuserImg=$("#mainTopAll .accountHeader .avatarWrap img").attr("src");
	var curuserName=$("#mainTopAll .accountHeader .textUserNick").html();																							
 	html+='<div class="chatContentSelf">';	
 	html+='		<img class="avatarImg" src="'+curuserImg+'">';
 	html+='		<p class="chatNick">'+curuserName;
 	html+='		</p>';
 	html+='		<p class="chatContent ">'+content+'</p>';
 	html+='	</div>';
 	var curId=$("#chatPanel").attr("curid");
 	var curIdType=curId.split("-")[0];
 	var curIdNum=curId.split("-")[1];
 	$.ajax({
 		type:"POST",
 		url:"include/ajax.php",
 		data:{flag:'sendMsg',chatMsg:content,receiverId:curIdNum},
 		success:function(res){
 			if(res=="ok"){
 				$("#chat-"+curIdType+"-item-"+curIdNum).find(".chatMessage").append(html);
			 	$("#chat-"+curIdType+"-item-"+curIdNum).find(".memberMsg").html(content);
			 	$("#panelBodyBox").append(html);
			    $("#panelBodyBox").scrollTop($("#panelBodyBox")[0].scrollHeight); 
			    $(".chatInputArea").val("");
 			}else{
 				alert("消息发送失败！请重新发送");
 			}
 		}
 	});
}

function getunreadMsg(){
	$.ajax({
		type:"POST",
		url:"include/ajax.php",
		data:{flag:"getunreadMsg"},
		success:function(res){
			if(res!="fail"){
				var objs=eval("("+res+")");
				$.each(objs,function(){
					var html="";
					html+='<div class="chatContentOther">';	
				 	html+='		<img class="avatarImg" src="'+this.userHeadImage+'">';
				 	html+='		<p class="chatNick">'+this.userNickname;
				 	html+='		</p>';
				 	html+='		<p class="chatContent ">'+this.msgContent+'</p>';
				 	html+='	</div>';
				 	if($("#chatPanel").attr("curid")=="friend-"+this.msgSender){
				 		$("#panelBodyBox").append(html);
				 		$("#panelBodyBox").scrollTop($("#panelBodyBox")[0].scrollHeight); 
				 	}
				 	if($("#chat-friend-item-"+this.msgSender).length>0){
				 		$("#chat-friend-item-"+this.msgSender).find(".chatMessage").append(html);
				 	}else{
				 		var chatheadhtml="";
				 		chatheadhtml+="<li class='listItem listItem-chat' id='chat-friend-item-"+this.msgSender+"'>";
				 		chatheadhtml+="<a class='avatar'><img src='"+this.userHeadImage+"'><div class='unreadMsgTip'></div></a>";
				 		chatheadhtml+="<p class='memberNick'><a>"+this.userNickname+"</a><span></span></p>";
				 		chatheadhtml+="<p class='memberMsg'></p>";
				 		chatheadhtml+="<div class='deleteConversation' style='display: none;'></div>"
				 		chatheadhtml+="<div class='chatMessage'>"
				 		chatheadhtml+=html;
				 		chatheadhtml+="</div></li>"
				 		$("#conversationList").append(chatheadhtml);
				 	}
				});
				$.ajax({
					type:"POST",
					url:"include/ajax.php",
					data:{flag:"setRead"},
					success:function(res){
						
					}
				});
			}
		}
	});
}