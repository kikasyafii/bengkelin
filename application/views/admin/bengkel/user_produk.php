<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<div class="page-header">
	<h1>Produk 
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
echo anchor('bengkel/user_add_product/',Tb::icon(Tb::ICON_PLUS).' Tambah Produk','class="btn btn-primary btn-sm"');
echo '&nbsp;&nbsp;&nbsp;';
echo anchor('bengkel/bengkel_profile', '<span class="clip-arrow-left-2"></span> Kembali ke List Bengkel &amp; Showroom', 'class="btn btn-info btn-sm"'); 
echo '&nbsp;&nbsp;&nbsp;';
echo anchor('users/profile', '<span class="clip-arrow-left-2"></span> Ke Profile', 'class="btn btn-info btn-sm"'); 
$form->end();
?>
<br>
<table class="table table-condensed table-stripped">
	<thead>
		<tr bgcolor="#CFCFCF">
			<th class="center">Gambar Produk</th>
			<th class="center">Nama Produk</th>
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
						<?php $resGallery = $this->bengkelin->get_produk_image($row->id_produk); ?>
						<?php if (!$resGallery): ?>
							<img src="<?php echo base_url().'assets/images/galleries/items.png'; ?>" alt="Belum Ada Gambar">
						<?php else: ?>
							<img src="<?php echo base_url().'assets/images/galleries/product/thumb/'.$resGallery->thumb_produk; ?>" alt="Produk <?php echo $row->nama_produk; ?>">
						<?php endif; ?>
							<div class="tools tools-bottom">
								<?php echo anchor('gallery/gallery_produk/'.$row->bengkel_id.'/'.$row->id_produk, '<i class="clip-pencil-2"></i> Edit Gallery'); ?>
							</div>
						</div>
					</div>
			</td>
			<td class="center"><?php echo $row->nama_produk; ?></td>
			<td><?php echo $row->deskripsi; ?></td>
			<td class="center">
				<?php echo anchor('bengkel/edit_produk/'.$row->bengkel_id.'/'.$row->id_produk, 'Edit Produk', 'class="btn btn-primary btn-sm"'); ?>
				&nbsp;&nbsp;
				<?php echo anchor('gallery/gallery_produk/'.$row->bengkel_id.'/'.$row->id_produk, 'Edit Gallery', 'class="btn btn-info btn-sm"'); ?>
			</td>
			<td class="center">
				<?php echo anchor('bengkel/delete_produk/'.$row->bengkel_id.'/'.$row->id_produk, Tb::icon(Tb::ICON_TRASH).' Hapus', 'class="btn btn-danger btn-sm" onclick="javascript:xconfirm=confirm(\'Apakah Anda ingin menghapus produk '.$row->nama_produk.'?\');if(xconfirm==true){return true;}else{return false;}"'); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php else : ?>
		<tr>
			<td colspan="4" class="center">No Result</td>
		</tr>
		<?php endif; ?>
	</tbody>
</table>
<?php $this->load->view('admin/footer'); 
