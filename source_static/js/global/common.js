$(document).ready(function(){
	// Active link
	var location_pathname = window.location.pathname;

	$('li.nav-item').each(function(){
		$(this).removeClass('active');
		var href = $(this).children().attr('href');
		if(location_pathname == href) $(this).addClass('active');
	});
});
