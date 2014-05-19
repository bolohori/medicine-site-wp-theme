<?php

    get_header();

    if (have_posts()) :
        while (have_posts()) :
            the_post();
            $class = '';
            if (get_the_post_thumbnail() != '') {
                $class = ' class="notch"';
                echo '<div id="featured-image">';
                the_post_thumbnail();
                echo '</div>';
            }
?>

<div id="main" class="clearfix">

    <div id="page-background"></div>

    <div class="wrapper">

        <?php get_sidebar( 'left' ); ?>

        <article<?php echo $class; ?>>
            <?php
                    the_title('<h1>', '</h1>');
                    the_content();
                endwhile;
            endif;
            ?>
        </article>

        <?php get_sidebar( 'right' ); ?>

    </div>

</div>


<?php get_footer(); ?>