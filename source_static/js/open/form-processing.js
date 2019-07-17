$(document).ready(function(){

	//------------------------------------------------
	// Functions for work with forms and
	// doing ajax requests
	//================================================

	var USERNAME_ERROR = 'Only letters are available! From 2 to 32 characters.\n',
		EMAIL_ERROR = 'Enter your email in the correct format!\n',
		PASSWORD_ERROR = 'Minimum password length 8 characters, maximum - 64!\n',
		PASS_COMP_ERROR = 'Passwords don\'t coincide!\n';
	var error;

	function validUsername(username) {
		if (username.search(/^[a-zA-Zа-яА-Я]/g) == -1 || username.length > 32 || username.length < 2)
			error = USERNAME_ERROR;
	}

	function validEmail(email) {
		if (email.search(/[A-z_\-0-9]+@[A-z_\-0-9]+\.[A-z_\-0-9]+/) == -1)
			error = EMAIL_ERROR;
	}

	function validPassword(password) {
		if (password.length > 64 || password.length < 8 )
			error = PASSWORD_ERROR;
	}

	function passwordComparsion(pass1, pass2) {
		if (pass1 !== pass2)
			error = PASS_COMP_ERROR;
	}

	function errorShow(error) {
		$('.alert-danger').empty().append(error);
		$('.alert-danger').fadeIn();
	}

	function errorHide() {
		error = '';
		$('.alert-danger').fadeOut();
	}

	function ajaxRequest(url_arg, method_arg, data_arg, success_func){
		$.ajax({
			url: url_arg,
			method: method_arg,
			data: data_arg,
			cache: false
		}).done(function(result){
			var json = JSON.parse(result);
			if (json.error) errorShow(json.error);
			else success_func();
		});
	}

	$('.mainpage-signup').submit(function(){
		errorHide();

		var username	= $('#signupUsername').val(),
			email		= $('#signupEmail').val(),
			password	= $('#signupPassword').val();

		validPassword(password);
		validEmail(email);
		validUsername(username);

		var data_string = 'operation=signup&username=' + username + '&email=' + email + '&password=' + password;

		if (error) errorShow(error);
 		else ajaxRequest('/', 'POST', data_string, function(){
 			swal({
				title: 'You are registered!',
				icon: "success"
			})
			.then((value) => {
				window.location.replace("/");
			});
 		});

 		return false;
	});

	$('#signin').submit(function(){
		errorHide();

		var email		= $('#signinEmail').val(),
			password	= $('#signinPassword').val();

		validPassword(password);
		validEmail(email);

		var data_string = 'operation=signin&email=' + email + '&password=' + password;

		if (error) errorShow(error);
 		else ajaxRequest('/', 'POST', data_string, function(){
			window.location.replace("profile");
		});

 		return false;
	});


	$('#recover').submit(function(){
		errorHide();

		var email		= $('#recoverEmail').val();

		validEmail(email);

		var data_string = 'operation=recover&email=' + email;

		if (error) errorShow(error);
 		else ajaxRequest('/', 'POST', data_string, function(){
 			swal({
				title: 'Success',
				text: 'Check your email!',
				icon: "success",
			})
			.then((value) => {
				window.location.replace('/');
			});
 		});

 		return false;
	});

	$('#newpassword').submit(function(){
		errorHide();

		var pass1	= $('#newPassword').val(),
			pass2	= $('#newPasswordRepeat').val();

		passwordComparsion(pass1, pass2);

		var data_string = 'operation=newpassword&password=' + pass1 + '&password_repeat=' + pass2 + '&restore_hash=' + window.location.search.split('=')[1];

		if (error) errorShow(error);
 		else ajaxRequest('/', 'POST', data_string, function(){
 			swal({
				title: 'Success',
				text: 'Password successfully changed!',
				icon: "success",
			})
			.then((value) => {
				$('.form-blocks #newpassword').fadeOut(0);
				$('.form-blocks #signin').fadeIn();
			});
 		});

 		return false;
	});

});
console.log(window.location.search.split('=')[1]);
