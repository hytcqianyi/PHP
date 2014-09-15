// function tiao(){
// 	alert("fail");
// }



$(function(){

    iniDelegate();
   // setInterval('getUnreadMsg()',1000)
    //getUnreadMsg();
    var str=""1+1;
    alert(eval(str));
});

function iniDelegate(){
	$(".friendli").click(function(){
       var istalking=$(this).attr("istalking");
       if(istalking=="yes"){
       	 return;
       }
       $(".friendli").attr("istalking","no");
       $(this).attr("istalking","yes");

       $("#chatdiv").show();
       
       var friendNoteName=$(this).attr("friendNoteName");
       var friendid=$(this).attr("friendid");
       $("#chatTitle").html("与"+friendNoteName+"聊天中");
       $(".btnSend").attr("friendid" ,friendid);

	});
  chathtml()
    $(".btnSend").click(function(){
    	var msg=$(".textMsg").val();
    	if(msg==""){return ;}

    	//通过ajax将当前数据插入数据库的表中
         var receiveid=$(this).attr("friendid");
        // alert(receiveid);
         var senderid=$("#info").attr("curuserid");
        // alert(senderid);
         $.ajax({
            type:"POST",
            url:"include/ajax.php",
            data:{flag:'sendMsg',msg:msg,senderid:senderid,receiveid:senderid},
            success:function(res){
                   alert(res);
            }
         });
    });
}

//获取自己的所有未读消息
function getUnreadMsg(){
	$.ajax({
		type:"POST",
		url:"include/ajax.php",
		data:{flag:'getUnreadMsg'},
		success:function(res){
      //$("#show").html(res);

			var objs=eval("(" + res + ")");
     // alert(objs);
		  $.each(objs,function(){
        alert(this.msgContent);
			});
		}
	});
}


function chathtml(){

  $(".friendList li").click(function(){

    var talkid=$(this).attr("talkid");
    var talkname=$(this).attr("talkname");
    var isshow=$(this).attr("isshow");
    var isapper=$(this).attr("isapper");
    
    if(isshow=="no"){
      $(this).attr("isshow","yes");
      if(isapper=="no"){

      var chathtmlA='';
        chathtmlA +='<div id="'+talkid+'" class="talk" >';
        chathtmlA +=' <div class="talkboxtitle"><a>'+talkname+'</a><span class="close"></span></div>';
        chathtmlA +='   <div class="talkbox">';
        chathtmlA +='     <div class="talkContent"></div>';
        chathtmlA +='   <div class="sendMsg">';
        chathtmlA +='     <div class="sendbox"><input class="txtMsg" type="text"/></div>';
        chathtmlA +='     <div class="sendbtn"><input class="send" type="submit" value="发送" /></div>';
        chathtmlA +='   </div>';
        chathtmlA +=' </div>';
        chathtmlA +='</div>';
        
        
        $(".right").append(chathtmlA);
        $(this).attr("isapper","yes");

      }
      else{ 
        $("#"+talkid).show();
      }   
    }
    $(".talk").css("z-index","1");
    $("#"+talkid).css("z-index","22");
    $(".close").click(function(){
      var talkidN = $(this).parent().parent().attr("id");
      $(".friendli[talkid='"+talkidN+"']").attr("isshow","no");
      $("#"+talkid).hide();
      
    });

    $("#"+talkid).draggable({ 
      handle: ".talkboxtitle" ,
      containment: "parent"
    });

    
  });
}