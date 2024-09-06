<?php // phpcs:ignore
/**
 * Admin Enqueue Scripts
 *
 * @package WordPress
 * @subpackage Mono/Plugins/ACF/Admin
 */

namespace Mono\Plugins\ACF\Input;

/**
 * Admin Enqueue Scripts
 */
class AdminEnqueueScripts {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'acf/input/admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Admin head
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style( get_theme_text_domain() . '-acf', get_template_directory_uri() . '/includes/Plugins/ACF/Input/style.css', false, null );
	}
}
