// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
// $(document).foundation();

$(document).ready(function(){
   	// Enable FastClick if present
   	if (typeof FastClick !== 'undefined') {
		// Don't attach to body if undefined
		if (typeof document.body !== 'undefined') {
			FastClick.attach(document.body);
		}
	}

	// -----------------------
	// Float nav
	// -----------------------
	$('.float-nav .nav-toggle').on('click', function(e) {
		e.preventDefault();
		$(this).closest('nav').toggleClass('expanded');
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
});
