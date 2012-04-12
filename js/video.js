window.addEvent('domready', function () {
	$$('.video-swapper').addEvent('click', function () {
		// Get the ID of the one we want
		var video_id = this.get('href').replace('#', '');

		// Get vidoes
		var videos = $$('.video div');

		// Hide others
		videos.filter(':not(#' + video_id + ')').setStyle('display', 'none');

		// Show the one we need
		videos.filter('#' + video_id).setStyle('display', 'block');

		// Make it active
		this.addClass('active').getSiblings().removeClass('active');
	});

	// Parse the URL for a video name
	var url_id = window.location.toString().match(/#(.*)$/);

	// Load that video if we have it
	if (url_id && url_id[1]) {
		$$('.video-swapper[href="#' + url_id[1] + '"]').fireEvent('click');
	}

	// Otherwise, show the very first video in the list
	else {
		$$('.video-swapper')[0].fireEvent('click');
	}
});