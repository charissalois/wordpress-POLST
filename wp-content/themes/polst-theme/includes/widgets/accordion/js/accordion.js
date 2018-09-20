//=================
// Accordion Widget
//=================
jQuery(document).ready(function($) {
    "use strict";

	$('.js-accordion-title').on("click", function (e) {
		e.preventDefault();

		var itemNo = $(e.target).data("item");
		var contentSelector = '.js-accordion-content' + "[data-item=" + itemNo + "]";

		// $(contentSelector).toggleClass("is-visible");
		$(contentSelector).slideToggle(200);
		$(contentSelector).parent('.accordion-item').toggleClass('is-open');
	});

	$('.js-accordion-expand').on("click", function (e) {
		e.preventDefault();

		var contentSelector = '.js-accordion-content';

		$(this).toggleClass('js-accordion-collapse');

		if ( !$(this).hasClass('js-accordion-collapse') ) {
			$(contentSelector).slideUp(200);
			$('.accordion-item').removeClass('is-open');	
			$(this).html('Expand all');
		} else {
			$(contentSelector).slideDown(200);
			$('.accordion-item').addClass('is-open');
			$(this).html('Collapse all');
		}
	});

});
