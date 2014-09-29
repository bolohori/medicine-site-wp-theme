<?php get_header(); ?>
<?php get_sidebar(); ?>
<div class="slide-wrapper billboard">
	<div class="slider-wrapper theme-default">
		<div id="billboard-slider" class="nivoSlider">
<?php
			$num_to_show = get_option( 'billboards_to_show', 5 );
			
			$args = array(
				'post_type'      => 'billboard', 
				'posts_per_page' => $num_to_show, 
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'fields'         => 'ids',
				'meta_key'       => 'sticky',
				'meta_value'     => 1
			);
			$loop = new WP_Query( $args );
			$ids = $loop->posts;
			$num_to_show = $num_to_show - sizeof( $ids );

			if ( $num_to_show > 0 ) {
				$args = array(
					'post_type'      => 'billboard', 
					'posts_per_page' => $num_to_show, 
					'orderby'        => 'date',
					'post__not_in'   => $ids,
					'fields'         => 'ids'
				);
				$loop = new WP_Query( $args );
				$ids = array_merge( $ids, $loop->posts );
			}

			$args = array(
				'post_type' => 'billboard',
				'orderby'   => 'post__in',
				'post__in'  => $ids
			);

			$loop = new WP_Query( $args );
			
			// Need this for billboards AND in the news images
			add_filter( 'post_thumbnail_html', 'remove_billboard_dimensions', 10, 5 );

			while ( $loop->have_posts() ) : $loop->the_post();
				$internal_only = get_field('internal_only');
				if ( $internal_only && !WASHU_IP )
					continue;

				$link = get_field('link');
				
				$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
 				$title = get_the_title();

				echo "<a href=\"$url\" alt='$title' onclick=\"javascript:_gaq.push(['_trackEvent','outbound-billboard','$title']);\">" . get_the_post_thumbnail( $post->ID ) . "</a>\n";
			endwhile;
			wp_reset_postdata();
?>
		</div>
	</div>
</div>
<section class="news" >
	<div class="wrapper">
		<div class="news-left slider-wrapper theme-default">
			<div class="all-news"><a href="news/press">SEE ALL</a></a></div>
			<h1 class="news-header">In the Media</h1>
			<ul class="news-list">
<?php
				$args = array(
					'post_type'      => 'media_mentions',
					'posts_per_page' => 3,
					'orderby'        => 'date'
				);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					$url = get_field('url');
					$title = get_the_title();
					echo "<li><a class='news-title' href=\"$url\" onclick=\"javascript:_gaq.push(['_trackEvent','outbound-news_release','$title']);\">$title</a><p>";
					echo "<a href=\"$url\" onclick=\"javascript:_gaq.push(['_trackEvent','outbound-news_release','$title']);\">" . get_field('source') . "</a></p></li>";
				endwhile;
				wp_reset_postdata();
?>
			</ul>
		</div>
			
		<div class="news-right">
			<div class="all-news"><a href="news/releases">SEE ALL</a></a></div>
			<h1 class="news-header">News Releases</h1>
			<ul class="news-list">
<?php

				$j = 0;
				$audio_out = '';
				$args = array(
					'post_type'      => 'news_releases',
					'posts_per_page' => 3,
					'orderby'        => 'date'
				);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					$link = get_field('url');
					$title = get_the_title();
					$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
 					
					echo "<li><a class='news-title' href=\"$url\" onclick=\"javascript:_gaq.push(['_trackEvent','outbound-news_release','$title']);\">$title</a><p>";
					if( ( $video = get_field('video') ) !== '')
						echo "<a rel=\"prettyPhoto\" href=\"$video\">Watch</a> | ";
					if( get_field('audio') !== '') {
						$audio_out .= wp_audio_shortcode( array( 'src' => get_field('audio') ) );
						echo "<a data-id=\"mep_$j\" href=\"javascript:return false;\" class=\"audio-file\">Listen</a> | ";
						$j++;
					}
					echo "<a href=\"$url\" onclick=\"javascript:_gaq.push(['_trackEvent','outbound-news_release','$title']);\">Read Article</a></p></li>";
				endwhile;
				wp_reset_postdata();
?>
			</ul>
			<?php echo $audio_out; ?>
		</div>
	</div>
</section>

<div id="featured-image">
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/hero/home.jpg" alt="" title="Faculty physician Anita Bhandiwad, MD, FACC, and fellow Mark Vogel, MD, of the Cardiovascular Division">
</div>

<div class="hero-text">
	<div class="wrapper">
		<h1>Advancing&nbsp;Health, Enriching&nbsp;Lives</h1>
		<p>Connecting some of the brightest minds in human health, Washington University School of Medicine is a national leader in medical research, teaching and patient care. An outstanding faculty and rigorous curriculum prepare some of the world's most promising students to become the health care leaders of tomorrow.</p>
		<a class="hero-button" onclick="javascript:_gaq.push(['_trackEvent','hero-education','<?php echo get_permalink( get_page_by_title( 'Education' ) ); ?>']);" href="<?php echo get_permalink( get_page_by_title( 'Education' ) ); ?>">education</a>
		<a class="hero-button" onclick="javascript:_gaq.push(['_trackEvent','hero-patient-care','<?php echo get_permalink( get_page_by_title( 'Patient Care' ) ); ?>']);" href="<?php echo get_permalink( get_page_by_title( 'Patient Care' ) ); ?>">patient care</a>
		<a class="hero-button" onclick="javascript:_gaq.push(['_trackEvent','hero-research','<?php echo get_permalink( get_page_by_title( 'Research' ) ); ?>']);" href="<?php echo get_permalink( get_page_by_title( 'Research' ) ); ?>">research</a>
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
				$args = array( 
					'post_type'      => 'spotlight',
					'posts_per_page' => $num_of_spotlights,
					'orderby'        => 'date'
				);
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

					/*$limit = 11;
					$excerpt = explode(' ', get_the_excerpt(), $limit);
					array_pop($excerpt);
					$excerpt = implode(" ",$excerpt);*/
					$excerpt = get_the_excerpt( );
					
					$slider .= ( get_the_post_thumbnail( $img_to_get ) ) ? get_the_post_thumbnail( $img_to_get, 'spotlight-image', array('class' => 'spotlight-image', 'title' => $slidetitle) ) : "<img src='" . get_stylesheet_directory_uri() . "/_/img/spotlight-default.png' class='spotlight-image' title='" . $slidetitle . "'>";

					$read_more_link = ( $url = $link['url'] ) ? "<a href=\"$url\" onclick=\"javascript:_gaq.push(['_trackEvent','outbound-news_release','$title']);\">Read More</a>" : "";

					$captions .= "<div id=\"spotlightcaption$i\" class=\"nivo-html-caption\"><strong style=\"font-size:15px\">$title</strong><p>$excerpt</p>$read_more_link</div>";
					$i++;
				endwhile;
				wp_reset_postdata();
				remove_filter( 'post_thumbnail_html', 'remove_billboard_dimensions', 10 );
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