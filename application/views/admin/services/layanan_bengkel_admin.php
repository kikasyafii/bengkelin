<?php $this->load->view('admin/header'); ?>
<div class="page-header">
	<h1>Layanan-layanan</h1>
</div>
<?php echo anchor('bengkel/profile/'.$bengkel_id, '<i class="clip-arrow-left"></i> Kembali ke Profile', 'class="btn btn-info btn-sm"');  ?>&nbsp;&nbsp;
<?php echo anchor('services/add_layanan_bengkel/'.$bengkel_id, Tb::icon(Tb::ICON_PLUS).' Tambah Layanan', 'class="btn btn-primary btn-sm"'); ?>
<br>
<br>
<table class="table table-condensed table-stripped">
	<thead>
		<tr bgcolor='#CFCFCF'>
			<th class="center">Nama Layanan</th>
			<th class="center">Deskripsi</th>
			<th class="center">Action</th>
		</tr>
	</thead>
	<tbody>
	<?php if ($result): ?>
	<?php foreach($result as $row): ?>
		<tr>
			<td class="center"><?php echo $row->judul_layanan; ?></td>
			<td class="center"><?php echo $row->konten; ?></td>
			<td class="center">
			<?php echo anchor('services/edit?id='.$row->service_id, Tb::icon(Tb::ICON_EDIT), 'class="btn btn-info btn-sm" title="EDIT"'); ?> &nbsp;&nbsp;
			<?php echo anchor('services/delete?id='.$row->service_id, Tb::icon(Tb::ICON_TRASH), 'class="btn btn-danger btn-sm" title="Delete" onclick="xconfirm=confirm(\'Apakah Anda yakin menghapus layanan ini?\');if (xcofirm==true){return true;} else {return false;}"'); ?>
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
<?php $this->load->view('admin/footer'); 
