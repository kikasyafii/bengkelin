		</div>
	</div>
	<!--BEGIN FOOTER-->
		<div id="footer">
			<div class="bottom_footer">
				<div class="f_widget ">
					<h3><strong>Tentang Kami</h3>
					<?php echo $this->bengkelin->config['about']; ?>
				</div>
				<div class="f_widget divide">
					<h3><strong>FAQ</strong></h3>
					<ul>
						<li><a href="#">How do I add an offer?</a></li>
						<li><a href="#">How do I find a vehicle</a></li>
						<li><a href="#">Price list</a></li>
						<li><a href="#">Office for car dealers</a></li>
					</ul>
				</div>
				<div class="fwidget_separator"></div>
				<div class="f_widget">
					<h3><strong>User</strong> area</h3>
					<ul>
						<li><a href="#">Add an offer</a></li>
						<li><a href="#">Register dealder</a></li>
						<li><a href="#">Login Dealer</a></li>
						<li><a href="#">News</a></li>
					</ul>
				</div>
				<div class="f_widget divide last">
					<h3><strong>Find</strong> us here</h3>
					<ul class="vertical">
						<li style="display:inline-block;"><div style="width:170px;display:inline-block;"><?php echo $this->bengkelin->config['address']; ?></div></li>
						<li style="display:inline-block;"><div style="width:170px;display:inline-block;"><?php echo $this->bengkelin->config['email']; ?></div></li>
						<li style="display:inline-block;"><div style="width:170px;display:inline-block;"><?php echo $this->bengkelin->config['phone']; ?></div></li>
					</ul>
				</div>
			</div>
			<div class="copyright_wrapper">
				<div class="copyright">&copy; 2013 Auto Sale. All Rights Reserved.</div>
			</div>
		</div>
		<?php 
		if (isset($footer_content)){
			echo $footer_content;
		}
		?>
	<!--EOF FOOTER-->
</body>
</html>
