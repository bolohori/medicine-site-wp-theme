<?php

get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();
        $class = 'full-width';
        $classes = '';
        $margin = ' non-landing-page';
        if (get_the_post_thumbnail() != '') {
            $margin = ' landing-page';
            $image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'landing-page' );
            echo '<div id="featured-image" style="background-image:url(' . $image . ');">';
            the_post_thumbnail('landing-page');
            echo '</div>';
        }
        if (get_field('special_header'))
            $class .= ' special-head';
        if ( $class !== '' )
            $classes = " class='$class'";
        ?>

        <div id="main" class="clearfix<?php echo $margin; ?>">

        <div id="page-background"></div>

        <div class="wrapper clearfix">

        <div id="page-background-inner"></div>

        <?php get_sidebar(); ?>

        <article<?php echo $classes; ?>>
        <?php
        if(get_field('special_header')) {
            $special_header = get_field('special_header');
            echo "<a class='special-header' href='" . get_permalink( $special_header->ID ) . "'>" . get_the_title( $special_header->ID ) . "</a>";
        }
        the_title('<h1>', '</h1>');
        the_content();
    endwhile;
endif;


// Queries to retrieve the data for the cards on the News page
$args = array(
    'post_type'      => 'news_releases',
    'posts_per_page' => 3
);
$news_releases = new WP_Query ( $args );

$args = array(
    'post_type'      => 'media_mentions',
    'posts_per_page' => 3
);
$in_the_media = new WP_Query ( $args );

$args = array(
    'post_type'      => 'research_news',
    'posts_per_page' => 3
);
$research_highlights = new WP_Query ( $args );

$args = array(
    'post_type'      => 'outlook',
    'posts_per_page' => 3
);
$outlook = new WP_Query ( $args );

$args = array(
    'post_type'      => 'spotlight',
    'posts_per_page' => 3
);
$national_leaders = new WP_Query ( $args );

$args = array(
    'post_type'      => 'in_focus',
    'posts_per_page' => 1
);
$campus_life = new WP_Query ( $args );

$args = array(
    'post_type'      => 'washington_people',
    'posts_per_page' => 1
);
$washington_people = new WP_Query ( $args );

?>


            <div class="card">
                <h2><a href="/news/releases/">News Releases</a></h2>
                <?php if ( $news_releases->have_posts() ) : ?>
                    <ul>
                        <?php while ( $news_releases->have_posts() ) : $news_releases->the_post(); ?>
                            <li>
                                <div class="dateline"><span class="date"><?php the_time('M j, Y'); ?></span></div>
                                <a href="<?php $link = get_field('url'); echo $link['url']; ?>"><?php the_title(); ?></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="card">
                <h2><a href="/news/in-the-media/">In the Media</a></h2>
                <?php if ( $in_the_media->have_posts() ) : ?>
                <ul>
                    <?php while ( $in_the_media->have_posts() ) : $in_the_media->the_post(); ?>
                    <li>
                        <div class="dateline"><span class="date"><?php the_time('M j, Y'); ?></span> &middot; <?php the_field('source'); ?></div>
                        <a href="<?php the_field('url'); ?>"><?php the_title(); ?></a>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>
            </div>

            <div class="card">
                <h2><a href="/news/headlines/">Research Highlights</a></h2>
                <?php if ( $research_highlights->have_posts() ) : ?>
                    <ul>
                        <?php while ( $research_highlights->have_posts() ) : $research_highlights->the_post(); ?>
                            <li>
                                <div class="dateline"><span class="date"><?php the_time('M j, Y'); ?></span></div>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="card">
                <h2><a href="/news/outlook/">Outlook Magazine</a></h2>
                <?php if ( $outlook->have_posts() ) : ?>
                    <ul>
                        <?php while ( $outlook->have_posts() ) : $outlook->the_post(); ?>
                            <li>
                                <div class="dateline"><span class="date"><?php the_time('M Y'); ?></span></div>
                                <a href="<?php echo get_field('url'); ?>"><?php the_title(); ?></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="card full-width">
                <h2><a href="/news/leaders/">National Leaders</a></h2>
                <?php if ( $national_leaders->have_posts() ) : ?>
                    <ul>
                        <?php while ( $national_leaders->have_posts() ) : $national_leaders->the_post(); ?>
                            <li>
                                <a href="<?php $link = get_field('nl-link'); echo $link['url']; ?>"><?php the_title(); ?></a>
                                <?php the_excerpt(); ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="card">
                <h2><a href="/news/multimedia/">Campus Life</a></h2>
                <?php if ( $campus_life->have_posts() ) : ?>
                    <?php while ( $campus_life->have_posts() ) : $campus_life->the_post();
                        $external_link = get_field('external_link');
                        $url = $external_link['url'] ? $external_link['url'] : get_permalink();
                        $link_text = $external_link['title'] ? $external_link['title'] : 'See photos';
                    ?>

                        <a href="<?php echo $url; ?>"><?php the_post_thumbnail( array(325, 218) ); ?></a>

                        <ul>
                            <li>
                                <div class="dateline"><span class="date"><?php the_time('M j, Y'); ?></span></div>
                                <a href="<?php echo $url; ?>"><?php the_title(); ?></a>
                                <p><?php echo get_the_excerpt(); ?> <a class="more" href="<?php echo $url; ?>"><?php echo $link_text; ?></a></p>
                            </li>
                        </ul>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <div class="card">
                <h2><a href="/news/washington-people/">Washington People</a></h2>
                <?php if ( $washington_people->have_posts() ) : ?>
                    <?php while ( $washington_people->have_posts() ) : $washington_people->the_post(); ?>
                        <a href="<?php echo get_field('url'); ?>"><?php the_post_thumbnail( array(325, 218) ); ?></a>
        
                        <ul>
                            <li>
                                <div class="dateline"><span class="date"><?php the_time('M j, Y'); ?></span></div>
                                <a href="<?php echo get_field('url'); ?>"><?php the_title(); ?></a>
                                <p><?php echo get_the_excerpt(); ?> <a class="more" href="<?php echo get_field('url'); ?>">Read more</a></p>
                            </li>
                        </ul>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <div class="card">
                <h2><a href="/news/announcements/">Announcements</a></h2>
                <ul>
                    <li><p>Updates on campus events, policy changes, road and building construction, calls for papers and more. <a class="more" href="/news/announcements">See announcements</a></p></li>
                </ul>
            </div>

            <div class="card">
                <h2><a href="http://news.wustl.edu/run/Pages/Record.aspx">The Record</a></h2>
                <ul>
                    <li><p>University-wide information including research, achievements and campus events. <a class="more" href="http://news.wustl.edu/run/Pages/Record.aspx">Go to The Record</a></p></li>
                </ul>
            </div>

            <p class="disclaimer">Feature Photo: Jay Fram</p>

        </article>

    </div>

</div>



<?php get_footer(); ?>