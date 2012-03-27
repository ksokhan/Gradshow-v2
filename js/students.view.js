window.addEvent ('domready', function () {
	var posters = $$('#content .poster');
	/*--------------------------------------------------------------------------
	Randomly Scatter
	--------------------------------------------------------------------------*/
	var randomlyStack = function (container, divs) {
		// randomize the divs
		divs.sort(function() { return 0.5 - Math.random() });

		var h_spacing = 125;
		var clump_width = h_spacing * (divs.length + 1);
		var clump_height = 300;
		var container_size = container.getSize();
		var h_start = (container_size.x - clump_width) / 2;
		var i = 1;

		// Position them
		divs.each (function (element, index) {
			var element_size = element.getSize();
			var zindex = Number.random(1, divs.length + 1);
			var x = h_start + (h_spacing * i) - (element_size.x / 2);
			var y = Number.random (0, container_size.y - element_size.y);

			element.setStyles ({
				'left': x,
				'top': y,
				'z-index': zindex
			});

			i++;
		});
	};

	window.addEvent ('load', function () {
		randomlyStack($('content'), posters);
		});

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
		var _self = this;

		// No clicking on already active thumbs
		if (this.hasClass ('active')) return false;

		// Transfer link properties to the enlarged image
		var img = $$('#overlay-large-image img')[0];
		img.fade(0).set('src', _self.get ('href'));
		img.removeEvents().addEvent('load', function () {
			img.set ({
				'width': _self.get('data-enlarged-width'),
				'height': _self.get('data-enlarged-height')
			}).fade(1);

			// Adjust max-height of the description
			$('overlay-description').setStyle('height', $('overlay-left-column').getSize().y);

			// Re-center the window (some images are different sizes, which throws the window around)
			$('overlay-window').position();
		});

		// Indicate which thumb is active
		_self.addClass('active').getSiblings().removeClass('active');
	};
	var ms_before_not_a_click = 100;
	Asset.javascript ('/js/classes/ModalWindow.js', {
		'onLoad': function () {
			var overlay_triggers = posters.concat($$('.overlayLink'));
			overlay_triggers.addEvent ('click', function (e) {
				// Just finished a drag? Then it's not a click!
				if (this.hasClass ('poster') && this.retrieve ('clickable', false) == false) return;

				var trigger = this;
				new Request.HTML ({
					'url': trigger.get ('data-url'),
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
								$('overlay-thumbnails').addEvent('click:relay(a)', enlarge_thumbnail)[0].fireEvent('click');
								$$('#overlay-large-image img').fireEvent ('load');
							}
						});
					}
				}).get();
				return false;
			}).filter('.active').fireEvent ('click');
		}
	});

	// Re-position the overlay on window resize
	window.addEvent('resize', function () {
		$$('#overlay-window').position();
	});
});