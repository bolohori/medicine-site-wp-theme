<?php 
 
 /**
 * Create HTML list of pages.
 *
 * @package Razorback
 * @subpackage Walker
 * @author Michael Fields <michael@mfields.org>
 * @link http://wordpress.mfields.org/2010/selective-page-hierarchy-for-wp_list_pages/
 * @copyright Copyright (c) 2010, Michael Fields
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @uses Walker_Page
 *
 * @since 2010-05-28
 * @alter 2010-10-09
 */
class Razorback_Walker_Page_Selective_Children extends Walker_Page {
	/**
	 * Walk the Page Tree.
	 *
	 * @global stdClass WordPress post object.
	 * @uses Walker_Page::$db_fields
	 * @uses Walker_Page::display_element()
	 *
	 * @since 2010-05-28
	 * @alter 2010-10-09
	 */
	function walk( $elements, $max_depth ) {
		global $post;
		$args = array_slice( func_get_args(), 2 );
		$output = '';
 
		/* invalid parameter */
		if ( $max_depth < -1 ) {
			return $output;
		}
 
		/* Nothing to walk */
		if ( empty( $elements ) ) {
			return $output;
		}
 
		/* Set up variables. */
		$top_level_elements = array();
		$children_elements  = array();
		$parent_field = $this->db_fields['parent'];
		$child_of = ( isset( $args[0]['child_of'] ) ) ? (int) $args[0]['child_of'] : 0;
 
		/* Loop elements */
		foreach ( (array) $elements as $e ) {
			$parent_id = $e->$parent_field;
			if ( isset( $parent_id ) ) {
				/* Top level pages. */
				if( $child_of === $parent_id ) {
					$top_level_elements[] = $e;
				}
				/* Only display children of the current hierarchy. */
				else if (
					( isset( $post->ID ) && $parent_id == $post->ID ) ||
					( isset( $post->post_parent ) && $parent_id == $post->post_parent ) ||
					( isset( $post->ancestors ) && in_array( $parent_id, (array) $post->ancestors ) )
				) {
					$children_elements[ $e->$parent_field ][] = $e;
				}
			}
		}
 
		/* Define output. */
		foreach ( $top_level_elements as $e ) {
			$this->display_element( $e, $children_elements, 2, 0, $args, $output );
		}
		return $output;
	}

	function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		extract($args, EXTR_SKIP);
		$css_class = array('page_item', 'page-item-'.$page->ID);

		if( isset( $args['pages_with_children'][ $page->ID ] ) )
			$css_class[] = 'page_item_has_children';

		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'current_page_item';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}

		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		if ( '' === $page->post_title )
			$page->post_title = sprintf( __( '#%d (no title)' ), $page->ID );

		/** This filter is documented in wp-includes/post-template.php */
		if( function_exists( 'get_field' ) && ! get_field( 'hide_in_left_nav', $page->ID ) ) {
			if ( function_exists( 'get_field' ) ) {
				$nav_title = get_field( 'left_nav_menu_title', $page->ID);
			}
            $page_title = ($nav_title == "") ? apply_filters( 'the_title', $page->post_title, $page->ID ) : $nav_title;
            $output .= $indent . '<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . $link_before . $page_title . $link_after . '</a>';
		}

		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;

			$output .= " " . mysql2date($date_format, $time);
		}
	}
}

function in_menu($id) {
	$menu_name = 'header-menu';
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		foreach ( (array) $menu_items as $key => $menu_item ) {
			if($menu_item->object_id == $id) {
				return true;
			}
		}
	}
	return false;
}