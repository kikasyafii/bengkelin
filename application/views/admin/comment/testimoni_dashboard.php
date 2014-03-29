<?php $this->load->view('admin/header'); ?>
<div class="page-header">
	<h1>Manajemen Testimoni</h1>
</div>
<?php 
$form = Tb::form(array('type' => Tb::FORM_TYPE_INLINE, 'value' => 'testimoni/dashboard')); 
echo $form->textFieldRow('query', 'Kueri', array('placeholder' => 'Kueri Pencarian'));
echo form_submit('cari', 'Cari', 'class="btn btn-primary btn-sm"');
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
			<th class="center">Action</th>
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
				<?php echo anchor('comments/edit_testimoni?id='.$row->testimoni_id, /**Tb::icon(Tb::ICON_EDIT)**/ 'Edit', 'title="EDIT" class="btn btn-info btn-sm"'); ?> &nbsp;&nbsp;
				<?php echo anchor('comments/delete_testimoni?id='.$row->testimoni_id, /**Tb::icon(Tb::ICON_TRASH)**/ 'Hapus', 'title="DELETE" class="btn btn-danger btn-sm" onclick="javascript:xconfirm=confirm(\'Apakah Anda yakin untuk menghapus komentar?\');if(xconfirm == true){return true;}else{return false;}"'); ?>
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
