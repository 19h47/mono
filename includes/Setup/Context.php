<?php // phpcs:ignore
/**
 * Context
 *
 * @package WordPress
 * @subpackage Mono/Setup/Theme
 */

namespace Mono\Setup;

use Timber\{ Timber, Site };

Timber::init();
Timber::$dirname = array( 'views', 'templates', 'dist' );

/**
 * Context
 */
class Context extends Site {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'timber/context', array( $this, 'add_socials_to_context' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/context', array( $this, 'add_to_theme' ) );
		add_filter( 'timber/context', array( $this, 'add_menus_to_context' ) );
		add_filter( 'timber/post/classmap', array( $this, 'add_post_classmap' ) );
	}


	/**
	 * Add to theme
	 *
	 * @param array $context The global context.
	 *
	 * @return array
	 */
	public function add_to_theme( array $context ): array {
		return $context;
	}


	/**
	 * Add socials to context
	 *
	 * @param array $context The global context.
	 *
	 * @return array
	 */
	public function add_socials_to_context( array $context ): array {
		// Share and Socials links.
		$socials = array(
			array(
				'title' => __( 'Instagram', 'mono' ),
				'slug'  => 'instagram',
				'url'   => get_option( 'socials' )['instagram'] ?? '',
				'color' => '#405de6',
			),
			array(
				'title' => __( 'Facebook', 'mono' ),
				'slug'  => 'facebook',
				'name'  => __( 'Share on Facebook', 'mono' ),
				'link'  => 'https://www.facebook.com/sharer.php?u=',
				'url'   => get_option( 'socials' )['facebook'] ?? '',
				'color' => '#1877f2',
			),
			array(
				'title' => __( 'LinkedIn', 'mono' ),
				'slug'  => 'linkedin',
				'name'  => __( 'Share on LinkedIn', 'mono' ),
				'link'  => 'https://www.linkedin.com/sharing/share-offsite/?url=',
				'url'   => get_option( 'socials' )['linkedin'] ?? '',
				'color' => '#0a66c2',
			),
			array(
				'title' => __( 'Tumblr', 'mono' ),
				'slug'  => 'tumblr',
				'name'  => __( 'Share on Tumblr', 'mono' ),
				'link'  => 'http://www.tumblr.com/share/link?url=',
				'color' => '#35465c',
				'url'   => get_option( 'socials' )['tumblr'] ?? '',
			),
			array(
				'title' => __( 'Pinterest', 'mono' ),
				'slug'  => 'pinterest',
				'name'  => __( 'Share on Pinterest', 'mono' ),
				'link'  => 'http://pinterest.com/pin/create/button/?url=',
				'url'   => get_option( 'socials' )['pinterest'] ?? '',
				'color' => '#e60023',
			),
			array(
				'title' => __( 'YouTube', 'mono' ),
				'slug'  => 'youtube',
				'url'   => get_option( 'socials' )['youtube'] ?? '',
				'color' => '#ff0000',
			),

		);

		foreach ( $socials as $social ) {
			if ( ! empty( $social['url'] ) ) {
				$context['socials'][ $social['slug'] ] = $social;
			}

			if ( ! empty( $social['link'] ) ) {
				$context['shares'][ $social['slug'] ] = $social;
			}
		}

		return $context;
	}


	/**
	 * Add to context
	 *
	 * @param array $context The global context.
	 *
	 * @return array
	 */
	public function add_to_context( array $context ): array {
		global $wp;

		$context['current_url'] = home_url( add_query_arg( array(), $wp->request ) );

		$context['privacy_policy_url'] = get_privacy_policy_url();
		$context['contact_url']        = get_permalink( get_option( 'theme' )['page_for_contact'] ?? '' );
		$context['posts_url']          = get_permalink( get_option( 'page_for_posts' ) );
		$context['home_url']           = home_url( '/' );

		$context['address']      = get_option( 'theme' )['address'] ?? '';
		$context['phone_number'] = get_option( 'theme' )['phone_number'] ?? '';
		$context['public_email'] = get_option( 'theme' )['public_email'] ?? '';
		$context['author']       = array(
			'name'        => get_option( 'theme' )['authorname'] ?? '',
			'description' => get_option( 'theme' )['authordescription'] ?? '',
			'career'      => get_option( 'theme' )['authorcareer'] ?? '',
			'image'       => get_option( 'theme' )['authorimage'] ?? '',
		);

		return $context;
	}

	/**
	 * Add post classmap
	 *
	 * @param array $classmap Classmap.
	 *
	 * @return array
	 */
	public function add_post_classmap( $classmap ): array {
		$custom_classmap = array();

		return array_merge( $classmap, $custom_classmap );
	}


	/**
	 * Add menus to context
	 *
	 * @param array $context The global context.
	 *
	 * @see https://developer.wordpress.org/reference/functions/get_registered_nav_menus/
	 *
	 * @return array
	 */
	public function add_menus_to_context( array $context ): array {
		$menus = get_registered_nav_menus();

		foreach ( $menus as $menu => $value ) {
			$context['nav_menus'][ $menu ] = Timber::get_menu( $menu );
		}

		return $context;
	}
}
