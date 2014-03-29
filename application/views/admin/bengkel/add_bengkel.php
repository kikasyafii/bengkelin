<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/jquery.ui.autocomplete.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<div class="page-header">
	<h1>Tambah Bengkel / Showroom</h1>
</div>
<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL,'action' => 'bengkel/save_add_bengkel_user'));
echo $form->dropDownListRow('Kategori Bengkel dan Showroom', 'jenis_id', '', $arrJenis,array('class' => 'input-sedang'));
echo $form->textFieldRow('nama_bengkel', 'Nama', array('placeholder' => 'Nama Bengkel / Show Room', 'class' => 'input-sedang')); 
echo $form->textFieldRow('alamat_bengkel', 'Alamat', array('placeholder' => 'Alamat','class' => 'input-panjang'));
echo $form->textFieldRow('city', 'Kota', array('placeholder' => 'Kota', 'id'=> 'kota', 'class' => 'input-pendek')); 
echo $form->textFieldRow('propinsi', 'Propinsi', array('placeholder' => 'Propinsi', 'id' => 'propinsi', 'class' => 'input-sedang'));
echo $form->textFieldRow('zippostal', 'Kodepos', array('placeholder' => 'KodePos', 'class' => 'input-sedang'));
echo $form->textFieldRow('country', 'Negara', array('placeholder' => 'Negara', 'id' => 'negara', 'class' => 'input-sedang'));
echo $form->textFieldRow('email', 'Email', array('placeholder' => 'Email', 'class' => 'input-sedang'));
echo $form->textFieldRow('telp', 'Telp', array('placeholder' => 'Telp', 'class' => 'input-sedang'));
echo $form->textFieldRow('fax', 'Fax', array('placeholder' => 'Fax', 'class' => 'input-sedang'));
echo $form->textAreaRow('deskripsi', 'Deskripsi', array('style' => 'height:70px;width:550px;')); 
echo '<div class="form-group">
	<div class="col-lg-4 center">'.form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"').
	'</div></div>';
$form->end();
?>
<?php 
$data['footer_content'] = '<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.position.js"></script>
<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.menu.js"></script>
<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.autocomplete.js"></script>
<script type="text/javascript">
	var BASE_URL = "'.base_url().'";
</script>
<script type="text/javascript" src="'.base_url().'index.php/users/cities_json"></script>
<script type="text/javascript" src="'.base_url().'index.php/users/states_json"></script>
<script type="text/javascript" src="'.base_url().'index.php/users/countries_json"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$("#kota").autocomplete({
		source: Cities,
		minLength: 2
	});
	
	$("#negara").autocomplete({
		source: Countries,
		minLength: 2
	});

	$("#kota").blur(function(){
		
		$.get(BASE_URL + "index.php/users/get_state?city=" + $("#kota").val(), function(data){
			$("#propinsi").val(data);
		});
	});
	
	$("#propinsi").blur(function(){
		
		$.get(BASE_URL + "index.php/users/get_country?state=" + $("#propinsi").val(), function(data){
			$("#negara").val(data);
		});
	});
});
</script>
';
$this->load->view('admin/footer',$data); 
