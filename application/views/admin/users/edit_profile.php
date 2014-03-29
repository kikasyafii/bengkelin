<?php 
$data['header_content'] = '
	<link rel="stylesheet" href="'.base_url().'assets/clipone/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
	<link rel="stylesheet" href="'.base_url().'assets/clipone/plugins/bootstrap-social-buttons/social-buttons-3.css">
';
$this->load->view('admin/header'); ?>
	<div class="page-header">
		<h1>Edit User Profile <?php echo $this->bengkelin_auth->user[0]->username; ?></h1>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tab-content">
				<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'users/save_profile')); ?>
				<div class="row">
					<div class="box-content">
						<div class="col-md-12">
							<div style="float:right;">
							<?php echo anchor('users/profile', '<i class="clip-arrow-left"></i> Kembali ke User Profile', 'class="btn btn-info btn-sm"'); ?>
							</div>
							<h3>Informasi Akun</h3>
							<hr>
						</div>
						<div class="col-md-6">
							<label class="control-label" for="first_name">Nama Depan</label>
							<?php echo form_input('first_name', $profile->first_name, 'class="form-control" id="first_name"'); ?>
							<br>
							<label class="control-label" for="last_name">Nama Belakang</label>
							<?php echo form_input('last_name', $profile->last_name, 'class="form-control" id="last_name"'); ?>
							<br>
							<label class="control-label" for="email">Email</label>
							<?php echo form_input('email', $profile->email, 'class="form-control" id="email"'); ?>
							<br>
							<label class="control-label" for="telp">Telp</label>
							<?php echo form_input('phone', $profile->phone, 'class="form-control" id="telp"'); ?>
							<br>
							<label class="control-label">Gender</label>
							<?php echo form_dropdown('sex', array('1' => 'Pria', '2'=> 'Wanita', '3' => 'Tidak bilang'), $profile->sex, 'class="form-control form-sedang"'); ?>
							<label class="control-label" for="password1">Password</label>
							<?php echo form_password('password1', '', 'class="form-control" id="password1"'); ?>
							<br>
							<label class="control-label" for="password2">Ulangi Password</label>
							<?php echo form_password('password2', '', 'class="form-control" id="password2"'); ?>
							(* Isi hanya kalau ingin mengubah password
							<br>
						</div>
						<div class="col-md-6">
							<div class="form-inline">
								<label class="control-label">Tanggal Lahir</label>
								<br>
								<?php 
								$bdate = (empty($profile->bdate) ? '0000-00-00' : $profile->bdate); 
								list($y,$m,$d) = explode("-", $bdate);
								$d = ($d == '00') ? date('d') : $d;
								$d = ($d == '00') ? date('m') : $m;
								echo form_dropdown('d', $date, $m,'class="input-pendek form-control" style="width:120px;" id="date"' ).'&nbsp;&nbsp;&nbsp;&nbsp;' .form_dropdown('m', $month, $m, 'class="input-pendek form-control" style="width:120px;" id="month"').'&nbsp;&nbsp;&nbsp;&nbsp;'. form_dropdown('y', $year, $y, 'class="input-pendek form-control" style="width:120px;" id="year"'); ?>
							</div>
							<br>
							<label class="control-label">Alamat</label><br>
							<?php echo form_input('alamat', $profile->alamat, 'class="form-control" id="alamat"'); ?>
							<br>
							<label class="control-label">Kota</label><br>
							<?php echo form_input('kota', $profile->kota, 'class="form-control" id="kota"'); ?>
							<br>
							<label class="control-label">Propinsi</label><br>
							<?php echo form_input('propinsi', $profile->propinsi, 'class="form-control" id="propinsi"'); ?>
							<br>
							<label class="control-label">Negara</label><br>
							<?php echo form_input('negara', $profile->negara, 'class="form-control" id="negara"'); ?>
							<br>
							<label class="control-label">Kodepos</label><br>
							<?php echo form_input('zippostal', $profile->zippostal, 'class="form-control" id="zippostal"'); ?>
							<br>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
							<h3>Informasi Tambahan</h3>
						<hr>
					</div>
					<div class="col-md-6">
						<label class="control-label">Facebook</label>
						<?php echo form_input('facebook', $profile->facebook, 'class="form-control"'); ?>
						<br>
						<label class="control-label">Twitter</label>
						<?php echo form_input('twitter', $profile->twitter, 'class="form-control"'); ?>
						<br>
						<label class="control-label">Gplus</label>
						<?php echo form_input('gplus', $profile->gplus, 'class="form-control"'); ?>
						<br>
						<label class="control-label">Path</label>
						<?php echo form_input('path', $profile->path, 'class="form-control"'); ?>
						<br>
						<label class="control-label">Linkedin</label>
						<?php echo form_input('linkedin', $profile->linkedin, 'class="form-control"'); ?>
						<br>
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
';
$this->load->view('admin/footer',$data); 
