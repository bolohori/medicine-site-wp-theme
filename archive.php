<?php

get_header(); ?>

    <div id="main" class="page-news clearfix">

        <?php get_template_part( '_/php/news/header' ); ?>

        <article>

            <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); if($term) { echo '<div class="news-type-title"><p>Source: ' . $term->name . '</p></div>'; } ?>

            <?php if (have_posts()) { ?>
            <div class="news-cards">
                <ul class="clearfix">
                <?php while (have_posts()) {
                    the_post();
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
                            <?php } else { ?>
                                <img src="<?php echo get_template_directory_uri() . '/_/img/default.jpg' ?>">
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