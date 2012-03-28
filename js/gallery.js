window.addEvent ('domready', function () {
	var loadVisible = function () {
		$$('.thumbnail').each (function (element, index) {
			if (element.getStyle ('display') == 'inline-block') {
				element.getElements('img').each (function (image, index) {
					image.set('src', image.get('data-src')).fade(1);
				});
			}
		});
	};

	/*--------------------------------------------------------------------------
	Set Active Menu Item
	--------------------------------------------------------------------------*/
	var setActiveMenuItem = function (element) {
		$$('.active-menu-item').removeClass ('active-menu-item');
		element.addClass ('active-menu-item');
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
		// if (e) e.preventDefault();
		setActiveMenuItem (this);
		sortRandomly ();
	}).fireEvent('click');

	/*--------------------------------------------------------------------------
	Filtering...
	--------------------------------------------------------------------------*/
	// Filter by...
	var showOnlyWhere = function (attribute, value) {
		// Sort first...
		if (attribute == 'data-course') {
			sortBy(courses);
		}
		else {
			sortBy(mediums);
		}

		// Show all?
		if (value == "all") {
			return;
		}

		// Clear all category cards (sortBy made its own...)
		$$('.category_card').destroy();

		// Now hide everything...
		$$('.thumbnail').setStyle ('display', 'none');

		// Get the container for the thumbnails
		var container = $('thumbnails');

		// Create a "name card" to denote where each new section begins
		Elements.from ('<div class="thumbnail category_card"><span>' + value + '</span></div>')[0].inject(container, 'top');

		// How show the ones we want...
		$$('.thumbnail[' + attribute + '="' + value + '"]').setStyle ('display', 'inline-block');

		// My own lazyLoad
		loadVisible();
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
			Elements.from('<div class="thumbnail category_card"><span>' + (folder_name || 'unclassified') + '</span></div>')[0].inject(container);

			// Spit out its thumbnails
			thumbnails.each (function (thumbnail, index) {
				thumbnail.inject(container);
			});
		});

		// My own lazyLoad
		loadVisible();
	};

	/*--------------------------------------------------------------------------
	By Course
	--------------------------------------------------------------------------*/
	// Create a "folder" for each course
	var course_names = [],
	    courses = {};
	$$('.thumbnail[data-course]').each(function (project, index) {
		var course_name = project.get('data-course');
		if (course_names.indexOf(course_name) < 0) course_names.push(course_name);
	});
	course_names.sort().each(function (course_name) {
		courses[course_name] = [];
	});

	// Stuff the folders
	Object.each (courses, function (arr, course_name) {
		courses[course_name] = $$('.thumbnail[data-course="' + course_name + '"]');
	});
	// Sort by...
	$$('#sort_by_course').addEvent ('click', function (e) {
		// if (e) e.preventDefault();
		setActiveMenuItem (this);
		sortBy(courses);
	});
	// Filter by...
	$$('[data-show-only-course]').addEvent ('click', function (e) {
		// if (e) e.preventDefault();
		setActiveMenuItem (this);
		showOnlyWhere ('data-course', this.get ('data-show-only-course'));
	});

	/*--------------------------------------------------------------------------
	By Medium
	--------------------------------------------------------------------------*/
	// Create a "folder" for each medium
	var medium_names = [],
	    mediums = {};
	$$('.thumbnail[data-medium]').each(function (project, index) {
		var medium_name = project.get('data-medium');
		if (medium_names.indexOf(medium_name) < 0) medium_names.push(medium_name);
	});
	medium_names.sort().each(function (medium_name) {
		mediums[medium_name] = [];
	});

	// Stuff the folders
	Object.each (mediums, function (arr, medium_name) {
		mediums[medium_name] = $$('.thumbnail[data-medium="' + medium_name + '"]');
	});
	// Sort by...
	$$('#sort_by_medium').addEvent ('click', function (e) {
		// if (e) e.preventDefault();
		setActiveMenuItem (this);
		sortBy(mediums);
	});
	// Filter by...
	$$('[data-show-only-medium]').addEvent ('click', function (e) {
		// if (e) e.preventDefault();
		setActiveMenuItem (this);
		showOnlyWhere ('data-medium', this.get ('data-show-only-medium'));
	});

	/*--------------------------------------------------------------------------
	URL Functions
	--------------------------------------------------------------------------*/
	var parseURLForFilters = function () {
		var url_cmd = window.location.toString().match(/#(medium|course)--(.*)$/);
		if (url_cmd[1] && url_cmd[2]) {
			$$('[data-show-only-' + url_cmd[1] + '="' + url_cmd[2] + '"]').fireEvent('click');
		}
	};
	parseURLForFilters();

	/*--------------------------------------------------------------------------
	LazyLoad
	--------------------------------------------------------------------------*/
	var lazyloader = new LazyLoad();
});