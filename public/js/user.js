$(document).ready(function() {
	getRoles();

	let roles = [];

	function getRoles() {
		let token = localStorage.getItem('token');
		if (!token) {
			swal("Unauthorized", "You have to login first", "error");
			location.href = "/login";
		} else {
			$.ajax({
		        url: "/api/roles",
		        headers: {
		        	'Authorization': 'Bearer ' + token
		        },
		        type: "GET",
		        dataType: "json",
		        success: function (result) {
		   			if (result.status == 'success') {
		            	roles = result.data;
		            	getUsers();
		            }
		        },
		        error: function (xhr, Status, err) {
		            let error_message = xhr.responseJSON.message;
		            swal("Error", error_message ? error_message : "Something error happened", "error");
		        }
		    });
		}
	}

	let user = null;

	function getUsers() {
		let token = localStorage.getItem('token');
		if (!token) {
			swal("Unauthorized", "You have to login first", "error");
			location.href = "/login";
		} else {
			$.ajax({
		        url: "/api/users",
		        headers: {
		        	'Authorization': 'Bearer ' + token
		        },
		        type: "GET",
		        dataType: "json",
		        success: function (result) {
		   			if (result.status == 'success') {
		            	users = result.data;
		            	$("#userList").empty();

		            	let user_lists = '';
		            	$.each(users, function (index, value) {
		            		user_lists += "<tr>";
		            		user_lists += "<td>" + value.id + "</td>";
		            		user_lists += "<td>" + value.name + "</td>";
		            		user_lists += "<td>" + value.role.name + "</td>";
		            		user_lists += "<td>";

		            		user_lists += "<select class='form-control'>";
		            		user_lists += "<option value=''>Change Role</option>";

		            		$.each(roles, function (index, value) {
		            			user_lists += "<option value='" + value.id + "'>" + value.name + "</option>";
		            		});

		            		user_lists += "</select>";
		            		user_lists += "<button class='btn btn-primary update-user-role' user_id='" + value.id + "'>Update</button>";
		            		user_lists += "</td>";
		            		user_lists += "</tr>";
		            	});

		            	$("#userList").html(user_lists);
		            }
		        },
		        error: function (xhr, Status, err) {
		            let error_message = xhr.responseJSON.message;
		            swal("Error", error_message ? error_message : "Something error happened", "error");
		        }
		    });
		}
	}

	$(document).on('click', '.update-user-role', function() {
		let user_id = $(this).attr('user_id');
		let new_role_id = $(this).prev().val();
		let new_role_name = $(this).prev().find('option:selected').text();

		console.log(user_id, new_role_id);

		if (!user_id) {
			swal("Error", "User ID is not recognized, please refresh the browser", "error");
			return false;
		}

		if (!new_role_id) {
			swal("Error", "Please choose a new role", "error");
			return false;
		}

		swal({
		  title: "Are you sure?",
		  text: "You will update this user's role to " + new_role_name,
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, update",
		  closeOnConfirm: false
		},
		function(){
			updateUser(user_id, new_role_id);
		});
	});

	function updateUser(user_id, new_role_id) {
		let token = localStorage.getItem('token');
		if (!token) {
			swal("Unauthorized", "You have to login first", "error");
			location.href = "/login";
		} else {
		    $.ajax({
		        url: "/api/users/" + user_id,
		        headers: {
		        	'Authorization': 'Bearer ' + token
		        },
		        data: {
		        	new_role_id: new_role_id
		        },
		        type: "PUT",
		        dataType: "json",
		        success: function (result) {
		   			if (result.status == 'success') {
		            	
		            }
		            swal("Information", result.message, result.status);
		        },
		        error: function (xhr, Status, err) {
		            let error_message = xhr.responseJSON.message;
		            swal("Error", error_message ? error_message : "Something error happened", "error");
		        }
		    });
		}
	}
});