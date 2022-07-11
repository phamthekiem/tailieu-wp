$(document).ready(function(){
    $('textarea[maxLength]').each(function(){
        var tId=$(this).attr("id");
        $(this).after('<br><span id="cnt'+tId+'"></span>');
        $(this).keyup(function () {
            var tId=$(this).attr("id");
            var tMax=$(this).attr("maxLength");//case-sensitive, unlike HTML input maxlength
            var left = tMax - $(this).val().length;
            if (left < 0) left = 0;
            $('#cnt'+tId).text('Characters left: ' + left);
        }).keyup();
    });
});
