<?php // phpcs:ignore
/**
 * Menu
 *
 * @package WordPress
 * @subpackage Mono
 */

namespace Mono;

/**
 * Menu
 */
class Menu {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'admin_menu', array( $this, 'remove_menu_pages' ), 10, 1 );
	}

	/**
	 * Remove menu pages
	 *
	 * @param string $context Empty context.
	 */
	public function remove_menu_pages( string $context ) {
		remove_menu_page( 'edit.php' );
		remove_menu_page( 'edit-comments.php' );
	}
}
