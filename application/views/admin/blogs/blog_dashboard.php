<?php $this->load->view('admin/header'); ?>
	<div class="page-header">
		<h1>Manajemen Blogs </h1>
	</div>
	<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_INLINE)); 
	echo $form->textFieldRow('query', 'Pencarian', array('placeholder' => 'Query Pencarian', 'value' => $query, 'class' => 'input-sedang'));
	echo $form->dropDownListRow('Publish', 'is_publish', $is_publish, array('0' => 'Not Publish', '1' => 'Draft', '2' => 'Publish'));
	echo form_submit('cari', 'Cari', 'class="btn btn-primary btn-sm"');
	echo '&nbsp;&nbsp;';
	echo anchor('blogs/add', Tb::icon(Tb::ICON_PLUS). 'Blog Baru', 'class="btn btn-primary btn-sm"'); 
	$form->end();
	?>
	<br>
	<table class="table table-condendsed table-stripped">
		<thead>
		<tr bgcolor="#CFCFCF">
			<th class="center">Author</th>
			<th class="center">Judul</th>
			<th class="center">Sudah Publis</th>
			<th class="center">Tgl Terbit</th>
			<th class="center">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php if ($result): ?>
		<?php foreach($result as $row): ?>
			<tr>
				<td class="center"><?php echo $row->username; ?></td>
				<td class="center"><?php echo $row->judul_blog; ?></td>
				<td class="center"><?php 
				if ($row->is_publish == 0){
					echo 'Belum Publish';
				}elseif ($row->is_publish == 1){
					echo 'Draft'; 
				}else if ($row->is_publish == 2){
					echo 'Sudah Publish';
				}
				 ?></td>
				<td class="center"><?php echo $row->date_publish; ?> <?php echo $row->time_publish; ?></td>
				<td class="center">
					<?php echo anchor('blogs/edit?blog_id='.$row->blog_id, '<i class="clips-pencil"></i>'); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		<?php else: ?>
		<tr>
			<td class="center" colspan="5">Belum ada Blog yang diposting</td>
		</tr>
		<?php endif; ?>
		</tbody>
	</table>
<?php $this->load->view('admin/footer'); 
