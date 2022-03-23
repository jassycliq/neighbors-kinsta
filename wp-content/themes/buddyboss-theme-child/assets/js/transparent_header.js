jQuery( document ).ready(function() {
	window.onscroll = function() {scrollFunction()};
});

function scrollFunction() {
	if (document.body.scrollTop > jQuery(document).height() * 0.1 || document.documentElement.scrollTop > jQuery(document).height() * 0.1) {
		if (jQuery(window).width() >= 600) {
			document.getElementById("masthead").style.background = "rgba(255, 255, 255, 0.95)";
            jQuery(".primary-menu > li > a").css("color", "black");
            jQuery(".bb-header-buttons a.button.outline").css("color", "black");
        }
        jQuery(".header-aside-change").css("color", "black");
        // jQuery(".site-header #header-aside i").css("color", "black");
        // jQuery(".site-header i").css("color", "black");
        jQuery(".primary-menu > .current-menu-item > a, .primary-menu .current_page_item > a").css("color", "#f9c349");
        jQuery(".bb-mobile-panel-header .user-name").css("color", "black");
        jQuery("a.bb-close-panel i").css("color", "black");
    } else {
        if (jQuery(window).width() >= 600) {
        	document.getElementById("masthead").style.background = "none";
            jQuery(".primary-menu > li > a").css("color", "white");
            jQuery(".bb-header-buttons a.button.outline").css("color", "white");
        }
        jQuery(".header-aside-change").css("color", "white");
        // jQuery(".site-header #header-aside i").css("color", "white");
        // jQuery(".site-header i").css("color", "white");
        jQuery(".primary-menu > .current-menu-item > a, .primary-menu .current_page_item > a").css("color", "#f9c349");
        jQuery(".bb-mobile-panel-header .user-name").css("color", "black");
        jQuery("a.bb-close-panel i").css("color", "black");
    }
}
