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
		time_pieces.days.set ('text', ('0' + timeDiff[2].toInt()).slice (-2));
		time_pieces.hours.set ('text', ('0' + timeDiff[4].toInt()).slice (-2));
		time_pieces.minutes.set ('text', ('0' + timeDiff[6].toInt()).slice (-2));
		time_pieces.seconds.set ('text', ('0' + timeDiff[8].toInt()).slice (-2));
	}).periodical(1000);

	/*--------------------------------------------------------------------------
	Gallery Tooltips
	--------------------------------------------------------------------------*/
	var tips = new Tips ('.thumbnail', {
		'className': 'tooltip'
	});
});