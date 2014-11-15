// -----------------------
// Home
// -----------------------

$(document).ready(function(){
	$("body.home .home-wrapper").onepage_scroll({
		pageContainer: ".home-wrapper section, .home-wrapper footer",
		navContainer: "body.home nav",
        threshholdQuery: "only screen and (min-width: 40.063em)",
        quietPeriodScroll: 50
   	});

   	// Enable FastClick if present
   	if (typeof FastClick !== 'undefined') {
		// Don't attach to body if undefined
		if (typeof document.body !== 'undefined') {
			FastClick.attach(document.body);
		}
	}
});