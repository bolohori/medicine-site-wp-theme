<?php
/*
*  Loop through a Flexible Content field and display its content with different views for different layouts
*/
if (get_field('sidebars')): ?>
    <div id="right-col">
    <?php while (has_sub_field('sidebars')):
        if (get_row_layout() == 'links'): // List of Links ?>
            <aside>
                <h2><?php the_sub_field('title'); ?></h2>
                <?php if (get_sub_field('links')): ?>
                    <ul>
                        <?php while (has_sub_field('links')):
                            $link_text = get_sub_field('link_text');
                            $url = get_sub_field('url');
                            $target = get_sub_field('open_in_current_window') ? '' : 'target="blank"';
                            echo "<li><a $target href=\"$url\">$link_text</a></li>";
                        endwhile; ?>
                    </ul>
                <?php endif; ?>
            </aside>
        <?php endif;
    endwhile; ?>
    </div>
<?php endif; ?>