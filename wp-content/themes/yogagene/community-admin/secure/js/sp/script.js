jQuery(function(){
    jQuery('.drawer').drawer();
    jQuery(".drawer-nav input").focus(function(){
        jQuery('.drawer').drawer('destroy');
    }).blur(function(){
        jQuery('.drawer').drawer();
        jQuery('.drawer').drawer('close');
    });
});