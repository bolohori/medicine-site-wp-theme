<footer class="clearfix">
	<a href="http://together.wustl.edu" onclick="__gaTracker('send','event','outbound-campaign','http://together.wustl.edu');"><div class="campaign"></div></a>
	<div id="site-footer">
    <div class="wrapper">
    <?php $footer_menu = wp_nav_menu( array(
        'theme_location' => 'footer-menu',
        'container'      => 'nav',
        'items_wrap'     => '<ul>%3$s</ul>',
        'fallback_cb'    => false,
        'echo'           => false,
    ) ); ?>
        <div id="site-footer-top" class="clearfix">
	        <?php echo $footer_menu; ?>
	        <div id="site-social">
	        	<a title="Facebook" id="site-facebook" onclick="__gaTracker('send','event','outbound-footer-social','facebook');" href="https://www.facebook.com/WUSTLmedicine.health"><img src="<?php echo get_template_directory_uri(); ?>/_/img/facebook.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/facebook.png';this.onerror=null;"></a>
				<a title="Twitter" id="site-twitter" onclick="__gaTracker('send','event','outbound-footer-social','twitter');" href="http://twitter.com/WUSTLmed"><img src="<?php echo get_template_directory_uri(); ?>/_/img/twitter.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/twitter.png';this.onerror=null;"></a>
				<a title="LinkedIn" id="site-linkedin" onclick="__gaTracker('send','event','outbound-footer-social','linkedin');" href="https://www.linkedin.com/company/washington-university-school-of-medicine"><img src="<?php echo get_template_directory_uri(); ?>/_/img/linkedin.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/linkedin.png';this.onerror=null;"></a>
				<a title="Flickr" id="site-flickr" onclick="__gaTracker('send','event','outbound-footer-social','flickr');" href="https://www.flickr.com/photos/wustlmedicine/"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flickr.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/flickr.png';this.onerror=null;"></a>
				<a title="RSS feed" id="site-rss" onclick="__gaTracker('send','event','outbound-footer-social','rss');" href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/rss.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/rss.png';this.onerror=null;"></a>
	        </div>
        </div>
        <div id="site-footer-bottom" class="clearfix">
            <div id="col1">
                <strong>Washington University School of Medicine</strong>
                <p>660 S. Euclid Ave., St. Louis, MO 63110</p>
                <p>Our 2,100 employed and volunteer faculty — the <a href="http://wuphysicians.wustl.edu" onclick="__gaTracker('send','event','outbound-footer','http://wuphysicians.wustl.edu');">Washington University Physicians</a> — also are the medical staff of <a href="http://www.barnesjewish.org/" onclick="__gaTracker('send','event','outbound-footer','http://www.barnesjewish.org');">Barnes-Jewish</a> and <a href="http://www.stlouischildrens.org/" onclick="__gaTracker('send','event','outbound-footer','http://www.stlouischildrens.org');">St. Louis Children's</a> hospitals. Through its hospital affiliations, the school is linked to BJC HealthCare.</p>
            </div>
            <div id="lists">
                <div id="col2">
                    <ul>
                        <li><a href="/directory/academic-departments/">Departments &amp; Programs</a></li>
                        <li><a href="/directory/index/">A to Z Index</a></li>
                        <li><a href="/news/announcements/">Announcements</a></li>
                        <li><a href="http://outlook.wustl.edu/">Outlook Magazine</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
	<div id="wusm-footer">

        <div class="wrapper clearfix">

            <div id="wusm-footer-left">
                <a onclick="__gaTracker('send', 'event', 'wusm-footer', 'http://medicine.wustl.edu', 'School of Medicine');" href="http://medicine.wustl.edu/"><img width="147" height="31" src="<?php echo get_template_directory_uri(); ?>/_/img/wusm-logo-footer.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/wusm-logo-footer.png';this.onerror=null;" alt="Washington University School of Medicine in St. Louis"></a>
                <div id="copyright"><a onclick="__gaTracker('send', 'event', 'wusm-footer', 'http://www.wustl.edu/policies/copyright.html', 'Copyright');" href="http://www.wustl.edu/policies/copyright.html">&copy; <?php echo date("Y") ?> Washington University in St. Louis</a></div>
            </div>

            <div id="wusm-footer-right">
                <nav>
                    <a class="first-child" onclick="__gaTracker('send', 'event', 'wusm-footer', 'http://emergency.wustl.edu', 'Emergency');" href="https://emergency.wustl.edu/">Emergency</a>
                    <a onclick="__gaTracker('send', 'event', 'wusm-footer', 'http://medicine.wustl.edu/policies', 'Policies');" href="/policies/">Policies</a>
                    <a class="last-child" onclick="__gaTracker('send', 'event', 'wusm-footer', 'https://medicine.wustl.edu/news/', 'News');" href="/news/">News</a>
                </nav>
            </div>

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
