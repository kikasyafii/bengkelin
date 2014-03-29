<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
	<div class="page-header">
		<h1>Tambah Layanan</h1>
	</div>
	<?php 
	$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'services/save_add_service', 'enctype' => 'multipart/form-data'));
	
	$arrBengkel = array();
	if ($resBengkel){
		foreach($resBengkel as $row){
			$arrBengkel[$row->bengkel_id] = $row->nama_bengkel;
		}
	}

	
	if ($resBengkel){
		echo $form->dropDownListRow('Nama Bengkel','bengkel_id','',$arrBengkel, array('class' => 'input-sedang'));
	}else{
		echo form_hidden('bengkel_id', $result[0]->bengkel_id);
	}
	echo $form->textFieldRow('judul_layanan', 'Nama Layanan', array('placeholder' => 'Nama Layanan', 'class' => 'input-sedang'));
	echo $form->textAreaRow('konten', 'Konten Layanan', array('style' => 'width:500px;height:80px;'));
	echo $form->fileFieldRow('gambar','Gambar Produk', array('class' => 'form-control input-sedang'));
	echo '<div class="col-lg-4 center">';
	echo form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"');
	echo '&nbsp;&nbsp;';
	echo anchor('services/layanan_bengkel', 'Kembali ke Layanan', 'class="btn btn-default btn-sm"');
	echo '</div>';
	$form->end();
	?>
<?php $this->load->view('admin/footer'); 
