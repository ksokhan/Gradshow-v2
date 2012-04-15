window.addEvent ('domready', function () {
	/*--------------------------------------------------------------------------
	The Countdown
	--------------------------------------------------------------------------*/
	var time_pieces = {
		'days': $$('#days-left var')[0],
		'hours': $$('#hours-left var')[0],
		'minutes': $$('#minutes-left var')[0],
		'seconds': $$('#seconds-left var')[0]
	};
	(function () {
		var now = Date.parse('04/15/2012 6:30pm');
		var timeDiff = now.timeDiff ().match (/(([0-9]+)d:)?(([0-9]+)h:)?(([0-9]+)m:)?(([0-9]+)s)?/);
		timeDiff[2] = timeDiff[2] || '00';
		timeDiff[4] = timeDiff[4] || '00';
		timeDiff[6] = timeDiff[6] || '00';
		timeDiff[8] = timeDiff[8] || '00';
		time_pieces.days.set ('text', ('0' + timeDiff[2].toInt()).slice (-2));
		time_pieces.hours.set ('text', ('0' + timeDiff[4].toInt()).slice (-2));
		time_pieces.minutes.set ('text', ('0' + timeDiff[6].toInt()).slice (-2));
		time_pieces.seconds.set ('text', ('0' + timeDiff[8].toInt()).slice (-2));
	}).periodical(1000);

	/*--------------------------------------------------------------------------
	Gallery Tooltips
	--------------------------------------------------------------------------*/
	var tips = new Tips ('.thumbnail:not(.student)', {
		'className': 'tooltip',
		'showDelay': 0,
		'hideDelay': 0
	});

	/*--------------------------------------------------------------------------
	Changing Colours
	--------------------------------------------------------------------------*/
	$$('#colour-picker li').addEvent ('click', function () {
		this.getParent ('ul').getElement ('.active').removeClass ('active');
		this.addClass ('active');
		document.body.set ('id', this.get ('text').toLowerCase());
		// localStorage.setItem('pique-bg-colour', this.get('id'));
		Cookie.write ('pique-bg-colour', this.get('id'));
	});
	// var stored_bg = localStorage.getItem ('pique-bg-colour') || 'set-bg-white';
	var stored_bg = Cookie.read ('pique-bg-colour') || 'set-bg-white';
	$(stored_bg).fireEvent ('click');

	/*--------------------------------------------------------------------------
	Pinned Sidebars
	--------------------------------------------------------------------------*/
	window.addEvent ('scroll', function () {
		var scroll_distance = window.getScroll().y;
		$$('.sidebar').setStyles ({
			'top': (scroll_distance - 177 > 0) ? scroll_distance - 177 + 30 : 0
		});
	});
});


