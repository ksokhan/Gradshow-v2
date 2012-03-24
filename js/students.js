window.addEvent ('domready', function () {
	// This one lets there be more than one active menu item on the page
	var setActiveMenuItem = function (element) {
		element.getParent('ul').getElements('.active-menu-item').removeClass('active-menu-item');
		element.addClass('active-menu-item');
	};

	/*--------------------------------------------------------------------------
	Sort Randomly
	--------------------------------------------------------------------------*/
	var sortRandomly = function () {
		// Clear all category cards
		$$('.category_card').destroy();

		// Get all thumbnails
		var thumbnails = $$('.thumbnail');

		// Sort them randomly
		thumbnails.sort(function () { return 0.5 - Math.random(); });

		// Spit them out
		var container = $('thumbnails');
		thumbnails.each (function (thumbnail, index) {
			thumbnail.setStyle('display', 'inline-block').inject(container);
		});
	};
	$$('#sort_randomly').addEvent ('click', function (e) {
		if (e) e.preventDefault();
		setActiveMenuItem (this);
		sortRandomly ();

		// If a letter is active, make it inactive because random always shows everyone
		setActiveMenuItem($$('[data-show-only-letter]:first-child')[0]);
	}).fireEvent('click');

	/*--------------------------------------------------------------------------
	Filtering...
	--------------------------------------------------------------------------*/
	// Filter by...
	var showOnlyWhere = function (attribute, value) {
		// Get the container for the thumbnails
		var container = $('thumbnails');

		// Sort first, if we need to!
		if (container.getElement ('.category_card'))
		{
			if (attribute == 'data-first-name') {
				sortBy(first_names_by_letter);
			} else {
				sortBy(last_names_by_letter);
			}
		}

		// Show all?
		if (value == "all") {
			// Just show everything
			$$('.thumbnail').setStyle ('display', 'inline-block');

			return;
		}

		// Clear all category cards
		$$('.category_card').destroy();

		// Now hide everything...
		$$('.thumbnail').setStyle ('display', 'none');

		// Create a "name card" to denote where each new section begins
		Elements.from ('<div class="thumbnail category_card"><span>' + value + '</span></div>').inject(container, 'top');

		// How show the ones we want...
		$$('.thumbnail[' + attribute + '^="' + value.toUpperCase() + '"]').setStyle ('display', 'inline-block');
	};

	/*--------------------------------------------------------------------------
	Sorting...
	--------------------------------------------------------------------------*/
	// Sort by...
	var sortBy = function (folders) {
		// Get the container for the thumbnails
		var container = $('thumbnails');

		// Just to make sure everything is visible...
		$$('.thumbnail').setStyle ('display', 'inline-block');

		// Clear all category cards
		$$('.category_card').destroy();

		// For each course in the list...
		Object.each (folders, function (thumbnails, folder_name) {
			// Create a "name card" to denote where each new section begins
			Elements.from ('<div class="thumbnail category_card"><span>' + folder_name + '</span></div>').inject(container);

			// Spit out its thumbnails
			thumbnails.each (function (thumbnail, index) {
				thumbnail.inject(container);
			});
		});
	};

	/*--------------------------------------------------------------------------
	By First Name
	--------------------------------------------------------------------------*/
	// Make little folders...
	var first_names_by_letter = {
		'a': [],
		'b': [],
		'c': [],
		'd': [],
		'e': [],
		'f': [],
		'g': [],
		'h': [],
		'i': [],
		'j': [],
		'k': [],
		'l': [],
		'm': [],
		'n': [],
		'o': [],
		'p': [],
		'q': [],
		'r': [],
		's': [],
		't': [],
		'u': [],
		'v': [],
		'w': [],
		'x': [],
		'y': [],
		'z': []
	};
	// Stuff the folders
	Object.each (first_names_by_letter, function (arr, letter) {
		first_names_by_letter[letter] = $$('.thumbnail[data-first-name^="' + letter.toUpperCase() + '"]');
		first_names_by_letter[letter].sort (function (a, b) {
			if (a.get('data-first-name') < b.get('data-first-name'))
				return -1;
			if (a.get('data-first-name') > b.get('data-first-name'))
				return 1;
			return 0;
		});
	});
	// Sort by...
	$$('#sort_by_first_name').addEvent ('click', function (e) {
		if (e) e.preventDefault();
		setActiveMenuItem (this);
		sortBy(first_names_by_letter);

		// If a letter is active, click it
		$$('.active-menu-item[data-show-only-letter]').fireEvent ('click');
	});

	// Filter by... Letter
	$$('[data-show-only-letter]').addEvent ('click', function (e) {
		if (e) e.preventDefault();

		// We doing this by last name or first name??
		var sort_axis = '';
		if ($('sort_by_first_name').hasClass ('active-menu-item')) {
			sort_axis = 'data-first-name';
		}
		else if ($('sort_by_last_name').hasClass ('active-menu-item')) {
			sort_axis = 'data-last-name';
		}

		// We're sorting randomly or something.
		else
		{
			// Sort by first name
			$('sort_by_first_name').fireEvent('click');

			// Set the sort axis
			sort_axis = 'data-first-name';
		}

		setActiveMenuItem (this);
		showOnlyWhere (sort_axis, this.get ('data-show-only-letter'));
	});

	/*--------------------------------------------------------------------------
	By Last Name
	--------------------------------------------------------------------------*/
	// Make little folders...
	var last_names_by_letter = {
		'a': [],
		'b': [],
		'c': [],
		'd': [],
		'e': [],
		'f': [],
		'g': [],
		'h': [],
		'i': [],
		'j': [],
		'k': [],
		'l': [],
		'm': [],
		'n': [],
		'o': [],
		'p': [],
		'q': [],
		'r': [],
		's': [],
		't': [],
		'u': [],
		'v': [],
		'w': [],
		'x': [],
		'y': [],
		'z': []
	};
	// Stuff the folders
	Object.each (last_names_by_letter, function (arr, letter) {
		last_names_by_letter[letter] = $$('.thumbnail[data-last-name^="' + letter.toUpperCase() + '"]');
		last_names_by_letter[letter].sort (function (a, b) {
			if (a.get('data-last-name') < b.get('data-last-name'))
				return -1;
			if (a.get('data-last-name') > b.get('data-last-name'))
				return 1;
			return 0;
		});
	});
	// Sort by...
	$$('#sort_by_last_name').addEvent ('click', function (e) {
		if (e) e.preventDefault();
		setActiveMenuItem (this);
		sortBy(last_names_by_letter);

		// If a letter is active, click it
		$$('.active-menu-item[data-show-only-letter]').fireEvent ('click');
	});
});