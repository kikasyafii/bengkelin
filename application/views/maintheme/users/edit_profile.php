<?php $this->load->view('maintheme/header'); ?>
<div class="box">
	<div class="box-content">
		<div class="form-horizontal">
		<div class="form-group">
		<div class="col-md-2">
		<h4>Profile</h4>
		</div>
		<div class="col-md-8">
			<div class="pull-right">
				
			</div>
		</div>
		<div class="clearfix"></div>
		</div>
		<hr>
		<?php echo form_open('users/save_profile'); ?>
		<div class="col-md-2">
			<?php if ($resGallery): ?>
				<a href="<?php echo base_url();?>assets/images/galleries/users/<?php echo $resGallery[0]->name_file; ?>"><img src="<?php echo base_url(); ?>assets/images/galleries/users/thumb/<?php echo $resGallery[0]->thumb_file;?>" width="150"></a>
			<?php else: ?>
				<img src="<?php echo base_url(); ?>assets/images/galleries/user-icon-128.png">
			<?php endif; ?>
			<br>
			<br>
			<?php echo anchor('gallery/gallery_profile', 'Ubah Foto Profile', 'class="btn btn-info btn-md"'); ?>
			<br>
			<br>
			<?php echo anchor('users/edit_password_profile', 'Ubah Password', 'class="btn btn-info btn-md"'); ?>
		</div>
		<div class="col-md-9">
			<div class="form-group">
				<div class="col-md-2"><label for="username" class="label-control">Username</label></div>
				<div class="col-md-8"><?php echo $profile->username; ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="first_name" class="label-control">Nama Depan</label></div>
				<div class="col-md-8"><?php echo form_input('first_name', $profile->first_name, 'class="form-control input-sedang" id="first_name"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="last_name" class="label-control">Nama Belakang</label></div>
				<div class="col-md-8"><?php echo form_input('last_name', $profile->last_name, 'class="form-control input-sedang" id="last_name"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><strong>Tanggal Lahir</label></div>
				<div class="col-md-8">
				<?php 
				list($y,$m,$d) = explode("-", $profile->bdate);
				$d = ($d == '00') ? date('d') : $d;
				$d = ($d == '00') ? date('m') : $m;
				echo form_dropdown('d', $date, $m,'class="input-select input-pendek" id="date"' ).' - ' .form_dropdown('m', $month, $m, 'class="input-select input-pendek" id="month"').' - '. form_dropdown('y', $year, $y, 'class="input-select input-pendek" id="year"'); ?>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="email">Email</label></div>
				<div class="col-md-8"><?php echo form_input('email', $profile->email, 'class="form-control input-sedang" id="email"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="alamat">Alamat</label></div>
				<div class="col-md-8"><?php echo form_input('alamat', $profile->alamat, 'class="form-control input-panjang" id="alamat"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="kota">Kota</label></div>
				<div class="col-md-8"><?php echo form_input('kota', $profile->kota, 'class="form-control input-sedang" id="kota"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="propinsi">Propinsi</label></div>
				<div class="col-md-8"><?php echo form_input('propinsi', $profile->propinsi, 'class="form-control input-sedang" id="propinsi"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="negara">Negara</label></div>
				<div class="col-md-8"><?php echo form_input('negara',$profile->negara, 'class="form-control input-sedang" id="negara"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="zippostal">Kode Pos</label></div>
				<div class="col-md-8"><?php echo form_input('zippostal', (empty($profile->zippostal) ? '-' : $profile->zippostal), 'class="form-control input-sedang" id="zippostal"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="phone">Phone</label></div>
				<div class="col-md-8"><?php echo form_input('phone', $profile->phone, 'class="form-control input-sedang" id="phone"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					<?php echo form_submit('save', 'Simpan Profile', 'class="btn btn-primary btn-sm"'); ?>
					&nbsp;&nbsp;
					<?php echo anchor('users/profile', 'Cancel', 'class="btn btn-default btn-sm"'); ?>
				</div>
			</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<div class="clearfix"></div>
		&nbsp;
	</div>
</div>
<?php 
$data['footer_content'] = '
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
	
	$("negara").autocomplete({
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
</script>
';
$this->load->view('maintheme/footer',$data); 
