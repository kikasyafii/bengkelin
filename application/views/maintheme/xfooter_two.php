			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<footer>
	<div class="col-md-12">
			<p align="pull-left">&copy;Bengkelin.com <?php echo date('Y'); ?>
			&nbsp;&nbsp;
			<?php echo anchor('content/pages/about', 'About'); ?> | <?php echo anchor('content/pages/api', 'API'); ?> | <?php echo anchor('content/pages/developer', 'Developer'); ?> | <?php echo anchor('content/pages/policy','Policy'); ?> | <?php echo anchor('content/pages/terms_of_use','Terms of Use'); ?>
			</p>
	</div>
</footer>
		<?php 
		if (isset($footer_content)){
			echo $footer_content;
		}
		?>
	</body>
</html>
