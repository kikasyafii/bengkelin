<?php $this->load->view('maintheme/header'); ?>
<div class="box">
	<div class="box-content">
		<div class="wrapper_1">
			<div class="slider_wrapper">
				<div class="home_slider">
					<div class="slider slider_1">
						<?php if ($resultPromo): ?>
						<?php foreach($resultPromo as $row) : ?>
						<div class="slide">
							<img src="<?php echo base_url().'assets/images/galleries/promo/'.$row->file_promo; ?>" alt=""/>
							<div class="description">
								<h2 class="title"><?php echo $row->judul_promo; ?></h2>
								<p class="desc"><?php echo $row->sinopsis; ?></p>
							</div>
						</div>
						<?php endforeach; ?>
						<?php else: ?>
						
						
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="search_auto_wrapper">
				<div class="search_auto">
					<?php echo form_open('welcome/index'); ?>
					<h3><strong>Search</strong> Bengkel</h3>
					<div class="clear"></div>
					<label><strong>Jenis Bengkel:</strong></label>
					<div class="select_box_1">
						<?php echo form_dropdown('jenis_id', $arrJenis, $jenis_id, 'class="select_1"'); ?>
					</div>
					<label><strong>Nama Bengkel:</strong></label>
					<div class="select_box_1">
						<?php echo form_input('nama_bengkel', $nama_bengkel, 'placeholder="Nama Bengkel" class="form-control input-sedang"'); ?>
					</div>
					<label><strong>Alamat Bengkel:</strong></label>
					<div class="select_box_1">
						<?php echo form_input('alamat', $alamat, 'placeholder="Alamat Bengkel" class="form-control input-sedang"'); ?>
					</div>
					<label><strong>Kota:</strong></label>
					<div class="select_box_1">
						<?php echo form_input('kota', $kota, 'placeholder="Kota" id="kota" class="form-control input-sedang"'); ?>
					</div>
					<label><strong>Propinsi:</strong></label>
					<div class="select_box_1">
						<?php echo form_input('propinsi', $propinsi, 'placeholder="Propinsi" id="propinsi" class="form-control input-sedang"'); ?>
					</div>
					<?php echo form_submit('go', 'Cari', 'class="btn_search"'); ?>
					<?php echo form_close(); ?>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<h2><strong>Kota</strong></h2>
		<?php if ($bengkelkota): ?>
		<?php foreach($bengkelkota as $kota): ?>
			<?php echo anchor('bengkel/city/'.$kota->city, '<strong>'.$kota->city.'</strong>', 'class="btn btn-info btn-mn"'); ?>
		<?php endforeach;?>
		<?php endif; ?>
		<br>
		<br>
		<h2><strong>Daftar Bengkel</strong></h2>
		<?php if ($result) : ?>
		<?php foreach($result as $row): ?>
			<div class="col-md-3 left post_block">
				<?php 
				if ($row->thumb_file == ''){
					$thumbfile = base_url().'assets/images/icons/bengkel.png';
				}else{
					$thumbfile = base_url().'assets/images/galleries/bengkel/thumb/'.$row->thumb_file;
				} ?>
				<img src="<?php echo $thumbfile; ?>"><br>
				<strong><?php echo $row->nama_bengkel; ?></strong><br>
				<?php 
				$arr = array();
				if ($row->alamat_bengkel != ''){
					$arr[] = $row->alamat_bengkel; 
				}
				
				if ($row->city != ''){
					$arr[] = $row->city;
				}
				
				if ($row->propinsi != ''){
					$arr[] = $row->propinsi; 
				}
				
				if ($row->telp != ''){
					$arr[] = $row->telp;
				}
				
				echo implode(", ", $arr);
				?>
			</div>
		<?php endforeach; ?>
		<?php else: ?>
			<div class="col-md-12">Belum Ada List</div>
		<?php endif; ?>
		<div class="clearfix"></div>
		<div align="center">
			<?php echo $links; ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<?php 
$data['footer_content'] = '
<script type="text/javascript"> var BASE_URL = "'.base_url().'";</script>
<script type="text/javascript" src="'.base_url().'index.php/users/cities_json"></script>
<script type="text/javascript" src="'.base_url().'index.php/users/states_json"></script>
<script type="text/javascript">

	$("#kota").autocomplete({
		source: Cities,
		minLength: 2
	});
	
	$("#propinsi").autocomplete({
		source: States,
		minLength: 2
	});
	
	$("#kota").blur(function(){
		
		$.get(BASE_URL + "index.php/users/get_state?city=" + $("#kota").val(), function(data){
			$("#propinsi").val(data);
		});
	});
</script>
';
$this->load->view('maintheme/footer',$data);
