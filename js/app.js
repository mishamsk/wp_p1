// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

// -----------------------
// Home
// -----------------------
$(document).ready(function(){
	$("body.home .home-wrapper").onepage_scroll({
		sectionContainer: ".home-wrapper section",
		responsiveFallback: false,
		loop: false,
		pagination: false,
		updateURL: true,
   		keyboard: true,
   		direction: "vertical"
   	});
});

// -----------------------
// Search form
// -----------------------
$('.search-toggle').hover(
	function () {
		$(this).find('.search-field').focus();
	}
	,function () {
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