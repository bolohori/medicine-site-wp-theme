<?php
	get_header();

	if ( have_posts() ) {
		while (have_posts()) :
			the_post();
			$class = '';
			if ( get_the_post_thumbnail() != '' ) {
				$class = ' notch';
				echo '<div id="featured-image">';
				the_post_thumbnail();
				echo '</div>';
			}
?>

<div id="main" class="clearfix">

	<div class="wrapper">
		
		<article class="front-page<?php echo $class; ?>">
	<?php
			the_title('<h1>', '</h1>');
			the_content();
		endwhile;
	} else { ?>
<div id="main" class="clearfix">

	<div id="page-background"></div>

	<div class="wrapper">

		<article class="front-page">
			<h1>Custom-designed front page</h1>	
	<?php } ?>
		</article>

	</div>

</div>


<?php get_footer(); ?>