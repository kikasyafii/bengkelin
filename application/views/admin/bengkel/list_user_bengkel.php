<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
	<div class="page-header">
		<h1>Profile Bengkel / Showroom</h1>
	</div>
<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_INLINE)); ?>
<?php echo $form->textFieldRow('query', 'Query', array('placeholder' => 'Search', 'class' => 'input-pendek')); ?>
<?php echo form_submit('Cari', 'cari', 'class="btn btn-primary btn-sm"'); ?>
&nbsp;&nbsp;&nbsp;
<?php echo anchor('bengkel/add_bengkel', Tb::icon(Tb::ICON_PLUS).' Tambah Bengkel / Showroom baru', 'class="btn btn-primary btn-sm"'); ?>
<?php $form->end(); ?>
<br>
<table class="table table-stripped">
	<thead>
		<tr bgcolor="#CFCFCF">
			<th class="center">Gallery Bengkel</th>
			<th class="center">Jenis Venue</th>
			<th class="center">Nama Bengkel</th>
			<th class="center">Alamat Bengkel</th>
			<th class="center">Email</th>
			<th class="center">Telp</th>
			<th class="center">Setting</th>
			<th class="center">Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($result) : ?>
		<?php foreach($result as $row): ?>
			<tr>
				<td class="center"><?php $image = $this->bengkelin->get_main_image_bengkel($row->bengkel_id);  ?>
					<div class="gallery-img">
						<div class="wrap-image">
							<?php if ($image): ?>
								<img src="<?php echo base_url().'assets/images/galleries/bengkel/thumb/'.$image->thumb_file?>">
							<?php else : ?>
								<img src="<?php echo base_url().'assets/images/galleries/bengkel.png'; ?>">
							<?php endif; ?>
							<div class="tools tools-bottom">
								<?php echo anchor('gallery/gallery_bengkel/'.$row->bengkel_id, '<i class="clip-pencil-2"></i> Gallery Bengkel'); ?>
							</div>
						</div>
					</div>
				</td>
				<td class="center"><?php echo anchor('bengkel/edit_profile/'.$row->bengkel_id, $arrJenis[$row->jenis_id]); ?>
				</td>
				<td class="center"><?php echo $row->nama_bengkel; ?></td>
				<td><?php echo $row->alamat_bengkel.' '.$row->city.' '.$row->propinsi; ?></td>
				<td class="center"><?php echo $row->email; ?></td>
				<td class="center"><?php echo $row->telp; ?></td>
				<td class='center'>
						<?php echo anchor('bengkel/profile/'.$row->bengkel_id, /**Tb::icon(Tb::ICON_SEARCH)**/ 'Preview', 'title="PREVIEW '.$row->nama_bengkel.'" class="btn btn-info btn-sm"'); ?>
						&nbsp;&nbsp;
						<?php echo anchor('bengkel/edit_profile/'.$row->bengkel_id, 'Edit Profile'/**Tb::icon(Tb::ICON_EDIT)**/, 'title="EDIT '.$row->nama_bengkel.'" class="btn btn-primary btn-sm"'); ?>
						&nbsp;&nbsp;
						<?php echo anchor('services/layanan_bengkel/'.$row->bengkel_id, /**'<span class="clip-wrench"></span>'**/ 'Layanan', 'title="Edit Layanan" class="btn btn-primary btn-sm"'); ?>
						&nbsp;&nbsp;
						<?php echo anchor('bengkel/user_product/'.$row->bengkel_id, /**'<span class="clip-tag-2"></span>' **/ 'Produk', 'title="TAMBAH PRODUK" class="btn btn-primary btn-sm"'); ?>
						&nbsp;&nbsp;
						<?php echo anchor('comments/user_testimoni/'.$row->bengkel_id, /**'<span class="clip-users-2"></span>' **/ 'Testimoni', 'class="btn btn-primary btn-sm"'); ?>
				</td>
				<td class="center">
					<?php echo anchor('bengkel/user_delete?bengkel_id='.$row->bengkel_id, /**Tb::icon(Tb::ICON_TRASH)**/ 'Hapus', 'title="DELETE '.$row->nama_bengkel.'" class="btn btn-danger btn-sm" onclick="javascript:xconfirm=confirm(\'Apakah Anda ingin menghapus bengkel '.$row->nama_bengkel.'?\');if(xconfirm==true){return true;}else{return false;}"'); ?>
					</td>
				</tr>
			</tr>
		<?php endforeach; ?>
		<?php else: ?>
		<tr>
			<td></td>
		</tr>
		<?php endif; ?>
	</tbody>
</table>
<?php $this->load->view('admin/footer'); 
