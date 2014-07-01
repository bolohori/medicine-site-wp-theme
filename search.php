<?php
    get_header();
    //query_posts("$query_string . '&posts_per_page=-1'");
?>


<div id="main" class="clearfix">

    <div id="page-background"></div>

    <div class="wrapper clearfix">

        <div id="page-background-inner"></div>

        <nav id="left-col">
            <?php get_sidebar( 'left' ); ?>
        </nav>

        <div id="search-results-wrapper">

            <article class="search-results">
                <h1>Search Results</h1>

                <?php if ( have_posts() ) :
                    while (have_posts()): the_post(); ?>
                        <p>
                            <a class="result-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                            <?php echo get_the_excerpt(); ?><br>
                            <a class="result-url" href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a>
                        </p>
                    <?php endwhile;
                else : ?>
                    <h2>No Results Found</h2>
                <?php endif; ?>
            </article>

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

    </div>

</div>


<?php get_footer(); ?>