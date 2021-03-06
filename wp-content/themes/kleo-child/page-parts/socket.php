
		<!-- SOCKET SECTION
		================================================ -->

		<div id="socket" class="socket-color footer-bar">
			<div class="footer-graphic" style="background-image: url('<?php echo get_stylesheet_directory_uri() . '/assets/images/footer.jpg' ?>');">
				<img class="logo" src="<?php echo get_stylesheet_directory_uri() . '/assets/svgs/birdyConnect_Logo-White.svg'; ?>">
					<p> <?php  echo __('Sign Up Today!'); ?>  </p>
				<?php if( !is_user_logged_in() ): ?>
					<a href="/register" class="b-button"> <?php echo __('Sign Up'); ?> </a>
				<?php endif; ?>
			</div>
			<div class="container">
				<div class="template-page tpl-no col-xs-12 col-sm-12">
					<div class="wrap-content">
						<div class="row">
              <div class="col-sm-6">
								&#169; <?php echo date('Y') . __(' Birdy Connect. All Rights Reserved.'); ?>
							</div>
							<div class="col-sm-6">
                <ul class="footer-links">
                  <li class="footer-links__link"> <a href="http://google.com"> <?php echo __('Privacy Policy') ?> </a> </li>
                  <li class="footer-links__link"> <a href="http://google.com"> <?php echo __('Terms &amp; Conditions') ?> </a> </li>
                </ul>
							</div>
						</div><!--end row-->
					</div><!--end wrap-content-->
				</div><!--end template-page-->
			</div><!--end container-->
		</div><!--end footer-->
