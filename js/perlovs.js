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
!function($) {
	$.fn.swipeEvents = function() {
        return this.each(function() {

            var startX = 0,
            	startY = 0,
            	$this = $(this),
            	enableMove = false;

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

                    if (deltaX >= 50) {
                        $this.trigger("swipeLeft");
                    }
                    if (deltaX <= -50) {
                        $this.trigger("swipeRight");
                    }
                    if (deltaY >= 50) {
                        $this.trigger("swipeUp");
                    }
                    if (deltaY <= -50) {
                        $this.trigger("swipeDown");
                    }
                    if (Math.abs(deltaX) >= 50 || Math.abs(deltaY) >= 50) {
                        enableMove = false;
                    }
                }
            }

            $this.bind('touchstart', $this.throttle(touchstart, 300));
            $this.bind('touchmove', touchmove);
        });
    };

    if (!Date.now) {
    	Date.now = function now() {
    		return new Date().getTime();
    	};
    }

	$.fn.throttle = function(func, wait, options) {
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

	$.fn.debounce = function(func, wait, immediate) {
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
}(window.jQuery);

/* ===========================================================
 * Onepage scrolling
 * ===========================================================
 * Copyright 2014 Mikhail Perlov.
 * http://perlovs.com
 *
 * Credit: Eike Send for the swipe event base source,
 * Pete Rojwongsuriya for onepage scroll source
 * https://github.com/peachananr/onepage-scroll
 *
 * License: GPL v3
 *
 * ========================================================== */

!function($){
	'use strict';

    $.fn.onepage_scroll = function(options) {
        var defaults = {
            pageContainer: "section",
            navContainer: "nav",
            easing: "ease",
            animationTime: 1000,
            updateURL: true,
            keyboard: true,
            threshholdQuery: null,
            disableCustomScroll: false,
            quietPeriodCustomScroll: 500,
            quietPeriodScroll: 1000,
            quietPeriodResize: 2000
        	},
        	settings = $.extend({}, defaults, options);

        var $this = $(this),
        	pages = $(settings.pageContainer),
            nav = $(settings.navContainer),
            windowHeight = 0,
            customScrollHandlerEnabled = false,
        	scrollHandlerEnabled = false,
        	eventHandlersBound = false,
        	sysScrollTarget = null;

    	var homePageName = pages.eq(0).data("page-name");

        $.fn.transformPage = function(target, animate) {

        	var pos = customScrollHandlerEnabled ?
        		-target.get(0).offsetTopInitial : target.get(0).offsetTopInitial;
        	pos = Math.round(pos);

        	if (customScrollHandlerEnabled) {
	            $this.css({
	                "-webkit-transform": "translate3d(0, " + pos + "px, 0)",
	                "-webkit-transition": animate ? "all " + settings.animationTime + "ms " + settings.easing : "none",
	                "-moz-transform": "translate3d(0, " + pos + "px, 0)",
	                "-moz-transition": animate ? "all " + settings.animationTime + "ms " + settings.easing : "none",
	                "-ms-transform": "translate3d(0, " + pos + "px, 0)",
	                "-ms-transition": animate ? "all " + settings.animationTime + "ms " + settings.easing : "none",
	                "transform": "translate3d(0, " + pos + "px, 0)",
	                "transition": animate ? "all " + settings.animationTime + "ms " + settings.easing : "none"
	            });
            }
            else {
            	if (animate) {
            		$this.parent().animate({scrollTop: pos + "px"});
            	}
            	else {
	        		$this.css({
		                "-webkit-transform": "none",
		                "-webkit-transition": "none",
		                "-moz-transform": "none",
		                "-moz-transition": "none",
		                "-ms-transform": "none",
		                "-ms-transition": "none",
		                "transform": "none",
		                "transition": "none"
		            });
            		$this.parent().scrollTop(pos);
            	}
            	sysScrollTarget = pos;
            }
        };

        $.fn.moveDown = function() {
            var current = curPage();
            var next = pages.eq(pages.index(current) + 1);

            if(next.length > 0) {
                move(next);
            }
        };

        $.fn.moveUp = function() {
            var current = curPage();
            if (pages.index(current) <= 0) return true;
            var next = pages.eq(pages.index(current) - 1);

            if(next !== undefined) {
                move(next);
            }
        };

        $.fn.moveTo = function(pageName) {
            var next = pages.filter("[data-page-name='" + (pageName) + "']");

            if(next.length > 0) {
                move(next, pageName);
            }
        };

        // Gets current page either from hash in URL or by classname. Falls back to first page if nothing found
        function curPage(forceUrl) {
        	forceUrl = forceUrl || false;

        	if (settings.updateURL === true || forceUrl)
        	{
        		var pageName = homePageName;
            	if(window.location.hash !== "") pageName =  window.location.hash.replace("#", "");
            	return pages.filter("[data-page-name='" + (pageName) + "']").length ?
            		pages.filter("[data-page-name='" + (pageName) + "']") : pages.eq(0);
        	}
        	else
        	{
        		return pages.filter(".current").length ? pages.filter(".current") : pages.eq(0);
        	}
        }

        // Add .current to appropriate items
        function updateClasses(next, pageName) {
        	// Get pagename if not specified
            pageName = pageName || next.data("page-name");

        	pages.removeClass("current");
            nav.find("li a").removeAttr('class');
            next.addClass("current");
            nav.find("li a" + "[data-page-name='" + (pageName) + "']").addClass("current");
        }

        // Update hash in href
        function updateURL(pageName) {
        	if (pageName === undefined) return true;

        	if (history.replaceState && settings.updateURL === true) {
                var href = window.location.href.substr(0,window.location.href.indexOf('#')) + "#" + pageName;
                history.pushState( {}, document.title, href );
            }
        }

        function move(next, pageName) {
        	// Get pagename if not specified
            pageName = pageName || next.data("page-name");

            // Scroll page
            $this.transformPage(next, true);

            // Update classes and URL
            updateClasses(next, pageName);
            updateURL(pageName);
        }

        var onScroll = $this.throttle(function() {
        		if (!scrollHandlerEnabled) return true;
        		if (sysScrollTarget !== null) {
        			if (sysScrollTarget >= this.scrollTop - 1 && sysScrollTarget <= this.scrollTop + 1) sysScrollTarget = null;
        			return true;
        		}

    			var current = curPage();
    			var next = pages.filter(function() {
    					var offsetTop = $(this).offset().top;
    					var offsetBottom = offsetTop + $(this).outerHeight();
    					return offsetTop > 0 ? offsetTop < windowHeight * 0.1 : offsetBottom >= windowHeight * 0.9;
    				});
    			if (current == next || next.length === 0) return true;
    			var pageName = next.data("page-name");

    			// Update classes and URL
            	updateClasses(next, pageName);
            	updateURL(pageName);
    		},settings.quietPeriodScroll,{trailing: true});

        // Bind events, check for mediaQuery (responsive)
        function bind() {
        	// Initial true binding of handlers for events
			if (!eventHandlersBound) {
				// Prevent further binding attempts even if js falls
				eventHandlersBound = true;

		        // If navigation present, bind click to move
		        if(nav.length > 0)  {
		        	nav.find('li a').each(function() {
		        		var a = $(this);
		        		var pageName = a.data('page-name');
		        		a.click(function (event) {
		        			event.preventDefault();
		        			$this.moveTo(pageName);
		        		});
		        	});
		        }

		        // If threshold media query set - rebind on resize
		        if(settings.threshholdQuery !== null) {
		        	$(window).resize($this.throttle(init, settings.quietPeriodResize));
		        }

		        // If URL changes active - bind to popstate to enable back button
		        if(settings.updateURL === true) {
		        	$(window).on('popstate', init);
		        }

		        // Regular scroll when custom scroll disabled
		        $this.parent().bind('scroll', onScroll);

		        // Custom scroll on swipe events for mobile
		        $this.swipeEvents().bind("swipeDown",  function(event){
		        	if (!customScrollHandlerEnabled) return true;
                    event.preventDefault();
                    $this.moveUp();
                }).bind("swipeUp", function(event){
                	if (!customScrollHandlerEnabled) return true;
                    event.preventDefault();
                    $this.moveDown();
                });

                // Custom scroll on mousewheel events for desktop
                $(document).bind('mousewheel DOMMouseScroll MozMousePixelScroll', $this.throttle(function(event) {
                    if (!customScrollHandlerEnabled) return true;

                    event.preventDefault();
                    var delta = event.originalEvent.wheelDelta || -event.originalEvent.detail;
                    if (delta < 0) {
                    	$this.moveDown();
                    } else {
                    	$this.moveUp();
                    }
                },settings.quietPeriodCustomScroll + settings.animationTime,{trailing: false}));

                // Custom scroll on keypress events for desktop
                if(settings.keyboard === true) {
                    $(document).keydown(function(e) {
                    	if (!customScrollHandlerEnabled) return true;

                        var tag = e.target.tagName.toLowerCase();

                        switch(e.which) {
                            case 38:
                                if (tag != 'input' && tag != 'textarea') $this.moveUp();
                                break;
                            case 40:
                                if (tag != 'input' && tag != 'textarea') $this.moveDown();
                                break;
                            case 32: //spacebar
                                if (tag != 'input' && tag != 'textarea') $this.moveDown();
                                break;
                            case 33: //pageg up
                                if (tag != 'input' && tag != 'textarea') $this.moveUp();
                                break;
                            case 34: //page dwn
                                if (tag != 'input' && tag != 'textarea') $this.moveDown();
                                break;
                            case 36: //home
                                $this.moveTo(homePageName);
                                break;
                            default: return true;
                        }
                    });
                }
			}

            // Either scroll or custm scroll has to be enabled
        	scrollHandlerEnabled = !customScrollHandlerEnabled;
        }

        // Initialize everything on load, back button, resize
        function init() {
            var current = curPage(true);

            // Check which scroll to use
            customScrollHandlerEnabled = settings.threshholdQuery ? Modernizr.mq(settings.threshholdQuery) : !settings.disableCustomScroll;
            // Get window height
        	windowHeight = $(window).height();

    		// Reset scrollTop to calculate offsetTop
    		sysScrollTarget = 0;
    		$this.parent().scrollTop(0);
    		$this.css({
		                "-webkit-transform": "none",
		                "-webkit-transition": "none",
		                "-moz-transform": "none",
		                "-moz-transition": "none",
		                "-ms-transform": "none",
		                "-ms-transition": "none",
		                "transform": "none",
		                "transition": "none"
		            });
    		pages.each(function() {
    			$.extend(this, {offsetTopInitial: this.offsetTop});
    			});

        	// Scroll page without animation (initial position)
            $this.transformPage(current, false);

            // Update classes and URL
            updateClasses(current);

	        bind();
        }

        // Initialize
        $(window).load(init);

        return false;
    };
}(window.jQuery);
