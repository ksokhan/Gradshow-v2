window.addEvent ('domready', function () {
	var posters = $$('#content .poster');
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

	randomlyStack($('content'), posters);

	/*--------------------------------------------------------------------------
	Make 'Em Draggable
	--------------------------------------------------------------------------*/
	var zindex = 10;
	posters.each (function (poster, index) {
		poster.store('clickable', true);
		new Drag(poster, {
			'snap': 0,
			'onSnap': function(el) {
				// Can't click!
				el.store('clickable', false);
				el.addClass('draggedItem');
				el.getSiblings().addClass('dragging');
				el.setStyle('z-index', zindex++);
			},
			'onComplete': function(el) {
				// Wait 500ms then say the item can be clicked again
				el.store.delay(500, el, ['clickable', true]);
				el.getSiblings().removeClass('dragging');
				el.removeClass('draggedItem');
			}
		});
	});

	/*--------------------------------------------------------------------------
	The Overlay
	--------------------------------------------------------------------------*/
	var enlarge_thumbnail = function (e) {
		if (e) e.preventDefault();
		$$('#overlay-large-image img').set ('src', this.get ('href'));
		this.addClass('active').getSiblings().removeClass('active');
	};
	var ms_before_not_a_click = 100;
	Asset.javascript ('/js/classes/ModalWindow.js', {
		'onLoad': function () {
			posters.addEvent ('click', function () {
				// Just finished a drag? Then it's not a click!
				if (this.retrieve ('clickable', false) == false) return;

				var poster = this;
				new Request.HTML ({
					'url': poster.get ('data-url'),
					'onSuccess': function (responseTree, responseElements, responseHTML, responseJavaScript) {
						new ModalWindow ({
							'id': 'overlay-window',
							'contents': responseHTML,
							'buttons': [
								{
									'label': '&times;'
								}
							],
							'onShow': function (window_element) {
								$$('#overlay-thumbnails a').addEvent('click', enlarge_thumbnail)[0].fireEvent('click');
							}
						});
					}
				}).get();
			}).filter('.active').fireEvent ('click');
		}
	});
});