/***
* name File: group.js
* author: Santo Doni Romadhoni
* email: exblopz[at]gmail.com
* Abu Aisyah Licensed: 2014
* 
***/

$(document).ready(function(){
	
	$("#addgroup").click(function(){
		$("#myModal").toggle(500).modal('show');
		$("#modalform").empty();
		$("#titlemodal").text("Add Group");
		$.get(BASE_URL + 'index.php/groups/modal_add_group', function(data){
			$("#modalform").html(data);
		});
	});
});

function editgroup(id){
	$("#myModal").toggle(500).modal('show');
	$("#modalform").empty();
	$("#titlemodal").text("Edit Group");
	$.get(BASE_URL + 'index.php/groups/modal_edit_group?id='+id, function(data){
		$("#modalform").html(data);
	});
}
