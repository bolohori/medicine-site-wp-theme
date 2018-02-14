<?php

	get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post();

?>

<div id="main">
	<article>
		<?php if( current_user_can('editor') || current_user_can('administrator') && has_term('news-release','news') ) {  ?>
			<?php if (strpos(get_the_permalink(),'?') === false) { ?>
				<a class="email-template-link" href="<?php echo get_the_permalink() . '?template=email'; ?>">Email</a>
			<?php } else { //embargoed releases already have a query string ?>
				<a class="email-template-link" href="<?php echo get_the_permalink() . '&template=email'; ?>">Email</a>
			<?php } ?>
		<?php } ?>
		<div>
			<header class="article-header">
				<a href="/news" class="visit-news-hub"><div class="arrow-left"></div>Visit the News Hub</a>

				<?php

				if (isset($_GET['_ppp']) || get_post_status() == 'future' ) {
					$date_time = get_the_date('F j, Y') . ' ' . get_the_time('H:i:s');
					$embargo_lift_pre = date('g:i a l, M. j, Y', strtotime($date_time . '+ 1 hour'));
					$embargo_lift = str_replace(array('am','pm',':00','Mar.','Apr.','May.','Jun.','Jul.','Sep.'),array('a.m. ET','p.m. ET','','March','April','May','June','July','Sept.'),$embargo_lift_pre);
				    echo '<p class="embargo-notice">Embargoed until ' . $embargo_lift . '</p>';
				}

				if(has_term('news-release','news')) {
					$term_link = get_term_link('news-release', 'news');
					echo '<div class="news-type"><a href="' . esc_url( $term_link ) . '">News Release</a></div>';
				}

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
							$author[] = '<a href="mailto:' . get_the_author_meta( 'user_email', $user_id ) . '">' . get_the_author_meta( 'display_name', $user_id) . '</a>';
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

				if(function_exists( 'sharing_display') && !isset($_GET['_ppp']) && !has_term('in-the-news','news')) {
				    sharing_display( '', true );
				}

				if (get_field('featured_video_url')) {
					wp_enqueue_script( 'wusm-fitvids' );
					echo apply_filters('embed_handler_html',wp_oembed_get(get_field('featured_video_url')));
					if (has_post_thumbnail()) {
						$creditID = get_post_thumbnail_id();
						$creditName = esc_html( get_post_meta( $creditID, 'image_credit', true ) );
						$credit = '';
						if (!empty($creditName)) {
							$credit = '<span class="image-credit">' . $creditName . '</span>';
						}
						echo $credit;
						if (get_post( get_post_thumbnail_id() )) {
							$post_thumbnail_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
						}
						if(!empty($post_thumbnail_caption)) {
							echo '<p class="featured-image-caption">' . $post_thumbnail_caption . '</p>';
						}
					}
				} elseif (has_post_thumbnail()) {
					if(has_term('national-leaders','news') OR has_term('obituaries','news')) { ?>
						<div class="featured-image-headshot">
					<?php }
						the_post_thumbnail('large');
						$creditID = get_post_thumbnail_id();
						$creditName = esc_html( get_post_meta( $creditID, 'image_credit', true ) );
						$credit = '';
						if (!empty($creditName)) {
							$credit = '<span class="image-credit">' . $creditName . '</span>';
						}
						echo $credit;
						if (get_post( get_post_thumbnail_id() )) {
							$post_thumbnail_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
						}
						if(!empty($post_thumbnail_caption)) {
							echo '<p class="featured-image-caption">' . $post_thumbnail_caption . '</p>';
						}
					if(has_term('national-leaders','news') OR has_term('obituaries','news')) { ?>
						</div>
					<?php }
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

			<?php $the_content = get_the_content();
			if(get_field('url') && empty($the_content)) {
				if(get_field('source')) {
					?><p class="news-source">Source: <?php the_field('source'); ?></p><?php
				} ?>
				<p><a href="<?php the_field('url') ?>" class="wusm-button">View Article</a></p><?php
			} ?>

			<?php the_content(); ?>

			<footer class="article-footer clearfix">
				<?php if(get_field('boilerplate')) { ?>
					<div class="boilerplate">
						<?php the_field('boilerplate'); ?>
					</div>
				<?php }

				if( get_post_meta( get_the_ID(), 'media_contact_0_media_contact', true ) ||
                    get_post_meta( get_the_ID(), 'article_author_0_author', true ) ||
					get_post_meta( get_the_ID(), 'multimedia_producer_0_producer', true ) ||
                    get_post_meta( get_the_ID(), 'media_contact_0_custom_media_contact', true ) ||
                    get_post_meta( get_the_ID(), 'article_author_0_custom_author', true ) ||
					get_post_meta( get_the_ID(), 'multimedia_producer_0_custom_producer', true )
				): ?>

					<div class="bio-wrapper">

                    <?php
                    //Get list of Media Contact user IDs to check against before displaying authors to prevent duplicates
                    $media_contacts = array();

                    if( have_rows('media_contact') ):
                        while ( have_rows('media_contact') ) : the_row();
                            if(get_sub_field('custom_media_contact')) {
                                ?><div class="footer-media-contact">
                                <p class="footer-heading">Media Contact</p>
                                <p class="name"><?php the_sub_field('name'); ?><?php if(get_sub_field('title')) { echo ', '; } the_sub_field('title'); ?></p>
                                <p class="phone-number"><?php the_sub_field('phone_number'); ?></p>
                                <p class="email-address"><a href="mailto:<?php the_sub_field('email_address'); ?>"><?php the_sub_field('email_address'); ?></a></p>
                                </div><?php
                            } elseif(get_sub_field('media_contact')) {
                                $contact = get_sub_field('media_contact');
                                $user_id = $contact['ID'];
                                $media_contacts[] = $user_id;
                                ?><div class="footer-media-contact">
                                <p class="footer-heading">Media Contact</p>
                                <p class="name"><?php the_author_meta( 'display_name', $user_id); ?><?php if(get_the_author_meta( 'title', $user_id )) { echo ', '; } the_author_meta( 'title', $user_id ); ?></p>
                                <p class="phone-number"><?php $user_phone = get_user_meta( $user_id, 'phone', true); echo $user_phone; ?></p>
                                <p class="email-address"><a href="mailto:<?php echo get_the_author_meta( 'user_email', $user_id ); ?>"><?php the_author_meta( 'user_email', $user_id ); ?></a></p>
                                </div><?php }
                        endwhile;
                    endif;

                    if( have_rows('article_author') ):
                        while ( have_rows('article_author') ) : the_row();
                            if(get_sub_field('custom_author')) {
                                ?><div class="footer-author">
                                <p class="footer-heading">Writer</p>
                                <p class="name"><?php the_sub_field('name'); ?><?php if(get_sub_field('title')) { echo ', '; } the_sub_field('title'); ?></p>
                                <p><?php the_sub_field('bio'); ?></p>
                                <p class="phone-number"><?php the_sub_field('phone_number'); ?></p>
                                <p class="email-address"><a href="mailto:<?php the_sub_field('email_address'); ?>"><?php the_sub_field('email_address'); ?></a></p>
                                </div><?php
                            } elseif(get_sub_field('author')) {
                                $author = get_sub_field('author');
                                $user_id = $author['ID'];
                                //Display author only if he's not also a media contact for the news release
                                if ( !in_array($user_id,$media_contacts) ) {
                                    ?><div class="footer-author">
                                    <p class="footer-heading">Writer</p>
                                    <p class="name"><a href="<?php echo get_author_posts_url($user_id); ?>"><?php the_author_meta( 'display_name', $user_id); ?></a><?php if(get_the_author_meta( 'title', $user_id )) { echo ', ' . get_the_author_meta( 'title', $user_id ) . '</p>';} ?>
                                    <?php if(get_the_author_meta( 'description', $user_id )) { echo '<p>' . get_the_author_meta( 'description', $user_id ) . '</p>'; } ?>
                                    <p class="phone-number"><?php $user_phone = get_user_meta( $user_id, 'phone', true); echo $user_phone; ?></p>
                                    <p class="email-address"><a href="mailto:<?php echo get_the_author_meta( 'user_email', $user_id ); ?>"><?php the_author_meta( 'user_email', $user_id ); ?></a></p>
                                    </div><?php } }
                        endwhile;
                    endif;

                    if( have_rows('multimedia_producer') ):
                        while ( have_rows('multimedia_producer') ) : the_row();
                            if(get_sub_field('custom_producer')) {
                                ?><div class="footer-author">
                                <p class="footer-heading">Multimedia Producer</p>
                                <p class="name"><?php the_sub_field('name'); ?><?php if(get_sub_field('title')) { echo ', '; } the_sub_field('title'); ?></p>
                                <p><?php the_sub_field('bio'); ?></p>
                                <p class="phone-number"><?php the_sub_field('phone_number'); ?></p>
                                <p class="email-address"><a href="mailto:<?php the_sub_field('email_address'); ?>"><?php the_sub_field('email_address'); ?></a></p>
                                </div><?php
                            } elseif(get_sub_field('producer')) {
                                $producer = get_sub_field('producer');
                                $user_id = $producer['ID'];
                                ?><div class="footer-author">
                                <p class="footer-heading">Multimedia Producer</p>
                                <p class="name"><a href="<?php echo get_author_posts_url($user_id); ?>"><?php the_author_meta( 'display_name', $user_id); ?></a><?php if(get_the_author_meta( 'title', $user_id )) { echo ', ' . get_the_author_meta( 'title', $user_id ) . '</p>';} ?>
                                <?php if(get_the_author_meta( 'description', $user_id )) { echo '<p>' . get_the_author_meta( 'description', $user_id ) . '</p>'; } ?>
                                <p class="phone-number"><?php $user_phone = get_user_meta( $user_id, 'phone', true); echo $user_phone; ?></p>
                                <p class="email-address"><a href="mailto:<?php echo get_the_author_meta( 'user_email', $user_id ); ?>"><?php the_author_meta( 'user_email', $user_id ); ?></a></p>
                                </div><?php }
                        endwhile;
                    endif;
                    ?>

					</div>
				<?php endif; ?>
			</footer>
		</div>

        <?php
            if ( class_exists( 'Jetpack_RelatedPosts' ) && ( get_field('display_related_posts') || is_null(get_field('display_related_posts')) ) ) {
                echo do_shortcode( '[jetpack-related-posts]' );
            }
        ?>
	</article>

	<?php $args = array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'category_name'  => 'editors-picks',
		'post__not_in'   => array(get_the_ID())
	);
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) { ?>
		<div class="footer-editors-picks">
			<h3>Editors' Picks</h3>
			<div class="news-cards">
				<ul class="clearfix">
				<?php while ( $the_query->have_posts() ) {
					$the_query->the_post();
					get_template_part( '_/php/news/card' );
				} ?>
				</ul>
			</div>
		</div>
	<?php } ?>
</div>

<?php
		endwhile;
	endif;
?>

<?php get_footer(); ?>
