<?php get_header(); ?>

    <div id="main" class="page-news clearfix">

        <?php get_template_part( '_/php/news/header' ); ?>

        <article>

            <?php

            global $wp_query;
            $curauth = get_user_by('slug', $wp_query->query['author_name']);

            echo '<div class="news-type-title"><p>Author: ' . $curauth->display_name . '</p></div>';

            if (have_posts()) { ?>
            <div class="news-cards">
                <ul class="clearfix">
                <?php while (have_posts()) {
                    the_post();
                    
                    get_template_part( '_/php/news/card' );

                    } ?>
                </ul>
            </div>
            <?php if ($wp_query->max_num_pages > 1) { ?>
                <div class="pagination">
                    <div class="next-posts"><?php next_posts_link( 'Load More', $wp_query->max_num_pages ); ?></div>
                </div>
            <?php }
            } ?>

        </article>

    </div>

<?php get_footer(); ?>