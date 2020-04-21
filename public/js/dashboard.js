var user = null;
$(document).ready(function() {
	verify();

	function verify() {
		let token = localStorage.getItem('token');
		if (!token) {
			swal("Unauthorized", "You have to login first", "error");
			location.href = "/login";
		} else {
			$.ajax({
		        url: "/api/user",
		        headers: {
		        	'Authorization': 'Bearer ' + token
		        },
		        type: "GET",
		        dataType: "json",
		        success: function (result) {
		   			if (result.status == 'success') {
		            	user = result.data;

		            	if (user.role) {
		            		$("#roleName").text(user.role.name + " - " + user.email);
		            	}

		            	if (user.role.accesses) {
		            		$("#accessList").empty();

		            		let access_lists = '';
		            		
		            		$.each(user.role.accesses, function (index, value) {
		            			access_lists += "<li class='nav-item'>\
                					<a class='nav-link " + (currentRoute == value.access.toLowerCase() ? 'active' : '') + "' href='/" + value.access.toLowerCase() + "'>\
              						<span data-feather='file'></span>" + value.access + "</a></li>";
		            		});

		            		$("#accessList").html(access_lists);
		            	}
		            }
		        },
		        error: function (xhr, Status, err) {
		            let error_message = xhr.responseJSON.message;
		        	localStorage.removeItem('token');
		            swal("Error", error_message ? error_message : "Something error happened", "error");
		        	location.href = "/login";
		        }
		    });
		}
	}

	$("#logOut").on('click', function() {
		let token = localStorage.getItem('token');
		if (!token) {
			swal("Unauthorized", "You have to login first", "error");
		} else {
			$.ajax({
		        url: "/api/logout",
		        type: "POST",
		        headers: {
		        	'Authorization': 'Bearer ' + token
		        },
		        dataType: "json",
		        success: function (result) {
		            swal("Logout", result.message, result.status)
					if (result.status == 'success') {
		            	location.href = "/login";
		            }

		            localStorage.removeItem('token');
		        },
		        error: function (xhr, Status, err) {
		            let error_message = xhr.responseJSON.message;
		            swal("Error", error_message ? error_message : "Something error happened", "error");
		        }
		    });
		}
	});

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
});