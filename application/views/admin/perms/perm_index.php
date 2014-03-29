<?php $this->load->view('admin/header'); ?>
<div class="box">
	<div class="box-content">
		<div class="page-header">
			<h1>Permission</h1>
		</div>
		<?php echo form_open('perms/save_perm'); ?>
		<table class="table">
			<tr bgcolor="#CFCFCF">
				<th class="center">Order</th>
				<th class="center">Nama Permission</th>
				<th class="center">Path</th>
				<th class="center">Icon</th>
				<th class="center">Status</th>
				<th class="center">&nbsp;</th>
			</tr>
			<tr>
				<td class="center"><?php echo form_input('newparentorder','','placeholder="Ordering" class="form-control"'); ?></td>
				<td class="center"><?php echo form_input('newparentnama','','placeholder="Nama Permission" class="form-control"'); ?></td>
				<td class="center"><?php echo form_input('newparentpath','','placeholder="Path" class="form-control"'); ?></td>
				<td class="center"><?php echo form_input('newparenticon','','placeholder="Nama Permission" class="form-control"'); ?></td>
				<td class="center"><?php echo form_dropdown('newparentstatus',array('1' => 'Aktif', '0' => 'Non Aktif'),'', 'class="form-control"'); ?></td>
				<td class="center">
					<?php echo form_submit('newparent', 'Add New Parent', 'class="btn btn-primary btn-sm"' ); ?>
				</td>
			</tr>
			<?php if ($result): ?>
			<?php foreach($result as $row): ?>
				<?php if ($row->parent_id > 0) continue; ?>
				<tr>
					<td class="center">
						<?php echo form_input('parentorder[]',$row->ordering, 'class="form-control"'); ?>
						<?php echo form_hidden('perm_id[]', $row->perm_id); ?>
					</td>
					<td class="center">
						<?php echo form_input('parentnama[]',$row->class_name, 'class="form-control"'); ?>
					</td>
					<td class="center">
						<?php echo form_input('parentpath[]',$row->class_path, 'class="form-control"'); ?>
					</td>
					<td class="center">
						<?php echo form_input('parenticon[]',$row->icon, 'class="form-control"'); ?>
					</td>
					<td class="center">
						<?php echo form_dropdown('parentstatus[]',array('1' => 'Aktif', '0' => 'Non Aktif'),$row->is_active, 'class="form-control"'); ?>
					</td>
					<td class="center">
						<?php echo anchor(current_url().'#',Tb::icon(Tb::ICON_PLUS).' Add Sub', 'class="btn btn-info btn-sm" onclick="javascript:addsub('.$row->perm_id.');"'); ?>&nbsp;&nbsp;
						<?php echo form_submit('saveparent', 'Save Parent', 'class="btn btn-primary btn-sm"'); ?>&nbsp;&nbsp;
						<?php echo anchor('perms/delete?perm_id='.$row->perm_id, Tb::icon(Tb::ICON_TRASH), 'title="Delete Parent" class="btn btn-danger btn-sm" onclick="javascript:xconfirm=confirm(\'Apakah Anda ingin menghapus permission ini?\');if (xconfirm == true) {return true;} else {return false;}"'); ?>
					</td>
				</tr>
				<?php if ($arrSub[$row->perm_id]): ?>
				<tr>
					<td colspan="6">
						<table width="90%" align="right" cellspacing=0 cellpadding="4">
							<tr>
								<th class="center">Order</td>
								<th class="center">Nama Sub Permission</td>
								<th class="center">Path</td>
								<th class="center">Status</td>
								<th class="center">&nbsp;</td>
							</tr>
						<?php foreach($arrSub[$row->perm_id] as $arrval): ?>
							<tr>
								<td class="center">
									<?php echo form_input('suborder[]',$arrval->ordering, 'class="form-control input-pendek"'); ?>
									<?php echo form_hidden('sub_id[]',$arrval->perm_id); ?>
									<?php echo form_hidden('subparent_id[]',$arrval->parent_id); ?>
								</td>
								<td class="center">
									<?php echo form_input('subnama[]',$arrval->class_name, 'class="form-control"'); ?>
								</td>
								<td class="center">
									<?php echo form_input('subpath[]',$arrval->class_path, 'class="form-control"'); ?>
								</td>
								<td class="center">
									<?php echo form_dropdown('substatus[]',array('1' => 'Aktif', '0' => 'Non Aktif'),$arrval->is_active, 'class="form-control"'); ?>
								</td>
								<td class="center">
									<?php echo form_submit('savesub', 'Save Sub', 'class="btn btn-primary btn-sm"'); ?>
									&nbsp;&nbsp;
									<?php echo anchor('perms/delete?perm_id='.$arrval->perm_id, Tb::icon(Tb::ICON_TRASH), 'title="Delete Sub" class="btn btn-danger btn-sm" onclick="javascript:xconfirm=confirm(\'Apakah Anda ingin menghapus permission ini?\');if (xconfirm == true) {return true;}else{return false;}"'); ?>
								</td>
							</tr>
						<?php endforeach; ?>
						</table>
					</td>
				</tr>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
		</table>
		<?php echo form_close(); ?>
		<?php 
		$datamodal['content'] = '<div id="modalform"></div>';
		$this->load->view('modal', $datamodal); 
		?>
	</div>
</div>
<?php 
$data['footer_content'] = '
<script type="text/javascript">var BASE_URL = "'.base_url().'"; </script>
<script type="text/javascript" src="'.base_url().'assets/js/admin/perms.js"></script>
';
$this->load->view('admin/footer',$data); 
