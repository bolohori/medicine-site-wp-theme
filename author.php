<?php

get_header(); ?>

    <div id="main" class="page-news clearfix">

        <?php get_template_part( '_/php/news/header' ); ?>

        <article>

            <?php function my_posts_where( $where ) {
                $where = str_replace("meta_key = 'article_author_%", "meta_key LIKE 'article_author_%", $where);
                return $where;
            }
            add_filter('posts_where', 'my_posts_where');

            $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
            $curauthID = $curauth->ID;
            echo '<div class="news-type-title"><p>Author: ' . $curauth->display_name . '</p></div>';

            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 24,
                'meta_query'    => array(
                    array(
                        'key'       => 'article_author_%_author',
                        'compare'   => '=',
                        'value'     => $curauthID,
                    )
                )
            );
            $the_query = new WP_Query( $args );
            if ($the_query->have_posts()) { ?>
            <div class="news-cards">
                <ul class="clearfix">
                <?php while ($the_query->have_posts()) {
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