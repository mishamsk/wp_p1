$("body").mobileNav();

$(document).ready(function(){
	'use strict';

	// -----------------------
	// Search form
	// -----------------------
	$('.search-toggle').hover(
		function () {
			$(this).find('.search-field').focus();
		},
		function () {
			$(this).find('.search-field').blur().val('');
		}
		);

	$('#tab-bar-search-toggle').on('click', function () {
		$(document).on('opened.fndtn.reveal', '#search-share-modal', function () {
			$(this).find('.search-field').focus();
		});
	});

	$(document).on('closed.fndtn.reveal', '#search-share-modal', function () {
		$(this).find('.search-field').blur().val('');
		$(document).off('opened.fndtn.reveal', '#search-share-modal');
	});
});
