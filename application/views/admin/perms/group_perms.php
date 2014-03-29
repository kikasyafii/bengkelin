<?php $this->load->view('admin/header'); ?>
	<div class="page-header">
		<h1>Group Permission</h1>
	</div>
	<?php echo form_open('perms/save_group_perms'); ?>
	<?php echo form_hidden('group_id', $group_id); ?>
	<?php echo $perms; ?>
	<hr>
	&nbsp;&nbsp;<input type="checkbox" name="all" id="checkall" /> <label for="checkall">Check All</label>&nbsp;&nbsp;
	<?php echo form_submit('save', 'Simpan Group Permission', 'class="btn btn-primary btn-sm"'); ?>
	<?php echo form_close(); ?>
<?php 
$data['footer_content'] = '
<script type="text/javascript">
$("#checkall").change(function () {
	if ($("#checkall").prop("checked")){
		$(".cekperm").attr("checked", "checked");
	}else{
		$(".cekperm").removeAttr("checked");
	}
});
</script>';
$this->load->view('admin/footer',$data);
