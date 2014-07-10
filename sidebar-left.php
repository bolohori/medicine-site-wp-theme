<nav id="left-col">

    <?php if (isset($post->ID)) : $id = $post->ID; ?>

        <ul id="left-nav">

            <?php
            if ((in_menu($id) || is_page() || (sizeof($post->ancestors) > 0)) && !(is_search())) {

                $walker = new Razorback_Walker_Page_Selective_Children();

                if ( is_page() || $force_menu) {
                    if ( is_page() && $post->post_parent ) {
                        // This is a subpage
                        $get_children_of = ( isset( $post->ID ) ) ? (int) $post->ancestors[count($post->ancestors)-1] : 0;
                    } else {
                        // This is not a subpage
                        $get_children_of = ( isset( $post->ID ) ) ? (int) $post->ID : 0;
                    }

                    $ptg = sizeof($post->ancestors) > 0 ? $post->ancestors[sizeof($post->ancestors) - 1 ] : $post;

                    $children = wp_list_pages( array (
                        'sort_column'  => 'menu_order',
                        'title_li'     => '',
                        'child_of'     => $get_children_of,
                        'walker'       => $walker,
                        'echo'         => 0
                    ));


                    if( function_exists('get_field') && !get_field('hide_in_left_nav', $ptg) ) {

                        if (function_exists('get_field')) {
                            $nav_title = get_field('left_nav_menu_title', $ptg);
                        }
                        $page_title = ($nav_title == "") ? get_post($ptg)->post_title : $nav_title;

                        if ( sizeof($post->ancestors) == 0 && $children ) {
                            // Top-level page with children
                            $top_level_page = '<li class="current_page_item top_level_page"><a href="/' . get_post($ptg)->post_name . '">' . $page_title . '</a></li>';
                        } elseif ( sizeof($post->ancestors) > 0 ) {
                            // Sub-page
                            $top_level_page = '<li class="top_level_page"><a href="/' . get_post($ptg)->post_name . '">' . $page_title . '</a></li>';
                        }

                        echo isset($top_level_page) ? $top_level_page : '';
                        echo $children;

                    }
                }
            }
            ?>
        </ul>

    <?php endif; ?>



    <ul id="mobile-nav">
        <li>
            <form method="get" id="mobile-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="text" name="s" id="mobile-search-box" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" placeholder="<?php esc_attr_e( 'Search' ); ?>">
                <input type="image" class="submit" name="submit" id="mobile-search-btn" src="<?php echo get_template_directory_uri(); ?>/_/img/mobile-search.png">
            </form>
        </li>
        <li class="page_item<?php echo is_front_page() ? ' current_page_item' : '' ?>"><a href="<?php echo home_url(); ?>">Home</a></li>

        <?php
        wp_list_pages( array(
            'sort_column'  => 'menu_order',
            'title_li' => '',
        ) );
        ?>

        <?php
        /*
        // This is a start to improve the mobile nav
        if ((in_menu($id) || (sizeof($post->ancestors) > 0)) && !(is_search()) && isset($top_level_page)) {
            // This part needs some work. The whole things should probably be reorganized.
            echo $top_level_page;
            echo $children;
        } else {
            // I think this part is working.
            $header_menu_items = wp_get_nav_menu_items('header');
            foreach ($header_menu_items as $menu_item) {
                echo '<li class="page_item';
                echo (is_front_page() && $menu_item->title == 'Home') || is_page($menu_item->object_id) ? ' current_page_item' : '';
                echo '"><a href="' . $menu_item->url . '">' . $menu_item->title . '</a> ';
                echo $menu_item->post_name . '</li>';
            }
        }
        */
        ?>

        <li class="page_item"><a onclick="javascript:_gaq.push(['_trackEvent','mobile-utility-nav','http://wustl.edu/']);" href="http://wustl.edu/">WUSTL</a></li>
        <li class="page_item"><a onclick="javascript:_gaq.push(['_trackEvent','mobile-utility-nav','http://medicine.wustl.edu/directory']);" href="http://medicine.wustl.edu/directory">Directories</a></li>
    </ul>

</nav>