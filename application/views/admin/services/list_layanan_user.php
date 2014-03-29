<?php $this->load->view('admin/header'); ?>
<div class="page-header">
	<h1>Layanan</h1>
</div>
<div class="row">
	<div class="col-md-12">
<?php echo anchor('services/add_layanan_bengkel/'.$bengkel_id, Tb::icon(Tb::ICON_PLUS).' Tambah Layanan', 'class="btn btn-primary btn-sm"'); ?>&nbsp;&nbsp;
<?php echo anchor('bengkel/bengkel_profile/', '<i class="clip-arrow-left"></i> Kembali ke List Bengkel &amp; Showroom', 'class="btn btn-info btn-sm"');  ?>&nbsp;&nbsp;
<?php echo anchor('bengkel/profile/'.$bengkel_id, '<i class="clip-arrow-left"></i> Ke Profile', 'class="btn btn-info btn-sm"');  ?>&nbsp;&nbsp;
	</div>
	<br>
	<br>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-condensed table-stripped">
			<thead>
				<tr bgcolor='#CFCFCF'>
					<th class="center"></th>
					<th class="center">Nama Layanan</th>
					<th class="center">Deskripsi</th>
					<th class="center">Edit</th>
					<th class="center">Hapus</th>
				</tr>
			</thead>
			<tbody>
			<?php if ($result): ?>
			<?php foreach($result as $row): ?>
				<tr>
					<td class="center">
						<div class="gallery-img">
							<div class="wrap-image">
							<?php $resGallery = $this->bengkelin->get_layanan_image($row->service_id); ?>
							<?php if (!$resGallery): ?>
								<img src="<?php echo base_url().'assets/images/galleries/items.png'; ?>" alt="Belum Ada Gambar">
							<?php else: ?>
								<img src="<?php echo base_url().'assets/images/galleries/service/thumb/'.$resGallery->thumb_layanan; ?>" alt="Layanan <?php echo $row->judul_layanan; ?>">
							<?php endif; ?>
								<div class="tools tools-bottom">
									<?php echo anchor('gallery/gallery_layanan/'.$row->bengkel_id.'/'.$row->service_id, '<i class="clip-pencil-2"></i> Edit Gallery'); ?>
								</div>
							</div>
						</div>
					</td>
					<td class="center"><?php echo $row->judul_layanan; ?></td>
					<td class="center"><?php echo $row->konten; ?></td>
					<td class="center">
					<?php echo anchor('services/user_edit/'.$row->bengkel_id.'/'.$row->service_id, /**Tb::icon(Tb::ICON_EDIT)**/ 'Edit', 'class="btn btn-primary btn-sm" title="EDIT"'); ?>
					&nbsp;&nbsp;
					<?php echo anchor('gallery/gallery_layanan/'.$row->bengkel_id.'/'.$row->service_id, 'Gallery Layanan', 'class="btn btn-primary btn-sm" title="GALLERY LAYANAN"' ); ?>
					</td>
					<td class="center">
					<?php echo anchor('services/user_delete/'.$row->bengkel_id.'/'.$row->service_id, 'Hapus', 'class="btn btn-danger btn-sm" title="Delete" onclick="xconfirm=confirm(\'Apakah Anda yakin menghapus layanan ini?\');if (xcofirm==true){return true;} else {return false;}"'); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="3" class="center">No Result</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<?php $this->load->view('admin/footer'); 
