				<div class="row">
					
					</div>
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<div class="footer clearfix">
				<?php echo date('Y') ?> &copy; Bengkelin | Bagian dari <?php echo anchor('http://alurkria.com', 'Alurkria.com'); ?> | Hosted by <a href="http://www.perdhanahost.net/" target="_blank">PerdhanaHost</a> | Hak Cipta dilindungi Undang-undang
			</div>
			<div class="footer-items">
				<span class="go-top"><i class="clip-chevron-up"></i></span>
			</div>
		</div>
		<!-- end: FOOTER -->
		<div id="event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title">Event Management</h4>
					</div>
					<div class="modal-body"></div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-light-grey">
							Close
						</button>
						<button type="button" class="btn btn-danger remove-event no-display">
							<i class='fa fa-trash-o'></i> Delete Event
						</button>
						<button type='submit' class='btn btn-success save-event'>
							<i class='fa fa-check'></i> Save
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/respond.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<!--<![endif]-->
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/less/less-1.5.0.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<?php 
		if (isset($footer_content)){
			echo $footer_content;
		}
		?>
		
		<script>
			jQuery(document).ready(function() {
				Main.init();
				<?php 
				if (isset($footer_init)){
					echo $footer_init;
				} 
				?>
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>
