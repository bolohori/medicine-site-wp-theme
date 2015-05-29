<div class="card">
    <?php
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

</div>