window.addEvent ('domready', function () {
	var setActiveMenuItem = function (element) {
		$$('.active_menu_item').removeClass ('active_menu_item');
		element.addClass ('active_menu_item');
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
			thumbnail.inject(container);
		});
	};
	$$('#sort_randomly').addEvent ('click', function (e) {
		if (e) e.preventDefault();
		setActiveMenuItem (this);
		sortRandomly ();
	}).fireEvent('click');

	/*--------------------------------------------------------------------------
	Filtering...
	--------------------------------------------------------------------------*/
	// Filter by...
	var showOnlyWhere = function (attribute, value) {
		// Sort first...
		if (attribute == 'data-course')
			sortBy(courses);
		else
			sortBy(mediums);

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

		// Get the container for the thumbnails
		var container = $('thumbnails');

		// Create a "name card" to denote where each new section begins
		Elements.from ('<div class="thumbnail category_card"><span>' + value + '</span></div>').inject(container, 'top');

		// How show the ones we want...
		$$('.thumbnail[' + attribute + '="' + value + '"]').setStyle ('display', 'inline-block');
	};

	/*--------------------------------------------------------------------------
	Sorting...
	--------------------------------------------------------------------------*/
	// Sort by...
	var sortBy = function (folders) {
		// Get the container for the thumbnails
		var container = $('thumbnails');

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
	By Course
	--------------------------------------------------------------------------*/
	// Make little folders...
	var courses = {
		'Book Design': [],
		'Corporate ID': [],
		'Communication Design': [],
		'Design Workshop': [],
		'Editorial Design': [],
		'Independent Study': [],
		'Information Design': [],
		'Interactivity Design': [],
		'Package Design': [],
		'Time-Based Design': [],
		'Typography': []
	};
	// Stuff the folders
	Object.each (courses, function (arr, course_name) {
		courses[course_name] = $$('.thumbnail[data-course="' + course_name + '"]');
	});
	// Sort by...
	$$('#sort_by_course').addEvent ('click', function (e) {
		e.preventDefault();
		setActiveMenuItem (this);
		sortBy(courses);
	});
	// Filter by...
	$$('[data-show-only-course]').addEvent ('click', function (e) {
		e.preventDefault();
		setActiveMenuItem (this);
		showOnlyWhere ('data-course', this.get ('data-show-only-course'));
	});

	/*--------------------------------------------------------------------------
	By Medium
	--------------------------------------------------------------------------*/
	// Make little folders...
	var mediums = {
		'Interactive': [],
		'Package': [],
		'Print': [],
		'Video': []
	};
	// Stuff the folders
	Object.each (mediums, function (arr, medium_name) {
		mediums[medium_name] = $$('.thumbnail[data-medium="' + medium_name + '"]');
	});
	// Sort by...
	$$('#sort_by_medium').addEvent ('click', function (e) {
		e.preventDefault();
		setActiveMenuItem (this);
		sortBy(mediums);
	});
	// Filter by...
	$$('[data-show-only-medium]').addEvent ('click', function (e) {
		e.preventDefault();
		setActiveMenuItem (this);
		showOnlyWhere ('data-medium', this.get ('data-show-only-medium'));
	});
});