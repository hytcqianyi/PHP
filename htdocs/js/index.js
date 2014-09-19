// function tiao(){
// 	alert("fail");
// }



$(function(){
    iniDelegate();
    setInterval('getUnreadMsg()',1000);
    altermessage();
    setInterval('getnewmessage()',5000);
    alterfriend();
    $(".close").click(function(){
      $("#chatdiv").hide();
      $("#chatdiv").attr("curid","");
    });
     $(".foreregister").click(function(){
         $(".denglu").hide();
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
          // var mynewname=$(".loginernicheng").val();
          //var mynewshuoshuo=$(".loginershuo").val();
         //alert("a");
         $(".makealteration").bind('click',function() { //点击确认修改键以后
           //alert("11"); 
           var mynewname=$(".loginernicheng").val();//将input内的新值赋给新的名称
           var mynewshuoshuo=$(".loginershuo").val();
           alert(mynewname);
            $.ajax({
              type:"POST",
              url:"include/ajax.php",
              data:{flag:'altermessage',mynewname:mynewname,mynewshuoshuo:mynewshuoshuo},
              success:function(res){
                 alert(res);

              }
            });
            $(".mynicheng").html(mynewname);
            $(".myshuoshuo").html(mynewshuoshuo);

            $("#altermessbox").hide();
        });          
         $(".closealter").click(function(){
              $("#altermessbox").hide();
         });

   });
}
 
function getnewmessage(){
    $.ajax({
              type:"POST",
              url:"include/ajax.php",
              data:{flag:'getnewmessage'},
              success:function(res){
                var objs=eval("("+res+")");//解压json格式
                $.each(objs,function(){//开始判断
                  //var a = $(".friendli[friendid="+this.id+"]");

                  $(".friendli[friendid="+this.id+"]").find(".friendshuoshuo").html(this.userTalk);//刷新自己好友列表中的全部
                  //  var curuserid=$(".mynicheng").attr("curid");//改自己的昵称
                  // //alert(curuserid);
                  // if(this.id==curuserid){
                  //   $(".mynicheng").html(this.userNickname);
                  //   $(".myshuoshuo").html(this.userTalk);
                  //  }
                });

              }
            });
}

function alterfriend(){
   $(".xiugaifriend").click(function(){
        $("#altermessbox-friend").show();
        var b=$(this).parent().find(".friendName").attr("curid");
        $("#altermessbox-friend").find(".loginername").attr("curidnew",b);
        alert("a");
        return false;
   });
   $(document).click(function(){
      $("#chatdiv").hide();
   });

   $(".closealter-friend").click(function(){
           $("#altermessbox-friend").hide();
        });
   $(".makealteration").bind('click',function(){
       //var alterfriendnickname=$(".loginernicheng").val();
       //alert(alterfriendnickname);
       var bnew= $("#altermessbox-friend").find(".loginername").attr("curidnew");
       var a=$(this).parent().parent().find(".loginernicheng").val();//将修改好的好友备注赋值给a
       alert(a);
       $(".friendName[curid="+bnew+"]").html(a);
      $.ajax({
              type:"POST",
              url:"include/ajax.php",
              data:{flag:'alterfriend',id:bnew,name:a},
              success:function(res){
                 alert(res);
              }
            });
       $("#altermessbox-friend").hide();
      // alert("a");
   });
}

