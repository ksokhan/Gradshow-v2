window.addEvent ('domready', function () {
	/*--------------------------------------------------------------------------
	Randomly Scatter
	--------------------------------------------------------------------------*/
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

	/*--------------------------------------------------------------------------
	Make 'Em Draggable
	--------------------------------------------------------------------------*/
	var zindex = 10;
	$$('#content .poster').each (function (poster, index) {
		new Drag(poster, {
			snap: 0,
			onSnap: function(el) {
				el.addClass('draggedItem');
				el.getSiblings().addClass('dragging');
				el.setStyle('z-index', zindex++);
			},
			onComplete: function(el) {
				el.getSiblings().removeClass('dragging');
				el.removeClass('draggedItem');
			}
		});
	});

	/*--------------------------------------------------------------------------
	The Overlay
	--------------------------------------------------------------------------*/
	Asset.javascript ('/js/classes/ModalWindow.js', {
		'onLoad': function () {
			$$('.poster').addEvent('click', function (e) {
				var poster = this;
				new Request.HTML ({
					'url': '/partial/overlay/options/student_id/' + poster.get ('data-student-id'),
					'onSuccess': function (responseTree, responseElements, responseHTML, responseJavaScript) {
						new ModalWindow ({
							'id': 'overlay_window',
							'contents': responseHTML,
							'buttons': [
								{
									'label': 'X'
								}
							]
						});
					}
				}).get();
			});
		}
	});
});