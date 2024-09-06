<?php // phpcs:ignore
/**
 * BodyClass
 *
 * @package WordPress
 * @subpackage Mono
 * @since 0.0.0
 */

namespace Mono\PostTemplate;

/**
 * BodyClass
 *
 * @see https://developer.wordpress.org/reference/hooks/body_class/
 */
class BodyClass {

	/**
	 * Run default hooks and actions for WordPress
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'body_class', array( $this, 'body_classes' ), 10, 2 );
	}


	/**
	 * Filters the list of CSS body class names for the current post or page.
	 *
	 * @since 0.0.0
	 *
	 * @param string[] $classes An array of body class names.
	 * @param string[] $class   An array of additional class names added to the body.
	 *
	 * @return $classes array
	 */
	public function body_classes( array $classes, array $class ): array {
		if ( is_front_page() || is_page() ) {
			$classes[] = 'bg-brand-vert';
		}

		if ( is_page_template( 'templates/about-page.php' ) ) {
			$classes[] = 'bg-brand-vert';
		}

		return $classes;
	}
}
