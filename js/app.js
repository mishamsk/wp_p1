// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

// -----------------------
// Home
// -----------------------
var $root = $('html, body');
$('a[href*=#]').on('click', function(event) {
    event.preventDefault();
    var href = $.attr(this, 'href');
    $root.animate({
        scrollTop: $(href).offset().top
    }, 500, function () {
        window.location.hash = href;
    });
    $(this).fadeOut();
});

$(window).scroll(Foundation.utils.debounce(function() {
		if ($(window).scrollTop() > 200) {
			$("#home-greeting a.arrow").fadeOut();
			$(window).off("scroll");
		}
	}, 300, true)
);

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