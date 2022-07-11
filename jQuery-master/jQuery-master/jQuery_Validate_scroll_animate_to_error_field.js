$("#commentForm").validate({
    focusInvalid: false,
    invalidHandler: function(form, validator) {
        
        if (!validator.numberOfInvalids())
            return;
        
        $('html, body').animate({
            scrollTop: $(validator.errorList[0].element).offset().top
        }, 1000);
        
    }
});
