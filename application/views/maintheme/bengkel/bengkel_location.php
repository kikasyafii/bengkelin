<?php 
$data['header_content'] = '
<script type="text/javascript">var BASE_URL = "'.base_url().'";</script>
<script type="text/javascript">
		var centreGot = false;
</script>
<script type="text/javascript">
	function updateDatabase(newLat, newLng)
	{
		// make an ajax request to a PHP file
		// on our site that will update the database
		// pass in our lat/lng as parameters
		$.post( BASE_URL+ "index.php/bengkel/save_venue_location", 
			{ \'lat\': newLat, \'lng\': newLng, \'bengkel_id\': \''.$bengkel_id.'\' }
		)
		.done(function(data) {
			$("#error").removeAttr("class");
			$("#error").attr("class", "alert alert-info");
			$("#error").html("Lokasi berhasil disimpan");
		}).fail(function(xhr, textStatus, errorThrown){
			$("#error").removeAttr("class");
			$("#error").attr("class", "alert alert-danger");
			$("#error").html("Ada kesalahan di database");
		});
	}
</script>
	'.$map['js'];;
$this->load->view('maintheme/header',$data); ?>
<div class="box">
	<div class="box-content">
		<h4>Lokasi Bengkel</h4>
		<div id="error" class="alert alert-info hide"></div>
		<?php echo form_open('bengkel/bengkel_location', array('class' => 'form-horizontal')); ?>
		<?php echo form_hidden('bengkel_id',$bengkel_id); ?>
		<div class="form-group">
			<div class="col-md-1">
				<label for="location">Lokasi</label>
			</div>
			<div class="col-md-4">
				<?php echo form_input('location', $location, 'class="form-control input-sedang" id="location"'); ?>
			</div>
			<div class="col-md-3">
				<div style="float:left;display:inline;">
				<?php echo form_submit('go', 'Go', 'class="btn btn-primary btn-sm"'); ?> &nbsp;
				&nbsp;<?php echo anchor('bengkel/bengkel_profile', 'Kembali ke My Bengkel'); ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php echo form_close(); ?>
		<hr>
		<p>Gerakkan pointer ke tempat yang ingin Anda pindahkan.</p>
		<?php echo $map['html'];  ?>
	</div>
</div>
<?php $this->load->view('maintheme/footer'); 
