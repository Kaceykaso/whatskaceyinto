(function () {

	// Menu button
	$('button.menu').click(function () {
		$('aside.menu').toggleClass('open');          // open|close menu
	});

	// Search button
	$('button.search').click(function () {
		$('aside.search').toggleClass('open');          // open|close menu
	});

}());
