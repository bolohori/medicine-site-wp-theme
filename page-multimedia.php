<?php

get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();
        $class = 'full-width';
        $classes = '';
        $margin = ' non-landing-page';
        if (get_the_post_thumbnail() != '') {
            $class .= ' notch';
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


        <nav id="left-col">
            <?php if( ! get_field( 'hide_nav' ) ) { ?>
                <ul id="left-nav">
                    <li class="current_page_item top_level_page"><a href="/news/">News</a></li>
                    <li class="page_item page-item-4713"><a href="/news/releases/">News Releases</a></li>
                    <li class="page_item page-item-4721"><a href="/news/in-the-media/">In the Media</a></li>
                    <li class="page_item page-item-436"><a href="/news/biomed-radio/">BioMed Radio Podcast</a></li>
                    <li class="page_item page-item-4741"><a href="/news/headlines/">Research Highlights</a></li>
                    <li class="page_item"><a href="/news/outlook/">Outlook Magazine</a></li>
                    <li class="page_item page-item-4723"><a href="/news/leaders/">National Leaders</a></li>
                    <li class="page_item page-item-7224"><a href="/news/publications/">Publications</a></li>
                    <li class="page_item page-item-329"><a href="/news/multimedia/">Campus Life</a></li>
                    <li class="page_item"><a href="/news/washington-people/">Washington People</a></li>
                    <li class="page_item page-item-4719"><a href="/news/announcements/">Announcements</a></li>
                </ul>
            <?php } ?>
        </nav>


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
?>

        </article>

    </div>

</div>



<?php get_footer(); ?>