<?php

get_header(); ?>

    <div id="main" class="page-news clearfix">

        <?php get_template_part( '_/php/news/header' ); ?>

        <article>

            <div class="news-type-title"><p>Source: Audio</p></div>

            <?php $args = array(
                'post_type' => 'post',
                'posts_per_page' => 24,
                'meta_query'    => array(
                    array(
                        'key'       => 'audio',
                        'compare'   => '!=',
                        'value'     => '',
                    )
                )
            );
            $the_query = new WP_Query( $args );
            if ($the_query->have_posts()) { ?>
            <div class="news-cards">
                <ul class="clearfix">
                <?php while ($the_query->have_posts()) {
                    $the_query->the_post();

                    get_template_part( '_/php/news/card' );

                    } ?>
                </ul>
            </div>
            <?php if ($the_query->max_num_pages > 1) { ?>
                <div class="pagination">
                    <div class="next-posts"><?php next_posts_link( 'Load More', $the_query->max_num_pages ); ?></div>
                </div>
            <?php }
            }
            wp_reset_postdata(); ?>

        </article>

    </div>


<?php get_footer(); ?>