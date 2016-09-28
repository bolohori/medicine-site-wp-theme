<?php get_header(); ?>

<section class="banner">
	<ul class="banner-slider">
		<?php
			if ( have_rows( 'banners', 'option'  ) ) {
				while ( have_rows( 'banners', 'option'  ) ) : the_row();
					echo '<li class="banner-single">';
						echo '<div>';
							$banner = get_sub_field( 'banner_photo', 'option' );
							echo '<div class="banneroverlay"><img src="' . $banner['url'] . '" class="bannerimg"></div>';
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
			<p>In a supportive environment fueled by collaboration, our teachers, scholars, caregivers and innovators apply passion and determination to solve medicine's toughest challenges.</p>
		</div>
	</div>
	<section class="news">
		<div class="news-cards">
			<ul class="clearfix">
				<li>
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

<section class="leaders-home">
	<div class="text-intro">
		<div class="wrap">
			<h1>Join a community of leaders in medicine.</h1>
			<p>Engaged in their fields and communities at home and around the world, the people of Washington University School of Medicine are defining the future of health and medicine.</p>
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
