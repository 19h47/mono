<?php // phpcs:ignore
/**
 * Init
 *
 * @package WordPress
 * @subpackage Mono/Plugins/ACF
 */

namespace Mono\Plugins\ACF;

/**
 * Init
 */
class Init {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'acf/init', array( $this, 'add_options_theme' ) );
	}

	/**
	 * Add options pages
	 */
	public function add_options_theme() {
	}
}
