<?php get_header(); ?>

<div id="main" class="clearfix">

	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper clearfix">

		<?php get_sidebar(); ?>
		<?php get_sidebar( 'right' ); ?>
		<article>
			<h1>In the News archive</h1>
		<?php if (have_posts()) :
			while (have_posts()) :
				the_post();
				$link = get_the_permalink();
				the_title('<h1 style="margin-top:20px;"><a href="' . $link . '">', '</a></h1>');
			endwhile;
		endif; ?>
		</article>

	</div>

</div>

<?php get_footer(); ?>