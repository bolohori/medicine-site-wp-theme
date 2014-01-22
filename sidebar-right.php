<?php 
/*
*  Loop through a Flexible Content field and display it's content with different views for different layouts
*/
while(has_sub_field("sidebars")): 
    if(get_row_layout() == "default"): // layout: Default Sidebar ?>
        <div class="sidebar">
            <p><?php the_sub_field("sidebar_title"); ?></p>
            <hr>
            <?php if(get_sub_field('sidebar_links')): ?>
                <ul>
                <?php while(has_sub_field('sidebar_links')):
                    $link = get_sub_field('sidebar_link');
                    $target = $link['external'] ? "" : "target='_blank'";
                    $url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
                    echo "<li><a $target href='$url'>" . $link['title'] . "</a></li>";
                endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php elseif(get_row_layout() == "single"): // layout: Single Link Sidebar ?>
        <div class="sidebar">
            <?php 
                $link = get_sub_field('single_link');
                $target = $link['external'] ? "" : "target='_blank'";
                $url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
                echo "<a $target href='$url'>" . $link['title'] . "</a>";
            ?>
        </div>
    <?php elseif(get_row_layout() == "cancer"): // layout: NYT Cancer Series ?>
        <div class="sidebar">
            <p><?php the_sub_field("cancer_title"); ?></p>
            <hr>
            <p class="sidebar-small"><?php the_sub_field("cancer_subtitle"); ?></p>
            <?php if(get_sub_field('cancer_links')): ?>
                <ul>
                <?php while(has_sub_field('cancer_links')):
                    $link = get_sub_field('cancer_link');
                    $target = $link['external'] ? "" : "target='_blank'";
                    $url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
                    echo "<li><a $target href='$url'>" . $link['title'] . "</a></li>";
                endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php elseif(get_row_layout() == "outlook"): // layout: Outlok Sidebar ?>
        <div class="sidebar sidebar-outlook" style="background: url(<?php the_sub_field('outlook_thumbnail'); ?>) 0 0 no-repeat #fff;">
            <img class="sidebar-outlook-header" src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/outlook.png">
            <p><?php the_sub_field('outlook_title'); ?></p>
            <p class="sidebar-small"><?php the_sub_field('outlook_tease'); ?></p>
            <a class="sidebar-outlook-link" target="_blank" href="http://outlook.wustl.edu">READ IT IN OUTLOOK</a>
        </div>
    <?php elseif(get_row_layout() == "connect"): // layout: Connect with us Sidebar ?>
        <div class="sidebar">
            <p><?php the_sub_field("connect_title"); ?></p>
            <hr>
            <?php 
            if( in_array( 'fb', get_sub_field('connect_buttons') ) ) {
            ?><a class="sidebar-img" target="_blank" href="http://www.facebook.com/WUSTLmedicine.health"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/facebook.png" alt=""></a><?php
            }
            if( in_array( 'twitter', get_sub_field('connect_buttons') ) ) {
            ?><a class="sidebar-img" target="_blank" href="http://twitter.com/WUSTLmedschool"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/twitter.png" alt=""></a><?php
            }
            if( in_array( 'in', get_sub_field('connect_buttons') ) ) {
            ?><a class="sidebar-img" target="_blank" href="http://www.linkedin.com/company/washington-university-school-of-medicine"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/linkedin.png" alt=""></a><?php
            }
            if( in_array( 'youtube', get_sub_field('connect_buttons') ) ) {
            ?><a class="sidebar-img" target="_blank" href="http://www.youtube.com/wustlpa"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/youtube.png" alt=""></a><?php
            }
            if( in_array( 'rss', get_sub_field('connect_buttons') ) ) {
            ?><a class="sidebar-img" target="_blank" href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/rss.png" alt=""></a><?php
            } ?>
        </div>
    <?php elseif(get_row_layout() == "heart"): // layout: Heart/Vascular Sidebar ?>
        <div class="sidebar">
            <p><?php the_sub_field("heart_title"); ?></p>
            <hr>
            <?php the_sub_field("heart_subtitle"); ?>
            <?php if(get_sub_field('heart_links')): ?>
                <ul class="sidebar-heart-list">
                <?php while(has_sub_field('heart_links')):
                    $link = get_sub_field('heart_link');
                    $target = $link['external'] ? "" : "target='_blank'";
                    $url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
                    echo "<li><a $target href='$url'>" . $link['title'] . "</a><br>" . the_sub_field('heart_link_phone') . "</li>";
                endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php elseif(get_row_layout() == "one_off"): // layout: Single Link Sidebar ?>
        <div class="raw-sidebar">
            <?php the_sub_field('raw_html');?>
        </div>
    <?php endif; 
endwhile;
?>