<div class="card">
    <?php
        $url = get_field('url') ? get_field('url') : get_permalink();
        $link_text = 'See photos';
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