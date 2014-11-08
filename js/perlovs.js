/* ===========================================================
 * Utility scripts for p1 theme
 * ===========================================================
 * Copyright 2014 Mikhail Perlov.
 * http://perlovs.com
 *
 * License: GPL v3
 *
 * ========================================================== */
 !function(w) {
 	w.perlovs = {
	 	// Underscrore.js now, throttle and debounce
	 	now : Date.now || function() {
	 		return new Date().getTime();
	 	},

	 	throttle : function(func, wait, options) {
	 		var context, args, result;
	 		var timeout = null;
	 		var previous = 0;
	 		if (!options) options = {};
	 		var later = function() {
	 			previous = options.leading === false ? 0 : perlovs.now();
	 			timeout = null;
	 			result = func.apply(context, args);
	 			if (!timeout) context = args = null;
	 		};
	 		return function() {
	 			var now = perlovs.now();
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
	 	},

	 	debounce : function(func, wait, immediate) {
	 		var timeout, args, context, timestamp, result;

	 		var later = function() {
	 			var last = perlovs.now() - timestamp;

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
	 			timestamp = perlovs.now();
	 			var callNow = immediate && !timeout;
	 			if (!timeout) timeout = setTimeout(later, wait);
	 			if (callNow) {
	 				result = func.apply(context, args);
	 				context = args = null;
	 			}

	 			return result;
	 		};
	 	}
	};

	return false;
}(window);

/* ===========================================================
 * jquery-onepage-scroll.js modified for p1 wp theme (based on v1.3.1)
 * ===========================================================
 * Copyright 2014 Mikhail Perlov.
 * http://perlovs.com
 *
 * Credit: Eike Send for the awesome swipe event, Pete Rojwongsuriya for source
 * https://github.com/peachananr/onepage-scroll
 *
 * License: GPL v3
 *
 * ========================================================== */

 !function($){

    /*------------------------------------------------*/
    /*  Credit: Eike Send for the awesome swipe event */
    /*------------------------------------------------*/
    $.fn.swipeEvents = function() {
        return this.each(function() {

            var startX,
            startY,
            $this = $(this);

            $this.bind('touchstart', perlovs.throttle(touchstart, 300));

            function touchstart(event) {
                var touches = event.originalEvent.touches;
                if (touches && touches.length) {
                    startX = touches[0].pageX;
                    startY = touches[0].pageY;
                    $this.bind('touchmove', touchmove);
                }
            }

            function touchmove(event) {
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
                        $this.unbind('touchmove', touchmove);
                    }
                }
            }
        });
    };


    $.fn.onepage_scroll = function(options) {
        var defaults = {
            pageContainer: "section",
            navContainer: "nav",
            easing: "ease",
            animationTime: 1000,
            updateURL: true,
            keyboard: true,
            beforeMove: null,
            afterMove: null,
            threshholdQuery: null,
            disableCustomScroll: false,
            quietPeriod: 500
        },
        customScrollBinded = false,
        scrollBinded = false,
        settings = $.extend({}, defaults, options),
        el = $(this),
        windowHeight = $(window).height();

        var pages = $(settings.pageContainer),
            nav = $(settings.navContainer),
            enableCustomScroll = settings.threshholdQuery ? Modernizr.mq(settings.threshholdQuery) : !settings.disableCustomScroll;

        $.fn.transformPage = function(settings, pos, pageName) {

        	if (enableCustomScroll) {
	            if (typeof settings.beforeMove === 'function') settings.beforeMove(pageName);

	            el.css({
	                "-webkit-transform": "translate3d(0, " + pos + "%, 0)",
	                "-webkit-transition": "all " + settings.animationTime + "ms " + settings.easing,
	                "-moz-transform": "translate3d(0, " + pos + "%, 0)",
	                "-moz-transition": "all " + settings.animationTime + "ms " + settings.easing,
	                "-ms-transform": "translate3d(0, " + pos + "%, 0)",
	                "-ms-transition": "all " + settings.animationTime + "ms " + settings.easing,
	                "transform": "translate3d(0, " + pos + "%, 0)",
	                "transition": "all " + settings.animationTime + "ms " + settings.easing
	            });

	            if (typeof settings.afterMove === 'function')
	                $(this).one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
	                    settings.afterMove(pageName);
	                });
            }
            else {
            	el.parent().animate({scrollTop: pos + "px"});
            }
        };

        $.fn.moveDown = function() {
            var current = pages.filter(".current");
            var next = pages.eq(pages.index(current) + 1);

            if(next.length > 0) {
                move(next);
            }
        };

        $.fn.moveUp = function() {
            var current = pages.filter(".current");
            if (pages.index(current) <= 0) return true;
            var next = pages.eq(pages.index(current) - 1);

            if(next !== undefined) {
                move(next);
            }
        };

        $.fn.moveTo = function(pageName) {
            var next = pages.filter("[data-page-name='" + (pageName) + "']");

            if(next.length > 0) {
                move(next);
            }
        };

        function move(next) {
            var current = pages.filter(".current");
            var pageName = next.data("page-name");

            pages.removeClass("current");
            nav.find("li a").removeClass("current");
            next.addClass("current");
            nav.find("li a" + "[data-page-name='" + (pageName) + "']").addClass("current");

            var pos = enableCustomScroll? (pages.index(next) * 100) * -1 : pages.index(next) * windowHeight;

            if (history.replaceState && settings.updateURL == true) {
                var href = window.location.href.substr(0,window.location.href.indexOf('#')) + "#" + pageName;
                history.pushState( {}, document.title, href );
            }
            el.transformPage(settings, pos, pageName);
        }

        onScroll = perlovs.throttle(function(event) {
    			var current = pages.filter(".current");
    			var next = pages.filter(function() {
    					offset = $(this).offset().top;
    					return offset <= windowHeight * 0.5 && offset > windowHeight * -0.5;
    				});
    			if (current == next) return true;
    			var pageName = next.data("page-name");

    			pages.removeClass("current");
            	nav.find("li a").removeClass("current");
    			next.addClass("current");
    			nav.find("li a" + "[data-page-name='" + (pageName) + "']").addClass("current");

    			if (history.replaceState && settings.updateURL == true) {
    				var href = window.location.href.substr(0,window.location.href.indexOf('#')) + "#" + pageName;
    				history.pushState( {}, document.title, href );
    			}
    		},settings.quietPeriod);

        // Bind events, check for mediaQuery (responsive)
        function bind() {

            // Bind (initial small screen or completely disabled custom scroll)
            if (!scrollBinded && !enableCustomScroll) {
            	el.parent().bind('scroll', onScroll);

            	scrollBinded = true;
            }

            // Bind (initial large screen or changing from small to large)
            if (!customScrollBinded && enableCustomScroll) {
                el.swipeEvents().bind("swipeDown",  function(event){
                    event.preventDefault();
                    el.moveUp();
                }).bind("swipeUp", function(event){
                    event.preventDefault();
                    el.moveDown();
                });

                $(document).bind('mousewheel DOMMouseScroll MozMousePixelScroll', perlovs.throttle(function(event) {
                    event.preventDefault();
                    var delta = event.originalEvent.wheelDelta || -event.originalEvent.detail;
                    if (delta < 0) {
                    	el.moveDown();
                    } else {
                    	el.moveUp();
                    }
                },settings.quietPeriod + settings.animationTime,{trailing: false}));

                if(settings.keyboard == true) {
                    $(document).keydown(function(e) {
                        var tag = e.target.tagName.toLowerCase();

                        switch(e.which) {
                            case 38:
                                if (tag != 'input' && tag != 'textarea') el.moveUp();
                                break;
                            case 40:
                                if (tag != 'input' && tag != 'textarea') el.moveDown();
                                break;
                            case 32: //spacebar
                                if (tag != 'input' && tag != 'textarea') el.moveDown();
                                break;
                            case 33: //pageg up
                                if (tag != 'input' && tag != 'textarea') el.moveUp();
                                break;
                            case 34: //page dwn
                                if (tag != 'input' && tag != 'textarea') el.moveDown();
                                break;
                            case 36: //home
                                el.moveTo('home');
                                break;
                            default: return;
                        }

                    });
                }

                el.parent().unbind('scroll');

                customScrollBinded = true;
                scrollBinded = false;
            }

            // Unbind (changing from large to small)
            if (customScrollBinded && !enableCustomScroll) {
                $(document).unbind('mousewheel DOMMouseScroll MozMousePixelScroll');
                if(settings.keyboard == true) $(document).unbind('keydown');
                el.swipeEvents().unbind("swipeDown swipeUp");
                customScrollBinded = false;

                // If threshhold set then bind scroll
                if (settings.threshholdQuery) {
                	el.parent().bind('scroll', onScroll);

                	scrollBinded = true;
                }
            }
        }

        function init() {
            var pageName = pages.eq(0).data("page-name");
            if(window.location.hash != "") pageName =  window.location.hash.replace("#", "");
            var current = pages.filter("[data-page-name='" + (pageName) + "']");

            pages.removeClass("current");
            nav.find("li a").removeClass("current");
            current.addClass("current");
            nav.find("li a" + "[data-page-name='" + (pageName) + "']").addClass("current");

            if (enableCustomScroll) {
	            var pos = (pages.index(current) * 100) * -1;

	            el.parent().scrollTop(0);

	            el.css({
	                "-webkit-transform": "translate3d(0, " + pos + "%, 0)",
	                "-webkit-transition": "none",
	                "-moz-transform": "translate3d(0, " + pos + "%, 0)",
	                "-moz-transition": "none",
	                "-ms-transform": "translate3d(0, " + pos + "%, 0)",
	                "-ms-transition": "none",
	                "transform": "translate3d(0, " + pos + "%, 0)",
	                "transition": "none"
	            });
	        }
	        else {
            	el.css({
	                "-webkit-transform": "none",
	                "-webkit-transition": "none",
	                "-moz-transform": "none",
	                "-moz-transition": "none",
	                "-ms-transform": "none",
	                "-ms-transition": "none",
	                "transform": "none",
	                "transition": "none",
	            });

	        	el.parent().scrollTop(pages.index(current) * windowHeight);
	        }
        }

        // If navigation present, bind click to move
        if(nav.length > 0)  {
            nav.find('li a').each(function() {
                var a = $(this);
                var pageName = a.data('page-name');
                a.click(function (event) {
                    event.preventDefault();
                    el.moveTo(pageName);
                });
            });
        }

        // Initialize (move to current page, add classes)
        init();

        // Initial bind
        bind();

        // If threshold media query set - rebind on resize
        if(settings.threshholdQuery != null) {
            $(window).resize(perlovs.throttle(function() {
            	enableCustomScroll = Modernizr.mq(settings.threshholdQuery);
            	windowHeight = $(window).height();
            	init();
                bind();
            },settings.quietPeriod));
        }

        return false;
    };
}(window.jQuery);