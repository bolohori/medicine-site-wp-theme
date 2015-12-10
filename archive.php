<?php

get_header(); ?>

    <div id="main" class="page-news clearfix">

        <header>
            
            <h1>News</h1>

            <ul class="news-subnav clearfix">
                <li><a href="<?php echo get_page_link( 7224 ) ?>">Publications</a></li>
                <li><a href="/news/releases/">For Media</a></li>
                <li><a href="/news/announcements/">Announcements</a></li>
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
                        <ul>
                            <li><a href="/news/type/news-release">News Releases</a></li>
                            <li><a href="/news/type/outlook-magazine">Outlook Magazine</a></li>
                            <li><a href="/news/type/national-leader">Profiles</a></li>
                            <li><a href="/news/type/washington-people">Notables</a></li>
                            <li><a href="/news/type/in-the-media">In the Media</a></li>
                            <li><a href="/news/type/audio">Audio</a></li>
                            <li><a href="/news/type/campus-life">Photos &amp; Video</a></li>
                            <li><a href="/news/type/other-news">More News</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="search"><div class="search-btn"><img src="<?php echo get_template_directory_uri() . '/_/img/search-news.svg'; ?>" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/search-news.png';this.onerror=null;"></div>
                    <form class="search-news" name="search" id="search-form-news" method="get" autocapitalize="none" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="hidden" name="post_type" value="post" />
                        <p><label for="search-box-news">Search News</label><br>
                        <input type="text" id="search-box-news" name="s">
                        <button type="submit" class="submit" id="search-btn-news" onclick="document.getElementById('search-form-news').submit();"><img alt="Search" src="<?php echo get_template_directory_uri(); ?>/_/img/search-news-input.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/search-news-input.png';this.onerror=null;"></button>
                    </form>
                </div>
            </div>

        </header>

        <article>

            <div class="news-cards">

            <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); if($term) { echo '<div class="news-type-title"><p>Source: ' . $term->name . '</p></div>'; } ?>

            <?php if (have_posts()) { ?>
                <ul class="clearfix">
                <?php while (have_posts()) {
                    the_post(); ?>
                    <?php $cardClass = '';
                    if(has_term('national-leader','news')) {
                        $cardClass = ' class="headshot"';
                    } ?>
                    <li<?php echo $cardClass; ?>>
                        <div class="card">
                            <?php if(has_post_thumbnail()) { ?>
                                <a href="<?php ( get_field('url') ? the_field('url') : the_permalink() ) ?>">
                                    <?php the_post_thumbnail('news'); ?>
                                </a>
                            <?php } elseif(has_term('national-leader','news')) { ?>
                                <img src="<?php echo get_template_directory_uri() . '/_/img/spotlight-default.png' ?>">
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
                            <?php if(has_excerpt()) {
                                the_excerpt();
                            } ?>
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