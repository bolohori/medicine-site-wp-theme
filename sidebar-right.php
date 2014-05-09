<<<<<<< HEAD
<?php
/*
*  Loop through a Flexible Content field and display its content with different views for different layouts
*/
if (get_field('sidebars')): ?>
    <div id="right-col">
    <?php while (has_sub_field('sidebars')):
        if (get_row_layout() == 'links'): // List of Links ?>
            <aside>
                <h2><?php the_sub_field('title'); ?></h2>
                <?php if (get_sub_field('links')): ?>
                    <ul>
                        <?php while (has_sub_field('links')):
                            $link_text = get_sub_field('link_text');
                            $url = get_sub_field('url');
                            $target = get_sub_field('open_in_current_window') ? '' : 'target="blank"';
                            echo "<li><a $target href=\"$url\">$link_text</a></li>";
                        endwhile; ?>
                    </ul>
                <?php endif; ?>
            </aside>
        <?php endif;
    endwhile; ?>
    </div>
<?php endif; ?>
=======
<?php 
/*
* Loop through a Flexible Content field and display it's content with different views for different layouts
*/
?>
<div id="right-col">
<?php
while( has_sub_field( 'sidebars' ) ):
	if( get_row_layout() === 'default' ): // layout: Default Sidebar ?>
		<aside class="links">
			<?php if ( get_sub_field( 'sidebar_title' ) ) { ?><h2><?php the_sub_field("sidebar_title"); ?></h2><?php } ?>
			<?php echo get_sub_field( 'sidebar_text' ) ? '<p class="secondary">' . get_sub_field( 'sidebar_text' ) . '</p>' : ''; ?>
			<?php if( get_sub_field( 'sidebar_links' ) ): ?>
				<ul>
				<?php while(has_sub_field( 'sidebar_links' )):
					$link = get_sub_field( 'sidebar_link' );
					$target = $link['new_window'] ? " target='_blank'" : "";
					$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
					$description = get_sub_field( 'description' ) ? '<br><span class="secondary">' . get_sub_field( 'description' ) . '</span>' : '';
					echo "<li><a$target href='$url'>" . $link['title'] . "</a>$description</li>";
				endwhile; ?>
				</ul>
			<?php endif; ?>
		</aside>
	<?php elseif( get_row_layout() === 'single' ): // layout: Single Link Sidebar ?>
		<aside class="single-link">
			<?php 
				$link = get_sub_field( 'single_link' );
				$link_target = $link['new_window'] ? "" : " target='_blank'";
				$link_text = $link['title'];
				$link_url = $link['url'];
				$styles = get_sub_field( 'single_link_style' );
				$link_style = ( $styles !== false ) ? " style='$styles'" : '';

				echo "<a$link_target$link_style href='$link_url'>$link_text</a>";
			?>
		</aside>
	<?php elseif(get_row_layout() == "cancer"): // layout: NYT Cancer Series ?>
		<aside class="sidebar">
			<p><?php the_sub_field("cancer_title"); ?></p>
			<hr>
			<p class="sidebar-small"><?php the_sub_field("cancer_subtitle"); ?></p>
			<?php if(get_sub_field( 'cancer_links' )): ?>
				<ul>
				<?php while(has_sub_field( 'cancer_links' )):
					$link = get_sub_field( 'cancer_link' );
					$target = $link['new_window'] ? "" : "target='_blank'";
					$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
					echo "<li><a $target href='$url'>" . $link['title'] . "</a></li>";
				endwhile; ?>
				</ul>
			<?php endif; ?>
		</aside>
	<?php elseif(get_row_layout() == "outlook"): // layout: Outlok Sidebar ?>
		<aside class="sidebar sidebar-outlook" style="background: url(<?php the_sub_field( 'outlook_thumbnail' ); ?>) 0 0 no-repeat #fff;">
			<img class="sidebar-outlook-header" src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/outlook.png">
			<p><?php the_sub_field( 'outlook_title' ); ?></p>
			<p class="sidebar-small"><?php the_sub_field( 'outlook_tease' ); ?></p>
			<a class="sidebar-outlook-link" target="_blank" href="http://outlook.wustl.edu">READ IT IN OUTLOOK</a>
		</aside>
	<?php elseif(get_row_layout() == "connect"): // layout: Connect with us Sidebar ?>
		<aside class="sidebar">
			<p><?php the_sub_field("connect_title"); ?></p>
			<hr>
			<?php 
			if( in_array( 'fb', get_sub_field( 'connect_buttons' ) ) ) {
			?><a class="sidebar-img" target="_blank" href="http://www.facebook.com/WUSTLmedicine.health"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/facebook.png" alt=""></a><?php
			}
			if( in_array( 'twitter', get_sub_field( 'connect_buttons' ) ) ) {
			?><a class="sidebar-img" target="_blank" href="http://twitter.com/WUSTLmedschool"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/twitter.png" alt=""></a><?php
			}
			if( in_array( 'in', get_sub_field( 'connect_buttons' ) ) ) {
			?><a class="sidebar-img" target="_blank" href="http://www.linkedin.com/company/washington-university-school-of-medicine"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/linkedin.png" alt=""></a><?php
			}
			if( in_array( 'youtube', get_sub_field( 'connect_buttons' ) ) ) {
			?><a class="sidebar-img" target="_blank" href="http://www.youtube.com/wustlpa"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/youtube.png" alt=""></a><?php
			}
			if( in_array( 'rss', get_sub_field( 'connect_buttons' ) ) ) {
			?><a class="sidebar-img" target="_blank" href="<?php bloginfo('rss2_url' ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/rss.png" alt=""></a><?php
			} ?>
		</aside>
	<?php elseif(get_row_layout() == "heart"): // layout: Heart/Vascular Sidebar ?>
		<aside class="sidebar">
			<p><?php the_sub_field("heart_title"); ?></p>
			<hr>
			<?php the_sub_field("heart_subtitle"); ?>
			<?php if(get_sub_field( 'heart_links' )): ?>
				<ul class="sidebar-heart-list">
				<?php while(has_sub_field( 'heart_links' )):
					$link = get_sub_field( 'heart_link' );
					$target = $link['new_window'] ? "" : "target='_blank'";
					$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
					echo "<li><a $target href='$url'>" . $link['title'] . "</a><br>" . the_sub_field( 'heart_link_phone' ) . "</li>";
				endwhile; ?>
				</ul>
			<?php endif; ?>
		</aside>
	<?php elseif(get_row_layout() == "one_off"): // layout: Single Link Sidebar ?>
		<div class="raw-sidebar">
			<?php the_sub_field( 'raw_html' );?>
		</div>
	<?php elseif (get_row_layout() == 'image_&_text' ): // Image & Text ?>
		<aside class="image-and-text">
			<?php
				$attachment_id = get_sub_field( 'image' );
				echo $attachment_id ? wp_get_attachment_image( $attachment_id, 'outlook-thumb' ) : '';
			?>
			<div class="sidebar-body">
				<?php if (get_sub_field( 'title' )): ?>
					<h2><?php the_sub_field( 'title' ); ?></h2>
				<?php endif; ?>
				<?php echo get_sub_field( 'text' ) ? get_sub_field( 'text' ) : ''; ?>
			</div>
			<?php
				$link = get_sub_field( 'link' );
				$target = $link['new_window'] ? "" : "target='_blank'";
				$url = $link['url'];
				$link_text = isset( $link['title'] ) ? $link['title'] : $link['url'];
				echo $link_text && $url ? "<a $target class='opt-link' href='$url'>$link_text</a>" : '';
			?>
		</aside>
	<?php elseif (get_row_layout() == 'announcements' ): // Announcements ?>
		<aside class="links">
			<h2>Recent Announcements</h2>
			<ul>
			<?php 
			$num_to_show = get_sub_field( 'number_to_show' );
			$args = array(
				'post_type' => 'announcement', 
				'posts_per_page' => $num_to_show, 
				'orderby' => 'menu_order date', 
				'order' => 'ASC',
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
			while ( $loop->have_posts() ) : $loop->the_post();
				$internal_only = get_field( 'internal_only' );
				if ( $internal_only && !WASHU_IP )
					continue;
				$link = get_field( 'url' );
				
				if( $link['url'] != '' ) {
					$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
					$target = ( $link['new_window'] !== 0 ) ? " target='_blank'" : "";
				} else {
					$url = get_permalink();
					$target = "";
				}
				echo "\t\t\t\t\t<li><a$target href='$url' onclick=\"javascript:_gaq.push(['_trackEvent','outbound-announcement-sidebar','$url']);\">" . get_the_title() . "</a></li>\n";
				
			endwhile;
			wp_reset_query();
			?>
			</ul>
		</aside>
	<?php endif; 
	endwhile; ?>
</div>
>>>>>>> FETCH_HEAD
