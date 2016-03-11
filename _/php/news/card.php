<?php
    $cardClass = '';
    if(has_term('national-leaders','news')) {
        $cardClass = ' class="headshot"';
    }
?><li<?php echo $cardClass; ?>>
    <div>
        <a href="<?php ( get_field('url') ? the_field('url') : the_permalink() ) ?>">
            <div class="card">
            <?php if(has_post_thumbnail()) {
                the_post_thumbnail('news');
            } elseif(has_term('national-leaders','news')) { ?>
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
                    echo '<p>' . get_the_excerpt() . '.</p>';
                }
                if(get_field('source')) {
                    echo '<p class="news-source">Source: ' . get_field('source') . '</p>';
                } else {
                    $terms = get_the_terms($post->ID, 'news');
                    if ($terms) {
                        $term_list = array();

                        foreach ($terms as $term) {
                            // Don't include More News in the list of terms.
                            if ($term->name != 'More News') {
                                $term_list[] = $term->name;
                            }
                        }
                    }
                    if ($term_list) {
                        echo '<p class="news-source">' . implode(', ', $term_list) . '</p>';
                    }
                } ?>
                </div>
            </div>
        </a>
    </div>
</li>