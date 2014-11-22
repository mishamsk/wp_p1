/* ===========================================================
 * Gisqus lazy load scripts for p1 theme
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
	$.fn.perlovsDisqus = function(options) {
		var defaults = {
            	disqus_shortname: "mishamsk",
            	scroll_wrapper: "#page-wrapper",
            	comment_wrapper: ".entry-comments"
        	},
        	settings = $.extend({}, defaults, options);

		var $this = $(this),
			$scroll_wrapper = $(settings.scroll_wrapper),
			$comment_wrapper = $(settings.comment_wrapper),
			eventHandlersBound = false,
			scriptAppended = false;

		function gotoDisqusScript() {
			// Append once
			if (!scriptAppended) {
				scriptAppended = true;
			    var dsq = document.createElement('script'); dsq.type = 'text/javascript';
			    dsq.async = true;
			    dsq.src = '//' + settings.disqus_shortname + '.disqus.com/embed.js';
			    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			}

			if ($scroll_wrapper.scrollTop() < $comment_wrapper.scrollTop() - $(window).height()) {
				$scroll_wrapper.scrollTop($comment_wrapper.scrollTop());
			}
		}

		// Bind events, check for mediaQuery (responsive)
        function bind() {
        	// Initial true binding of handlers for events
			if (!eventHandlersBound) {
				// Prevent further binding attempts even if js falls
				eventHandlersBound = true;

				$this.on('click', gotoDisqusScript);
        	}
        }

		// Initialize everything on load, back button, resize
        function init() {
        	bind();
        }

		$(document).ready(init);
	};
}(jQuery, window, window.document));
