$(function(){
	$(".loginOptionsLeft").click(function(){
		if($(this).find(".loginOptionsLeftBox").attr("class")!="loginOptionsLeftBox"){
			$(this).find(".loginOptionsLeftBox").removeClass("loginOptionsLeftBoxSelected");
		}else{
			$(this).find(".loginOptionsLeftBox").addClass("loginOptionsLeftBoxSelected");
		}
	});
	$(".mcwLeftSearchInput").focus(function(){
		$(this).parent().css({
			"opacity":"1",
			"filter":"alpha(opacity=100)"
		});
	});
	$(".mcwLeftSearchInput").blur(function(){
		$(this).parent().css({
			"opacity":"0.3",
			"filter":"alpha(opacity=30)"
		});
	});
	//当导航的标签被hover时
	$(".mark").hover(function(){
		$(this).addClass("selected");
	},function(){
		if($(".navTimeContent").find(".selected").length==2){
			$(this).removeClass("selected");
		}
	});
	//当导航的标签被点击时
	$(".mark").click(function(){
		var clickid=$(this).attr("navid");
		var curid=$(".mainWrapper").find(".active").attr("contentid");
		if(clickid!=curid){
			var clickleft=$(this).css("left").split("px")[0];
			var navTimeMiddleleft=$(".navTimeMiddle").css("left").split("px")[0];
			navTimeMiddleleft=985-clickleft;
			$(".navTimeMiddle").animate({"left":navTimeMiddleleft+"px"},{duration:1000,easing:"easeOutCirc"});

			if(clickid*1<curid*1){
				$(".mainWrapper").find(".mainContent[contentid='"+clickid+"']").css({"left":"0"});
				$(".mainWrapper").find(".mainContent[contentid='"+curid+"']").stop().animate({"left":"2732px"});
				$(".mainWrapper").find(".mainContent[contentid='"+clickid+"']").stop().animate({"left":"1366px"});
			}else if(clickid*1>curid*1){
					$(".mainWrapper").find(".mainContent[contentid='"+clickid+"']").css({"left":"2732"});
				$(".mainWrapper").find(".mainContent[contentid='"+curid+"']").stop().animate({"left":"0px"});
				$(".mainWrapper").find(".mainContent[contentid='"+clickid+"']").stop().animate({"left":"1366px"});
			}
			$(".navTimeContent").find(".selected").removeClass("selected");
			$(this).addClass("selected");
			$(".mainWrapper").find(".active").removeClass("active");
			$(".mainWrapper").find(".mainContent[contentid='"+clickid+"']").addClass("active");
		}
	});




	//拖动时间轴
	// var left1;
	// var left2;
    $('.navTimeMiddle').draggable({axis:"x",scroll:false,containment:".navWrapper",
	 	 // start:function(){
	   //        	 left1=$(this).css("left").split("px")[0];
	   //         } ,
	   //    drag:function(){

	   //    		if(left1<(-2000)){
	   //    			alert("a");
	   //    			$(this).css({"left":"-2000px"});
	   //    		}else if(left1>(-800)){
	   //    			alert("b");
	   //    			$(this).css({"left":"-2000px"});
	   //    		}
	   //    },
	 	 //  stop:function(){
	 	 //  	 $('.line').draggable({snap:".navtimeline",snapModel:"inner"});
	 		//     left2=$(this).css("left").split("px")[0];
	 		//   if(left1<left2){
	 		//   	$(this).css({"left":(left2*1-5)+"px"});
	 		//   }else if(left1>left2){
	 		//   	$(this).css({"left":(left2*1+5)+"px"});
	 		//   }
	 	 //   }
    }); 
});