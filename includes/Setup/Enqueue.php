<?php // phpcs:ignore
/**
 * Enqueue
 *
 * @package WordPress
 * @subpackage Mono
 */

namespace Mono\Setup;

use Mono\Vite;

/**
 * Enqueue
 */
class Enqueue {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'wp_head', array( $this, 'preload_wp_scripts' ) );
		add_action( 'wp_head', array( $this, 'preload_wp_styles' ) );
	}


	/**
	 * Enqueue styles.
	 *
	 * @access public
	 * @return void
	 * @since  1.0.0
	 */
	public function enqueue_styles(): void {
		// Add custom fonts, used in the main stylesheet.
		$deps = array();

		foreach ( get_webfonts() as $name => $url ) {
			wp_register_style( 'font-' . $name, $url, array(), '1.0.0' );
			$deps[] = "font-$name";
		}

		// register theme-style-css
		$filename = Vite::asset( 'src/stylesheets/styles.css' );

		if ( is_singular( 'case_study' ) ) {
			$data = 'body { background-color: rgba(' . join( ', ', get_field( 'general' )['color'] ) . '); }';

			wp_register_style( get_theme_text_domain() . '-case-study', false );
			wp_enqueue_style( get_theme_text_domain() . '-case-study', );

			wp_add_inline_style( get_theme_text_domain() . '-case-study', $data );
		}

		// enqueue theme-style-css into our head
		wp_enqueue_style( get_theme_text_domain() . '-main', $filename, $deps, null );
		wp_enqueue_style( 'typekit', '//use.typekit.net/xkp3qjz.css' );
	}


	/**
	 * Dequeue styles
	 *
	 * Remove styles that are not needed.
	 *
	 * @access public
	 * @return void
	 */
	public function dequeue_styles(): void {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-block-style' );
		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'classic-theme-styles' );
	}

	/**
	 * Enqueue scripts
	 *
	 * @access public
	 * @return void
	 * @since  1.0.0
	 */
	public function enqueue_scripts(): void {

		// if (WP_DEBUG === false) {
			wp_deregister_script( 'jquery' );
		// }
		wp_deregister_script( 'wp-embed' );

		$deps = array();

		// Enqueue the Vite module.
		Vite::enqueue_script_module();

		wp_register_script_module(
			get_theme_text_domain() . '-main',
			Vite::asset( 'src/scripts/app.js' ),
			$deps,
			null
		);

		$data = array(
			'template_directory_uri' => get_template_directory_uri(),
			'base_url'               => site_url(),
			'home_url'               => home_url( '/' ),
			'ajax_url'               => admin_url( 'admin-ajax.php' ),
			'api_url'                => home_url( 'wp-json' ),
			'current_url'            => get_permalink(),
			'nonce'                  => wp_create_nonce( 'security' ),
			'text_domain'            => get_theme_text_domain(),
			'messages'               => array(
				'value_missing' => array(
					'default' => _x( 'Please fill out this field.', 'messages', 'mono' ),
				),
				'type_mismatch' => array(
					'email'   => _x( 'Please enter an email address.', 'messages', 'mono' ),
					'url'     => _x( 'Please enter a URL.', 'messages', 'mono' ),
					'default' => _x( 'Please match the expected format.', 'messages', 'mono' ),
				),
			),
		);

		wp_register_script( get_theme_text_domain() . '-feature', false );
		wp_add_inline_script( get_theme_text_domain() . '-feature', '!function(e,n,o){("ontouchstart"in e||e.DocumentTouch&&n instanceof DocumentTouch||o.MaxTouchPoints>0||o.msMaxTouchPoints>0)&&(n.documentElement.className=n.documentElement.className.replace(/\bno-touch\b/,"touch")),n.documentElement.className=n.documentElement.className.replace(/\bno-js\b/,"js")}(window,document,navigator);' );
		wp_add_inline_script( get_theme_text_domain() . '-feature', '/Safari/.test(navigator.userAgent)&&/Apple Computer/.test(navigator.vendor)&&(document.documentElement.className+=" is-safari");' );

		// @TODO doesn't work with wp_enqueue_script_module
		wp_add_inline_script(
			get_theme_text_domain() . '-feature',
			'var ' . get_theme_text_domain() . ' = ' . wp_json_encode(
				$data
			),
			'before',
		);

		wp_enqueue_script( get_theme_text_domain() . '-feature' );
		wp_enqueue_script_module( get_theme_text_domain() . '-main' );
	}


	/**
	 * Preload scripts
	 *
	 * Preload scripts for faster loading.
	 *
	 * @access public
	 * @return void
	 */
	public function preload_wp_scripts(): void {
		global $wp_scripts;

		foreach ( $wp_scripts->queue as $handle ) {
			$script = $wp_scripts->registered[ $handle ];

			if ( substr( $script->handle, 0, strlen( get_theme_text_domain() ) ) !== get_theme_text_domain() ) {
				continue;
			}

			if ( isset( $script->extra['group'] ) && 1 === $script->extra['group'] ) {
				$href = $script->src . ( $script->ver ? "?ver={$script->ver}" : '' );
				echo '<link rel="preload" as="script" href="' . esc_attr( $href ) . '">';
			}
		}
	}


	/**
	 * Preload styles
	 *
	 * Preload styles for faster loading.
	 *
	 * @access public
	 * @return void
	 */
	public function preload_wp_styles(): void {
		global $wp_styles;

		foreach ( $wp_styles->queue as $handle ) {
			$style = $wp_styles->registered[ $handle ];

			if ( substr( $style->handle, 0, strlen( get_theme_text_domain() ) ) !== get_theme_text_domain() ) {
				continue;
			}

			$href = $style->src . ( $style->ver ? "?ver={$style->ver}" : '' );
			echo '<link rel="preload" as="style" href="' . esc_attr( $href ) . '">';

		}
	}
}
