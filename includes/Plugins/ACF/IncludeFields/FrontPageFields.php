<?php // phpcs:ignore
/**
 * Front Page Fields
 *
 * @package WordPress
 * @subpackage Mono
 */

namespace Mono\Plugins\ACF\IncludeFields;

/**
 * Front Page Fields
 */
class FrontPageFields {
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
		$key            = 'front_page';
		$hide_on_screen = array( 'the_content' );

		$location = array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
		);

		$fields = array(
			array(
				'key'       => 'field_' . $key . '_general_tab',
				'label'     => __( 'General', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
			),
			array(
				'key'          => 'field_' . $key . '_general',
				'label'        => __( 'General', 'mono' ),
				'name'         => 'general',
				'aria-label'   => __( 'General', 'mono' ),
				'type'         => 'group',
				'instructions' => '',
				'layout'       => 'block',
				'sub_fields'   => array(
					array(
						'key'           => 'field_' . $key . '_general_title',
						'label'         => __( 'Title', 'mono' ),
						'name'          => 'title',
						'aria-label'    => __( 'Title', 'mono' ),
						'type'          => 'textarea',
						'instructions'  => __( 'Line breaks are allowed.', 'mono' ),
						'default_value' => '',
						'rows'          => 2,
						'placeholder'   => __( 'Title', 'mono' ),
						'new_lines'     => '',
					),
				)
			)
		);

		acf_add_local_field_group(
			array(
				'key'            => 'group_' . $key,
				'title'          => __( 'Front Page Fields', 'mono' ),
				'fields'         => $fields,
				'location'       => $location,
				'menu_order'     => 0,
				'hide_on_screen' => $hide_on_screen,
			)
		);
	}
}
