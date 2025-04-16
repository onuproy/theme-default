	<?php 
		global $coder;
	 ?>

	<footer class="footer_area">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="footer_content">
						<div class="copyright">
							<p><?php echo $coder['copyright']; ?></p>
						</div>
						<div class="privacy">
							<p><a href="#">Terms</a> | <a href="#">Imprint</a></p>
						</div>
						<div class="social_icon">
							<ul>
								<li><a target="_blank" href="<?php echo $coder['instagramurlupdate']; ?>"><img src="<?php echo myfile(); ?>assets/images/vactor/instagram_1.png" alt=""></a></li>
								<li><a target="_blank" href="<?php echo $coder['facebookurlupdate']; ?>"><img src="<?php echo myfile(); ?>assets/images/vactor/facebook.png" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
	

</body>

</html>