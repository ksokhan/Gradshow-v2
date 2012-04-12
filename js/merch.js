window.addEvent('domready', function () {
	$$('a.button').addEvent('click', function () {
		this.getParent('form').submit();
	});
});