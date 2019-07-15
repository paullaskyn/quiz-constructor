
// Logout
$(document).on('click', '.logout_btn', function(){
	ajaxRequest('/', 'POST', 'logout', function(){
		window.location.replace("/");
	});
});
