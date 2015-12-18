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

            // If there is an editor's pick, store the post ID to exclude it from the main query
            $exclude = array();

            if ( $the_query->have_posts() ) { ?>
            <div class="editors-pick">
                <?php while ( $the_query->have_posts() ) {
                    $the_query->the_post(); 
                    $exclude[] = $post->ID; ?>
                    <div>
                        <a href="<?php ( get_field('url') ? the_field('url') : the_permalink() ) ?>">
                                <?php the_post_thumbnail('news'); ?>
                        </a>
                        <div class="editors-pick-text">
                            <p class="article-date"><?php the_time('M j, Y'); ?></p>
                            <a href="<?php ( get_field('url') ? the_field('url') : the_permalink() ) ?>">
                                <?php the_title('<h2>', '</h2>'); ?>
                            </a>
                            <?php if(has_excerpt()) {
                                the_excerpt();
                            } ?>
                        </div>
                    </div>
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
                    $cardClass = '';
                    if(has_term('national-leader','news')) {
                        $cardClass = ' class="headshot"';
                    } ?><li<?php echo $cardClass; ?>>
                        <div><a href="<?php ( get_field('url') ? the_field('url') : the_permalink() ) ?>">
                            <div class="card">
                            <?php if(has_post_thumbnail()) {
                                the_post_thumbnail('news');
                            } elseif(has_term('national-leader','news')) { ?>
                                <img src="<?php echo get_template_directory_uri() . '/_/img/spotlight-default.png' ?>">
                            <?php } elseif(has_term('in-the-media','news')) { ?>
                                <img src="<?php echo get_template_directory_uri() . '/_/img/default-inthenews.png' ?>">
                            <?php } else { ?>
                                <img src="<?php echo get_template_directory_uri() . '/_/img/default-news.png' ?>">
                            <?php } ?>
                            <div class="card-text">
                            <?php if(get_field('audio')) { ?>
                                <img class="has-audio" src="<?php echo get_template_directory_uri() . '/_/img/audio/audio.png' ?>">
                            <?php } ?>
                            <p class="article-date"><?php the_time('M j, Y'); ?></p>
                            <?php the_title('<h2 class="article-title">', '</h2>');
                            if(has_excerpt()) {
                                the_excerpt();
                            }
                            if(get_field('source')) {
                                echo '<p class="news-source">Source: ' . get_field('source') . '</p>';
                            } else {
                                $terms = get_the_term_list( $post->ID, 'news', '', ', ', '' ) ;
                                echo '<p class="news-source">' . strip_tags($terms) . '</p>';
                            } ?>
                            </div>
                            </div>
                        </a></div>
                    </li><?php } ?>
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