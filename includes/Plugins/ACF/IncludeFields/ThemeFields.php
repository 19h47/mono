<?php // phpcs:ignore
/**
 * Theme Fields
 *
 * @package WordPress
 * @subpackage Mono
 */

namespace Mono\Plugins\ACF\IncludeFields;

/**
 * Theme Fields
 */
class ThemeFields {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'acf/include_fields', array( $this, 'fields' ) );
	}

	/**
	 * Registers the field group.
	 *
	 * @return void
	 */
	public function fields() {
		$key            = 'theme';
		$hide_on_screen = array( 'the_content' );

		$location = array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'theme-settings',
				),
			),
		);

		$fields = array();

		acf_add_local_field_group(
			array(
				'key'            => 'group_' . $key,
				'title'          => __( 'Theme Fields', 'mono' ),
				'fields'         => $fields,
				'location'       => $location,
				'menu_order'     => 0,
				'hide_on_screen' => $hide_on_screen,
			)
		);
	}
}
