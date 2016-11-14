<?php get_header(); ?>

<section class="home-banner">
	<ul class="home-banner-slider">
		<?php
			if ( have_rows( 'banners', 'option'  ) ) {
				while ( have_rows( 'banners', 'option'  ) ) : the_row();
					echo '<li class="home-banner-single">';
						echo '<div>';
							$banner = get_sub_field( 'banner_photo', 'option' );
							echo '<div class="home-banneroverlay"><img src="' . $banner['url'] . '" class="home-bannerimg"></div>';
							echo '<h1>' . get_sub_field( 'banner_text', 'option' ) . '</h1>';
						echo '</div>';
					echo '</li>';
				endwhile;
			}
		?>
	</ul>
</section>

<?php
    if ( function_exists( 'wusm_alert_display' ) ) {
		wusm_alert_display();
	}
?>

<section class="news-home">
	<div class="text-intro">
		<div class="wrap">
			<h1>The future of medicine starts with you.</h1>
			<p>With passion and determination, our teachers, scholars, caregivers and innovators come together to tackle medicine's toughest challenges.</p>
		</div>
	</div>
	<section class="news">
		<div class="news-cards">
			<ul class="clearfix">
				<li class="news-block">
					<div>
						<a href="/news">
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

<section class="icons-home">
	<div class="wrap">
		<div class="icon first">
			<object type="image/svg+xml" data="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/svg/lightbulb.svg">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/lightbulb.png" srcset="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/lightbulb-2x.png 2x" alt="lightbulb icon">
				<span class="visuallyhidden">lightbulb icon</span>
			</object>
			<div class="context">209 patents filed by faculty and students in FY2016</div>
		</div>
		<div class="icon">
			<object type="image/svg+xml" data="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/svg/76.svg">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/76.png" srcset="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/76-2x.png 2x" alt="76">
				<span class="visuallyhidden">76</span>
			</object>
			<div class="context">clinical specialties and subspecialties in medicine and allied health</div>
		</div>
		<div class="icon nobel">
			<object>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/nobel.png" srcset="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/nobel-2x.png 2x" alt="nobel laureates">
				<span class="visuallyhidden">nobel laureates</span>
			</object>
			<div class="context">18 nobel laureates associated with the school</div>
		</div>
		<div class="icon">
			<object type="image/svg+xml" data="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/svg/stethoscope.svg">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/stethoscope.png" srcset="<?php echo get_stylesheet_directory_uri(); ?>/_/img/icons/png/stethoscope-2x.png 2x" alt="lightbulb icon">
				<span class="visuallyhidden">stethoscope icon</span>
			</object>
			<div class="context">67% of faculty members also treat patients</div>
		</div>
	</div>
</section>

<section class="cta-home">
	<div class="wrap">
		<div class="cta-text">
			<h2>The future of medicine starts here.</h2>
			<p>Our top-ranked, student-centered programs will prepare you to join the next generation of leaders.</p>
		</div>
		<a href="/education/admissions/" class="cta-button">Explore our programs</a>
	</div>
</section>

<section class="leaders-home">
	<div class="text-intro">
		<div class="wrap">
			<h1>We are a community of leaders.</h1>
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

<?php get_footer(); ?>
