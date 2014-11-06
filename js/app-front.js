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