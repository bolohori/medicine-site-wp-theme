<?php
/*
 * Template Name: Standard Page Style
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
			?>	
		</article>
    </div>
</div>
<?php 
	endwhile;
	endif;
	get_footer();
?>