window.addEvent ('domready', function () {
	var randomlyStack = function (container, divs) {
		// randomize the divs
		divs.sort(function() { return 0.5 - Math.random() });

		// Measurments and crap
		var h_wiggle = 50;
		var container_size = container.getSize();
		var x_increment = container_size.x / (divs.length + 1);
		var i = 1;

		// Position them
		divs.each (function (element, index) {
			var element_size = element.getSize();
			var zindex = index;

			var x = x_increment * i++ - (element_size.x / 2);
			x = Number.random (x - h_wiggle, x + h_wiggle);
			var y = Number.random(element_size.y / 2, container_size.y - element_size.y);

			element.setStyles ({
				'left': x,
				'top': y,
				'z-index': zindex
			});
		});
	};

	randomlyStack($('content'), $$('#content .poster'));
});