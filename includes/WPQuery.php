<?php // phpcs:ignore
/**
 * WP Query
 *
 * @package WordPress
 * @subpackage Mono/WPQuery
 */

namespace Mono;

use WP_Query;

/**
 * WP Query
 */
class WPQuery {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ), 10, 1 );
	}

	/**
	 * Pre Get Posts
	 *
	 * @param WP_Query $query The WP_Query instance (passed by reference).
	 */
	public function pre_get_posts( WP_Query $query ) {
	}
}
