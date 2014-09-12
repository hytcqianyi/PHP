function tiao(){
	alert("fail");
}



$(function(){
   iniDelegate();
});

function iniDelegate(){
	$(".friendli").click(){
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
       $("btnSend").attr("friendid" ,friendid);

	});
}