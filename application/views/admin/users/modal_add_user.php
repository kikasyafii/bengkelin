<link href="<?php echo base_url(); ?>assets/css/jquery.ui.autocomplete.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<?php
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'users/save_add'));
echo $form->textFieldRow('username', 'Username', array('placeholder' => 'Username',));
echo $form->textFieldRow('first_name', 'Fist Name', array('placeholder' => 'First Name'));
echo $form->textFieldRow('last_name', 'Last Name', array('placeholder' => 'Last Name'));
echo $form->textFieldRow('email', 'Email', array('placeholder' => 'Email', 'class' => 'input-pendek'));
echo $form->textFieldRow('alamat', 'Alamat', array('placeholder' => 'Alamat'));
echo $form->textFieldRow('kota', 'Kota', array('placeholder' => 'Kota', 'id' => 'kota'));
echo $form->textFieldRow('propinsi', 'Propinsi', array('placeholder' => 'Propinsi', 'id' => 'propinsi'));
echo $form->textFieldRow('negara', 'Negara', array('placeholder' => 'Negara', 'id' => 'negara'));
echo $form->textFieldRow('zippostal', 'Kodepos', array('placeholder' => 'Kodepos', 'id' => 'zippostal'));
echo $form->textFieldRow('phone', 'Phone', array('placeholder' => 'Phone'));
echo $form->textFieldRow('facebook', 'Facebook', array('placeholder' => 'Facebook', 'value' => ''));
echo $form->textFieldRow('twitter', 'Twitter', array('placeholder' => 'Twitter', 'value' => ''));
echo $form->textFieldRow('gplus', 'Gplus', array('placeholder' => 'Gplus', 'value' => ''));
echo $form->textFieldRow('linkedin', 'Linkedin', array('placeholder' => 'Linkedin', 'value' => ''));
echo $form->textFieldRow('path', 'Path', array('placeholder' => 'Path', 'value' => ''));
echo $form->dropDownListRow('Gender', 'sex', '', array('1' => 'Male', '2' => 'Female', '3' => 'Tidak Bilang'));
echo $form->passwordFieldRow('password1', 'Password');
echo $form->passwordFieldRow('password2', 'Ulang Password');
echo '<div class="form-group"><div class="col-lg-2"><label for="bdate" class="control-label pull-right">Bdate</label></div><div class="col-lg-10 form-inline">';
echo form_dropdown('d', $date, '','class="form-control input-pendek" id="date"' ).' - ' .form_dropdown('m', $month, '', 'class="form-control input-pendek" id="month"').' - '. form_dropdown('y', $year, '', 'class="form-control input-pendek" id="year"');
echo '</div></div>';
//echo $form->dropDownListRow('group_id', 'Group', $group_id, $arrGroups, array('class' => 'input-pendek'));
echo $form->dropDownListRow('Group', 'group_id','', $arrGroups, array('class' => 'input-pendek'));
echo $form->dropDownListRow('Aktif', 'is_active', '', array('1' => 'Aktif', '0' => 'Tidak aktif'), array('class' => 'input-pendek'));
echo '&nbsp;'.form_submit('save', 'Save', 'class="btn btn-sm btn-primary"');
$form->end();
?>
<script type="text/javascript">var BASE_URL = "<?php echo base_url(); ?>"; </script>
<script type="text/javascript" src="<?php echo base_url(); ?>index.php/users/cities_json"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>index.php/users/states_json"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>index.php/users/countries_json"></script>
<script type="text/javascript">

$(document).ready(function(){
	$("#kota").autocomplete({
		source: Cities,
		minLength: 2
	});
	
	$("#propinsi").autocomplete({
		source: States,
		minLength: 2
	});
	
	$("negara").autocomplete({
		source: Countries,
		minLength: 2
	});

	$("#kota").blur(function(){
		
		$.get(BASE_URL + 'index.php/users/get_state?city=' + $("#kota").val(), function(data){
			$("#propinsi").val(data);
		});
	});
	
	$("#propinsi").blur(function(){
		$.get(BASE_URL + 'index.php/users/get_country?state=' + $('#propinsi').val(), function(data){
			$("#negara").val(data);
		});
	});
	
	$("#year").blur(function(){
		var tahun = parseInt($("#year").val());
		
		if ($("#month").val() == '02'){
			if (tahun % 4 == 0){
				if ($("#date").val() > 29){
					alert('Isian Tanggal tidak benar!');
					$("#date").focus();
				}
			}else{
				if ($("#date").val() > 28){
					alert('Isian Tanggal tidak benar!');
					$("#date").focus();
				}
			}
		}
	});
});
</script>
