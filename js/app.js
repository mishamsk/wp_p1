// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

$('.search-toggle').on('click', function () {
	var target = Foundation.utils.data_options($(this)).target;
	//Foundation.utils.S('#' + target + '.open').find('#search-field').focus();
	if (!$('#' + target).hasClass('open')) {
		setTimeout(function(){
		    $('#' + target).find('#search-field').focus();
		}, 0);
	};
});