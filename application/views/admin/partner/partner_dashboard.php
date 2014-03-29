<?php $this->load->view('admin/header'); ?>
	<div class="page-header">
		<h1>Manajemen Partner</h1>
	</div>
	<?php 
	$form = Tb::form(array('type' => Tb::FORM_TYPE_INLINE, 'action' => 'partners/dashboard'));
	echo $form->textFieldRow('query', 'Nama Partner', array('placeholder' => 'Nama Partner'));
	echo form_submit('save', 'Simpan', 'class="btn btn-info btn-sm"');
	echo '&nbsp;&nbsp;';
	echo anchor('partners/add', Tb::icon(Tb::ICON_PLUS).' Tambah Partner' , 'class="btn btn-primary btn-sm"');
	$form->end();
	?>
	<br>
	<table class="table table-condensed table-stripped">
		<thead>
			<tr bgcolor="#CFCFCF">
				<th class="center">Nama Partner</th>
				<th class="center">Deskripsi</th>
				<th class="center">Status</th>
				<th class="center">Logo</th>
				<th class="center">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php if ($result): ?>
		<?php foreach($result as $row): ?>
			<tr>
				<td class="center"><?php echo $row->nama_partner; ?></td>
				<td class="center"><?php echo $row->deskripsi; ?></td>
				<td class="center"><?php echo ($row->is_active == '1') ? 'Aktif' : 'Tidak Aktif'; ?></td>
				<td class="center"><img src="<?php echo base_url().'assets/images/galleries/partner/thumb/'.$row->thumb_file; ?>"></td>
				<td class="center">
					<?php echo anchor('partners/edit?id='.$row->partner_id, Tb::icon(Tb::ICON_EDIT),'class="btn btn-info btn-sm"'); ?>&nbsp;&nbsp;
					<?php echo anchor('partners/delete?id='.$row->partner_id, Tb::icon(Tb::ICON_TRASH), 'class="btn btn-danger btn-sm" onclick="javascript:xconfirm=confirm(\'Apakah Anda yakin mau menghapus Partner '.$row->nama_partner.'?\');if(xconfirm == true) { return true; } else { return false; } "'); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="4" class="center">No Result</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>
<?php $this->load->view('admin/footer'); 
