
(function($) {

var MAX_HEIGHT = 600;

		function readURL(input,ID_VAR) {

	        if (input.files && input.files[0]) {
		   	    // MegaPixImage constructor accepts File/Blob object.
			    var mpImg = new MegaPixImage(input.files[0]);

			    // Render resized image into image element using quality option.
			    // Quality option is valid when rendering into image element.
			    var resImg = document.getElementById('resultImage');
			    mpImg.render(resImg, { maxHeight: MAX_HEIGHT, quality: 1 }, function(src){
			    	$(ID_VAR).val(src);
			    });
			}
			return true;
         		
		}

	    $(".input_file").change(function(){
	        readURL(this,"#photoUrl");
	    });


		//表单提交  photo     name     function      location      email 

		function formsubmit(_photo,_name,_function,_location,_email){
			$.ajax({
				type: "POST",
				url: "/Request.php?model=finish",
				dataType:"json",
				data: {
			       "photo": _photo,
			       "name":_name,
			       "function":_function,
			       "location":_location,
			       "email":_email
			    }
			}).done(function(data){
				$("#loaded").hide(1000);
				if(data.code == 1){
						window.location.href="congratulation.html";
					}else if(data.code == 2){
						alert("参数错误");
					}else{
						alert("图片未上传");
					}
			});
		}


	    function popup(aclass){
	    	$(".tip").addClass(aclass).fadeIn();
	    }

	    function popupclose(){
	    	$(".tip").attr("class","tip").hide();
	    }

	    function isEmail(str){
	        var reg = /^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/;;
	        return reg.test(str);
		}
		function getVal(nameval){    
			return $("input[name="+nameval+"]").val();
		}  
	    function checkForm(cn){

	    	$(cn).each(function(){
	    		var curVal = $(this).val();

	    		if($(this).attr("name") == "email" && !isEmail(curVal)){
	    			//popup("second");
	    			$(this).val("").addClass("error");
	    		}else if(curVal==""){
	    			$(this).val("").addClass("error");
	    		}else{
	    			$(this).removeClass("error");
	    		}

	    		if($(this).attr("name") == "photo" &&  curVal==""){
	    			//popup("first");
	    			return false;
	    		}else if(curVal=="" && $(this).attr("name") != "photo"){
	    			//popup("second");
	    		}
	    	})


	    	if($(".error").length<=0){
	    		var submitText = {
	    			"_photo" : getVal("photo"),
	    			"_name" : getVal("name"),
	    			"_fun" : getVal("function"),
	    			"_location" : getVal("location"),
	    			"_email" : getVal("email")
	    		}
	    		$("#loaded").show();
	    		formsubmit(submitText._photo,submitText._name,submitText._fun,submitText._location,submitText._email);
	    		return false;
	    	}
	    }

    $(".formsubmit").click(function(){
    	checkForm(".txt");
    })

    $(".close_btn").click(function(){
    	popupclose()
    })

})(jQuery);




function orientationChange() {
switch(window.orientation) {
　　case 0:
        document.getElementById('heng').style.display="none";
        break;
　　case -90:
        document.getElementById('heng').style.display="block";
        break;
　　case 90:
        document.getElementById('heng').style.display="block";
        break;
　　case 180:
    　　document.getElementById('heng').style.display="none";
    　　break;
};

};


addEventListener('load', function(){
	orientationChange();
	window.onorientationchange = orientationChange;
});





