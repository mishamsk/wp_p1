/* ===========================================================
 * Utility scripts for p1 theme
 * ===========================================================
 * Copyright 2014 Mikhail Perlov.
 * http://perlovs.com
 *
 * Credit: Eike Send for the swipe event base source,
 * Undescrore.js for throttle and debounce
 *
 * License: GPL v3
 *
 * ========================================================== */
(function($, window, document, undefined) {

    $(document).ready(function(){
        // Enable FastClick if present
        if (typeof FastClick !== 'undefined') {
            // Don't attach to body if undefined
            if (typeof document.body !== 'undefined') {
                FastClick.attach(document.body);
            }
        }
    });

	$.fn.swipeEvents = function() {
        return this.each(function() {

            var startX = 0,
            	startY = 0,
            	$this = $(this),
            	enableMove = false;

            var Modernizr = window.Modernizr || {};

            if (!Modernizr.touch) { return true; }

            function touchstart(event) {
                var touches = event.originalEvent.touches;
                if (touches && touches.length) {
                    startX = touches[0].pageX;
                    startY = touches[0].pageY;
                    enableMove = true;
                }
            }

            function touchmove(event) {
            	if (!enableMove) return true;

                var touches = event.originalEvent.touches;
                if (touches && touches.length) {
                    var deltaX = startX - touches[0].pageX;
                    var deltaY = startY - touches[0].pageY;

                    if (deltaX >= 50 && Math.abs(deltaY) < 20) {
                        $this.trigger("swipeLeft");
                    }
                    if (deltaX <= -50 && Math.abs(deltaY) < 20) {
                        $this.trigger("swipeRight");
                    }
                    if (deltaY >= 50 && Math.abs(deltaX) < 20) {
                        $this.trigger("swipeUp");
                    }
                    if (deltaY <= -50 && Math.abs(deltaX) < 20) {
                        $this.trigger("swipeDown");
                    }
                    if (Math.abs(deltaX) >= 50 || Math.abs(deltaY) >= 50) {
                        enableMove = false;
                    }
                }
            }

            $this.bind('touchstart', window.throttle(touchstart, 300));
            $this.bind('touchmove', touchmove);
        });
    };

    if (!Date.now) {
    	Date.now = function now() {
    		return new Date().getTime();
    	};
    }

    /*
    https://github.com/paulirish/matchMedia.js
    */

    window.matchMedia = window.matchMedia || (function( doc ) {
        "use strict";

        var bool,
        docElem = doc.documentElement,
        refNode = docElem.firstElementChild || docElem.firstChild,
        // fakeBody required for <FF4 when executed in <head>
        fakeBody = doc.createElement( "body" ),
        div = doc.createElement( "div" );

        div.id = "mq-test-1";
        div.style.cssText = "position:absolute;top:-100em";
        fakeBody.style.background = "none";
        fakeBody.appendChild(div);

        return function (q) {

            div.innerHTML = "&shy;<style media=\"" + q + "\"> #mq-test-1 { width: 42px; }</style>";

            docElem.insertBefore( fakeBody, refNode );
            bool = div.offsetWidth === 42;
            docElem.removeChild( fakeBody );

            return {
                matches: bool,
                media: q
            };

        };
    }( document ));

	window.throttle = function(func, wait, options) {
 		var context, args, result;
 		var timeout = null;
 		var previous = 0;
 		if (!options) options = {};
 		var later = function() {
 			previous = options.leading === false ? 0 : Date.now();
 			timeout = null;
 			result = func.apply(context, args);
 			if (!timeout) context = args = null;
 		};
 		return function() {
 			var now = Date.now();
 			if (!previous && options.leading === false) previous = now;
 			var remaining = wait - (now - previous);
 			context = this;
 			args = arguments;
 			if (remaining <= 0 || remaining > wait) {
 				clearTimeout(timeout);
 				timeout = null;
 				previous = now;
 				result = func.apply(context, args);
 				if (!timeout) context = args = null;
 			} else if (!timeout && options.trailing !== false) {
 				timeout = setTimeout(later, remaining);
 			}
 			return result;
 		};
 	};

	window.debounce = function(func, wait, immediate) {
 		var timeout, args, context, timestamp, result;

 		var later = function() {
 			var last = Date.now() - timestamp;

 			if (last < wait && last > 0) {
 				timeout = setTimeout(later, wait - last);
 			} else {
 				timeout = null;
 				if (!immediate) {
 					result = func.apply(context, args);
 					if (!timeout) context = args = null;
 				}
 			}
 		};

 		return function() {
 			context = this;
 			args = arguments;
 			timestamp = Date.now();
 			var callNow = immediate && !timeout;
 			if (!timeout) timeout = setTimeout(later, wait);
 			if (callNow) {
 				result = func.apply(context, args);
 				context = args = null;
 			}

 			return result;
 		};
	};
}(jQuery, window, window.document));
