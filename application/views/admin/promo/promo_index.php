<?php $this->load->view('admin/header'); ?>
	<div class="page-header">
		<h1>Manajemen Promo</h1>
	</div>
	<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_INLINE));
	echo $form->textFieldRow('judul_promo', 'Judul Promo', array('placeholder' => 'Judul Promo', 'class' => 'input-sedang'));
	echo $form->textFieldRow('query', 'Query', array('placeholder' => 'Content', 'class' => 'input-sedang'));
	echo form_submit('cari', 'Go', 'class="btn btn-info btn-sm"'). '&nbsp;&nbsp;';
	echo anchor('promo/add', Tb::icon(Tb::ICON_PLUS).' Tambah Promo', 'class="btn btn-primary btn-sm"');
	$form->end();
	?>
	<br>
	<table class="table table-condensed table-stripped">
		<thead>
		<tr bgcolor="#CFCFCF">
			<th class="center">Judul Promo</th>
			<th class="center">Sinopsis</th>
			<th class="center">Konten</th>
			<th class="center">Gambar</th>
			<th class="center">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php if ($result): ?>
		<?php foreach($result as $row): ?>
			<tr>
				<td class="center"><?php echo $row->judul_promo; ?></td>
				<td class="center"><?php echo $row->sinopsis; ?></td>
				<td class="center"><?php echo $row->content; ?></td>
				<td class="center"><?php 
					if ($row->file_thumb != ''){
						echo '<img src="'.base_url().'assets/images/galleries/promo/thumb/'.$row->file_thumb.'">'; 
					}else{
						echo 'No Image';
					}
				?></td>
				<td class="center">
					<?php echo anchor('promo/edit?promo_id='.$row->promo_id, Tb::icon(Tb::ICON_EDIT), 'title="EDIT" class="btn btn-info btn-sm"') ?>&nbsp;&nbsp;
					<?php echo anchor('promo/delete?promo_id='.$row->promo_id, Tb::icon(Tb::ICON_TRASH), 'title="DELETE" class="btn btn-danger btn-sm" onclick="javascript:xconfirm=confirm(\'Apakah Anda ingin menghapus '.$row->judul_promo.'?\');if (xconfirm==true) { return true;} else { return false; }"') ?>
				</td>
			</tr>
		<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="5" class="center">No Result</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>
	<br>
	<div class="center">
	<?php echo $links; ?>
	</div>
<?php $this->load->view('admin/footer'); 
