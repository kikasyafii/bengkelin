<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
	<div class="page-header">
		<h1>Profile Bengkel / Showroom</h1>
	</div>
	<div class="core-box">
		<div class="heading">
			<i class="clip-puzzle circle-icon circle-teal"></i>
			<h2>Belum Ada Profile?</h2>
		</div>
		<div class="content">
			<p>Profile Bengkel Anda masih kosong. Anda belum mengisi profile sama sekali. Isi profile baru? </p>
			<?php echo anchor('bengkel/add_bengkel', Tb::icon(Tb::ICON_PLUS).' Tambah Profile Baru', 'class="btn btn-primary btn-sm"'); ?>
		</div>
	</div>
<?php $this->load->view('admin/footer');
