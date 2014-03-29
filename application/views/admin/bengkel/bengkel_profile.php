<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
	<div class="page-header">
		<div class="col-sm-4 col-md-4">
		<?php if ($resBengkel): ?>
			<h1>Profile <?php echo ucwords($arrJenis[$resBengkel[0]->jenis_id]); ?> <small><?php echo $resBengkel[0]->nama_bengkel; ?></small></h1>
		<?php else: ?>
			<h1>Profile Bengkel / Showroom</h1>
		<?php endif; ?>
		</div>
		<div class="col-sm-7 col-md-7">
		<span style="float:right;"><?php echo anchor('bengkel/bengkel_profile', '<i class="clip-arrow-left"></i> Kembali ke Daftar Bengkel / ShowRoom', 'class="btn btn-info btn-sm"'); ?></span>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="row">
		<div class="col-sm-7 col-md-6">
			<div class="user-left">
				<?php if ($resBengkel): ?>
				<div class="center">
					<span style="float:right;"><?php echo anchor('bengkel/edit_profile/'.$resBengkel[0]->bengkel_id, '<i class="clip-pencil-3"></i> Edit Profile', 'class="btn btn-sm btn-primary"'); ?></span>
					<div class="fileupload fileupload-new" data-provides="file-upload">
						<div class="user-image">
							<h4><?php echo $resBengkel[0]->nama_bengkel; ?></h4>
							<div class="fileupload-new thumbnail center">
								<?php if ($resGallery && $resGallery[0]->name_file != ''): ?>
								<img src="<?php echo base_url(); ?>assets/images/galleries/bengkel/<?php echo $resGallery[0]->name_file;?>" width="150">
								<?php else: ?>
								<img src="<?php echo base_url(); ?>assets/images/galleries/bengkel.png" width="150">
								<?php endif; ?>
							<br>
							<?php echo anchor('gallery/gallery_bengkel/'.$bengkel_id, Tb::icon(Tb::ICON_PLUS).' '.Tb::icon(Tb::ICON_PICTURE).'Tambah Foto Profile Bengkel', 'class="btn btn-primary btn-sm center"'); ?>
							</div>
						</div>
					<br>
					</div>
					<br>
				</div>
				<table class="table table-condensed table-hover">
					<tr>
						<th>Layanan</th>
						<th class="number"><?php echo anchor('services/layanan_bengkel/'.$bengkel_id, '<i class="clip-pencil-3"></i> Edit Layanan' , 'class="btn btn-info btn-sm"');  ?></th>
					</tr>
					<?php if ($resService): ?>
					<?php foreach($resService as $row): ?>
						<tr>
							<td><?php echo $row->judul_layanan; ?></td>
							<td><?php echo $row->konten; ?></td>
						</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr>
						<td colspan="2">Belum Ada Layanan</td>
					</tr>
					<?php endif; ?>
				</table>
				<?php else: ?>
					<p>Anda belum punya bengkel &amp; showroom. <?php echo anchor('bengkel/add_bengkel', '<i class="clip-pencil"></i> Tambah Bengkel / Showroom Baru', 'class="btn btn-primary btn-sm"'); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-5">
			<?php if ($resBengkel): ?>
			<table class="table table-condensed table-hover">
				<tr>
					<th colspan="2">Informasi Bengkel / Show Room</th>
				</tr>
				<tr>
					<td width="50%">Nama Bengkel</td>
					<td align="right"><?php echo $resBengkel[0]->nama_bengkel; ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td align="right"><?php echo $resBengkel[0]->alamat_bengkel; ?></td>
				</tr>
				<tr>
					<td>Kota</td>
					<td align="right"><?php echo $resBengkel[0]->city; ?></td>
				</tr>
				<tr>
					<td>Propinsi</td>
					<td align="right"><?php echo $resBengkel[0]->propinsi; ?></td>
				</tr>
				<tr>
					<td>Negara</td>
					<td align="right"><?php echo $resBengkel[0]->country; ?></td>
				</tr>
				<tr>
					<td>Kodepos</td>
					<td align="right"><?php echo $resBengkel[0]->zippostal; ?></td>
				</tr>
				<tr>
					<td valign="top">Deskripsi</td>
					<td align="right"><?php echo $resBengkel[0]->deskripsi; ?></td>
				</tr>
				<tr>
					<th colspan="2">Informasi Tambahan</th>
				</tr>
				<tr>
					<td>Phone</td>
					<td><?php echo $resBengkel[0]->telp; ?></td>
				</tr>
				<tr>
					<td>Fax</td>
					<td><?php echo $resBengkel[0]->fax; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo $resBengkel[0]->email; ?></td>
				</tr>
			</table>
			<br>
			<table class="table table-condensed table-hover">
				<tr>
					<th>Lokasi</span>
					</th>
				</tr>
				<tr>
					<td>
					<?php echo $map['html']; ?>
					</td>
				</tr>
			</table>
			<?php endif; ?>
		</div>
	</div>
<?php 
$data['footer_content'] = 
'<script type="text/javascript">var BASE_URL = "'.base_url().'";</script>
'.$map['js'];
$this->load->view('admin/footer',$data);
