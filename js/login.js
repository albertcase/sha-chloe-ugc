// JavaScript Document

$(".login_btn").click(function(){
	var forbidden =	document.myform.password.value;
	/*if(forbidden=="00000000"){
		$(".forbidden").show();
	}else{*/
		usrLoginFun(document.myform.name.value,document.myform.password.value);
	//};
	
})



function testAnim(eventId,x,hideId,showId) {
    $(eventId).removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $(this).removeClass();
	  $(hideId).hide();
	  $(showId).fadeIn();
    });
};

testAnim("lightSpeedIn");



function sett(){
	$("#errorPrompt").animate({"top":"-50px"}).removeClass("success");
}

function errorPrompt(success){
	if(success=="success"){
		$("#errorPrompt").addClass("success").animate({"top":"0"},function(){
			setTimeout('sett()',2500)	
        });
	}else{
		$("#errorPrompt").animate({"top":"0"},function(){
		    setTimeout('sett()',2500)	
        });
	}
	
}

//lightSpeedOut
$(".changelink").click(function(){
	if(document.myform.name.value==""){
		document.myform.name.focus();
		errorPrompt();
		$("#errorPrompt").html("请输入用户名!");
		testAnim("#animationSandbox_login","shake","","");
		return false;
	}
	testAnim("#animationSandbox_login","flipOutY","#animationSandbox_login","#animationSandbox_changepw");
	changeFun(document.myform.name.value);
})

$(".reback").click(function(){
	$("#newspassword").val("");
	$("#oldpassword").val("");
	testAnim("#animationSandbox_changepw","flipOutY","#animationSandbox_changepw","#animationSandbox_login");
})

/*$(".help").hover(function(){
	$("#helpTips").show();
	testAnim("#helpTips","bounceInUp","","");
},function(){
	$("#helpTips").hide();
	testAnim("#helpTips","bounceOutUp","","");
})
*/

function changeFun(loginUserName,newPassword){
	$.get("../password.php",{"LoginName": loginUserName,"newPwd":newPassword},function(result){
		//console.log(document.myform.name.value);
		if(!newPassword){
			var resultVal = JSON.parse(result);
			/*if(resultVal.Member[0].Password=="00000000"){
				$(".forbidden").show();
				return false;
			}else{*/
				
				if(resultVal.Member.length==0){
					errorPrompt();
					$("#errorPrompt").html("没有你这个人！or 长的系统都不识别！");
					setTimeout('$(".reback").click();',1500)
					//return false;
				}else{
					$("#oldpassword").val(document.myform.password.value);
				}	
				$("#oldpassword").attr("data-num",resultVal.Member[0].Password);
				
			//}
		}else{
			errorPrompt("success");
			$("#errorPrompt").html("你给我记着！");	
			setTimeout('$(".reback").click();',1500)
		}
		
	})
}

$(".modify_btn").click(function(){
	var newsVal = $("#newspassword").val();
	var oldVal = $("#oldpassword").val();
	var dataNum = $("#oldpassword").attr("data-num");
 	if(newsVal==""||newsVal.length<6){
		errorPrompt();
		$("#errorPrompt").html("这么屌的密码至少有6位！");	
		testAnim("#animationSandbox_changepw","shake","","");
	}else if(oldVal!=dataNum){
		errorPrompt();
		$("#errorPrompt").html("不对！什么？又忘了？！去跪舔IT吧");	
		testAnim("#animationSandbox_changepw","shake","","");
	}else{
	    changeFun(document.myform.name.value,newsVal);	
	}
})







function usrLoginFun(userName,userPassword){
	var username = document.myform.name.value;
	var password = document.myform.password.value;
	
	errorPrompt();
	if(username==""){
		document.myform.name.focus();
		$("#errorPrompt").html("Please enter your account!");
		testAnim("#animationSandbox_login","shake","","");
		return false;
	}else if(password==""){
		document.myform.password.focus();
		$("#errorPrompt").html("Please enter your password!");
		testAnim("#animationSandbox_login","shake","","");
		return false;
	}
	
	$.get("../login.php",{"uname": userName,"upassword":userPassword},function(result){
		var resultVal = JSON.parse(result);
		if(resultVal.Member[0].success==0){
			errorPrompt();
			$("#errorPrompt").html("Failed!");	
			testAnim("#animationSandbox_login","shake","","");
		}else{
			errorPrompt("success");
			$("#errorPrompt").html("Login success!");	
			window.location.href="../chloeTable.php";
		}
		
	})
}





