<?php $this->load->view('admin/header'); ?>
<div class="page-header">
	<h1>Testimoni</h1>
</div>
<?php 
$form = Tb::form(array('type' => Tb::FORM_TYPE_INLINE, 'value' => 'testimoni/dashboard')); 
echo $form->textFieldRow('query', 'Kueri', array('placeholder' => 'Kueri Pencarian', 'value' => $query));
echo form_hidden('bengkel_id', $bengkel_id);
echo form_submit('show', 'Cari', 'class="btn btn-primary btn-sm"');
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
			<th class="center">Waktu Komentar</th>
			<th class="center">Nama</th>
			<th class="center">Email</th>
			<th class="center">Website</th>
			<th class="center">Perijinan</th>
			<th class="center">Komentar</th>
			<th class="center">Edit</th>
			<th class="center">Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($result): ?>
		<?php foreach($result as $row): ?>
			<tr>
				<td class="center"><?php echo $row->date_testimoni; ?></td>
				<td class="center"><?php echo $row->nama; ?></td>
				<td class="center"><?php echo $row->email; ?></td>
				<td class="center"><?php echo $row->website; ?></td>
				<td class="center"><?php echo ($row->approved == 1) ? 'Diijinkan':'Belum Diijinkan'; ?></td>
				<td class="center"><?php echo $row->konten; ?></td>
				<td class="center">
				<?php echo anchor('comments/user_edit_testimoni/'.$row->bengkel_id.'/'.$row->testimoni_id, /*Tb::icon(Tb::ICON_EDIT)*/ 'Edit', 'title="EDIT" class="btn btn-info btn-sm"'); ?>
				</td>
				<td class="center">
				<?php echo anchor('comments/user_delete_testimoni/'.$row->bengkel_id.'/'.$row->testimoni_id, /*Tb::icon(Tb::ICON_TRASH)*/ 'Hapus', 'title="DELETE" class="btn btn-danger btn-sm" onclick="javascript:xconfirm=confirm(\'Apakah Anda yakin untuk menghapus komentar?\');if(xconfirm == true){return true;}else{return false;}"'); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="6" class="center">Belum Ada Testimoni</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>
<?php $this->load->view('admin/footer');
