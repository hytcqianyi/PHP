// function tiao(){
// 	alert("fail");
// }
$(function(){

  
  // $.ajax({
  //   url:"gettq.php",
  //   type:"POST",
  //   success:function(res){
  //     alert(res);
  //   }
  // });
});


$(function(){
    iniDelegate();
    setInterval('getUnreadMsg()',1000);
    //getUnreadMsg();
   // var str=""1+1;
   altermessage();

   $(".close").click(function(){
      $("#chatdiv").hide();
      $("#chatdiv").attr("curid","");
    });
});

function iniDelegate(){
	   chatHtml();
     sendMsg();   
}
  
function chatHtml(){
   $(".friendli").click(function(){
      //判断点击的用户是否是当前正在聊天的好友 
       if( $(this).attr("friendid") != $("#chatdiv").attr("curid") ){
          if($("#chatdiv").attr("curid")!=" "){//当点开窗口时
            var preFriendid=$("#chatdiv").attr("curid");
            var chatmess=$("#chatHistory").html();
            $(".friendli[friendid='"+preFriendid+"']").find(".msghistory").html(chatmess);
           }
         $("#chatHistory").html( $(this).find(".msghistory").html());


           var istalking=$(this).attr("istalking");
           if(istalking=="yes"){
             return;
           }
           $(".friendli").attr("istalking","no");
           $(this).attr("istalking","yes");
           $("#chatdiv").show();
           
           var friendNoteName=$(this).attr("friendNoteName");
           var friendid=$(this).attr("friendid");
           $("#chatdiv").attr("curid",friendid);
           //alert(friendid);
           $("#chatTitle").html("与"+friendNoteName+"聊天中");
           $(".btnSend").attr("friendid" ,friendid);       
       }
  });
}

function sendMsg(){
   $(document).on("click",".btnSend",function(){
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
            data:{flag:'sendMsg',msg:msg,receiveid:receiveid},
            success:function(res){
                  // alert(res);
            }
         });  

        $(this).parent().find(".textMsg").val(" ");
        var myHeadImageUrl=$(".myHeadImage").attr("curHeadImageUrl");
        var myname=$(".mynicheng").attr("curname");
       // alert("a");
        var chathtmlA ='';
        
          chathtmlA +=' <div class="onetalkbox">';
          chathtmlA +='   <div class="headImage"><img src=" '+myHeadImageUrl+' " class="headImage"  /></div>';
          chathtmlA +='   <div class="talknameA">'+ myname +'</div>';
          chathtmlA +='   <div class="onetalk">'+msg+'</div>';
          chathtmlA +=' </div>';
          
          $(this).parent().parent().find(".talkContent").append(chathtmlA);

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
      if(res!="fail"){
        var objs=eval("(" + res + ")");//解压json格式
        $.each(objs,function(){//开始判断
           if(this.msgSender == $("#chatdiv").attr("curid")){
               var chathtmlA ='';
                  chathtmlA +=' <div class="othertalkbox">';
                  chathtmlA +='   <div class="otherheadImage"><img src=" '+this.userHeadImage+' " class="headImage"  /></div>';
                  chathtmlA +='   <div class="talknameB">'+ this.userNickname +'</div>';
                  chathtmlA +='   <div class="othertalk">'+this.msgContent+'</div>';
                  chathtmlA +=' </div>';
                $("#chatHistory").append(chathtmlA);
           }
       });
        if($("#chatdiv").attr("curid")!=""){//设置为已读
          var senderid1=$("#chatdiv").attr("curid");
            $.ajax({
            type:"POST",
            url:"include/ajax.php",
            data:{flag:'setreadMsg',setreadSenderid:senderid1},
            success:function(res){
               //alert(res);
             }
           });
        }
      }

		}
	});
}


function altermessage(){
   $(".myaltermes").click(function(){
         $("#altermessbox").show();
         var mynewname=$(".loginernicheng").val();
         var mynewshuoshuo=$(".loginershuo").val();
         alert("a");

         $(".makealteration").bind('click',function() { 
          alert("11"); 
          
        });  
         
         $(".closealter").click(function(){
              $("#altermessbox").hide();
         });


   });
}