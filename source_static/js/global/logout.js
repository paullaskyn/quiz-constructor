
// Logout
$(document).on('click', '.logout_btn', function(){
	swal({
		title: 'Do you really want to log out?',
		icon: 'warning',
		buttons: true,
		dangerMode: true,
		buttons: ["Nope", "Yep"],
	})
	.then((willDelete) => {
		if (willDelete) {
			ajaxRequest('/', 'POST', 'logout', function(){
				window.location.replace("/");
			});
		}
	});
});
