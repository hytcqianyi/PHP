// $(function(){
	
// 	initDelegate();
// 	$("#login").dialog({
// 		buttons:{
// 			"OK":function(){
// 				var userid = $("#txtid").val();
// 				var userpwd = $("#txtpwd").val();
// 				if (userid == "" || userpwd == "") {
// 					return;
// 				}
// 				checkUser(userid,userpwd);
				
// 			}
// 		},
// 		width:500,
// 		height:350,
// 		autoOpen:false
// 	});

// 	$.ajax({
// 		type:"POST",
// 		url:"include/ajax.php",
// 		data:{flag:'checkSession'},
// 		success:function(res){
		
// 			if (res == "no") {
// 				beginLogin();
// 			}else{
// 				showCurUserInfo(res);
// 			}
// 		}
// 	});



// });

// function initDelegate(){
// 	$(document).on('click',"#btnLogout",function(){
// 		beginLogin();
// 	});
// }
// function beginLogin(){
// 	//clear session
// 	$.ajax({
// 		type:"POST",
// 		url:"include/ajax.php",
// 		data:{flag:'clearSession'},
// 		success:function(){
// 			$("#userinfo").html("login...");
// 		}
// 	});

// 	//show the dialog of login.
// 	$("#login").dialog("open");
// }


// function checkUser(id,pwd){
// 	// check id and pwd by ajax.

// 	$.ajax({
// 		type:"POST",
// 		url:"include/ajax.php",
// 		data:{flag:'checkUser',userid:id,userpwd:pwd},
// 		success:function(res){
// 			if (res =="right") {
					
// 			}else{

// 			}
			
// 		}
// 	});

// }
// function showCurUserInfo(res){

// 	var user = eval("(" + res + ")");
// 	var userName = user["name"];
// 	var userId = user["id"];

// 	$("#userinfo").html("welcome:" + userName + "<span id='btnLogout'>logout</span>");


// }