window.addEvent('domready', function () {
	$$('.product:not(.disabled) a.button').addEvent('click', function () {
		this.getParent('form').submit();
	});
});