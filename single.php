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
			<?php
				echo get_the_term_list( $post->ID, 'news', '<ul class="news-types"><li>', '</li><li>', '</li></ul>' );
				the_title('<h1>', '</h1>');
				if(get_field('subhead'))
					echo "<p class='subhead'>" . get_field('subhead') . "</p>";
				echo "<p class='meta-header'>";
				
				if( have_rows('article_author') ):
				    while ( have_rows('article_author') ) : the_row(); ?>
				    <?php if(get_sub_field('custom_author')) { ?>
				    	by <?php the_sub_field('name'); ?> <span class="meta-separator">&bull;</span>
				    <?php } elseif(get_sub_field('author')) {
				        	$author = get_sub_field('author');
							$user_id = $author['ID']; ?>
						by <a href="<?php echo get_author_posts_url($user_id); ?>"><?php the_author_meta( 'display_name', $user_id); ?></a> <span class="meta-separator">&bull;</span>
					<?php } ?>	
				   	<?php endwhile;
				endif; ?>

				<?php the_date();
				echo "</p>";
				if(function_exists( 'sharing_display')) {
				    sharing_display( '', true );
				}
				the_post_thumbnail('landing-page');
				the_post_thumbnail_caption();
			?>
			</header>

			<?php the_content(); ?>
			
			<footer class="article-footer clearfix">
				<?php if(get_field('boilerplate')) { ?>
					<div class="boilerplate">
						<?php the_field('boilerplate'); ?>
					</div>
				<?php } ?>
				<div class="bio-wrapper">
				<?php if( have_rows('article_author') ):
				    while ( have_rows('article_author') ) : the_row(); ?>
				        <?php if(get_sub_field('custom_author')) { ?>
				        <div class="footer-author">
				        	<?php the_sub_field('name'); ?>
							<p><?php the_sub_field('bio'); ?></p>
							<p class="phone-number"><?php the_sub_field('phone'); ?></p>
							<p class="email-address"><a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('phone'); ?></a></p>
						</div>
				        <?php } elseif(get_sub_field('author')) {
				        	$author = get_sub_field('author');
							$user_id = $author['ID']; ?>
						<div class="footer-author">
							<a href="<?php echo get_author_posts_url($user_id); ?>"><?php the_author_meta( 'display_name', $user_id); ?></a>
							<p><?php the_author_meta( 'description', $user_id ); ?></p>
							<p class="phone-number"><?php $user_phone = get_user_meta( $user_id, 'phone', true); echo $user_phone; ?></p>
							<p class="email-address"><a href="mailto:<?php echo get_the_author_meta( 'user_email', $user_id ); ?>"><?php the_author_meta( 'user_email', $user_id ); ?></a></p>
						</div>
				        <?php } ?>
				    <?php endwhile;
				endif; ?>

				<div class="footer-media-contact">
					<a href="">Media Contact</a>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
					<p class="phone-number">555-555-5555</p>
					<p class="email-address"><a href="mailto:email@wustl.edu">email@wustl.edu</a></p>
				</div>
				
				</div>
			</footer>
			<?php
				endwhile;
			endif;
			?>
		</div>
	</article>
	<div class="footer-related clearfix">
		<h3>Related Articles</h3>
		<?php
		$the_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 3) );
		if ( $the_query->have_posts() ) {
			echo '<ul>';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				echo '<li><div class="card">';
				the_post_thumbnail('in-the-news');
				echo '<p class="article-date">' . get_the_time('M d, Y') . '</p>';
				echo '<a href="' . get_the_permalink() . '">';
				the_title('<h4>', '</h4>');
				echo '</a>';
				the_excerpt();
				echo '</div></li>';
			}
			echo '</ul>';
		} ?>
	</div>
</div>

<?php get_footer(); ?>