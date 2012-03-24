/*
	new ModalWindow ({
		'id': 'my-window-id',
		'className': 'my-window-class',
		'contents': 'Hurray!',
		'buttons': [
			{
				'label': 'Close',
				'className': 'my-button-class',
				'events': {
					'click': function () {
						alert ('The window is about to close, but this alert will fire first.');
					}
				}
			}
		]
	})

	Produces the following markup:

	<body>
		<div id="modal-window-viewport-shader"></div>

		<div class="modal-window my-window-class" id="my-window-id">
			<div class="window-contents">
				Hurray!
			</div>
			<div class="button-container">
				<a href="#" class="my-button-class">Close</a>
			</div>
		</div>
	</body>
*/

var ModalWindow;
(function () {
	var z_index = 1000;

	ModalWindow = new Class ({
		'Implements': [Options, Events],

		'options': {
			'id': '',
			'className': '',
			'contents': 'No contents provided',
			'shade_viewport': true,
			'buttons': [
				{
					'label': 'Close', /*
					'className': ''
					'events': {
						'click': funciton () {
							alert ('Bye!');
						}
					}
					*/
				}
			],
		},

		'initialize': function (options) {
			this.setOptions (options);
			this.build ();
		},

		'build': function () {
			var _self = this;

			// Make the window
			_self.window_element = new Element ('div', {
				'id': _self.options.id,
				'class': 'modal-window ' + (_self.options.className || ''),
				'html': '<section class="window-contents">' + _self.options.contents + '</section>',
				'data-shading': _self.options.shade_viewport ? 'true' : 'false',
				'styles': {
					'z-index': z_index++,
				}
			});

			// Are there any buttons?
			if (_self.options.buttons.length)
			{
				// Make a button container
				_self.window_element.button_container = new Element ('div', {
					'class': 'button-container'
				});
				_self.window_element.adopt (_self.window_element.button_container);

				// Build the buttons
				_self.options.buttons.each (function (button) {
					var new_button = new Element ('a', {
						'class': 'button ' + (button.className || ''),
						'html': button.label,
						'href': button.href || '#',
						'events': button.events || {}
					});

					// Every button closes the window
					new_button.addEvent ('click', _self.dismiss.bind (_self));

					// Add it to the container
					_self.window_element.button_container.adopt (new_button);
				});
			}

			// Do we shade the viewport?
			if (_self.options.shade_viewport)
			{
				// The viewport shader
				_self.viewport_shader = $('modal-window-viewport-shader') || new Element ('div', { 'id': 'modal-window-viewport-shader'}).inject (document.body);
				_self.shadeViewport ();
			}

			// Show the window, centered
			_self.window_element.inject (document.body).fade('hide').position ().fade('in');

			// This is the "show" method
			this.fireEvent ('show', [ _self.window_element, _self ]);
		},

		'dismiss': function () {
			var _self = this;

			// It's not technically shading while it's fading out...
			_self.window_element.set('data-shading', '').fade ('out');

			// When it's hidden, get rid of it
			(function () { _self.window_element.destroy(); }).delay (1000);

			// Unshade the viewport at the same time
			_self.unShadeViewport ();

			// Tell other things that it's been dismissed
			this.fireEvent ('dismiss', [ _self ]);
		},

		'shadeViewport': function () {
			var _self = this;

			// If there are no other windows open that are shading the viewport,
			// shade the viewport
			if ($$('.modal-window[data-shading="true"]').length == 0)
			{
				_self.viewport_shader.fade ('in');
			}
		},

		'unShadeViewport': function () {
			var _self = this;

			// If there are no other windows open that are shading the viewport,
			// unshade the viewport
			if ($$('.modal-window[data-shading="true"]').length == 0)
			{
				_self.viewport_shader.fade ('out');
			}
		},
	});
})();