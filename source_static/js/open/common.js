$(document).ready(function() {

	// Active link
	var location_pathname = window.location.pathname;

	$('li.nav-item').each(function(){
		$(this).removeClass('active');
		var href = $(this).children().attr('href');
		if(location_pathname == href) $(this).addClass('active');
	});


	if (window.location.search.split('=')[0] == '?recovery'){
		$('.form-blocks').fadeIn(200);
		$('#newpassword').fadeIn(200);
	}

	// Popup open
	$(document).on('click', '.open_form-blocks', function(){
		$('.form-blocks form , .alert').fadeOut(0);
		var sign_content = $(this).attr('href');
		$('.form-blocks').fadeIn(200);
		$(sign_content).fadeIn(200);
	});

	$('.popup_close').click(function() {
		$('.form-blocks , .form-blocks form').fadeOut(200);
		$('.alert-danger').fadeOut(0);
	});


});
