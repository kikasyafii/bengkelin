<?php 
$data['header_content'] = '
<script type="text/javascript">var BASE_URL = "'.base_url().'";</script>
<script type="text/javascript">
		var centreGot = false;
</script>
<script type="text/javascript">
	function updateDatabase(newLat, newLng)
	{
		console.log("DAMN");
		// make an ajax request to a PHP file
		// on our site that will update the database
		// pass in our lat/lng as parameters
		$.post( BASE_URL+ "index.php/bengkel/save_venue_location", 
			{ \'lat\': newLat, \'lng\': newLng, \'bengkel_id\': \''.$bengkel_id.'\' }
		)
		.done(function(data) {
			$("#error").removeAttr("class");
			$("#error").attr("class", "alert alert-info");
			$("#error").html("Lokasi berhasil disimpan <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>");
		}).fail(function(xhr, textStatus, errorThrown){
			$("#error").removeAttr("class");
			$("#error").attr("class", "alert alert-danger");
			$("#error").html("Ada kesalahan di database <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>");
		});
	}
</script>
	'.$map['js'];;
$this->load->view('admin/header',$data); ?>
<div class="box">
	<div class="box-content">
		<div id="error" class="alert alert-info hidden"></div>
		<h3>Set Lokasi</h3>
		<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_INLINE, 'action' => 'bengkel/bengkel_venue?bengkel_id='.$bengkel_id));
		echo form_hidden('bengkel_id',$bengkel_id);
		echo $form->textFieldRow('location','Lokasi', array('placeholder' => 'Lokasi', 'class' => 'input-sedang', 'value' => $location));
		echo form_submit('go', 'Go', 'class="btn btn-primary btn-sm"');
		echo '&nbsp;&nbsp;';
		echo anchor('bengkel/dashboard', 'Back', 'class="btn btn-info btn-sm"'); 
		$form->end();
		?>
		<br>
		<?php echo $map['html']; ?>
	</div>
</div>
<?php 
$data['footer_content'] = '';
$this->load->view('admin/footer',$data); 
