/* ===========================================================
 * Navigation scripts for p1 theme
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
	$.fn.perlovsNav = function(options) {
		var defaults = {
            floatNavContainer: ".float-nav",
            floatNavToggleClass: ".nav-toggle",
            floatNavExpandedClass: "expanded",
            offCanvasContainer: ".off-canvas-menu",
            offCanvasToggle: ".off-canvas-toggle",
            offCanvasExit: ".exit-off-canvas",
            offCanvasMoveClass: "off-canvas-move",
            offCanvasPos: 'left'
        	},
        	settings = $.extend({}, defaults, options);

		var $this = $(this),
			eventHandlersBound = false,
			$floatNav = $(settings.floatNavContainer),
			$offCanvas = $(settings.offCanvasContainer);

		var Modernizr = window.Modernizr || {};

		$.fn.openOffCanvas = function(e) {
			e.preventDefault();
			$('body').addClass(settings.offCanvasMoveClass);
		};

		$.fn.closeOffCanvas = function(e) {
			e.preventDefault();
			$('body').removeClass(settings.offCanvasMoveClass);
		};

		// Bind events, check for mediaQuery (responsive)
        function bind() {
        	// Initial true binding of handlers for events
			if (!eventHandlersBound) {
				// Prevent further binding attempts even if js falls
				eventHandlersBound = true;

				$this.find(settings.offCanvasToggle).on('click', $this.openOffCanvas);

				$offCanvas.find(settings.offCanvasExit).on('click', $this.closeOffCanvas);

				// Show/hide offcanvas on swipe events for mobile
				if (settings.offCanvasPos === 'left') {
			        $this.swipeEvents()
			        	.bind("swipeRight", $this.openOffCanvas)
			        	.bind("swipeLeft", $this.closeOffCanvas);
			    }
			    else {
			    	$this.swipeEvents()
			        	.bind("swipeLeft", $this.openOffCanvas)
			        	.bind("swipeRight", $this.closeOffCanvas);
			    }

			    $floatNav.find(settings.floatNavToggleClass).on('click', function () {
			    	$(this).parent().toggleClass(settings.floatNavExpandedClass);
			    });
        	}
        }

		// Initialize everything on load, back button, resize
        function init() {
        	bind();
        }

		$(document).ready(init);
	};
}(jQuery, window, window.document));
