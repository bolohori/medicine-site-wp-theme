
<?php $walker = new Razorback_Walker_Page_Selective_Children(); ?>
<nav id="left-col">

	<?php if (isset($post->ID)) : $id = $post->ID; ?>

		<ul id="left-nav">

			<?php
				if ((in_menu($id) || (sizeof($post->ancestors) > 0)) && !(is_search())) {
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


						if ( ! ( function_exists( 'get_field' ) && get_field( 'hide_in_left_nav', $ptg ) ) ) {
							if ( function_exists( 'get_field' ) ) {
								$nav_title = get_field('left_nav_menu_title', $ptg);
							}
							
							$page_title = ( isset( $nav_title ) ) ? $nav_title : get_post($ptg)->post_title;

							if ( sizeof($post->ancestors) == 0 && $children ) {
									// Top-level page with children
									echo '<li class="current_page_item top_level_page"><a href="/' . get_post($ptg)->post_name . '">' . $page_title . '</a></li>';
								} elseif ( sizeof($post->ancestors) > 0 ) {
									// Sub-page
									echo '<li class="top_level_page"><a href="/' . get_post($ptg)->post_name . '">' . $page_title . '</a></li>';
								}

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
			'sort_column'	=> 'menu_order',
			'title_li' 		=> '',
			'walker'		=> $walker
		) );
		?>

		<li class="page_item"><a onclick="javascript:_gaq.push(['_trackEvent','mobile-utility-nav','http://wustl.edu/']);" href="http://wustl.edu/">WUSTL</a></li>
		<li class="page_item"><a onclick="javascript:_gaq.push(['_trackEvent','mobile-utility-nav','http://medicine.wustl.edu/directory']);" href="http://medicine.wustl.edu/directory">Directories</a></li>
	</ul>

</nav>