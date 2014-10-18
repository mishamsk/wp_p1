// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

$('.search-toggle').hover(
	function () {
		$(this).find('.search-field').focus();
	}
	,function () {
		$(this).find('.search-field').blur().val('');
	}
);