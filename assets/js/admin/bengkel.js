/***
* name File: bengkel.js
* author: Santo Doni Romadhoni
* email: exblopz[at]gmail.com
* Abu Aisyah Licensed: 2014
* 
***/

$(document).ready(function(){

	$("#addbengkel").click(function(){
		$("#myModal").toggle(500).modal('show');
		$("#modalform").empty();
		$("#titlemodal").text("Add Bengkel");
		$.get(BASE_URL + 'index.php/bengkel/modal_add_bengkel', function(data){
			$("#modalform").html(data);
		});
	});
	
	$("#kota").autocomplete({
		source: Cities,
		minLength: 2
	});
	
	$("#negara").autocomplete({
		source: Countries,
		minLength: 2
	});

	$("#kota").blur(function(){
		
		$.get(BASE_URL + 'index.php/users/get_state?city=' + $("#kota").val(), function(data){
			$("#propinsi").val(data);
		});
	});
});

function editbengkel(id){
	$("#myModal").toggle(500).modal('show');
	$("#modalform").empty();
	$("#titlemodal").text("Edit Bengkel");
	$.get(BASE_URL + 'index.php/bengkel/modal_edit_bengkel?bengkel_id='+ id, function(data){
		$("#modalform").html(data);
	});
}

function detailbengkel(id){
	
	$("#tableDetail" + id).removeAttribute('class');
	$.get(BASE_URL + 'index.php/bengkel/detail_bengkel/' + id, function(data){
		$("#contentdetail" + id).html(data);
	});
	
}
