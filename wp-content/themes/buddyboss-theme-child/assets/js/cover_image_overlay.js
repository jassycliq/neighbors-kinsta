jQuery( document ).ready( function(){
    var observer = new MutationObserver(function(mutations) {
        if (jQuery("#header-cover-image").length > 0) {
            jQuery("#header-cover-image").append("<div class='cover-image-overlay'></div>");
            observer.disconnect();
        }
    });
        
    observer.observe(document, {attributes: false, childList: true, characterData: false, subtree:true});

});
