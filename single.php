<?php

	get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post();
			$class = '';
			$classes = '';
			$margin = ' non-landing-page';

			

			if ( get_the_post_thumbnail() != '' && !has_term( 'campus-life', 'news' )  && !has_term( 'washington-people', 'news' ) && !has_term( 'national-leader', 'news' ) ) {

				$class .= ' notch';
				$margin = ' landing-page';
				$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'landing-page' );
				echo '<div id="featured-image" style="background-image:url(' . $image . ');">';
				the_post_thumbnail('landing-page');
				echo '</div>';

			}

			if ( get_field( 'special_header' ) ) {

				$class .= ' special-head';

			}

			if ( $class !== '' ) {

				$classes = " class ='$class'";

			}
?>

<div id="main" class="clearfix<?php echo $margin; ?>">

	<div id="page-background"></div>

	<div class="wrapper clearfix">

		<div id="page-background-inner"></div>

		<nav id="left-col">
			<?php if( ! get_field( 'hide_nav' ) ) { ?>
			<ul id="left-nav">
				<li class="top_level_page"><a href="/news">News</a></li>
				<li class="page_item<?php if( has_term( 'news-release', 'news' ) ) { echo " current_page_item"; } ?>"><a href="/news/releases/">News Releases</a></li>
				<li class="page_item<?php if( has_term( 'in-the-media', 'news' ) ) { echo " current_page_item"; } ?>"><a href="/news/press/">In the Media</a></li>
				<li class="page_item<?php if( has_term( 'other-news', 'news' ) ) { echo " current_page_item"; } ?>"><a href="/news/headlines/">Research Highlights</a></li>
				<li class="page_item"><a href="/news/biomed-radio/">BioMed Radio Podcast</a></li>
				<li class="page_item<?php if( has_term( 'national-leader', 'news' ) ) { echo " current_page_item"; } ?>"><a href="/news/leaders/">National Leaders</a></li>
				<li class="page_item<?php if( has_term( 'washington-people', 'news' ) ) { echo " current_page_item"; } ?>"><a href="/news/washington-people/">Washington People</a></li>
				<li class="page_item<?php if( has_term( 'campus-life', 'news' ) ) { echo " current_page_item"; } ?>"><a href="/news/multimedia/">Campus Life</a></li>
				<li class="page_item<?php if( has_term( 'outlook', 'news' ) ) { echo " current_page_item"; } ?>"><a href="/news/outlook-magazine/">Outlook Magazine</a></li>
				<li class="page_item"><a href="/news/publications/">Publications</a></li>
				<li class="page_item<?php if( $post->post_type == 'announcements' ) { echo " current_page_item"; } ?>"><a href="/news/announcements/">Announcements</a></li>
			</ul>
			<?php } ?>
		</nav>

		<article<?php echo $classes; ?>>
			<?php
				if(get_field('special_header')) {
					$special_header = get_field('special_header');
					echo "<a class='special-header' href='" . get_permalink( $special_header->ID ) . "'>" . get_the_title( $special_header->ID ) . "</a>";
				}
					the_title('<h1>', '</h1>');
					add_filter( 'excerpt_more', function() { return ''; } );
					
					if( !has_term( 'campus-life', 'news' ) && !has_term( 'national-leader', 'news' ) && !has_term( 'outlook', 'news' ) ) {

						echo "<p class='custom-intro'>" . get_the_excerpt() . "</p>";

					}
					
					echo "<p class='custom-byline'>";
					the_date();
					
					if( get_field( 'author' ) ) {
					
						echo " | " . get_field('author');

					}

					echo "</p>";
					if( get_the_content() ) {
					
						the_content();
					
					} else {
                    	
						if( has_term( 'national-leader', 'news' ) ) {

							$link = get_field( 'nl-link' );


						} else {

                        	$link = get_field( 'url' );

                        }

						if( has_term( 'news-release', 'news' ) ) {

                            $link = $link['url'];
                            $button_text = "See News Release";

                        } elseif($post->post_type == 'announcement') {

                            $link = $link['url'];
							$button_text = "View Announcement";

						} else {

							$button_text = "View Article";

						}
						the_excerpt();
						echo "<br><a href=\"$link\"><button class=\"single-link\">$button_text</button></a>";
					}
				endwhile;
			endif;
			?>
		</article>

		<?php if( !has_term( 'campus-life', 'news' ) && !has_term( 'national-leader', 'news' ) ) { get_sidebar( 'right' ); } ?>

	</div>

</div>

<?php get_footer(); ?>