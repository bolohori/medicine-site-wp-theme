<?php

get_header(); ?>

    <div id="main" class="page-news clearfix">

        <header>
            
            <h1>News</h1>

            <ul class="news-subnav clearfix">
                <li><a href="<?php echo get_page_link( 7224 ) ?>">Publications</a></li>
                <li><a href="">For Media</a></li>
                <li><a href="">About Public Affairs</a></li>
            </ul>

            <div class="news-filters clearfix">
                <div class="collapse">Filter</div>
                <ul>
                    <li><a href="/news">All</a></li>
                    <li<?php if(is_category( "Editor's Picks" )) { echo ' class="active"'; } ?>><a href="<?php $category_id = get_cat_ID( "Editor's Picks" ); echo esc_url(get_category_link( $category_id )); ?> ">Editor's Picks</a></li>
                    <li class="parent"><a href="">Topics</a>
                        <ul><?php echo wp_list_categories( 'title_li=' ); ?></ul>
                    </li>
                    <li class="parent"><a href="">Source</a>
                        <?php  $terms = get_terms( 'news', 'orderby=count&order=DESC' );
                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                            echo '<ul>';
                            foreach ( $terms as $term ) {
                                echo '<li>' . '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a></li>'; 
                            }
                            echo '</ul>';
                        } ?>
                    </li>
                </ul>
                <div class="search"><div class="search-btn"><img src="<?php echo get_template_directory_uri() . '/_/img/search-news.svg'; ?>" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/search-news.png';this.onerror=null;"></div>
                    <form class="search-news" name="search" method="get" autocapitalize="none" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="hidden" name="post_type" value="post" />
                        <input type="text" id="search-box-news" name="s">
                    </form>
                </div>
            </div>

        </header>

        <article>

            <div class="news-cards">

            <?php if (have_posts()) { ?>
                <ul class="clearfix">
                <?php while (have_posts()) {
                    the_post(); ?>
                    <li>
                        <div class="card">
                            <?php if(has_post_thumbnail()) { ?>
                                <a href="<?php ( get_field('url') ? the_field('url') : the_permalink() ) ?>">
                                    <?php the_post_thumbnail('news'); ?>
                                </a>
                            <?php } else { ?>
                                <img src="<?php echo get_template_directory_uri() . '/_/img/default.jpg' ?>">
                            <?php } ?>
                            <p class="article-date"><?php the_time('M j, Y'); ?></p>

                            <a href="<?php ( get_field('url') ? the_field('url') : the_permalink() ) ?>">
                                <?php the_title('<h2>', '</h2>'); ?>
                            </a>
                            <?php if(get_field('source')):
                                echo '<p class="news-source">Source: ' . get_field('source') . '</p>';
                            endif; ?>
                            <?php the_excerpt(); ?>
                        </div>
                    </li>
                <?php } ?>
                </ul>
            </div>
                <?php if ($wp_query->max_num_pages > 1) { ?>
                    <div class="pagination">
                        <div class="next-posts"><?php next_posts_link( 'Load More', $wp_query->max_num_pages ); ?></div>
                    </div>
                <?php } ?>
            <?php }
            wp_reset_postdata(); ?>

        </article>

    </div>


<?php get_footer(); ?>