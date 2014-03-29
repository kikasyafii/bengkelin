<?php $this->load->view('maintheme/header'); ?>
<div class="box">
	<div class="box-content">
		<div class="form-horizontal">
			<div class="col-md-2">
			<h3>Profile Bengkel</h3>
			</div>
			<div class="col-md-8">
			</div>
			<div class="clearfix"></div>
		<hr>
		<?php if ($resBengkel) : ?>
		<div class="col-md-2">
			<?php echo anchor('gallery/gallery_bengkel/'.$resBengkel[0]->username, 'Gallery Bengkel', 'class="btn btn-info btn-sm"'); ?>
			<br>
			<br>
			<?php echo anchor('bengkel/bengkel_location/'.$resBengkel[0]->username, 'Setting Map Venue', 'class="btn btn-info btn-sm"'); ?>
			<br>
			<br>
			<?php //echo anchor('bengkel/promo', 'Promo Bengkel', 'class="btn btn-info btn-sm"'); ?>
		</div>
		<div class="col-md-9 left-bordering">
			<div class="form-group">
				<div class="col-md-2"><label>Nama Bengkel</label></div>
				<div class="col-md-8"><p><?php echo $resBengkel[0]->nama_bengkel; ?></p></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label>Jenis Bengkel</label></div>
				<div class="col-md-8"><p><?php echo $resBengkel[0]->nama_jenis; ?></p></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label>Alamat Bengkel</label></div>
				<div class="col-md-8"><p><?php echo $resBengkel[0]->alamat_bengkel; ?></p></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label>Kota</label></div>
				<div class="col-md-8"><p><?php echo $resBengkel[0]->city; ?></p></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label>Propinsi</label></div>
				<div class="col-md-8"><p><?php echo $resBengkel[0]->propinsi; ?></p></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label>Negara</label></div>
				<div class="col-md-8"><p><?php echo $resBengkel[0]->country; ?></p></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label>Kode Pos</label></div>
				<div class="col-md-8"><p><?php echo $resBengkel[0]->zippostal; ?></p></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label>Email</label></div>
				<div class="col-md-8"><p><?php echo $resBengkel[0]->email; ?></p></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label>Telepon</label></div>
				<div class="col-md-8"><p><?php echo $resBengkel[0]->telp; ?></p></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label>Fax</label></div>
				<div class="col-md-8"><p><?php echo $resBengkel[0]->fax; ?></p></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><label>Keterangan Singkat</label></div>
				<div class="col-md-8"><p><?php echo $resBengkel[0]->deskripsi; ?></p></div>
				<div class="clearfix"></div>
			</div>
		</div>
		<?php else : ?>
			<?php if ($username == '' || $username == $this->bengkelin_auth->user[0]->username): ?>
			<div class="alert alert-info">
				<p>Anda belum mengisi profile bengkel. Silakan edit profile bengkel terlebih dulu. </p>
				<br>
				<?php echo anchor('bengkel/edit_profile', 'Edit Profile Bengkel', 'class="btn btn-info btn-sm"'); ?>
			</div>
			<?php else: ?>
			<div class="alert alert-info">
				<p>User ini belum mengisi profile bengkelnya</p>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		</div>
	</div>
</div>
<?php $this->load->view('maintheme/footer');
