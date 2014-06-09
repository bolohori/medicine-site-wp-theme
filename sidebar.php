<nav id="left-col">

	<?php 
	$force = 0;
	if ( isset( $post->ID ) ) : $id = $post->ID;
	
	if ( $post->post_type == 'faculty_profile' ) {
		$post = get_page_by_title( 'Faculty Recognition' );
		setup_postdata( $post );
		$force = 1;
		//add_filter( 'page_css_class', function( $css_class, $page ) use( &$post) { if ( $page->ID == $post->ID ) $css_class[] = 'current_page_item'; return $css_class; }, 10, 2 );
	}
	?>

		<ul id="left-nav">

			<?php
				$walker = new Razorback_Walker_Page_Selective_Children();
				
				if ( ( is_page() || $force  || ( sizeof( $post->ancestors ) > 0 ) ) &&  ! ( is_search() ) && ! ( get_field('hide_in_nav', $post->ID) ) ) {

					// This is a page
					if ( ( is_page() && $post->post_parent ) || ( $force ) ) {
						// This is a subpage
						$get_children_of = ( isset( $post->ID ) ) ? (int) $post->ancestors[count($post->ancestors)-1] : 0;
					} else {
						// This is not a subpage
						$get_children_of = ( isset( $post->ID ) ) ? (int) $post->ID : 0;
					}

					$ptg = sizeof( $post->ancestors ) > 0 ? $post->ancestors[sizeof( $post->ancestors ) - 1 ] : $post;

					$children = wp_list_pages( array (
						'sort_column'  => 'menu_order',
						'title_li'     => '',
						'child_of'     => $get_children_of,
						'walker'       => $walker,
						'echo'         => 0
					) );

					$post_to_get = get_post($ptg);
					$nav_title = get_field('nav_menu_title', $post_to_get->ID);
					$title = ( $nav_title === '' ) ? $post_to_get->post_title : $nav_title;

					if ( sizeof($post->ancestors) == 0 && $children ) {
						// Top-level page with children
						echo "<li class='current_page_item top_level_page'><a href='/" . get_post($ptg)->post_name . "'>$title</a></li>";
					} elseif ( sizeof($post->ancestors) > 0 ) {
						// Sub-page
						echo "<li class='top_level_page'><a href='/" . get_post($ptg)->post_name . "'>$title</a></li>";
					}

					echo $children;
				}
			?>
		</ul>

	<?php endif; ?>

	<?php 
	/*
	 * Keeping this in here for the future, right now we're not using it, but hopefully someday we will
	 */
	if(0) { ?>
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
            'walker'       => $walker
        ) );
        ?>

        <li class="page_item"><a onclick="javascript:_gaq.push(['_trackEvent','mobile-utility-nav','http://wustl.edu/']);" href="http://wustl.edu/">WUSTL</a></li>
        <li class="page_item"><a onclick="javascript:_gaq.push(['_trackEvent','mobile-utility-nav','http://medicine.wustl.edu/directory']);" href="http://medicine.wustl.edu/directory">Directories</a></li>
    </ul>
    <?php } ?>
</nav>