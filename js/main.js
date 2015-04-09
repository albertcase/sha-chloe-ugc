
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
				console.log(mbase64.split("base64,")[1])
			};
			image.src = src;
		}



	    $(".input_file").change(function(){
	        readURL(this,"#photoUrl");
	    });



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
	    			$(this).val("").addClass("error");
	    		}else if(curVal==""){
	    			$(this).val("").addClass("error");
	    		}
	    	})

	    }

	    $(".formsubmit").click(function(){
	    	checkForm(".txt");
	    })


})(jQuery);