<?php // phpcs:ignore
/**
 * Menu
 *
 * @package WordPress
 * @subpackage Mono/Menu
 */

namespace Mono\Admin;

/**
 * Menu
 */
class Menu {

	/**
	 * Runs initialization tasks.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/admin_menu/
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'admin_menu', array( $this, 'add_options_page' ), 10, 1 );
	}

	/**
	 * Add options page
	 *
	 * @param string $context Empty context.
	 *
	 * @return void
	 */
	public function add_options_page( string $context ) {
		add_options_page(
			__( 'Socials', 'mono' ),
			__( 'Socials', 'mono' ),
			'manage_options',
			'socials',
			array( $this, 'add_socials_option_page' )
		);

		add_options_page(
			__( 'Theme', 'mono' ),
			__( 'Theme', 'mono' ),
			'manage_options',
			'theme',
			array( $this, 'add_theme_option_page' )
		);
	}


	/**
	 * Options page callback
	 */
	public function add_socials_option_page() {
		?>
		<div class="wrap">
			<h1><?php _e( 'Socials', 'mono' ); ?></h1>
			<form method="post" action="options.php">
			<?php
				settings_fields( 'socials' );
				do_settings_sections( 'socials' );
				submit_button( __( 'Save Changes', 'mono' ) );
			?>
			</form>
		</div>
		<?php
	}

	/**
	 * Options page callback
	 */
	public function add_theme_option_page() {
		?>
		<div class="wrap">
			<h1><?php _e( 'Theme', 'mono' ); ?></h1>
			<form method="post" action="options.php">
			<?php
				settings_fields( 'theme' );
				do_settings_sections( 'theme' );
				submit_button( __( 'Save Changes', 'mono' ) );
			?>
			</form>
		</div>
		<?php
	}
}
