/* ===========================================================
 * Scripts to provide async gmaps
 * ===========================================================
 * Copyright 2014 Mikhail Perlov.
 * http://perlovs.com
 *
 * License: GPL v3
 *
 * ========================================================== */
(function($, window, document, undefined) {
	'use strict';

	$.fn.perlovsGMaps = function(options) {
		var defaults = {
            	api_key: "",
            	canvasParent: "",
            	canvasId: "map-canvas"
        	},
        	settings = $.extend({}, defaults, options);

		var $this = $(this),
			eventHandlersBound = false,
			$canvasParent = settings.canvasParent === "" ? $this.parent() : $(settings.canvasParent);

		function loadMap() {
			$canvasParent.append('<div id="' + settings.canvasId + '"></div>');

			// hide opening button
			$this.hide();

			var script = document.createElement('script');
			script.type = 'text/javascript';
			//script.src = 'http://maps.googleapis.com/maps/api/js?v=3.exp&key=' + settings.api_key + '&' + 'callback=initMap';
		  	script.src = 'http://maps.googleapis.com/maps/api/js?v=3.exp' + '&' + 'callback=initMap';
			document.head.appendChild(script);
		}

		window.initMap = function() {
			var google = window.google || {};

	 		var c_map = new google.maps.Map(document.getElementById(settings.canvasId), {
	 			center: new google.maps.LatLng(30,0),
	 			zoom: 2,
	 			disableDefaultUI: true,
	 			mapTypeId: google.maps.MapTypeId.ROADMAP
	 		});

	 		var world_geometry = new google.maps.FusionTablesLayer({
	 			query: {
	 				select: 'geometry',
	 				from: '1N2LBk4JHwWpOY4d9fobIn27lfnZ5MDy-NoqqRpk',
	 				where: window.gmapsVars.allQuery
	 			},
	 			styles: [{
	 				where: window.gmapsVars.currentQuery,
	 				markerOptions: {
						iconName: 'red_circle'
					},
	 				polygonOptions: {
	 					fillColor: '#EB6841',
	 					fillOpacity: 0.3
	 				}
	 			}, {
	 				where: window.gmapsVars.otherQuery,
	 				polygonOptions: {
	 					fillColor: '#00A0B0',
	 					fillOpacity: 0.5
	 				}
	 			}],
	 			map: c_map,
	 			suppressInfoWindows: true
	 		});

	 		google.maps.event.addListener(world_geometry, 'click', function(e) {
	 			document.location.href = document.location.protocol + '//' + document.location.host + '/countries/' + e.row.Name.value.toLowerCase();
	 		});
	 	};

		// Bind events
        function bind() {
        	// Initial true binding of handlers for events
			if (!eventHandlersBound) {
				// Prevent further binding attempts even if js falls
				eventHandlersBound = true;

				// Open map by starting to load the srcipts
				$this.on('click', loadMap);
        	}
        }

		// Initialize everything on load, back button, resize
        function init() {
        	bind();
        }

		$(document).ready(init);
	};
}(jQuery, window, window.document));
