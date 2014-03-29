<?php 
$data['header_content'] = '
<script type="text/javascript">var BASE_URL = "'.base_url().'";</script>
'.$map['js'];;
$this->load->view('maintheme/header',$data); ?>
<div class="box">
	<div class="box-content">
		<h4>Lokasi Bengkel</h4>
		<hr>
		<?php echo $map['html']; ?>
	</div>
</div>
<?php $this->load->view('maintheme/footer'); 
