/* ===========================================================
 * Mobile nav for p1 theme
 * ===========================================================
 * Copyright 2014 Mikhail Perlov.
 * http://perlovs.com
 *
 * License: GPL v3
 *
 * ========================================================== */
(function($, window, document, undefined) {
	'use strict';

	// -----------------------
	// Float nav and off canvas
	// -----------------------
	$.fn.mobileNav = function(options) {
		var defaults = {
            floatNavContainer: ".float-nav",
            floatNavToggle: ".nav-toggle",
            floatNavExpandedClass: "expanded",
            offCanvasContainer: ".right-off-canvas-menu",
            offCanvasToggle: ".right-off-canvas-toggle",
            offCanvasExit: ".exit-off-canvas",
            offCanvasMoveClass: "move-left"
        	},
        	settings = $.extend({}, defaults, options);

		var $this = $(this),
			eventHandlersBound = false,
			$floatNav = $(settings.floatNavContainer),
			$offCanvas = $(settings.offCanvasContainer);

		var Modernizr = window.Modernizr || {};

		$.fn.toggleFloatNav = function(e) {
			e.preventDefault();
			$floatNav.toggleClass(settings.floatNavExpandedClass);
		};

		$.fn.openOffCanvas = function(e) {
			e.preventDefault();
			$floatNav.removeClass(settings.floatNavExpandedClass);
			$offCanvas.addClass(settings.offCanvasMoveClass);
		};

		$.fn.closeOffCanvas = function(e) {
			e.preventDefault();
			$offCanvas.removeClass(settings.offCanvasMoveClass);
		};

		// Bind events, check for mediaQuery (responsive)
        function bind() {
        	// Initial true binding of handlers for events
			if (!eventHandlersBound) {
				// Prevent further binding attempts even if js falls
				eventHandlersBound = true;

        		// Nav toggle toggles button visibility buttons
				$floatNav.find(settings.floatNavToggle).on('click', $this.toggleFloatNav);

				$floatNav.find(settings.offCanvasToggle).on('click', $this.openOffCanvas);

				$offCanvas.find(settings.offCanvasExit).on('click', $this.closeOffCanvas);

				// Show/hide offcanvas on swipe events for mobile
		        $this.swipeEvents()
		        	.bind("swipeLeft", $this.openOffCanvas)
		        	.bind("swipeRight", $this.closeOffCanvas);
        	}
        }

		// Initialize everything on load, back button, resize
        function init() {
        	bind();
        }

		$(document).ready(init);
	};
}(jQuery, window, window.document));
