<?php get_header(); ?>

<article>

    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_title('<h1>', '</h1>');
            the_post();
            the_content();
        endwhile;
    endif;
    ?>

</article>

<aside>

    <h2>Sidebar Content</h2>

</aside>

<?php get_footer(); ?>