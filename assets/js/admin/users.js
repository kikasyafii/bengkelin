/***
* name File: users.js
* author: Santo Doni Romadhoni
* email: exblopz[at]gmail.com
* Abu Aisyah Licensed: 2014
* 
***/

$(document).ready(function(){

	$("#adduser").click(function(){
		$("#myModal").toggle(500).modal('show');
		$("#modalform").empty();
		$("#titlemodal").text("Add User");
		$.get(BASE_URL + 'index.php/users/modal_add_user', function(data){
			$("#modalform").html(data);
		});
	});
	
	
});

function edit_user(id){
	$("#myModal").toggle(500).modal('show');
	$("#modalform").empty();
	$("#titlemodal").text("Edit User");
	$.get(BASE_URL + 'index.php/users/modal_edit_user?user_id='+ id, function(data){
		$("#modalform").html(data);
	});
}


