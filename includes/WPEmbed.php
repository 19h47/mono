<?php // phpcs:ignore
/**
 * WPEmbed
 *
 * @package WordPress
 * @subpackage Mono/WPEmbed
 */

namespace Mono;

/**
 * WPEmbed
 */
class WPEmbed {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'embed_oembed_html', array( $this, 'embed_oembed_html' ), 10, 4 );
	}


	/**
	 * Embed OEmbed HTML
	 *
	 * @param string|false $cache The cached HTML result, stored in post meta.
	 * @param string       $url The attempted embed URL.
	 * @param array        $attr An array of shortcode attributes.
	 * @param int          $post_id Post ID.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/embed_oembed_html/
	 *
	 * @return string|false
	 */
	public function embed_oembed_html( string|false $cache, string $url, array $attr, int $post_id ): string|false {
		return '<div class="embed">' . $cache . '</div>';
	}
}
