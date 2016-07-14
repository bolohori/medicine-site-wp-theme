<?php

	if ( 'podcast' == get_post_type() ) {
		add_filter( 'body_class', 'wusm_podcast_class' );
		function wusm_podcast_class( $classes ) {
			$classes[] = 'single-post';
			return $classes;
		}
	}

	get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post();
			$class = '';
			$classes = '';
			$margin = ' non-landing-page';
			if (get_the_post_thumbnail() != '') {
				$margin = ' landing-page';
				$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'landing-page' );
				echo '<div id="featured-image" style="background-image:url(' . $image . ');">';
				the_post_thumbnail('landing-page');
				echo '</div>';
			}
			if (get_field('special_header'))
				$class .= ' special-head';
			if ( $class !== '' )
				$classes = " class ='$class'";

	$downloadlink = '<a href="' . get_post_meta( get_the_ID(), 'audio_file', true ) . '?ref=download" title="' . get_the_title() . '">Download episode</a> | ';
	$windowlink = '<a href="' . get_post_meta( get_the_ID(), 'audio_file', true ) . '?ref=new_window" target="_blank" title="' . get_the_title() . '">Play in new window</a>';

	if ( '' != get_post_meta( get_the_ID(), 'duration', true ) ) {
		$duration = ' |  Duration: ' . get_post_meta( get_the_ID(), 'duration', true );
	}

	if ( '' != get_post_meta( get_the_ID(), 'date_recorded', true ) ) {
		$daterecorded = ' |  Date Recorded: ' . date_i18n( get_option( 'date_format' ), strtotime( get_post_meta( get_the_ID(), 'date_recorded', true ) ) );
	}

?>	

<div id="main" class="clearfix<?php echo $margin; ?>">
	<article>
		<a href="/news" class="visit-news-hub"><div class="arrow-left"></div>Listen to more BioMed Radio episodes</a>
		<div>
        <?php
        	echo '<header class="article-header">';
			the_title('<h1>', '</h1>');
			echo '</header>';
			?>
			<div id="article-audio" class="audio-container">
				<div class="audio-thumbnail">
					<img src="<?php echo get_stylesheet_directory_uri() . '/_/img/audio/biomedradio.jpg'; ?>">
				</div>
				<div class="audio-player">
					<?php echo wp_audio_shortcode( array( 'src' => get_post_meta( get_the_ID(), 'audio_file', true ) ) ); ?>
				</div>
			</div>
			<?php
			the_content();
			get_template_part( '_/php/cards/footercards' );
            get_sidebar( 'right' ); ?>
        </div>
    </article>
		<?php endwhile;
	endif; ?>
</div>

<?php get_footer(); ?>