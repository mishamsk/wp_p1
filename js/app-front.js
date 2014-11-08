// -----------------------
// Home
// -----------------------
$(document).ready(function(){
	$("body.home .home-wrapper").onepage_scroll({
		pageContainer: ".home-wrapper section, .home-wrapper footer",
		navContainer: "body.home nav",
        easing: "ease",
        animationTime: 1000,
        updateURL: true,
        keyboard: true,
        beforeMove: null,
        afterMove: null,
        threshholdQuery: "only screen and (min-width: 40.063em)",
        quietPeriod: 500
   	});
});