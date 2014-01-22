<?php get_header(); ?>
<div class="slide-wrapper">
	<div class="slider-wrapper theme-default">
		<div id="slider" class="nivoSlider">
<?php
			$num_to_show = get_option( 'billboards_to_show', 5 );
			$args = array( 'post_type' => 'billboard', 'posts_per_page' => $num_to_show );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
				$internal_only = get_field('internal_only');
				if ($internal_only[0] && !WASHU_IP)
					continue;

				$link = get_field('link');
				
				$target = $link['external'] ? "" : "target='_blank'";
				$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
 				$title = get_the_title();

				echo "<a $target href='$url' alt='$title'>" . get_the_post_thumbnail( $post->ID ) . "</a>\n";

			endwhile;
			wp_reset_postdata();
?>
		</div>
	</div>
</div>
<section class="news" >
	<div class="wrapper">
		<div class="news-left slider-wrapper theme-default">
<?php
				$args = array( 'post_type' => 'in_the_news', 'posts_per_page' => 4 );
				$loop = new WP_Query( $args );
				$i = 1;
				$images = "";
				$captions = "";
				while ( $loop->have_posts() ) : $loop->the_post();
					$images .= "<img src='";
					$images .= get_field( 'thumbnail' ) ? get_field( 'thumbnail' ) : get_stylesheet_directory_uri() . "/_/img/itn-default.png'";
					$images .= "' alt='' title='#htmlcaption" . $i . "' />\n";
					$captions .= "<div id='htmlcaption" . $i . "' class='nivo-html-caption'><a target='_blank' href='" . get_field( 'url' ) . "'><p class='news-citation'>" . get_field('source') . "</p>" . get_the_title() . "</a></div>\n";
					$i++;
				endwhile;
				wp_reset_postdata();
				echo "<div id='news-slider' class='nivoSlider'>" . $images . "</div>" . $captions . "\n";
?>
			<a class="in-the-news-archive" href="/in_the_news">MORE</a>
		</div>
			
		<div class="news-right">
			<div class="all-news"><a href="news/releases">ALL NEWS</a></a></div>
			<h1 class="recent-news">Recent News</h1>
			<ul class="news-list">
<?php
				$i = 0;
				$j = 0;
				$args = array( 'post_type' => 'news_releases', 'posts_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC'  );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					echo "<li>" . get_the_title() . "<p>";
					if( get_field('video') != '')
						echo "<a rel='prettyPhoto' href='" . get_field('video') . "'>Watch</a> | ";
					if( get_field('audio') != '') {
						$audio_out .= wp_audio_shortcode(array('src'=>get_field('audio')));
						echo "<a data-id='mep_$j' href='#' class='audio-file'>Listen</a> | ";
						$j++;
					}
					$link = get_field('url');
					$target = $link['external'] ? "" : "target='_blank'";
					$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
 					echo "<a $target href='$url'>Read Article</a></p></li>";
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
		<h1>Advancing Health, Enriching Lives</h1>
		<p>Connecting some of the brightest minds in human health, Washington University School of Medicine is a national leader in medical research, teaching and patient care. An outstanding faculty and rigorous curriculum prepare some of the world's most promising students to become the health care leaders of tomorrow.</p>
		<a class="hero-button" href="<?php echo page_by_name('Education'); ?>">education</a>
		<a class="hero-button" href="<?php echo page_by_name('Patient Care'); ?>">patient care</a>
		<a class="hero-button" href="<?php echo page_by_name('Research'); ?>">research</a>
	</div>
</div>


<div class="spotlight">
	<div class="wrapper">
		<a href="/news/leaders" class="spotlight-archive">MORE</a>
		<h1>National Leadership</h1>
		<p>Engaged in their fields as well as communities at home and around the world, the people of Washington University School of Medicine are actively defining the future of medicine and health.</p>
<?php
				$i = 0;
				$slider = "";
				$captions = "";
				$args = array( 'post_type' => 'spotlight', 'posts_per_page' => 4, 'orderby' => 'menu_order', 'order' => 'ASC' );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					$slidetitle = "#spotlightcaption$i";
					$slider .= ( get_the_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail( $post->ID, 'spotlight-image', array('class' => 'spotlight-image', 'title' => $slidetitle) ) : "<img src='" . get_stylesheet_directory_uri() . "/_/img/spotlight-default.png' class='spotlight-image' title='" . $slidetitle . "'>";
					$captions .= "<div id='spotlightcaption$i' class='nivo-html-caption'><strong style='font-size:15px'>" . get_the_title() . "</strong><p>" . get_the_content() ."</p><a href=''>Read More</a></div>";
					$i++;
				endwhile;
				wp_reset_postdata();
?>

		<div class="spotlight-div spotlight-slider-wrapper slider-wrapper theme-default">
			<div class="spotlight-div" id="spotlight-slider" class="nivoSlider">
				<?php echo $slider; ?>
			</div>
		</div>
		<?php echo $captions; ?>
	</div>
</div>
<?php get_footer(); ?>