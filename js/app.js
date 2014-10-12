// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

$(document).on('opened.fndtn.dropdown', '[data-reveal]', function () {
  Foundation.utils.S('#search-field').focus();
});