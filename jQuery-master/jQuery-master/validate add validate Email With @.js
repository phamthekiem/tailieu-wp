//Thêm validate Email cho Validate jQuery Plugin
$.validator.addMethod("customemail", 
	function(value, element) {
		return /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
	}, 
	"Sorry, I've enabled very strict email validation"
);

$("#signup_form").validate({
	rules: {
		email: {
		  required: {
			  depends:function(){
				  $(this).val($.trim($(this).val()));
				  return true;
			  }   
		  },                  
		  customemail: true
		}
	  },
});