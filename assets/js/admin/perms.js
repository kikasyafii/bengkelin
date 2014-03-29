/***
* name File: users.js
* author: Santo Doni Romadhoni
* email: exblopz[at]gmail.com
* Abu Aisyah Licensed: 2014
* 
***/

$(document).ready(function(){
});

function addsub(perm_id){
	$("#myModal").toggle(500).modal('show');
	$("#modalform").empty();
	$("#titlemodal").text("Add Sub Permission");
	$.get(BASE_URL + 'index.php/perms/modal_sub', function(data){
		$("#modalform").html(data);
		$("input[name='parent_id']").val(perm_id);
	});
}
