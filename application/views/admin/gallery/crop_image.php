<?php 
$data['header_content'] = '<link rel="stylesheet" href="'.base_url().'assets/clipone/plugins/Jcrop/css/jquery.Jcrop.css">';
$this->load->view('admin/header',$data); ?>
	<div class="page-header">
		<h1>Image Crop</h1>
	</div>
	<div class="inner">
		<div class="col-md-12">
			<?php if ($resultGallery[0]->name_file == ''): ?>
				<p>Belum Ada foto yang diupload</p>
			<?php else: ?>
				<div class="form-inline">
					<img src="<?php echo base_url(); ?>assets/images/galleries/users/<?php echo $resultGallery[0]->name_file; ?>" id="cropbox">
					<br>
					<form action="<?php echo site_url('gallery/save_crop'); ?>" method="post" onsubmit="return checkCoords();">
						<?php echo form_hidden('gallery_id', $gallery_id); ?>
						<input type="hidden" id="x" name="x" />
						<input type="hidden" id="y" name="y" />
						<input type="hidden" id="w" name="w" />
						<input type="hidden" id="h" name="h" />
						<input type="submit" name='crop' value="Crop Image" class="btn btn-large btn-inverse" />
					</form>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php 
$data['footer_content'] = '
<script type="text/javascript" src="'.base_url().'assets/clipone/plugins/Jcrop/js/jquery.Jcrop.min.js"></script>
<script type="text/javascript">
	  $(function(){

		$(\'#cropbox\').Jcrop({
		  aspectRatio: 1,
		  onSelect: updateCoords
		});

	  });

	  function updateCoords(c)
	  {
		$(\'#x\').val(c.x);
		$(\'#y\').val(c.y);
		$(\'#w\').val(c.w);
		$(\'#h\').val(c.h);
	  };

	  function checkCoords()
	  {
		if (parseInt($(\'#w\').val())) return true;
		alert(\'Please select a crop region then press submit.\');
		return false;
	  };
</script>
';
$this->load->view('admin/footer',$data);
