</div>
<footer class="clearfix">
	<div class="campaign-wrapper">
		<div class="wrapper">
			<a class="campaign-banner" target="_blank" href="http://together.wustl.edu" onclick="javascript:_gaq.push(['_trackEvent','outbound-campaign','http://together.wustl.edu']);">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/campaign.png" alt="Leading Together, the campaign for Washington University">
			</a>
		</div>
	</div>
	<div class="wrapper">
		<div class="double-footer">
			<p>Our 2,100 employed and volunteer faculty — the <a target="_blank" href="http://wuphysicians.wustl.edu" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer','http://wuphysicians.wustl.edu']);">Washington University Physicians</a> — also are the medical staff of <a target="_blank" href="http://www.barnesjewish.org/" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer','http://www.barnesjewish.org']);">Barnes-Jewish</a> and <a target="_blank" href="http://www.stlouischildrens.org/" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer','http://www.stlouischildrens.org']);">St. Louis Children's</a> hospitals. Through its hospital affiliations, the School is linked to BJC HealthCare.</p>
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
				<a target="_blank" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','facebook']);" href="http://www.facebook.com/WUSTLmedicine.health"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/facebook.png" alt="Facebook"></a>
				<a target="_blank" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','twitter']);" href="http://twitter.com/WUSTLmed"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/twitter.png" alt="Twitter"></a>
				<a target="_blank" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','linkedin']);" href="http://www.linkedin.com/company/washington-university-school-of-medicine"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/linkedin.png" alt="LinkedIn"></a>
				<a target="_blank" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','googleplus']);" href="http://plus.google.com/+WashingtonUniversitySchoolofMedicineStLouis/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/googleplus.png" alt="Google+"></a>
				<a target="_blank" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','rss']);" href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/rss.png" alt="RSS"></a>
				<a target="_blank" onclick="javascript:_gaq.push(['_trackEvent','outbound-footer-social','WUSTL reader']);" href="http://reader.wustl.edu/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/wustl_reader.png" alt="YouTube"></a>
			</p>
			<p class="small-text pad-top-20">660 S. Euclid Ave.<br>St. Louis, MO 63110</p>
		</div>
	</div>
</footer>

<div class="sticky-footer">
	<div  class="sticky-top">
		<div class="wrapper">
			<ul>
				<a target="_blank" href="http://wuphysicians.wustl.edu/directory.aspx" onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','WU Physicians']);"><li>Find a Doctor</li></a>
				<a onclick="javascript:_gaq.push(['_trackEvent','stick-footer','Departments and Programs']);" href="<?php echo get_permalink( get_page_by_title( 'Academic Departments &amp; Programs' ) );?>"><li>Departments &amp; Programs</li></a>
				<a onclick="javascript:_gaq.push(['_trackEvent','stick-footer','Admissions']);" href="<?php echo get_permalink( get_page_by_title( 'Admissions' ) );?>"><li class="sticky-top-last">Admissions</li></a>
			</ul>
		</div>
	</div>

	<div class="wrapper">
		<ul class="sticky-bottom">
			<li class="first-child"><a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Prospective Students']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Prospective Students' ) );?>">Prospective Students</a></li><li>
			<a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Current Students']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Current Students' ) );?>">Current Students</a></li><li>
			<a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Faculty']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Faculty' ) );?>">Faculty</a></li><li>
			<a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Staff']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Staff' ) );?>">Staff</a></li><li class='responsive-break'>
			<a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Alumni']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Alumni & Friends' ) );?>">Alumni &amp; Friends</a></li><li class='responsive-clear'>
			<a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Administrators']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Administrators' ) );?>">Administrators</a></li><li>
			<a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','facebook']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Researchers' ) );?>">Researchers</a></li><li class="last-child">
			<a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Researchers']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Job Seekers' ) );?>">Job Seekers</a></li><li class="last-child announcements">
			<a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Announcements']);" href="javascript:;">Announcements</a></li>
		</ul>
	</div>  
	
		<div class="hidden-footer">
			<div class="wrapper">
			<div class="announcements-left">
				<h2>Announcements</h2>
				<p>Updates on campus events, policy changes, road and building construction, calls for papers and more.</p>
			</div>
			<div class="announcements-right">
				<ul class="announcement-list" data-columns="2">
<?php
					$num_to_show = get_option( 'announcements_to_show', 6 );

					$args = array(
						'post_type' => 'announcement', 
						'posts_per_page' => $num_to_show, 
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'fields' => 'ids',
						'meta_query' => array(
							array(
								'key' => 'sticky',
								'value' => 1,
								'compare' => '=',
							)
						)
					);
					$loop = new WP_Query( $args );
					$ids = $loop->posts;
					$num_to_show = $num_to_show - sizeof( $ids );

					if( $num_to_show > 0 ) {
						$args = array(
							'post_type' => 'announcement', 
							'posts_per_page' => $num_to_show, 
							'orderby' => 'date',
							'fields' => 'ids',
							'post__not_in' => $ids,
							'meta_query' => array(
								'relation' => 'OR',
								array(
									'type' => 'DATETIME',
									'key' => 'expiration_date',
									'value' => date_i18n("Y-m-d H:i:s"),
									'compare' => '>',
								),
								array(
									'key' => 'expiration_date',
									'value' => '',
									'compare' => '=',
								)
							)
						);
						$loop = new WP_Query( $args );
						$ids = array_merge( $ids, $loop->posts );
					}

					$args = array(
						'post_type' => 'announcement',
						'orderby' => 'post__in',
						'post__in' => $ids
					);
					
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
						$internal_only = get_field('internal_only');
						if ( $internal_only && !WASHU_IP ) {
							echo "internal";
							continue;
						}
						$link = get_field('url');
						
						if( $link['url'] != '' ) {
							$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
							$target = ( $link['new_window'] !== 0 ) ? " target='_blank'" : "";
						} else {
							$url = get_permalink();
							$target = "";
						}
						echo "\t\t\t\t\t<li class='announcement'><a$target href='$url' onclick=\"javascript:_gaq.push(['_trackEvent','outbound-announcement','$url']);\">" . get_the_title() . "</a></li>\n";
						
					endwhile;
?>
				</ul>
			</div>
			<p class="announcements">close <span class="arrow-up">&nbsp;</span></p>
		</div>
	</div>
</div>

<?php
   /* Always have wp_footer() just before the closing </body>
	* tag of your theme, or you will break many plugins, which
	* generally use this hook to reference JavaScript files.
	*/
	wp_footer();
?>
</body>
</html>