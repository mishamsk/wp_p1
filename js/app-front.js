// -----------------------
// Home
// -----------------------
$("body.home .home-wrapper").onepageScroll({
	pageContainer: ".home-wrapper section, .home-wrapper footer",
	navContainer: "body.home nav",
	threshholdQuery: "only screen and (min-width: 40.063em)",
	quietPeriodScroll: 50
});