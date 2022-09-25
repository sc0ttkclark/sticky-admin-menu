<?php
/*
Plugin Name: Sticky Admin Menu
Plugin URI: https://www.scottkclark.com/
Description:
Version: 1.0.0
Author: Scott Kingsley Clark
Author URI: https://www.scottkclark.com/
*/

/**
 * Use the last hook available after parent file has been set but before the menu is output
 * so that the menu order can be adjusted.
 *
 * @since 1.0.0
 *
 * @param string $submenu_file The submenu file.
 *
 * @return string The submenu file.
 */
function skc_sticky_admin_menu( $submenu_file ) {
	global $menu;

	$real_page_parent = get_admin_page_parent();

	$found_parent = null;

	foreach ( $menu as $key => $menu_item ) {
		if ( $real_page_parent !== $menu_item[2] ) {
			continue;
		}

		$found_parent = $menu_item;

		unset( $menu[ $key ] );

		break;
	}

	if ( $found_parent ) {
		array_unshift( $menu, $found_parent );
	}

	return $submenu_file;
}

add_filter( 'submenu_file', 'skc_sticky_admin_menu' );
