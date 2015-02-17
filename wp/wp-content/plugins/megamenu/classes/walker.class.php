<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}

if( ! class_exists( 'Mega_Menu_Walker' ) ) :

/**
 * @package WordPress
 * @since 1.0.0
 * @uses Walker
 */
class Mega_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat("\t", $depth);

		$output .= "\n$indent<ul class=\"mega-sub-menu\">\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * Custom walker. Add the widgets into the menu.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		if ( property_exists( $item, 'megamenu_settings' ) ) {
			$settings = $item->megamenu_settings;
		} else {
			$settings = Mega_Menu_Nav_Menus::get_menu_item_defaults();
		}

		// Item Class
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $classes[] = 'menu-item-' . $item->ID;

        if ( $depth == 0 ) {
			$classes[] = 'align-' . $settings['align'];
			$classes[] = 'menu-' . $settings['type'];
		}

        if ( $settings['hide_arrow'] == 'true') {
        	$classes[] = 'hide-arrow';
        }

        if ( $settings['hide_text'] == 'true' && $depth == 0 ) {
        	$classes[] = 'hide-text';
        }

        if ( $settings['item_align'] != 'left' && $depth == 0 ) {
        	$classes[] = 'item-align-' . $settings['item_align'];
        }

        // add column classes for second level menu items displayed in mega menus
        if ( $item->type != 'widget' && $depth == 1 ) {

        	$parent_settings = array_filter( (array) get_post_meta( $item->menu_item_parent, '_megamenu', true ) );

        	if ( isset( $parent_settings['type'] ) && $parent_settings['type'] == 'megamenu' ) {

				$parent_settings = array_merge( Mega_Menu_Nav_Menus::get_menu_item_defaults(), $parent_settings );

				$span = $settings['mega_menu_columns'];
				$total_columns = $parent_settings['panel_columns'];

				if ( $total_columns >= $span ) {
					$classes[] = "menu-columns-{$span}-of-{$total_columns}";
				} else {
					$classes[] = "menu-columns-{$total_columns}-of-{$total_columns}";
				}

			}

        }

        $class = join( ' ', apply_filters( 'megamenu_nav_menu_css_class', array_filter( $classes ), $item, $args ) );

		// Item ID
		$id = esc_attr( apply_filters( 'megamenu_nav_menu_item_id', "mega-menu-item-{$item->ID}", $item, $args ) );

		$output .= $indent . "<li class='{$class}' id='{$id}'>";

		// output the widgets
		if ( $item->content ) {

			$item_output = $item->content;

		} else {

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';

			if ( $settings['disable_link'] != 'true') {
				$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
			}

			if ( isset( $settings['icon']) && $settings['icon'] != 'disabled' ) {
				$atts['class'] = $settings['icon'];
			}

			$atts = apply_filters( 'megamenu_nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';

			foreach ( $atts as $attr => $value ) {

				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}

			}

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';

			if ( $settings['hide_text'] == 'true' && $depth == 0 ) {
				/** This filter is documented in wp-includes/post-template.php */
			} else {
				$item_output .= $args->link_before . apply_filters( 'megamenu_the_title', $item->title, $item->ID ) . $args->link_after;
			}

			$item_output .= '</a>';
			$item_output .= $args->after;

		}

		$output .= apply_filters( 'megamenu_walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

endif;