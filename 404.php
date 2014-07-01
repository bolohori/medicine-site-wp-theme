<?php get_header(); ?>

<div id="main" class="clearfix">

    <div id="page-background"></div>

    <div class="wrapper clearfix">

        <div id="page-background-inner"></div>

        <nav id="left-col">
            <?php get_sidebar( 'left' ); ?>
        </nav>

        <article>

            <h1>Page not found</h1>

            <p>We're sorry; we can't find the page you're looking for. Please make sure the web address is entered correctly, or use the site search above to find the page.</p>

            <p>We have recorded this issue and will resolve it as soon as possible. Please <a href="mailto:<?php bloginfo('admin_email'); ?>">contact us</a> if you would like assistance.</p>

        </article>

    </div>

</div>


<?php get_footer(); ?>