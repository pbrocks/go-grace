jQuery(document).ready(function($) {
	$(window).scroll(function() {
		if ($(document).scrollTop() > 19) {
			$("#site-navigation").addClass("scroll");
		} else {
			$("#site-navigation").removeClass("scroll");
		}
	});
});
