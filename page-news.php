<?php

get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post(); ?>

    <div id="main" class="page-news clearfix">

        <?php get_template_part( '_/php/news/header' ); ?>

        <article>

            <?php $args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'category_name' => 'editors-picks',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'news',
                        'field'    => 'term_id',
                        'terms'    => array( 37 ),
                        'operator' => 'NOT IN',
                    ),
                ),
            );
            $the_query = new WP_Query( $args );

            // If there is an editors' pick, store the post ID to exclude it from the main query
            $exclude = array();

            if ( $the_query->have_posts() ) { ?>
            <div class="editors-pick">
                <?php while ( $the_query->have_posts() ) {
                    $the_query->the_post(); 
                    $exclude[] = $post->ID; ?>
                    <a href="<?php ( get_field('url') ? the_field('url') : the_permalink() ) ?>">
                    <div class="ep-card">
                        <?php the_post_thumbnail('news'); ?>
                        <div class="editors-pick-text">
                            <p class="article-date"><?php the_time('M j, Y'); ?></p>
                            <?php the_title('<h2>', '</h2>'); ?>
                            <?php if(has_excerpt()) {
                                the_excerpt();
                            } ?>
                        </div>
                    </div>
                    </a>
                <?php } ?>
            </div>
            <?php } ?>

            <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 24,
                'paged' => $paged,
                'post__not_in' => $exclude
            );
            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() ) { ?>
            <div class="news-cards">
                <ul class="clearfix">
                <?php while ( $the_query->have_posts() ) {
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

<?php endwhile;
endif; ?>

<?php get_footer(); ?>