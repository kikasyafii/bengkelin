<?php 
$data['header_content'] = '
	<link rel="stylesheet" href="'.base_url().'assets/clipone/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
	<link rel="stylesheet" href="'.base_url().'assets/clipone/plugins/bootstrap-social-buttons/social-buttons-3.css">
';
$this->load->view('admin/header'); ?>
	<div class="page-header">
		<h1>Edit Bengkel / Show Room Profile</h1>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tab-content">
				<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'bengkel/save_profile')); ?>
				<?php echo form_hidden('bengkel_id', $bengkel_id); ?>
				<div class="row">
					<div class="box-content">
						<div class="col-md-12">
							<div style="float:right;">
							<?php echo anchor('bengkel/bengkel_profile', '<i class="clip-arrow-left"></i> Kembali ke List Bengkel &amp; ShowRoom', 'class="btn btn-info btn-sm"'); ?>&nbsp;&nbsp;
							<?php echo anchor('bengkel/profile/'.$bengkel_id, '<i class="clip-arrow-left"></i> Ke Profile', 'class="btn btn-info btn-sm"'); ?>
							</div>
							<h3>Informasi Akun</h3>
							<hr>
						</div>
						<div class="col-md-6">
							<label class="control-label" for="nama_bengkel">Nama Bengkel / Showroom</label>
							<?php echo form_input('nama_bengkel', $resBengkel[0]->nama_bengkel, 'class="form-control" id="first_name"'); ?>
							<br>
							<label class="control-label" for="alamat_bengkel">Alamat Bengkel</label>
							<?php echo form_input('alamat_bengkel', $resBengkel[0]->alamat_bengkel, 'class="form-control" id="last_name"'); ?>
							<br>
							<label class="control-label" for="alamat_bengkel">Jenis Bengkel</label>
							<?php echo form_dropdown('jenis_id', $arrJenis, $resBengkel[0]->jenis_id, 'class="form-control"' ); ?>
							<br>
							<label class="control-label" for="email">Email</label>
							<?php echo form_input('email', $resBengkel[0]->email, 'class="form-control" id="email"'); ?>
							<br>
							<label class="control-label" for="telp">Telp</label>
							<?php echo form_input('telp', $resBengkel[0]->telp, 'class="form-control" id="telp"'); ?>
							<br>
							<label class="control-label" for="fax">Fax</label>
							<?php echo form_input('fax', $resBengkel[0]->fax, 'class="form-control" id="fax"'); ?>
							<br>
							<label class="control-label" for="city">Kota</label>
							<?php echo form_input('kota', $resBengkel[0]->city, 'class="form-control" id="kota"'); ?>
							<br>
							<label class="control-label" for="propinsi">Propinsi</label>
							<?php echo form_input('propinsi', $resBengkel[0]->propinsi, 'class="form-control" id="propinsi"'); ?>
							<br>
							<label class="control-label" for="country">Negara</label>
							<?php echo form_input('negara', $resBengkel[0]->country, 'class="form-control" id="negara"'); ?>
							<br>
							<label class="control-label" for="zippostal">Kode Pos</label>
							<?php echo form_input('zippostal', $resBengkel[0]->zippostal, 'class="form-control" id="zippostal"'); ?>
							<br>
						</div>
						<div class="col-md-6">
							<div class="form-inline">
								<label class="control-label">Deskripsi Singkat</label>
								<?php echo form_textarea(array('name' => 'deskripsi', 'value' => $resBengkel[0]->deskripsi, 'class' => 'form-control')); ?>
							</div>
							<table class="table table-condensed table-hover">
							<tr>
								<th>
									<span style="float:left">Lokasi</span>
									<span style="float:right"><?php echo anchor('bengkel/bengkel_venue_profile/'.$resBengkel[0]->bengkel_id, 'Edit lokasi', 'class="btn btn-primary btn-sm"'); ?></span>
								</th>
							</tr>
							<tr>
								<td>
								<?php echo $map['html']; ?>
								</td>
							</tr>
						</table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<hr>
					<?php echo form_submit('save', 'Simpan Perubahan', 'class="btn btn-primary btn-sm"'); ?>
					</div>
				</div>
				<?php $form->end(); ?>
			</div>
		</div>
	</div>
<?php 
$data['footer_content'] = '<script type="text/javascript">var BASE_URL = "'.base_url().'"; </script>
<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.position.js"></script>
<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.menu.js"></script>
<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.autocomplete.js"></script>
<script src="'.base_url().'assets/clipone/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script src="'.base_url().'assets/clipone/plugins/jquery.pulsate/jquery.pulsate.min.js"></script>
<script src="'.base_url().'assets/clipone/js/pages-user-profile.js"></script>
<script type="text/javascript" src="'.base_url().'index.php/users/cities_json"></script>
<script type="text/javascript" src="'.base_url().'index.php/users/states_json"></script>
<script type="text/javascript" src="'.base_url().'index.php/users/countries_json"></script>
<script type="text/javascript">

	$("#kota").autocomplete({
		source: Cities,
		minLength: 2
	});
	
	$("#propinsi").autocomplete({
		source: States,
		minLength: 2
	});
	
	$("#negara").autocomplete({
		source: Countries,
		minLength: 2
	});

	$("#kota").blur(function(){
		
		$.get(BASE_URL + "index.php/users/get_state?city=" + $("#kota").val(), function(data){
			$("#propinsi").val(data);
		});
	});
	
	$("#propinsi").blur(function(){
		$.get(BASE_URL + "index.php/users/get_country?state=" + $("#propinsi").val(), function(data){
			$("#negara").val(data);
		});
	});
	
	$("#year").blur(function(){
		var tahun = parseInt($("#year").val());
		
		if ($("#month").val() == "02"){
			if (tahun % 4 == 0){
				if ($("#date").val() > 29){
					alert("Isian Tanggal tidak benar!");
					$("#date").focus();
				}
			}else{
				if ($("#date").val() > 28){
					alert("Isian Tanggal tidak benar!");
					$("#date").focus();
				}
			}
		}
	});
	jQuery(document).ready(function() {
		Main.init();
		PagesUserProfile.init();
	});
</script>
'.$map['js'];
$this->load->view('admin/footer',$data); 
