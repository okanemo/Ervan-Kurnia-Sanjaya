$(document).ready(function() {
	verify();

	function verify() {
		let token = localStorage.getItem('token');
		if (token) {
			location.href = "/dashboard";
		}
	}

	$("#logInButton").on('click', function() {
		let email = $("#inputEmail").val();
		let password = $("#inputPassword").val();
		let remember_me = $("#inputRememberMe").prop('checked') ? 1 : 0;

		if (email && password) {
			$.ajax({
		        url: "/api/login",
		        type: "POST",
		        data: {
		        	email: email,
		        	password: password,
		        	remember_me: remember_me
		        },
		        dataType: "json",
		        success: function (result) {
		            swal("Login", result.message, result.status)
					if (result.status == 'success') {
		            	localStorage.setItem('token', result.data);
		                location.href = "/dashboard";
		            }
		        },
		        error: function (xhr, Status, err) {
		            let error_message = xhr.responseJSON.message;
		            swal("Error", error_message ? error_message : "Something error happened", "error");
		        }
		    });
		} else {
			swal("Complete Login Detail", "Please fill in your e-mail and password", "warning");
		}
	});

	$("#registerButton").on('click', function() {
		let name = $("#inputName").val();
		let email = $("#inputEmail").val();
		let password = $("#inputPassword").val();
		let password_confirmation = $("#inputPasswordConfirmation").val();

		if (name && email && password) {
			$.ajax({
		        url: "/api/register",
		        type: "POST",
		        data: {
		        	name: name,
		        	email: email,
		        	password: password,
		        	password_confirmation: password_confirmation
		        },
		        dataType: "json",
		        success: function (result) {
		            swal("Register", result.message, result.status)
		            if (result.status == 'success') {
		                location.href = "/";
		            }
		        },
		        error: function (xhr, Status, err) {
		            let error_message = xhr.responseJSON.message;
		            swal("Error", error_message ? error_message : "Something error happened", "error");
		        }
		    });
		} else {
			swal("Complete Register Detail", "Please fill in your name, e-mail and password", "warning");
		}
	});
});