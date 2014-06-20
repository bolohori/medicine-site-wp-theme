</div>
<footer class="clearfix">
	<div class="campaign-wrapper">
		<div class="wrapper">
			<a class="campaign-banner" href="http://together.wustl.edu" onclick="javascript:_gaq.push(['_trackEvent','outbound-campaign','http://together.wustl.edu']);">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/campaign.png" alt="Leading Together, the campaign for Washington University">
			</a>
		</div>
	</div>
	<div class="wrapper">
		<div class="double-footer">
			<p>Our 2,100 employed and volunteer faculty — the <a href="http://wuphysicians.wustl.edu" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer','http://wuphysicians.wustl.edu']);">Washington University Physicians</a> — also are the medical staff of <a href="http://www.barnesjewish.org/" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer','http://www.barnesjewish.org']);">Barnes-Jewish</a> and <a href="http://www.stlouischildrens.org/" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer','http://www.stlouischildrens.org']);">St. Louis Children's</a> hospitals. Through its hospital affiliations, the School is linked to BJC HealthCare.</p>
			<p class="small-text">&copy;<?php echo date("Y") ?> Washington University School of Medicine in St. Louis</p>
		</div>
		<div class="single-footer">
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
				<a title="Facebook" class="facebook" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','facebook']);" href="http://www.facebook.com/WUSTLmedicine.health"></a>
				<a title="Twitter" class="twitter" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','twitter']);" href="http://twitter.com/WUSTLmed"></a>
				<a title="LinkedIn" class="linkedin" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','linkedin']);" href="http://www.linkedin.com/company/washington-university-school-of-medicine"></a>
				<a title="Google Plus" class="googleplus" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','googleplus']);" href="http://plus.google.com/+WashingtonUniversitySchoolofMedicineStLouis/"></a>
				<a title="RSS feed" class="rss" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','rss']);" href="<?php bloginfo('rss2_url'); ?>"></a>
				<a title="WUSTL Reader mobile app" class="reader" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','WUSTL reader']);" href="http://reader.wustl.edu/"></a>
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