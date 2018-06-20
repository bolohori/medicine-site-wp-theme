<?php 

// Added expires header for front page
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (12 * 60 * 60)));

get_header(); 
if ( get_field( 'hero_image', 'option' ) ) {
	$heroimg = get_field( 'hero_image', 'option' );
	if ( $heroimg['sizes']['hero-img-2x-width'] < 2880 ) {
		$heroimg2x = $heroimg['sizes']['hero-img-1_5x'];
	} else {
		$heroimg2x = $heroimg['sizes']['hero-img-2x'];
	}
} ?>
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
			background-image: url(<?php if ( $image2x[1] >= 2880 ) { echo $heroimg['sizes']['hero-img-2x']; } else { echo $heroimg['sizes']['hero-img-1_5x']; } ?>);
		}
	}
</style>
<section class="hero-banner desktop">
	<?php
		if ( get_field( 'hero_image', 'option' ) ) {
			// Adds featured image size for pages.
			$heroalign = get_field( 'text_alignment', 'option' );
			$heroheadline = get_field( 'headline', 'option' );
			$herodesc = get_field( 'descriptive_text', 'option' );
			$herobuttontext = get_field( 'button_text', 'option' );
			$herobuttonlink = get_field( 'button_link', 'option' );

			// generate the markup for the responsive image
			echo '<div class="hero-banner mobile"></div>';
			echo '<div class="hero-container">';
				echo '<div class="hero-text">';
					echo '<span class="hero-headline">' . $heroheadline . '</span>';
					echo '<p>' . $herodesc . '</p>';
					echo '<a class="hero-button" href="' . $herobuttonlink . '">' . $herobuttontext . ' &gt;</a>';
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

<section class="news-home">
	<div class="text-intro">
		<div class="wrap">
			<h2>We connect the brightest minds in medicine.</h2>
			<p>With passion and determination, our teachers, scholars, caregivers and innovators come together to tackle medicine's toughest challenges.</p>
		</div>
	</div>
	<section class="news">
		<div class="news-cards">
			<ul class="clearfix">
				<li class="news-block">
					<div>
						<a data-category="Front page" data-action="CTA - See our latest news" href="/news">
							<div class="card latest-news-block">
								<p>Explore the scientific discovery, medical innovation and commitment to care that inspire us.</p>
								<span class="link">See our latest news</span>
							</div>
						</a>
					</div>
				</li>
				<?php
					if ( have_rows( 'home_stories', 'option' ) ) {
						while ( have_rows( 'home_stories', 'option' ) ) : the_row();
							$newscards = get_sub_field( 'selected_stories', 'option' );
							if ( $newscards ) {
								$post = $newscards;
								setup_postdata( $post );
								get_template_part( '_/php/news/card' );
							}
						endwhile;
					}
				?>
			</ul>
		</div>
	</section>
</section>

<section class="cta-home turquoise">
	<div class="wrap">
		<div class="cta-text">
			<h2>We're turning ideals into action.</h2>
			<p>The School of Medicine is taking meaningful action to increase diversity on campus and in medical professions.</p>
		</div>
		<a data-category="Front page" data-action="CTA - Diversity" href="/about/diversity-inclusion/" class="cta-button">SEE DIVERSITY INITIATIVES</a>
	</div>
</section>

<?php do_action( 'wusm_front_page_additional_sections' );?>

<section class="leaders-home">
	<div class="text-intro">
		<div class="wrap">
			<h2>We are a community of leaders.</h2>
			<p>Engaged in our fields at home and around the world, we are defining the future of health and medicine.</p>
		</div>
	</div>
	<section class="leaders">
		<?php
		$args = array(
			'post_type'      => 'post',
			'news'           => 'national-leaders',
			'posts_per_page' => 3,
			'orderby'        => 'date'
		);
		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) { ?>
			<div class="news-cards">
				<ul class="clearfix">
					<?php while ( $the_query->have_posts() ) {
						$the_query->the_post();
						get_template_part( '_/php/news/card' );
					} ?>
				</ul>
			</div>
		<?php
		}
		wp_reset_postdata(); ?>
		<a class="national-leaders-see-all" href="/news/type/national-leaders/">SEE ALL</a>
	</section>
</section>

<section class="cta-home">
	<div class="wrap">
		<div class="cta-text">
			<h2>The future of medicine starts here.</h2>
			<p>Our top-ranked, student-centered programs will prepare you to join the next generation of leaders.</p>
		</div>
		<a data-category="Front page" data-action="CTA - Admissions button" href="/education/admissions/" class="cta-button">Explore our programs</a>
	</div>
</section>

<section class="icons-home">
	<div class="wrap">
		<a data-category="Front page" data-action="Icon - Facts and figures" href="https://otm.wustl.edu/facts-figures/" class="iconlink">
			<div class="icon">
				<object type="image/svg+xml" data="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/svg/lightbulb.svg">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/lightbulb.png" srcset="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/lightbulb-2x.png 2x" alt="lightbulb icon">
					<span class="visuallyhidden">lightbulb icon</span>
				</object>
				<div class="context">209 patents filed by faculty and students in FY2016</div>
			</div>
		</a>
		<a data-category="Front page" data-action="Icon - Specialties" href="https://wuphysicians.wustl.edu/medical-services/specialties" class="iconlink">
			<div class="icon">
				<object type="image/svg+xml" data="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/svg/76.svg">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/76.png" srcset="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/76-2x.png 2x" alt="76">
					<span class="visuallyhidden">76</span>
				</object>
				<div class="context">clinical specialties and subspecialties</div>
			</div>
		</a>
		<a data-category="Front page" data-action="Icon - Nobel Laureates" href="/research/nobel-prize-winners/" class="iconlink">
			<div class="icon nobel">
				<object>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/nobel.png" srcset="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/nobel-2x.png 2x" alt="nobel laureates">
					<span class="visuallyhidden">nobel laureates</span>
				</object>
				<div class="context">18 nobel laureates associated with the school</div>
			</div>
		</a>
		<a data-category="Front page" data-action="Icon - Patient care"  href="/patient-care/" class="iconlink">
			<div class="icon">
				<object type="image/svg+xml" data="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/svg/stethoscope.svg">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/stethoscope.png" srcset="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/stethoscope-2x.png 2x" alt="lightbulb icon">
					<span class="visuallyhidden">stethoscope icon</span>
				</object>
				<div class="context">67% of faculty members also treat patients</div>
			</div>
		</a>
	</div>
</section>

<?php get_footer(); ?>
