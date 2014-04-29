<?php get_header();
function remove_billboard_dimensions( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	return preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
} ?>
<?php get_sidebar(); ?>
<div class="slide-wrapper">
	<div class="slider-wrapper theme-default">
		<div id="slider" class="nivoSlider">
<?php
			$num_to_show = get_option( 'billboards_to_show', 5 );
			$args = array( 'post_type' => 'billboard', 'posts_per_page' => $num_to_show );
			$loop = new WP_Query( $args );
			
			add_filter( 'post_thumbnail_html', 'remove_billboard_dimensions', 10, 5 );

			while ( $loop->have_posts() ) : $loop->the_post();
				$internal_only = get_field('internal_only');
				if ($internal_only && !WASHU_IP)
					continue;

				$link = get_field('link');
				
				$target = $link['new_window'] ? "" : "target='_blank'";
				$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
 				$title = get_the_title();

				echo "<a $target href='$url' alt='$title' onclick=\"javascript:_gaq.push(['_trackEvent','outbound-billboard','$url']);\">" . get_the_post_thumbnail( $post->ID ) . "</a>\n";

			endwhile;
			wp_reset_postdata();
			remove_filter( 'post_thumbnail_html', 'remove_billboard_dimensions', 10 );
?>
		</div>
	</div>
</div>
<section class="news" >
	<div class="wrapper">
		<div class="news-left slider-wrapper theme-default">
<?php
				$args = array( 'post_type' => 'media_mentions', 'posts_per_page' => 4 );
				$loop = new WP_Query( $args );
				$i = 1;
				$images = "";
				$captions = "";
				while ( $loop->have_posts() ) : $loop->the_post();
					$url = get_field( 'url' );
					$images .= "<img src='";
					$images .= get_field( 'thumbnail' ) ? get_field( 'thumbnail' ) : get_stylesheet_directory_uri() . "/_/img/itn-default.png'";
					$images .= "' alt='' title='#htmlcaption" . $i . "' />\n";
					$captions .= "<div id='htmlcaption" . $i . "' class='nivo-html-caption'><a target='_blank' href='$url' onclick=\"javascript:_gaq.push(['_trackEvent','outbound-in-the-media','$url']);\"><p class='news-citation'>" . get_field('source') . "</p>" . get_the_title() . "</a></div>\n";
					$i++;
				endwhile;
				wp_reset_postdata();
				echo "<div id='news-slider' class='nivoSlider'>" . $images . "</div>" . $captions . "\n";
?>
			<a class="in-the-news-archive" href="/news/press">MORE <span class="mobile-archive">PRESS MENTIONS&raquo;</span></a>
		</div>
			
		<div class="news-right">
			<div class="all-news"><a href="news/releases">ALL NEWS</a></a></div>
			<h1 class="recent-news">Recent News</h1>
			<ul class="news-list">
<?php
				$i = 0;
				$j = 0;
				$audio_out = '';
				$args = array( 'post_type' => 'news_releases', 'posts_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC'  );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					echo "<li>" . get_the_title() . "<p>";
					if( get_field('video') != '')
						echo "<a rel='prettyPhoto' href='" . get_field('video') . "'>Watch</a> | ";
					if( get_field('audio') != '') {
						$audio_out .= wp_audio_shortcode(array('src'=>get_field('audio')));
						echo "<a data-id='mep_$j' href='javascript:return false;' class='audio-file'>Listen</a> | ";
						$j++;
					}
					$link = get_field('url');
					$target = $link['new_window'] ? "" : "target='_blank'";
					$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
 					echo "<a $target href='$url' onclick=\"javascript:_gaq.push(['_trackEvent','outbound-news_release','$url]);\">Read Article</a></p></li>";
					$i++;
					if($i==3)
						echo "</ul>\n<ul class='news-list'>";
				endwhile;
				wp_reset_postdata();
?>
			</ul>
			<?php echo $audio_out; ?>
		</div>
	</div>
</section>

<div class="hero">
	<div class="wrapper">
		<img class="hero-image" src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/hero/image1.png" alt="Hero image">
	</div>
</div>

<div class="hero-text">
	<div class="wrapper">
		<h1>Advancing&nbsp;Health, Enriching&nbsp;Lives</h1>
		<p>Connecting some of the brightest minds in human health, Washington University School of Medicine is a national leader in medical research, teaching and patient care. An outstanding faculty and rigorous curriculum prepare some of the world's most promising students to become the health care leaders of tomorrow.</p>
		<a class="hero-button" href="<?php echo page_by_name('Education'); ?>">education</a>
		<a class="hero-button" href="<?php echo page_by_name('Patient Care'); ?>">patient care</a>
		<a class="hero-button" href="<?php echo page_by_name('Research'); ?>">research</a>
	</div>
</div>


<div class="spotlight">
	<div class="wrapper">
		<div class="spotlight-left">
		<h1>National Leadership</h1>
		<p class="spotlight-desc">Engaged in their fields and communities at home and around the world, the people of Washington University School of Medicine are actively defining the future of health and medicine.</p>
<?php
				$i = 0;
				$slider = "";
				$captions = "";
				$num_of_spotlights = get_option( 'spotlights_to_show', 4 );
				$args = array( 'post_type' => 'spotlight', 'posts_per_page' => $num_of_spotlights, 'orderby' => 'menu_order', 'order' => 'ASC' );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					$read_more_link = "";
					$link = get_field('nl-link');
					$slidetitle = "#spotlightcaption$i";
					
					if ( get_field( 'faculty_member' ) ) {
						$faculty_member = get_field( 'faculty_member' );
						$img_to_get = $faculty_member->ID;
					} else {
						$img_to_get = $post->ID;
					}

					$title = get_the_title();
					$content = "<p>".get_the_content()."</p>";

					$slider .= ( get_the_post_thumbnail( $img_to_get ) ) ? get_the_post_thumbnail( $img_to_get, 'spotlight-image', array('class' => 'spotlight-image', 'title' => $slidetitle) ) : "<img src='" . get_stylesheet_directory_uri() . "/_/img/spotlight-default.png' class='spotlight-image' title='" . $slidetitle . "'>";

					if ( $link['url'] !== null ) {
						$url = $link['url'];
						$target = ( $link['new_window'] !== 0 ) ? " target='_blank'" : "";
						$read_more_link = "<a$target href='$url' onclick=\"javascript:_gaq.push(['_trackEvent','outbound-news_release','$url]);\">Read More</a>";
					}

					$captions .= "<div id='spotlightcaption$i' class='nivo-html-caption'><strong style='font-size:15px'>" . $title . "</strong>$content$read_more_link</div>";
					$i++;
				endwhile;
				$captions .= "<div class='mobile-archive spotlight-archive'><a href='/news/leaders'>MORE NATIONAL LEADERS&raquo;</a></div>";
				wp_reset_postdata();
?>
		</div>
		
		<div class="spotlight-div spotlight-slider-wrapper slider-wrapper theme-default">
			<div class="spotlight-div" id="spotlight-slider" class="nivoSlider">
				<?php echo $slider; ?>
			</div>
			<div class="spotlight-archive">
				<a href="/news/leaders">MORE</a>
			</div>
		</div>
		<?php echo $captions; ?>
	
	</div>
</div>
<?php get_footer(); ?>