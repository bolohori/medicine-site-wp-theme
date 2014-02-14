</div>
<footer class="clearfix">
    <div class="campaign-wrapper">
        <div class="wrapper">
            <a class="campaign-banner" target="_blank" href="http://together.wustl.edu">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/campaign.png" alt="Leading Together, the campaign for Washington University">
            </a>
        </div>
    </div>
    <div class="wrapper">
        <div class="double-footer">
            <p>Our 2,100 employed and volunteer faculty — the <a target="_blank" href="http://wuphysicians.wustl.edu">Washington University Physicians</a> — also are the medical staff of <a target="_blank" href="http://www.barnesjewish.org/">Barnes-Jewish</a> and <a target="_blank" href="http://www.stlouischildrens.org/">St. Louis Children's</a> hospitals. Through its hospital affiliations, the School is linked to BJC HealthCare.</p>
            <p class="small-text">&copy;2013 Washington University School of Medicine in St. Louis</p>
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
                <a target="_blank" href="http://www.facebook.com/WUSTLmedicine.health"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/facebook.png" alt="Facebook"></a>
                <a target="_blank" href="http://twitter.com/WUSTLmedschool"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/twitter.png" alt="Twitter"></a>
                <a target="_blank" href="http://www.linkedin.com/company/washington-university-school-of-medicine"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/linkedin.png" alt="LinkedIn"></a>
                <a target="_blank" href="http://www.youtube.com/wustlpa"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/youtube.png" alt="YouTube"></a>
                <a target="_blank" href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/rss.png" alt="RSS"></a>
            </p>
            <p class="small-text pad-top-20">660 S. Euclid Ave.<br>St. Louis, MO 63110</p>
        </div>
    </div>
</footer>

<div class="sticky-footer">
    <div  class="sticky-top">
        <div class="wrapper">
            <ul>
                <a target="_blank" href="http://wuphysicians.wustl.edu/directory.aspx"><li>Find a Doctor</li></a>
                <a href="<?php echo page_by_name('Departments & Programs');?>"><li>Departments &amp; Programs</li></a>
                <a href="<?php echo page_by_name('Admissions');?>"><li class="sticky-top-last">Admissions</li></a>
            </ul>
        </div>
    </div>

    <div class="wrapper">
        <ul class="sticky-bottom">
            <a href="<?php echo page_by_name('Prospective Students');?>"><li class="first-child">Prospective Students</li></a>
            <a href="<?php echo page_by_name('Current Students');?>"><li>Current Students</li></a>
            <a href="<?php echo page_by_name('Faculty');?>"><li>Faculty</li></a>
            <a href="<?php echo page_by_name('Staff');?>"><li>Staff</li></a>
            <a href="<?php echo page_by_name('Alumni & Friends');?>"><li>Alumni &amp; Friends</li></a>
            <a href="<?php echo page_by_name('Administrators');?>"><li>Administrators</li></a>
            <a href="<?php echo page_by_name('Researchers');?>"><li>Researchers</li></a>
            <a href="<?php echo page_by_name('Job Seekers');?>"><li class="last-child">Job Seekers</li></a>
            <a class="last-child announcements" href="javascript:;"><li>Announcements</li></a>
        </ul>
        <div class="hidden-footer">
            <div class="announcements-left">
                <h2>Announcements</h2>
                <p>From outreach events and international conferences to changes on campus and calls for abstracts, news for the school is available here.</p>
            </div>
            <div class="announcements-right">
                <ul class="announcement-list">
<?php
                    $num_to_show = get_option( 'announcements_to_show', 6 );
                    $args = array(
                        'post_type' => 'announcement', 
                        'posts_per_page' => $num_to_show, 
                        'orderby' => 'menu_order', 
                        'order' => 'ASC',
                        'meta_query' => array(
                            'relation' => 'OR',
                            array(
                                'type' => 'DATETIME',
                                'key' => 'expiration_date',
                                'value' => 'TIMESTAMP',
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
                    while ( $loop->have_posts() ) : $loop->the_post();
                        $internal_only = get_field('internal_only');
                        if ( $internal_only && !WASHU_IP)
                            continue;
                        $link = get_field('url');
                        $target = $link['new_window'] ? "" : " target='_blank'";
                        $url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
                        /*echo "\t\t\t\t\t<li data-test='$test' data-curr='$curr' data-expir='$expir' class='announcement'><a$target href='$url'>" . get_the_title() . "</a></li>\n";*/
                        echo "\t\t\t\t\t<li class='announcement'><a$target href='$url'>" . get_the_title() . "</a></li>\n";
                        
                    endwhile;
?>
                </ul>
            </div>
            <p class="announcements">close <span class="arrow-up">&nbsp;</span></p>
        </div>
    </div>  

</div>

<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
         http://chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
    
<?php
   /* Always have wp_footer() just before the closing </body>
    * tag of your theme, or you will break many plugins, which
    * generally use this hook to reference JavaScript files.
    */
    wp_footer();
?>
</body>
</html>