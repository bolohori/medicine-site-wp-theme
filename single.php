<?php

	get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post();

?>

<div id="main">
	<article>
		<div>
			<header class="article-header">
				<a href="/news" class="visit-news-hub"><div class="arrow-left"></div>Visit the News Hub</a>

				<?php if (isset($_GET['_ppp'])) {
					$date_time = get_the_date('F j, Y') . ' ' . get_the_time('H:i:s');
					$embargo_lift = date('F j, Y \a\t g:i A', strtotime($date_time . '+ 1 hour'));
				    echo '<p class="embargo-notice">This article is embargoed until ' . $embargo_lift . ' EST.</p>';
				} ?>
				
				<?php echo get_the_term_list( $post->ID, 'news', '<ul class="news-types"><li>', '</li><li>', '</li></ul>' );
				
				the_title('<h1>', '</h1>');
				
				if(has_excerpt()):
					echo "<p class='subhead'>" . get_the_excerpt() . "</p>";
				endif;

				echo "<p class='meta-header'>";

				if( have_rows('article_author') ):
				$author = array();
					while ( have_rows('article_author') ) : the_row();
						if(get_sub_field('custom_author')) {
							$author[] = get_sub_field('name');
						} elseif(get_sub_field('author')) {
				        	$wp_author = get_sub_field('author');
							$user_id = $wp_author['ID'];
							$author[] = '<a href="' . get_author_posts_url($user_id) . '">' . get_the_author_meta( 'display_name', $user_id) . '</a>';
						}
					endwhile;

					switch (count($author)) {
					    case 0:
					        $result = '';
					        break;
					    case 1:
					        $result = 'by ' . reset($author) . '<span class="meta-separator">&bull;</span>';
					        break;
					    default:
					        $last = array_pop($author);
					        $result = 'by ' . implode(', ', $author) . ' & ' . $last . '<span class="meta-separator">&bull;</span>';
					        break;
					}
        			echo $result;
        		endif;

        		the_date();
				
				echo "</p>";

				if(function_exists( 'sharing_display') && !isset($_GET['_ppp'])) {
				    sharing_display( '', true );
				}

				if(has_post_thumbnail()) {
					the_post_thumbnail('large');
					$post_thumbnail_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
					if(!empty($post_thumbnail_caption)) {
						echo '<p class="featured-image-caption">' . $post_thumbnail_caption . '</p>';
					}
				}

				if( get_field('audio') ) { ?>
					<div id="article-audio" class="audio-container">
					<div class="audio-thumbnail">
						<img src="<?php echo get_stylesheet_directory_uri() . '/_/img/audio/biomedradio.jpg'; ?>">
					</div>
					<div class="audio-player">
						<?php echo wp_audio_shortcode( array( 'src' => get_field('audio') ) ); ?>
					</div>
					</div>
				<?php } ?>
			</header>

			<?php the_content(); ?>
			
			<footer class="article-footer clearfix">
				<?php if(get_field('boilerplate')) { ?>
				<div class="boilerplate">
					<?php the_field('boilerplate'); ?>
				</div>
				<?php }

				$has_author = '';
				$has_media_contact = '';
				$rows = get_field( 'article_author' );
				$has_author = $rows[0]['author'];
				$rows = get_field( 'media_contact' );
				$has_media_contact = $rows[0]['media_contact'];

				if( $has_author || $has_media_contact ): ?>				
				<div class="bio-wrapper">
				<?php if( have_rows('article_author') ):
				    while ( have_rows('article_author') ) : the_row();
				    	if(get_sub_field('custom_author')) {
				        ?><div class="footer-author">
				        	<p class="name"><?php the_sub_field('name'); ?></p>
							<p><?php the_sub_field('bio'); ?></p>
							<p class="phone-number"><?php the_sub_field('phone_number'); ?></p>
							<p class="email-address"><a href="mailto:<?php the_sub_field('email_address'); ?>"><?php the_sub_field('email_address'); ?></a></p>
						</div><?php
						} elseif(get_sub_field('author')) {
				        	$author = get_sub_field('author');
							$user_id = $author['ID'];
						?><div class="footer-author">
							<p class="name"><a href="<?php echo get_author_posts_url($user_id); ?>"><?php the_author_meta( 'display_name', $user_id); ?></a></p>
							<p><?php the_author_meta( 'description', $user_id ); ?></p>
							<p class="phone-number"><?php $user_phone = get_user_meta( $user_id, 'phone', true); echo $user_phone; ?></p>
							<p class="email-address"><a href="mailto:<?php echo get_the_author_meta( 'user_email', $user_id ); ?>"><?php the_author_meta( 'user_email', $user_id ); ?></a></p>
						</div><?php } endwhile; endif;

				if( have_rows('media_contact') ):
				    while ( have_rows('media_contact') ) : the_row();
				    	if(get_sub_field('custom_media_contact')) {
				        ?><div class="footer-media-contact">
				       		<p class="mc-heading">Media Contact</p>
				        	<p class="name"><?php the_sub_field('name'); ?></p>
							<p class="title"><?php the_sub_field('title'); ?></p>
							<p class="phone-number"><?php the_sub_field('phone_number'); ?></p>
							<p class="email-address"><a href="mailto:<?php the_sub_field('email_address'); ?>"><?php the_sub_field('email_address'); ?></a></p>
						</div><?php
						} elseif(get_sub_field('media_contact')) {
				        	$author = get_sub_field('media_contact');
							$user_id = $author['ID'];
						?><div class="footer-media-contact">
							<p class="mc-heading">Media Contact</p>
							<p class="name"><?php the_author_meta( 'display_name', $user_id); ?>, <?php the_author_meta( 'title', $user_id ); ?></p>
							<p class="phone-number"><?php $user_phone = get_user_meta( $user_id, 'phone', true); echo $user_phone; ?></p>
							<p class="email-address"><a href="mailto:<?php echo get_the_author_meta( 'user_email', $user_id ); ?>"><?php the_author_meta( 'user_email', $user_id ); ?></a></p>
						</div><?php } endwhile; endif; ?>
				</div>
				<?php endif; ?>
			</footer>
		</div>
	</article>
	<div class="footer-related clearfix">
		<h3>Related Articles</h3>
		<?php
		if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
		    echo do_shortcode( '[jetpack-related-posts]' );
		}
		?>
	</div>
</div>

<?php
		endwhile;
	endif;
?>

<?php get_footer(); ?>