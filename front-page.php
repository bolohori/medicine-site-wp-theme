<?php
/**
 * Added expires header for front page
 */
header( 'Expires: ' .gmdate ( 'D, d M Y H:i:s \G\M\T', time() + ( 12 * 60 * 60 ) ) );

get_header();

// Get image for hero banner.
if ( get_field( 'hero_image', 'option' ) ) {
	$heroimg = get_field( 'hero_image', 'option' );
	if ( $heroimg['sizes']['hero-img-2x-width'] < 2880 ) {
		$heroimg2x = $heroimg['sizes']['hero-img-1_5x'];
	} else {
		$heroimg2x = $heroimg['sizes']['hero-img-2x'];
	}
}
?>
<style>
	.hero-banner,
	.hero-banner .mobile {
		background-image: url(<?php echo $heroimg['sizes']['hero-img-sm']; ?>);
	}
	@media screen and (min-width: 639px),
		screen and (-webkit-min-device-pixel-ratio: 1.5),
		screen and (min-resolution: 144dpi) {
		.hero-banner {
			background-image: url(<?php echo $heroimg['sizes']['hero-img']; ?>);
		}
	}
	@media screen and (min-resolution: 144dpi) and (min-width: 639px), 
		screen and (-webkit-min-device-pixel-ratio: 1.5) and (min-width: 639px) {
		.hero-banner {
			background-image: url(<?php if ( $heroimg2x[1] >= 2880 ) { echo $heroimg['sizes']['hero-img-2x']; } else { echo $heroimg['sizes']['hero-img-1_5x']; } ?>);
		}
	}
</style>

<div id="page">
	<section class="hero-banner desktop">
	<?php
	if ( get_field( 'hero_image', 'option' ) ) {
		// Adds featured image size for pages.
		$heroalign = ' ' . get_field( 'text_alignment', 'option' );
		$heroheadline = get_field( 'headline', 'option' );
		$herodesc = get_field( 'descriptive_text', 'option' );
		$herobuttontext = get_field( 'button_text', 'option' );
		$herobuttonlink = get_field( 'button_link', 'option' );

		/*
		* Making the string able to have the arrow wrap
		* with the last word.
		*/
		$explodedbutton = explode( ' ', $herobuttontext );
		$herobuttonlast = array_pop( $explodedbutton );

		echo '<div class="hero-banner mobile"></div>';
		echo '<div class="hero-container' . $heroalign . '">';
			echo '<div class="hero-text">';
				echo '<h2 class="hero-headline">' . esc_html( $heroheadline ) . '</h2>';
				echo '<p>' . esc_html( $herodesc ) . '</p>';
				echo '<a data-category="Front page" data-action="Call to action" data-label=" ' . $herobuttontext . '" class="cta-button gray" href="' . esc_html( $herobuttonlink ) . '">' . implode( ' ', $explodedbutton ) . ' ' . '<span class="cta-button-wrap">' . esc_html( $herobuttonlast ) . '</span>' . '</a>';
			echo '</div>';
		echo '</div>';
	}
	?>
	</section>

	<?php
		if ( function_exists( 'wusm_alert_display' ) ) {
			wusm_alert_display();
		}
	?>

	<section class="bythenumbers">
		<h2>&#35;WashUMed</h2>
		<span class="tagline">by the numbers</span>
		<div class="icons">
			<div class="icon">
				<a data-category="Front page" data-action="Click" data-label="Top 10 Medical Schools" href=" https://www.usnews.com/best-graduate-schools/top-medical-schools/research-rankings"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/home/microscope-icon.svg" alt="microscope-icon">
				<span class="desctext">Top 10 Medical School</span></a>
			</div>
			<div class="icon">
				<a data-category="Front page" data-action="Click" data-label="13 Degree Programs" href="https://medicine.wustl.edu/education/admissions/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/home/graduation-icon.svg" alt="graduation-icon">
				<span class="desctext">13 Degree Programs</span></a>
			</div>
			<div class="icon">
				<a data-category="Front page" data-action="Click" data-label="76 Clinical Specialties & Subspecialties" href="https://wuphysicians.wustl.edu/medical-services/specialties"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/home/hospital-icon.svg" alt="hospital-icon">
				<span class="desctext">76 Clinical Specialties &amp; Subspecialties</span></a>
			</div>
			<div class="icon">
				<a data-category="Front page" data-action="Click" data-label="2nd-Lowest Student Debt" href="https://medicine.wustl.edu/education/financial-support/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/home/debt-icon.svg" alt="debt-icon">
				<span class="desctext">2nd-Lowest Student Debt</span></a>
			</div>
		</div>
	</section>

	<section class="half-callout">
		<div class="half-intro">
			<div class="triangle"></div>
			<?php
				$hc_image = get_field( 'half_callout_image', 'option' );
				$size = 'full-split';

				if ( $hc_image ) {
					echo wp_get_attachment_image ( $hc_image, $size );
				}
			?>
			<h2 class="white"><?php the_field( 'half_callout_title', 'option' ); ?></h2>
		</div>
		<div class="half-info">
			<h3 class="fancy-heading"><?php 
				$halfsubhead = get_field( 'half_callout_subhead', 'option' );
				$halfpieces = explode(' ', $halfsubhead );
				$halflastword = array_pop( $halfpieces );
				$halfstr = preg_replace('/\W\w+\s*(\W*)$/', '$1', $halfsubhead);
				echo $halfstr . ' <span class="sanstext">' . $halflastword . '</span>';
			?></h3>
			<p><?php the_field( 'half_callout_description', 'option' ); ?></p>

			<?php
			/*
			* Making the string able to have the arrow wrap
			* with the last word.
			*/
			$hc_link = get_field( 'half_callout_link', 'option' );
			$hc_text = get_field( 'half_callout_link_text', 'option' );
			$hc_exploded = explode( ' ', $hc_text );
			$hc_last = array_pop( $hc_exploded );

			echo '<a data-category="Front page" data-action="Call to action" data-label="' . $hc_text . '" class="cta-button secondary" href="' . esc_html( $hc_link ) . '">' . implode( ' ', $hc_exploded ) . ' ' . '<span class="cta-button-wrap">' . esc_html( $hc_last ) . '</span>' . '</a>';
			?>
		</div>
	</section>

	<section class="news-section">
		<h2 class="sanstext">Latest News</h2>
			<?php if ( have_rows( 'news_items', 'option' ) ) {
				echo '<div class="home-stories">';
					while ( have_rows( 'news_items', 'option' ) ) {
						the_row();
						$post_id = get_sub_field( 'news_item', false, false );
						$date = get_the_date( '', $post_id );
						$title = get_the_title( $post_id );
						$link = get_permalink( $post_id );
						?>
						<a data-category="Front page" data-action="Click" data-label="<?php echo $title; ?>" href="<?php echo $link; ?>">
							<div class="home-story">
								<?php echo get_the_post_thumbnail( $post_id, 'news' ); ?>
								<div class="home-news-info">
									<span class="home-news-date"><?php echo $date; ?></span>
									<span class="home-news-title"><?php echo $title; ?></span>
								</div>
							</div>
						</a>
						<?php
					}
				echo '</div>';
			} ?>
		<a data-category="Front page" data-action="CTA - Hero banner - Admissions" class="cta-button secondary" href="/news"><span class="cta-button-wrap">Read all news</span></a>
	</section>

	<section class="showcase-section">
		<div class="background">
			<?php
				$sc_image = get_field( 'showcase_image', 'option' );
				$size = 'hero-img-2x';

				if ( $sc_image ) {
					echo wp_get_attachment_image ( $sc_image, $size );
				}
			?>
		</div>
		<div class="textoverlay">
			<div class="play"><a data-category="Front page" data-action="Click" data-label="Showcase Video" href="<?php the_field( 'showcase_video_link', 'option' ); ?>" data-lity><img src="<?php echo get_stylesheet_directory_uri() . '/_/img/play-button.svg'; ?>"></a></div>
			<div class="textwrap">
				<h2 class="white"><?php the_field( 'showcase_headline', 'option' ); ?></h2>
				<p><?php the_field( 'showcase_caption', 'option' ); ?></p>
			</div>
		</div>
	</section>

	<section class="voices-section">
		<div class="voices-image">
			<?php
			$voiceimg = get_field( 'full_callout_image', 'option' );
			$size = 'full';
			
			if ( $voiceimg ) {
				echo wp_get_attachment_image( $voiceimg, $size );
			}
			?>
		</div>
		<div class="voices-quote">
			<h2 class="fancy-heading"><?php 
				$voicetitle = get_field( 'full_callout_title', 'option' );
				$voicepieces = explode(' ', $voicetitle );
				$voicelastword = array_pop( $voicepieces );
				$voicestr = preg_replace('/\W\w+\s*(\W*)$/', '$1', $voicetitle);
				echo $voicestr . ' <span class="sanstext">' . $voicelastword . '</span>';
			?></h2>
			<p><?php the_field( 'full_callout_quote', 'option' ); ?></p>
			<span class="quote-attribution"><?php the_field( 'full_callout_quote_attribution', 'option' ); ?></span>
			<span class="attributor-description"><?php the_field( 'full_callout_attributor_description', 'option' ); ?></span>
			<a data-category="Front page" data-action="Call to action" data-label="<?php the_field( 'full_callout_quote_attribution', 'option' ); ?>" class="cta-button secondary" href="<?php the_field( 'full_callout_cta_link', 'option' ); ?>"><span class="cta-button-wrap">Read more</span></a>
		</div>
	</section>

	<section class="leaders-section">
		<div class="leaders-intro">
			<h2 class="white"><?php the_field( 'community_leaders_title', 'option' ); ?></h2>
			<p><?php the_field( 'community_leaders_description', 'option' ); ?></p>
		</div>
		<div class="leader-lineup">
			<div class="leaders-intro">
				<img src="<?php echo get_stylesheet_directory_uri() . '/_/img/home/leaders-bg-mobile@2x.jpg'; ?>">
				<div class="leaders-text-wrap">
					<h2 class="white"><?php the_field( 'community_leaders_title', 'option' ); ?></h2>
					<p><?php the_field( 'community_leaders_description', 'option' ); ?></p>
				</div>
			</div>
			<?php
				if ( have_rows( 'community_leader', 'option' ) ) {
					while ( have_rows( 'community_leader', 'option' ) ) {
						the_row();
						$leaderlink = get_sub_field( 'community_leader_link' );
						echo '<div class="leader">';
							echo '<a data-category="Front page" data-action="Click" data-label="' . the_sub_field( 'community_leader_name' ) . '" href="' . $leaderlink . '">';
								$leaderimg = get_sub_field( 'community_leader_image' );
								if ( $leaderimg ) {
									echo wp_get_attachment_image( $leaderimg, 'leaders-2x' );
								} else {
									echo '<img src="' . get_template_directory_uri() . '/_/img/spotlight-default.png">';
								}
								echo '<div class="leadertext">';
									echo '<span class="leadername">';
										the_sub_field( 'community_leader_name' );
									echo '</span>';
									the_sub_field( 'community_leader_description' );
								echo '</div>';
							echo '</a>';
						echo '</div>';
					}
				}
			?>
		</div>
	</section>

	<section class="connect-section">
		<h2><?php the_field( 'full_callout_2_title', 'option' ); ?></h2>
		<p class="connect-subhead"><?php the_field( 'full_callout_2_subhead', 'option' ); ?></p>
		<?php
		/*
		* Making the string able to have the arrow wrap
		* with the last word.
		*/
		$fc2_link = get_field( 'full_callout_2_link', 'option' );
		$fc2_text = get_field( 'full_callout_2_link_text', 'option' );
		$fc2_exploded = explode( ' ', $fc2_text );
		$fc2_last = array_pop( $fc2_exploded );

		echo '<a data-category="Front page" data-action="Call to action" data-label="' . $fc2_text . '" class="cta-button secondary" href="' . esc_html( $fc2_link ) . '">' . implode( ' ', $fc2_exploded ) . ' ' . '<span class="cta-button-wrap">' . esc_html( $fc2_last ) . '</span>' . '</a>';
		?>
	</section>

	<section class="full-section">
		<div class="full-split-left">
			<h2 class="fancy-heading"><?php 
				$splittitle = get_field( 'full_split_subhead', 'option' );
				$splitpieces = explode(' ', $splittitle );
				$splitlastword = array_pop( $splitpieces );
				$splitstr = preg_replace('/\W\w+\s*(\W*)$/', '$1', $splittitle);
				echo $splitstr . ' <span class="sanstext">' . $splitlastword . '</span>';
			?></h2>
			<p><?php the_field( 'full_split_subhead_description', 'option' ); ?></p>
			<?php
			/*
			* Making the string able to have the arrow wrap
			* with the last word.
			*/
			$fs_link = get_field( 'full_split_link', 'option' );
			$fs_text = get_field( 'full_split_link_text', 'option' );
			$fs_exploded = explode( ' ', $fs_text );
			$fs_last = array_pop( $fs_exploded );

			echo '<a data-category="Front page" data-action="Call to action" data-label="' . $splittitle . '" class="cta-button secondary" href="' . esc_html( $fs_link ) . '">' . implode( ' ', $fs_exploded ) . ' ' . '<span class="cta-button-wrap">' . esc_html( $fs_last ) . '</span>' . '</a>';
			?>
		</div>
		<div class="full-split-right">
			<div class="triangle"></div>
			<?php
				$fs_image = get_field( 'full_split_image', 'option' );
				$size = 'full-split';

				if ( $fs_image ) {
					echo wp_get_attachment_image ( $fs_image, $size );
				}
			?>
			<h3 class="white large-headline"><?php the_field( 'full_split_callout_title', 'option' ); ?></h3>
		</div>
	</section>

	<section class="stlouis-home">
		<div class="wrap">
			<div class="text-intro">
				<div class="wrap">
					<h2>Our city will surprise you.</h2>
					<p>Here you’ll find charming neighborhoods, vibrant cultural and culinary scenes, and plenty of fun for nature-lovers and urbanites alike &ndash; all packed into an incredibly affordable city.</p>
					<a data-category="Front page" data-action="Call to action" data-label="Why we love St. Louis" class="cta-button secondary" href="https://medicine.wustl.edu/about/st-louis/"><span class="cta-button-wrap">Why we love St. Louis</span></a>
				</div>
			</div>
			<div class="stlouis-outline"></div>
		</div>
	</section>
</div>

<?php get_footer(); ?>
