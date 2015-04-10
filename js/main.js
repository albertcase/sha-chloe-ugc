
(function($) {

var MAX_HEIGHT = 600;

		function readURL(input,ID_VAR) {
	        if (input.files && input.files[0]) {
			
				var reader = new FileReader();
				reader.onload = function (e) {
						render(e.target.result,ID_VAR);
				}
				reader.readAsDataURL(input.files[0]);
         		
			}
			return true;
		}
	    

		function render(src,mtarget){
			var image = new Image();
			image.onload = function(){
				var canvas = document.createElement('canvas');
				if(image.height > MAX_HEIGHT) {
					image.width *= MAX_HEIGHT / image.height;
					image.height = MAX_HEIGHT;
				}
				var ctx = canvas.getContext("2d");
				ctx.clearRect(0, 0, canvas.width, canvas.height);
				canvas.width = image.width;
				canvas.height = image.height;
				ctx.drawImage(image, 0, 0, image.width, image.height);
				var mbase64 = canvas.toDataURL("image/jpeg",0.6);
				ctx=null;
				$(mtarget).val(mbase64);
			};
			image.src = src;
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
			    },
				success: function(data){
					if(data.code == 1){
						window.location.href="congratulation.html";
					}else if(data.code == 2){
						alert("参数错误");
					}else{
						alert("图片未上传");
					}
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
	    			popup("second");
	    			$(this).val("").addClass("error");
	    		}else if(curVal==""){
	    			$(this).val("").addClass("error");
	    		}else{
	    			$(this).removeClass("error");
	    		}

	    		if($(this).attr("name") == "photo" &&  curVal==""){
	    			popup("first");
	    			return false;
	    		}else if(curVal=="" && $(this).attr("name") != "photo"){
	    			popup("second");
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