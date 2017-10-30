<?php

get_header(); ?>

    <div id="main" class="page-news clearfix">

        <?php get_template_part( '_/php/news/header' ); ?>

        <article>

            <?php function my_posts_where( $where ) {
                $search = "wp_postmeta.meta_key = 'article_author_%_author'";
                $replace = "wp_postmeta.meta_key LIKE 'article_author_%_author' OR wp_postmeta.meta_key LIKE 'multimedia_producer_%_producer'";
                $where = str_replace($search, $replace, $where);
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