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
			get_template_part( '_/php/cards/classacts' );
			?>	
		</article>
    </div>
</div>
<?php 
	endwhile;
	endif;
	get_footer();
?>