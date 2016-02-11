<?php
/*
 * Template Name: Class Acts
 */
get_header();
if (have_posts()) :
	while (have_posts()) :
		the_post();
?>	
<div id="main" class="clearfix>">
	<div id="page-background"></div>
	<div class="wrapper clearfix">
		<div id="page-background-inner"></div>
		<?php get_sidebar(); ?>
		<article>
			<?php 
			the_title('<h1>', '</h1>');
			the_content(); 
			$classyear = get_field( 'class_year_check' );
            $args = array(
                'post_type' => 'post',
                'post_status' => 'published',
                'tax_query' => array (
	                array (
		            	'taxonomy' => 'class_year',
		            	'field' => 'slug',
		            	'terms' => $classyear->name
	                ),
                ),
            );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) {
			?>
			<div class="generic-cards">
                <ul class="clearfix">
	                <?php while ( $the_query->have_posts() ) {
	                    $the_query->the_post(); 
	                    $i = 0; ?>
	                <a href="<?php the_permalink(); ?>">
						<li>
						    <div>
						        <?php if( $i % 2 == 1 ) {
					            	echo '<div class="card odd">';
								} else if( $i % 2 == 0 ) {
						    		echo '<div class="card even">';
					            } if( has_post_thumbnail() ) {
					                the_post_thumbnail('news');
					            } else {
					                echo '<img src="'. get_template_directory_uri() . '/_/img/default.jpg">';
					            }
								echo '<div class="card-text">';
							            the_title('<h2 class="article-title">', '</h2>');
							            the_excerpt();
							    ?>
					            </div>
						    </div>
						</li>
					</a>
					<?php } /* end while */ ?>
                </ul>
			</div>
			<?php } /* end if */ ?>
		</article>
    </div>
</div>
<?php 
	endwhile;
	endif;
	get_footer();
?>