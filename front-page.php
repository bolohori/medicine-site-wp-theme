<?php
/**
 * Added expires header for front page
 */
header( 'Expires: ' .gmdate( 'D, d M Y H:i:s \G\M\T', time() + ( 12 * 60 * 60 ) ) );

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

	/*
	 * Making the string able to have the arrow wrap
	 * with the last word.
	*/
	$explodedbutton = explode( ' ', $herobuttontext );
	$herobuttonlast = array_pop( $explodedbutton );

	echo '<div class="hero-banner mobile"></div>';
	echo '<div class="hero-container">';
		echo '<div class="hero-text">';
			echo '<span class="hero-headline">' . esc_html( $heroheadline ) . '</span>';
			echo '<p>' . esc_html( $herodesc ) . '</p>';
			echo '<a data-category="Front page" data-action="CTA - Hero banner - Admissions" class="cta-button" href="' . esc_html( $herobuttonlink ) . '">' . implode( ' ', $explodedbutton ) . ' ' . '<span class="cta-button-wrap">' . esc_html( $herobuttonlast ) . '</span>' . '</a>';
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
	<div class="icon">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/home/microscope-icon.svg" alt="microscope-icon">
		<span class="desctext">Top 10 Medical School</span>	
	</div>
	<div class="icon">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/home/graduation-icon.svg" alt="graduation-icon">
		<span class="desctext">13 Degree Programs</span>	
	</div>
	<div class="icon">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/home/hospital-icon.svg" alt="hospital-icon">
		<span class="desctext">76 Clinical Specialties and Subspecialties</span>	
	</div>
	<div class="icon">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/home/debt-icon.svg" alt="debt-icon">
		<span class="desctext">2nd-Lowest Student Debt</span>	
	</div>
</section>

<section class="half-callout">
	<div class="half-intro">
		<h2><?php the_field( 'half_callout_title', 'option' ); ?></h2>
	</div>
	<div class="half-info">
		<h3><?php the_field( 'half_callout_subhead', 'option' ); ?></h3>
		<p><?php the_field( 'half_callout_description', 'option' ); ?></p>
		<a class="hero-button" href="<?php the_field( 'half_callout_link', 'option' ); ?>"><?php the_field( 'half_callout_link_text', 'option' ); ?></a>
	</div>
</section>

<section class="news-section">
	<h2>Latest News</h2>

	<span class="more-link">Read all news</span>
</section>

<section class="showcase-section">
	<h2><?php the_field( 'showcase_headline', 'option' ); ?></h2>
	<p><?php the_field( 'showcase_caption', 'option' ); ?></p>
</section>

<section class="voices-section">
	<h2><?php the_field( 'full_callout_title', 'option' ); ?></h2>
	<div class="callout-quote">
		<h3><?php the_field( 'full_callout_quote', 'option' ); ?></h3>
		<span class="quote-attribution"><?php the_field( 'full_callout_quote_attribution', 'option' ); ?></span>
		<span class="attributor-description"><?php the_field( 'full_callout_attributor_description', 'option' ); ?></span>
		<a class="hero-button" href="<?php the_field( 'full_callout_cta_link', 'option' ); ?>">Read more</a>
	</div>
</section>

<section class="leaders-section">
	<h2><?php the_field( 'community_leaders_title', 'option' ); ?></h2>
	<div class="leader-lineup">
	
	</div>
	<span class="leader-description"><?php the_field( 'community_leaders_description', 'option' ); ?></span>
</section>

<section class="connect-section">
	<h2><?php the_field( 'full_callout_2_title', 'option' ); ?></h2>
	<p class="connect-subhead"><?php the_field( 'full_callout_2_subhead', 'option' ); ?></p>
	<a href="hero-button" href="<?php the_field( 'full_callout_2_link', 'option' ); ?>"><?php the_field( 'full_callout_2_link_text' ); ?></a>
</section>

<section class="full-section">
	<div class="full-split-left">
		
	</div>
	<div class="full-split-right">
	
	</div>
</section>

<section class="stlouis-home">
	<div class="wrap">
		<div class="text-intro">
			<div class="wrap">
				<h2>Our city will surprise you.</h2>
				<p>Here you’ll find charming neighborhoods, vibrant cultural and culinary scenes, and plenty of fun for nature-lovers and urbanites alike &ndash; all packed into an incredibly affordable city.</p>
				<a data-category="Front page" data-action="CTA - St. Louis" class="home-cta-button" href="https://medicine.wustl.edu/about/st-louis/"><span class="home-cta-button-wrap">Why we love St. Louis</span></a>;
				<a href="#">Why we love St. Louis</a>
			</div>
		</div>
		<div class="stlouis-outline"></div>
	</div>
</section>

<?php get_footer(); ?>
