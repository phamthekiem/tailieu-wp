/*Phone format 999-999-9999
Use: 
phone:{ 
	required: true,
	customphone: true
},
*/
$.validator.addMethod('customphone', function (value, element) {
    return this.optional(element) || /^\d{3}-\d{3}-\d{4}$/.test(value);
}, "Please enter a valid phone number");

//Tùy biến hiển thị tin nhắn cho radio button
errorPlacement: function(error, element) {
		if (element.attr("type") == "radio") {
              error.insertAfter(element.parents('.radio_style'));
          } else {
              error.insertAfter(element);
          }
	console.log(error,element);
},
$.validator.addMethod("date_format", 
    function(value, element) {
    	return /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(1|3)\d{3}$/.test(value);
    }, 
    "Sorry, I've enabled very strict date validation"
);

//Format value but not required by regex
$.validator.addMethod(
	"regex",
	function (value, element, regexp) {
	    var re = new RegExp(regexp);
	    return this.optional(element) || re.test(value);
	},
	"Sorry, I've enabled very strict email validation"
);
//Ex format email but not required by regex
email: {
	regex: /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/
},

//Change div error display
errorLabelContainer: $(".subscribe_newsletter_mess")
errorPlacement: function(error, element) {
	if (element.attr("type") == "radio") {
	    error.insertAfter(element.parents('.radio_style_error'));
	}else if (element.attr("type") == "checkbox") {
	    error.insertAfter(element.parents('.checkbox_style'));
	}else {
	    error.insertAfter(element);
	}
},

//required that at least 1 of these is filled out

$.validator.addMethod("require_from_group", function(value, element, options) {
	var numberRequired = options[0];
	var selector = options[1];
	var fields = $(selector, element.form);
	var filled_fields = fields.filter(function() {
	// it's more clear to compare with empty string
	return $(this).val() != ""; 
	});
	var empty_fields = fields.not(filled_fields);
	// we will mark only first empty field as invalid
	if (filled_fields.length < numberRequired && empty_fields[0] == element) {
	return false;
	}
	return true;
	// {0} below is the 0th item in the options field
}, "Please fill out at least {0} of these fields.");


$.validator.addMethod('vietnamphone', function (value, element) {
    return /^0+(\d{9,10})$/.test(value);
}, "Hãy điền đúng số điện thoại");
$.validator.addMethod("customemail",
    function(value, element) {
	if(value == "") return true;
	return /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
    },
    "Định dạng email không đúng."
);
var checkoutForm = $(".page-template-temp-checkout form.checkout.woocommerce-checkout");
checkoutForm.validate({
    rules: {
	'billing_phone': {
	    required: {
		depends:function(){
		    $(this).val($.trim($(this).val()));
		    return true;
		}
	    },
	    vietnamphone: true
	},
	'shipping_phone': {
	    required: {
		depends:function(){
		    $(this).val($.trim($(this).val()));
		    return true;
		}
	    },
	    vietnamphone: true
	},
	'billing_email': {
	    required: function(element){
		var require_email = $(element).data('required');
		return (require_email == 1) ? true : false;
	    },
	    customemail: true
	}
    },
    messages: {
	'billing_phone': "Số điện thoại là bắt buộc",
	'shipping_phone': "Số điện thoại là bắt buộc",
	'billing_email': "Email là bắt buộc",
    },
    highlight: function (element, errorClass, validClass) {
	var elem = $(element);
	if (elem.hasClass("select2-hidden-accessible")) {
	    elem.closest('.woocommerce-input-wrapper').find('.select2-selection--single').addClass(errorClass);
	} else {
	    elem.addClass(errorClass);
	}
    },
    unhighlight: function (element, errorClass, validClass) {
	var elem = $(element);
	if (elem.hasClass("select2-hidden-accessible")) {
	    elem.closest('.woocommerce-input-wrapper').find('.select2-selection--single').removeClass(errorClass);
	} else {
	    elem.removeClass(errorClass);
	}
    }
});
