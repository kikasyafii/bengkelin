<?php $this->load->view('admin/header'); ?>
<div class="page-header">
	<h1>Layanan
		<?php if (isset($bengkel_id) && $bengkel_id != ''): ?>
			<small><?php echo $resBengkel[0]->nama_bengkel; ?></small>
		<?php endif; ?>
	</h1>
</div>
<?php
$form = Tb::form(array('type' => Tb::FORM_TYPE_INLINE));

$arrBengkel = array('' => 'Semua List Bengkel');
foreach($resBengkel as $row){
	$arrBengkel[$row->bengkel_id] = $row->nama_bengkel;
}

echo $form->dropDownListRow('Bengkel', 'bengkel_id', $bengkel_id,  $arrBengkel, array('class' => 'input-sedang'));
echo $form->textFieldRow('query', 'Search', array('placeholder' => 'Pencarian'));
echo '&nbsp;&nbsp;';
echo form_submit('show', 'Cari','class="btn btn-primary btn-sm"');
echo '&nbsp;&nbsp;&nbsp;';
echo anchor('services/add_layanan_bengkel',Tb::icon(Tb::ICON_PLUS).' Tambah Layanan','class="btn btn-primary btn-sm"');
echo '&nbsp;&nbsp;&nbsp;';
echo anchor('bengkel/bengkel_profile', '<span class="clip-arrow-left-2"></span> Kembali ke List Bengkel &amp; Showroom', 'class="btn btn-info btn-sm"'); 
echo '&nbsp;&nbsp;&nbsp;';
echo anchor('users/profile', '<span class="clip-arrow-left-2"></span> Ke Profile', 'class="btn btn-info btn-sm"'); 
$form->end();
?>
<br>
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
					<?php echo anchor('services/user_edit/'.$row->bengkel_id.'/'.$row->service_id, /**Tb::icon(Tb::ICON_EDIT)**/ 'Edit Lauanan', 'class="btn btn-primary btn-sm" title="EDIT"'); ?>
					&nbsp;&nbsp;
					<?php echo anchor('gallery/gallery_layanan/'.$row->bengkel_id.'/'.$row->service_id, 'Gallery Layanan', 'class="btn btn-info btn-sm" title="GALLERY LAYANAN"' ); ?>
					</td>
					<td class="center">
					<?php echo anchor('services/user_delete/'.$row->bengkel_id.'/'.$row->service_id, 'Hapus', 'class="btn btn-danger btn-sm" title="Delete" onclick="xconfirm=confirm(\'Apakah Anda yakin menghapus layanan '.$row->judul_layanan.'?\');if (xcofirm==true){return true;} else {return false;}"'); ?>
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
