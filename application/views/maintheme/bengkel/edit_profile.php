<?php $this->load->view('maintheme/header'); ?>
<div class="box">
	<div class="box-content">
		<?php echo form_open('bengkel/save_profile',array('class' => 'form-horizontal')); ?>
		<?php echo form_hidden('bengkel_id',$resBengkel[0]->bengkel_id); ?>
		<h3>Edit Profile Bengkel</h3>
		<hr>
		<div class="col-md-2">
			<?php echo anchor('gallery/gallery_bengkel', 'Gallery Bengkel', 'class="btn btn-info btn-sm"'); ?>
			<br>
			<br>
			<?php echo anchor('bengkel/bengkel_location', 'Setting Map Venue', 'class="btn btn-info btn-sm"'); ?>
			<br>
			<br>
			<?php //echo anchor('bengkel/promo', 'Promo Bengkel', 'class="btn btn-info btn-sm"'); ?>
		</div>
		<div class="col-md-9 left-bordering">
			<div class="form-group">
				<div class="col-md-2"><label for="nama_bengkel">Jenis Bengkel</label></div>
				<div class="col-md-8"><?php echo form_dropdown('jenis_id', $arrJenis, '', 'class="form-control"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="nama_bengkel">Nama Bengkel</label></div>
				<div class="col-md-8"><?php echo form_input('nama_bengkel', $resBengkel[0]->nama_bengkel, 'class="form-control"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="alamat">Alamat Bengkel</label></div>
				<div class="col-md-8"><?php echo form_input('alamat_bengkel', $resBengkel[0]->alamat_bengkel, 'class="form-control"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="kota">Kota</label></div>
				<div class="col-md-8"><?php echo form_input('kota', $resBengkel[0]->city, 'class="form-control" id="kota"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="propinsi">Propinsi</label></div>
				<div class="col-md-8"><?php echo form_input('propinsi', $resBengkel[0]->propinsi, 'class="form-control" id="propinsi"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="negara">Negara</label></div>
				<div class="col-md-8"><?php echo form_input('negara', $resBengkel[0]->country, 'class="form-control" id="negara"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="zippostal">Kode Pos</label></div>
				<div class="col-md-8"><?php echo form_input('zippostal', $resBengkel[0]->zippostal, 'class="form-control"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="email">Email</label></div>
				<div class="col-md-8"><?php echo form_input('email', $resBengkel[0]->email, 'class="form-control"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="telp">Telephon</label></div>
				<div class="col-md-8"><?php echo form_input('telp', $resBengkel[0]->telp, 'class="form-control"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="fax">Fax</label></div>
				<div class="col-md-8"><?php echo form_input('fax', $resBengkel[0]->fax, 'class="form-control"'); ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label for="deskripsi">Keterangan Singkat</label></div>
				<div class="col-md-8"><?php echo form_textarea(array('name' => 'deskripsi', 'value' => $resBengkel[0]->deskripsi, 'class' => 'form-control', 'style' => 'width:400px;height:85px;')); ?></div>
			</div>
			<div class="form-group">
				<div class="col-md-8 center">
				<?php echo form_submit('save', 'Simpan Profile Bengkel','class="btn btn-primary btn-sm"'); ?>&nbsp;&nbsp;
				<?php echo anchor('bengkel/profile', 'Cancel', 'class="btn btn-default btn-sm"'); ?>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
</div>
<?php 
$data['footer_content'] = '
<script type="text/javascript">
	var BASE_URL = "'.base_url().'";
</script>
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
</script>
';
$this->load->view('maintheme/footer',$data);
