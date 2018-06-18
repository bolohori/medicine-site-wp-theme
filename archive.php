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
                <nav id="paginate-results">
                    <?php
                        global $wp_query;
						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'current' => max( 1, get_query_var('paged') ),
							'total' => $wp_query->max_num_pages
						) );
                ?>
				</nav>
            </div>
            <?php } ?>

        </article>

    </div>

<?php get_footer(); ?>