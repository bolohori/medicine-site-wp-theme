<?php get_header(); ?>

<div class="slide-wrapper billboard">
	<ul class="billboard-slider">
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

				$imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

			echo "<li><a href=\"$url\" alt='$title' onclick=\"__gaTracker('send','event','outbound-billboard','$title');\"><div style='background-image:url(" . $imgurl . ");'><div class='billboard-overlay'></div>" . get_the_post_thumbnail( $post->ID ) . "<div class='billboard-title-wrap'><p class='billboard-title'>$title &raquo;</p></div></div></a></li>\n";
		endwhile;
		wp_reset_postdata();
?>
	</ul>
</div>

<?php
    if (function_exists('wusm_emergency_ribbon')) {
        echo wusm_emergency_ribbon();
    }

    if (function_exists('wusm_yellow_ribbon')) {
        echo wusm_yellow_ribbon();
    }
?>

<section class="news">
	<div class="news-wrap">
		<div class="news-left slider-wrapper theme-default">
			<div class="all-news"><a href="news/in-the-media">SEE ALL</a></a></div>
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
					echo "<li><a class='news-title' href=\"$url\" onclick=\"__gaTracker('send','event','outbound-news_release','$title');\">$title</a><p>";
					echo "<a href=\"$url\" onclick=\"__gaTracker('send','event','outbound-news_release','$title');\">" . get_field('source') . "</a></p></li>";
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
 					
					echo "<li><a class='news-title' href=\"$url\" onclick=\"__gaTracker('send','event','outbound-news_release','$title');\">$title</a><p>";
					if( ( $video = get_field('video') ) !== '')
						echo "<a rel=\"prettyPhoto\" href=\"$video\">Watch</a> | ";
					if( get_field('audio') !== '') {
						$audio_out .= wp_audio_shortcode( array( 'src' => get_field('audio') ) );
						echo "<a data-id=\"mep_$j\" href=\"javascript:return false;\" onclick=\"__gaTracker('send','event','news-release-audio','$title');\" class=\"audio-file\">Listen</a> | ";
						$j++;
					}
					echo "<a href=\"$url\" onclick=\"__gaTracker('send','event','outbound-news_release','$title');\">Read Article</a></p></li>";
				endwhile;
				wp_reset_postdata();
?>
			</ul>
			<?php echo $audio_out; ?>
		</div>
	</div>
</section>

<div id="featured-image" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/_/img/hero/home.jpg);">
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/hero/home.jpg" alt="" title="Faculty physician Anita Bhandiwad, MD, FACC, and fellow Mark Vogel, MD, of the Cardiovascular Division">
</div>

<div class="hero-text">
	<div class="wrapper">
		<h1>Advancing&nbsp;Health, Enriching&nbsp;Lives</h1>
		<p>Connecting some of the brightest minds in human health, Washington University School of Medicine is a national leader in medical research, teaching and patient care. An outstanding faculty and rigorous curriculum prepare some of the world's most promising students to become the health care leaders of tomorrow.</p>
		<a class="hero-button" onclick="__gaTracker('send','event','hero-education','<?php echo get_permalink( get_page_by_title( 'Education' ) ); ?>');" href="<?php echo get_permalink( get_page_by_title( 'Education' ) ); ?>">education</a>
		<a class="hero-button" onclick="__gaTracker('send','event','hero-patient-care','<?php echo get_permalink( get_page_by_title( 'Patient Care' ) ); ?>');" href="<?php echo get_permalink( get_page_by_title( 'Patient Care' ) ); ?>">patient care</a>
		<a class="hero-button" onclick="__gaTracker('send','event','hero-research','<?php echo get_permalink( get_page_by_title( 'Research' ) ); ?>');" href="<?php echo get_permalink( get_page_by_title( 'Research' ) ); ?>">research</a>
	</div>
</div>


<section class="spotlight">
	<div class="spotlight-wrap">
		<div class="spotlight-intro">
			<h1>National Leadership</h1>
			<p class="spotlight-desc">Engaged in their fields and communities at home and around the world, the people of Washington University School of Medicine are defining the future of health and medicine.</p>
		</div>
<?php
				$i = 0;
				$slider = "";
				$captions = "";
				$args = array( 
					'post_type'      => 'spotlight',
					'posts_per_page' => 3,
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
					$excerpt = get_the_excerpt( );

					$slider .= "<li class='clearfix'><div class='spotlight-individual clearfix'>";
					$slider .= ( $url = $link['url'] ) ? "<a href=\"$url\" onclick=\"__gaTracker('send','event','national-leader','$title');\">" : "";
					$slider .= ( get_the_post_thumbnail( $img_to_get ) ) ? get_the_post_thumbnail( $img_to_get, 'spotlight-image', array('class' => 'spotlight-image', 'title' => $slidetitle) ) : "<img src='" . get_stylesheet_directory_uri() . "/_/img/spotlight-default.png' class='spotlight-image' title='" . $slidetitle . "'>";
					$slider .= ( $url = $link['url'] ) ? "</a>" : "";

					$read_more_link = ( $url = $link['url'] ) ? "<a class='spotlight-more' href=\"$url\" onclick=\"__gaTracker('send','event','national-leader','$title');\">Read More</a>" : "";

					$slider .= "<h2>";
					$slider .= ( $url = $link['url'] ) ? "<a href=\"$url\" onclick=\"__gaTracker('send','event','national-leader','$title');\">" : "";
					$slider .= "$title";
					$slider .= ( $url = $link['url'] ) ? "</a>" : "";
					$slider .= "</h2><p>$excerpt&nbsp;&nbsp;$read_more_link</p>";
					$slider .= "</div></li>";
					$i++;
				endwhile;
				wp_reset_postdata();
				remove_filter( 'post_thumbnail_html', 'remove_billboard_dimensions', 10 );
?>
		<ul class="spotlight-featured">
			<?php echo $slider; ?>
		</ul>
		<a class="spotlight-archive" href="/news/leaders">SEE ALL</a>
	</div>
</section>

<?php get_footer(); ?>