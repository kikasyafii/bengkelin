<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<div class="page-header">
	<h1>Tambah Produk <small><?php echo $resBengkel[0]->nama_bengkel; ?></small></h1>
</div>
<?php
$form = Tb::form(array('type' => Tb::FORM_TYPE_INLINE,));
echo form_hidden('bengkel_id', $bengkel_id);
echo $form->textFieldRow('query', 'Search', array('placeholder' => 'Pencarian'));
echo '&nbsp;&nbsp;';
echo form_submit('show', 'Cari','class="btn btn-primary btn-sm"');
echo '&nbsp;&nbsp;&nbsp;';
echo anchor('bengkel/add_product/'.$bengkel_id,Tb::icon(Tb::ICON_PLUS).' Tambah Produk','class="btn btn-primary btn-sm"');
echo '&nbsp;&nbsp;';
echo anchor('bengkel/dashboard/', '<span class="clip-arrow-left-2"></span> Kembali ke List Bengkel / Showroom', 'class="btn btn-info btn-sm"'); 
$form->end();
?>
<br>
<table class="table table-condensed table-stripped">
	<thead>
		<tr bgcolor="#CFCFCF">
			<th class="center">Gambar Produk</th>
			<th class="center">Nama Produk</th>
			<th class="center">Deskripsi</th>
			<th class="center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($result): ?>
		<?php foreach($result as $row): ?>
		<tr>
			<td class="center">
				<?php if ($row->file_produk == ''): ?>
					<img src="<?php echo base_url().'assets/images/galleries/product/items.png'; ?>" alt="Belum Ada Gambar">
				<?php else: ?>
					<img src="<?php echo base_url().'assets/images/galleries/product/thumb/'.$row->thumb_produk; ?>" alt="Produk <?php echo $row->nama_produk; ?>">
				<?php endif; ?>
			</td>
			<td class="center"><?php echo $row->nama_produk; ?></td>
			<td class="center"><?php echo $row->deskripsi; ?></td>
			<td class="center">
				<?php echo anchor('bengkel/edit_produk/'.$row->id_produk, Tb::icon(Tb::ICON_EDIT), 'class="btn btn-primary btn-sm"'); ?>
				&nbsp;&nbsp;
				<?php echo anchor('bengkel/delete_produk/'.$row->id_produk, Tb::icon(Tb::ICON_TRASH), 'class="btn btn-danger btn-sm" onclick="javascript:xconfirm=confirm(\'Apakah Anda yakin ingin menghapus produk '.$row->nama_produk.'?\');if(xconfirm == true) { return true;} else { return false;};"'); ?>
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
