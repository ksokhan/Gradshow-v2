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
	The Bio
	--------------------------------------------------------------------------*/
	$$('#bio').position();
	$$('#close-bio').addEvent('click', function () {
		var box = this.getParent();
		box.get('tween').start('opacity',0).chain(function () {
			box.destroy();
		});
	});

	/*--------------------------------------------------------------------------
	The Overlay
	--------------------------------------------------------------------------*/
	var enlarge_thumbnail = function (e) {
		if (e) e.preventDefault();
		var _self = this;

		// No clicking on already active thumbs
		if (_self.hasClass('active')) return false;

		// Indicate which thumb is active
		_self.addClass('active').getSiblings().removeClass('active');

		// Transfer link properties to the enlarged image
		var img = $$('#overlay-large-image img')[0];

		// Destroy any other iframes that might exist...
		img.getSiblings('iframe').destroy();

		// Is it a video thumbnail? Do different things...
		if (_self.hasClass('video-link'))
		{
			// Hide the image
			img.setStyle('display', 'none');

			// Get the video ID
			var video_id = _self.get('data-video-url').match(/([0-9]+)\/?$/)[0];

			// Build a video frame and put it beside the image
			Elements.from('<iframe src="http://player.vimeo.com/video/' + video_id + '?title=0&amp;byline=0&amp;portrait=0" width="600" height="335" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>')[0].inject(img, 'before');

			// Don't do anything else...
			return;
		}

		// Do image things
		img.setStyle('display', '').fade(0).set('src', _self.get ('href'));
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
								$$('#overlay-thumbnails a.video-link').inject($('overlay-thumbnails'), 'top');
								$$('#overlay-thumbnails a').addEvent('click', enlarge_thumbnail)[0].fireEvent('click');
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