</div>
<footer class="clearfix">
	<a class="campaign-banner" href="http://together.wustl.edu" onclick="__gaTracker('send','event','outbound-campaign','http://together.wustl.edu');">
		<div class="campaign-wrapper">
			<div class="wrapper">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/campaign.png" alt="Leading Together, the campaign for Washington University">
			</div>
		</div>
	</a>
	<div class="wrapper clearfix">
		<div class="double-footer">
			<p>Our 2,100 employed and volunteer faculty — the <a href="http://wuphysicians.wustl.edu" onclick="__gaTracker('send','event','outbound-footer','http://wuphysicians.wustl.edu');">Washington University Physicians</a> — also are the medical staff of <a href="http://www.barnesjewish.org/" onclick="__gaTracker('send','event','outbound-footer','http://www.barnesjewish.org');">Barnes-Jewish</a> and <a href="http://www.stlouischildrens.org/" onclick="__gaTracker('send','event','outbound-footer','http://www.stlouischildrens.org');">St. Louis Children's</a> hospitals. Through its hospital affiliations, the School is linked to BJC HealthCare.</p>
			<p class="small-text"><a href="http://www.wustl.edu/policies/copyright.html">&copy; <?php echo date("Y") ?> Washington University in St. Louis</a></p>
		</div>
		<div class="single-footer footer-menu-block">
<?php 
			wp_nav_menu( array(
				'theme_location' => 'footer-menu',
				'container'      => '',
				'menu'           => 'footer',
				'items_wrap'     => '<ul>%3$s</ul>',
			) );
?>
		</div>
		<div class="single-footer last-child">
			<p class="social">
				<a title="Facebook" class="facebook" onclick="__gaTracker('send','event','outbound-footer-social','facebook');" href="https://www.facebook.com/WUSTLmedicine.health"><img src="<?php echo get_template_directory_uri(); ?>/_/img/facebook.svg" width="23" height="23" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/facebook.png';this.onerror=null;"></a>
				<a title="Twitter" class="twitter" onclick="__gaTracker('send','event','outbound-footer-social','twitter');" href="http://twitter.com/WUSTLmed"><img src="<?php echo get_template_directory_uri(); ?>/_/img/twitter.svg" width="23" height="23" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/twitter.png';this.onerror=null;"></a>
				<a title="LinkedIn" class="linkedin" onclick="__gaTracker('send','event','outbound-footer-social','linkedin');" href="https://www.linkedin.com/company/washington-university-school-of-medicine"><img src="<?php echo get_template_directory_uri(); ?>/_/img/linkedin.svg" width="23" height="23" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/linkedin.png';this.onerror=null;"></a>
				<a title="Google Plus" class="googleplus" onclick="__gaTracker('send','event','outbound-footer-social','googleplus');" href="http://plus.google.com/+WashingtonUniversitySchoolofMedicineStLouis/"><img src="<?php echo get_template_directory_uri(); ?>/_/img/google-plus.svg" width="23" height="23" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/google-plus.png';this.onerror=null;"></a>
				<a title="RSS feed" class="rss" onclick="__gaTracker('send','event','outbound-footer-social','rss');" href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/rss.svg" width="23" height="23" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/rss.png';this.onerror=null;"></a>
				<a title="WUSTL Reader mobile app" class="reader" onclick="__gaTracker('send','event','outbound-footer-social','WUSTL reader');" href="http://reader.wustl.edu/"><img src="<?php echo get_template_directory_uri(); ?>/_/img/reader.png" width="23" height="23"></a>
			</p>
			<p class="small-text pad-top-20">660 S. Euclid Ave.<br>St. Louis, MO 63110</p>
		</div>
	</div>
</footer>

<?php
   /* Always have wp_footer() just before the closing </body>
	* tag of your theme, or you will break many plugins, which
	* generally use this hook to reference JavaScript files.
	*/
	wp_footer();
?>
</body>
</html>