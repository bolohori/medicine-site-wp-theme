<?php
/*
*  Loop through a Flexible Content field and display its content with different views for different layouts
*/
if ( function_exists( 'get_field' ) && get_field( 'sidebars' ) ): ?>
	<div id="right-col">
	<?php while ( has_sub_field( 'sidebars' ) ):
		if ( get_row_layout() == 'links' ): // Related Links ?>
			<aside class="links">
				<h2><?php the_sub_field( 'title' ); ?></h2>
				<?php echo get_sub_field( 'text' ) ? '<p class="secondary">' . get_sub_field( 'text' ) . '</p>' : ''; ?>
				<?php if ( get_sub_field( 'links' ) ): ?>
					<ul>
						<?php while ( has_sub_field( 'links' ) ):
							$link_text = get_sub_field( 'link_text' );
							$url = get_sub_field( 'url' );
							$target = get_sub_field( 'open_in_new_window' ) ? 'target="_blank"' : '';
							$description = get_sub_field( 'description' ) ? '<br><span class="secondary">' . get_sub_field( 'description' ) . '</span>' : '';
							echo "<li><a $target href=\"$url\">$link_text</a>$description</li>";
						endwhile; ?>
					</ul>
				<?php endif; ?>
			</aside>
		<?php elseif ( get_row_layout() == 'image_&_text' ): // Image & Text ?>
			<aside class="image-and-text">
				<?php
					$attachment_id = get_sub_field( 'image' );
					echo $attachment_id ? wp_get_attachment_image( $attachment_id, 'right-sidebar' ) : '';
				?>
				<div class="sidebar-body">
					<h2><?php the_sub_field( 'title' ); ?></h2>
					<?php echo get_sub_field( 'text' ) ? get_sub_field( 'text' ) : ''; ?>
				</div>
				<?php
					$link_text = get_sub_field( 'link_text' );
					$url = get_sub_field( 'url' );
					$target = get_sub_field( 'open_in_new_window' ) ? 'target="_blank"' : '';
					echo $link_text && $url ? "<a $target class=\"opt-link\" href=\"$url\">$link_text</a>" : '';
				?>
			</aside>
		<?php endif;
	endwhile; ?>
	</div>
<?php endif; ?>