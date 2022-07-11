// JavaScript Document
/*
Validate Checkbox
Bắt buộc chọn 1 lựa chọn trong list checkbox

Cách dùng:
if( !validate_checkbox( 'w_location[]' ) ){
	//Code have Error
}else{
	//Code no Error
}
*/
function validate_checkbox( checkboxID ){
	var chks = document.getElementsByName( checkboxID );
	var hasChecked = false;
	for (var i = 0; i < chks.length; i++){
		if (chks[i].checked){
			hasChecked = true;
			break;
		}
	}
	if (hasChecked == false){
		return false;
	}
	return true;
}