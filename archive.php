<?php

get_header(); ?>

    <div id="main" class="page-news clearfix">

        <?php get_template_part( '_/php/news/header' ); ?>

        <article>
        
            <div class="news-type-title"><p><?php the_archive_title(); ?></p></div>

            <?php if (have_posts()) { ?>
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
            }
            wp_reset_postdata(); ?>

        </article>

    </div>

<?php get_footer(); ?>