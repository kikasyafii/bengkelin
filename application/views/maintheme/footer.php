  <footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="block random-cars">
					<div class="title">
						<h2>Bengkel Populer</h2>
					</div><!-- /.title -->

					<div class="items">
						<?php $resBengkelPopuler = $this->bengkelin->bengkel_populer(); ?>
						<?php if ($resBengkelPopuler) : ?>
							<?php foreach($resBengkelPopuler as $row): ?>
						<div class="teaser-item-wrapper">
							<div class="teaser-item">
								<div class="title">
									<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>"><?php echo $row->nama_bengkel; ?></a>
								</div><!-- /.title -->
								<div class="subtitle"><?php echo $row->alamat_bengkel; ?></div><!-- /.subtitle -->

								<div class="row">
									<div class="picture-wrapper col-lg-4 col-md-4 col-sm-4 col-xs-4">
										<div class="picture">
											<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>">
												<span class="hover">
													<span class="hover-inner">
														<i class="icon icon-normal-link"></i>
													</span><!-- /.hover-inner -->
												</span><!-- /.hover -->
												<?php 
												$images = $this->bengkelin->get_main_image_bengkel($row->bengkel_id);
												if (isset($images) && $images->thumb_file != ''):
												?>
													<img src="<?php echo base_url().'assets/images/galleries/bengkel/thumb/'.$images->thumb_file; ?>" alt="#">
												<?php else: ?>
													<img src="<?php echo base_url(); ?>	assets/images/galleries/bengkel.png" alt="#">
												<?php endif; ?>
											</a>
										</div><!-- /.picture -->
									</div><!-- /.picture-wrapper -->

									<div class="content-wrapper col-lg-8 col-md-8 col-sm-8 col-xs-8">
										<?php if ($row->telp != '') : ?>
										<div class="price"><?php echo $row->telp; ?></div>
										<?php endif; ?>
										<?php if ($row->deskripsi != ''): ?>
											<p><?php echo $row->deskripsi; ?></p>
										<?php endif; ?>
									</div><!-- /.picture-content -->
								</div><!-- /.row -->
							</div><!-- /.teaser-item -->
						</div><!-- /.teaser-item-wrapper -->
						<?php endforeach; ?>
						<?php else: ?>
						<div class="teaser-item-wrapper">
							<div class="teaser-item">
								<p>Belum ada record</p>
							</div>
						</div>
						<?php endif; ?>
					</div><!-- /.items -->
				</div><!-- /.block -->				
			</div><!-- /.col-md-4 -->


			<!-- <div class="col-lg-4 col-md-4 col-sm-6">
				<div class="block">
					<div class="title">
						<h2>Subscribe to Newsletter</h2>
					</div>
					
					<form method="post">
						<div class="input-group">						  
						  <input type="email" class="form-control" placeholder="Your e-mail address" required="required">

						  <span class="input-group-btn">
							<button class="btn btn-default" type="button">Submit</button>
						  </span>
						</div>
					</form>

					<br>

					<div class="opening-hours">
						<div class="day clearfix">
							<span class="name">Monday</span><span class="hours">07:00 AM - 07:00 PM</span>
						</div>

						<div class="day clearfix">
							<span class="name">Tuesday</span><span class="hours">07:00 AM - 07:00 PM</span>
						</div>

						<div class="day clearfix">
							<span class="name">Wednesday</span><span class="hours"><i class="icon icon-normal-car"></i> Demonstration drives only</span>
						</div>

						<div class="day clearfix">
							<span class="name">Thursday</span><span class="hours">07:00 AM - 07:00 PM</span>
						</div>

						<div class="day clearfix">
							<span class="name">Friday</span><span class="hours">07:00 AM - 07:00 PM</span>
						</div>

						<div class="day clearfix">
							<span class="name">Saturday</span><span class="hours">07:00 AM - 02:00 PM</span>
						</div>

						<div class="day clearfix">
							<span class="name">Sunday</span><span class="hours"><i class="icon icon-normal-door-out"></i> Closed</span>
						</div>
					</div>
				</div>
			</div> -->


			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="block random-cars">
					<div class="title">
						<h2>Showroom Populer</h2>
					</div><!-- /.title -->

					<div class="items">
					<?php $resShowroomPopuler = $this->bengkelin->showroom_populer(); ?>
						<?php if ($resShowroomPopuler) : ?>
							<?php foreach($resShowroomPopuler as $row): ?>
						<div class="teaser-item-wrapper">
							<div class="teaser-item">
								<div class="title">
									<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>"><?php echo $row->nama_bengkel; ?></a>
								</div><!-- /.title -->
								<div class="subtitle"><?php echo $row->alamat_bengkel; ?></div><!-- /.subtitle -->

								<div class="row">
									<div class="picture-wrapper col-lg-4 col-md-4 col-sm-4 col-xs-4">
										<div class="picture">
											<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>">
												<span class="hover">
													<span class="hover-inner">
														<i class="icon icon-normal-link"></i>
													</span><!-- /.hover-inner -->
												</span><!-- /.hover -->
												<?php 
												$images = $this->bengkelin->get_main_image_bengkel($row->bengkel_id);
												if (isset($images) && $images->thumb_file != ''):
												?>
													<img src="<?php echo base_url().'assets/images/galleries/bengkel/thumb/'.$images->thumb_file; ?>" alt="#">
												<?php else: ?>
													<img src="<?php echo base_url(); ?>	assets/images/galleries/bengkel.png" alt="#">
												<?php endif; ?>
											</a>
										</div><!-- /.picture -->
									</div><!-- /.picture-wrapper -->

									<div class="content-wrapper col-lg-8 col-md-8 col-sm-8 col-xs-8">
										<?php if ($row->telp != '') : ?>
										<div class="price"><?php echo $row->telp; ?></div>
										<?php endif; ?>
										<?php if ($row->deskripsi != ''): ?>
											<p><?php echo $row->deskripsi; ?></p>
										<?php endif; ?>
									</div><!-- /.picture-content -->
								</div><!-- /.row -->
							</div><!-- /.teaser-item -->
						</div><!-- /.teaser-item-wrapper -->
						<?php endforeach; ?>
						<?php else: ?>
							<div class="teaser-item-wrapper">
								<div class="teaser-item">
									<p>Belum ada record</p>
								</div>
							</div>
						<?php endif; ?>

					</div><!-- /.items -->
				</div><!-- /.block -->				
			</div><!-- /.col-md-4 -->
			

			<div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2">
				<div class="block">
					<div class="title center-sm">
						<h2>Kontak</h2>
					</div><!-- /.title -->

					<h3 class="kontak-sub-title"><?php echo $this->bengkelin->config['company_name']; ?></h3>
					<div class="row">
						<div class="col-lg-12">
							<div class="footer-contact-description">
								<p><span class="glyphicon glyphicon-home"></span><?php echo $this->bengkelin->config['address'] ; ?></p>
								<p><span class="glyphicon glyphicon-phone-alt"></span><?php echo $this->bengkelin->config['phone']; ?></p>
								<p><span class="glyphicon glyphicon-envelope"></span><a href="mailto:bengkelin@bengkelin.com"><?php echo $this->bengkelin->config['email']; ?></a></p>
							</div>							
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<h2 class="footer-contact-custom-margin-bottom">Connect With Us</h2>
							<ul class="footer-socmed">
								<li><a href="<?php echo (empty($this->bengkelin->config['facebook']) ? '#' : $this->bengkelin->config['facebook']); ?>"><img src="<?php echo base_url(); ?>assets/images/icons/footer-facebook.png"></a></li>
								<li><a href="<?php echo (empty($this->bengkelin->config['twitter']) ? '#' : $this->bengkelin->config['twitter']); ?>"><img src="<?php echo base_url(); ?>assets/images/icons/footer-twitter.png"></a></li>
								<li><a href="<?php echo (empty($this->bengkelin->config['youtube']) ? '#' : $this->bengkelin->config['youtube']); ?>"><img src="<?php echo base_url(); ?>assets/images/icons/footer-youtube.png"></a></li>
								<li><a href="<?php echo (empty($this->bengkelin->config['linkedin']) ? '#' : $this->bengkelin->config['linkedin']); ?>"><img src="<?php echo base_url(); ?>assets/images/icons/footer-linkedin.png"></a></li>
							</ul>
						</div>
					</div>
				</div><!-- /.block -->
			</div><!-- /.col-md-4 -->				
		</div><!-- /.row -->
	</div><!-- /.container -->

	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12 clearfix">
					<div class="copyright">
						&copy; Bengkelin.com <span class="separator">/</span> Bagian dari <a href="http://alurkria.com">Alurkria</a> <span class="separator">/</span> Hosted by <a href="http://www.perdhanahost.net/"  target="_blank">PerdhanaHost</a><span class="separator">/</span> Hak Cipta Dilindungi oleh Undang-undang
					</div><!-- /.pull-left -->

					<ul class="nav nav-pills">
						<li><?php echo anchor(base_url(), 'Beranda'); ?></li>
						<li><?php echo anchor(site_url('bengkel/list_bengkel'), 'Bengkel'); ?></li>
						<li><?php echo anchor(site_url('bengkel/list_showroom'), 'Show Room'); ?></li>
						<li><?php echo anchor(site_url('content/terms_of_use'), 'Terms of Use'); ?></li>
						<li><?php echo anchor(base_url().'#', 'API'); ?></li>
						<li><?php echo anchor(base_url().'#', 'Developer'); ?></li>
						<li><?php echo anchor(site_url('content/kontak'), 'Kontak'); ?></li>
					</ul><!-- /.nav -->
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.footer-bottom -->
</footer><!-- /#footer -->


<script src="<?php echo base_url().'assets/carat/'; ?>assets/js/jquery.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="<?php echo base_url().'assets/carat/'; ?>assets/js/jquery.ui.js"></script>
<script src="<?php echo base_url().'assets/carat/'; ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url().'assets/carat/'; ?>assets/js/cycle.js"></script>
<script src="<?php echo base_url().'assets/carat/'; ?>libraries/jquery.bxslider/jquery.bxslider.js"></script>
<script src="<?php echo base_url().'assets/carat/'; ?>libraries/easy-tabs/lib/jquery.easytabs.min.js"></script>
<script src="<?php echo base_url().'assets/carat/'; ?>libraries/chosen/chosen.jquery.js"></script>
<script src="<?php echo base_url().'assets/carat/'; ?>libraries/star-rating/jquery.rating.js"></script>
<script src="<?php echo base_url().'assets/carat/'; ?>libraries/colorbox/jquery.colorbox-min.js"></script>
<script src="<?php echo base_url().'assets/carat/'; ?>libraries/jslider/bin/jquery.slider.min.js"></script>
<script src="<?php echo base_url().'assets/carat/'; ?>libraries/ezMark/js/jquery.ezmark.js"></script>

<script type="text/javascript" src="<?php echo base_url().'assets/carat/'; ?>libraries/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/carat/'; ?>libraries/flot/jquery.flot.canvas.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/carat/'; ?>libraries/flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/carat/'; ?>libraries/flot/jquery.flot.time.js"></script>


<script src="http://maps.googleapis.com/maps/api/js?sensor=true&amp;v=3.13"></script>
<script src="<?php echo base_url().'assets/carat/'; ?>assets/js/carat.js"></script></body>
</html>
