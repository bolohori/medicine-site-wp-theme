<?php get_header(); ?>

<<<<<<< HEAD
<div id="main" class="clearfix">

    <div id="page-background"></div>

    <div class="wrapper">

        <nav id="left-col">
            <?php get_sidebar( 'left' ); ?>
        </nav>

        <article>

            <h1>Page not found</h1>

            <p>We're sorry; we can't find the page you're looking for. Please make sure the web address is entered correctly, or use the site search above to find the page.</p>

            <p>We have recorded this issue and will resolve it as soon as possible. Please <a href="mailto:<?php bloginfo('admin_email'); ?>">contact us</a> if you would like assistance.</p>

        </article>

    </div>
=======
<div id="main" class="clearfix non-landing-page">

	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper">

		<?php get_sidebar(); ?>
		
		<article>

			<h1>Page not found</h1>

			<p>We're sorry; we can't find the page you're looking for. Please make sure the web address is entered correctly, or use the site search above to find the page.</p>

			<p>We have recorded this issue and will resolve it as soon as possible. Please <a href="/contact/">contact us</a> if you would like assistance.</p>

		</article>

	</div>
>>>>>>> FETCH_HEAD

</div>


<?php get_footer(); ?>