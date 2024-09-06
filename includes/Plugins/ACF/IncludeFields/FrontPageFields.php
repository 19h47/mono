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
				'key'       => 'field_' . $key . '_hero_tab',
				'label'     => __( 'Hero', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
			),
			array(
				'key'        => 'field_' . $key . '_hero',
				'label'      => __( 'Hero', 'mono' ),
				'name'       => 'hero',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					get_acf_content_field( $key . '_hero_content', 6 / 12 * 100 ),
					array(
						'key'           => 'field_' . $key . '_hero_image',
						'label'         => __( 'Image', 'mono' ),
						'name'          => 'image',
						'type'          => 'image',
						'instructions'  => __( 'Block image.', 'mono' ),
						'wrapper'       => array(
							'width' => 6 / 12 * 100,
						),
						'return_format' => 'id',
						'library'       => 'all',
						'preview_size'  => 'medium',
					),
				),
			),
			array(
				'key'       => 'field_' . $key . '_product_categories_tab',
				'label'     => __( 'Product Categories', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
			),
			array(
				'key'          => 'field_' . $key . '_product_categories',
				'label'        => __( 'Product Categories', 'mono' ),
				'name'         => 'product_categories',
				'type'         => 'group',
				'layout'       => 'block',
				'instructions' => __( 'If no category is selected, nothing will be displayed.', 'mono' ),
				'sub_fields'   => array(
					array(
						'key'          => 'field_' . $key . '_product_categories_title',
						'label'        => __( 'Title', 'mono' ),
						'name'         => 'title',
						'type'         => 'text',
						'instructions' => __( 'Title block.', 'mono' ),
						'placeholder'  => __( 'Title', 'mono' ),
					),
					array(
						'key'          => 'field_' . $key . '_product_categories_text',
						'label'        => __( 'Text', 'mono' ),
						'name'         => 'text',
						'type'         => 'textarea',
						'instructions' => __( 'Text block.', 'mono' ) . '<br>' . __( 'Line breaks are allowed.', 'mono' ),
						'rows'         => 2,
						'placeholder'  => __( 'Text', 'mono' ),
						'new_lines'    => '',
					),
					array(
						'key'           => 'field_' . $key . '_product_categories_product_categories',
						'label'         => __( 'Product Categories', 'mono' ),
						'name'          => 'product_categories',
						'type'          => 'taxonomy',
						'required'      => 0,
						'taxonomy'      => 'product_cat',
						'add_term'      => 0,
						'save_terms'    => 0,
						'load_terms'    => 0,
						'return_format' => 'id',
						'field_type'    => 'multi_select',
						'allow_null'    => 1,
						'multiple'      => 1,
					),
				),
			),
			array(
				'key'       => 'field_' . $key . '_catchphrase_tab',
				'label'     => __( 'Catchphrase', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
			),
			array(
				'key'        => 'field_' . $key . '_catchphrase',
				'label'      => __( 'Catchphrase', 'mono' ),
				'name'       => 'catchphrase',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'          => 'field_' . $key . '_catchphrase_text',
						'label'        => __( 'Text', 'mono' ),
						'name'         => 'text',
						'type'         => 'textarea',
						'rows'         => 2,
						'instructions' => __( 'Text block.', 'mono' ) . '<br>' . __( 'Line breaks are allowed.', 'mono' ),
						'placeholder'  => __( 'Text', 'mono' ),
					),
				),
			),
			array(
				'key'       => 'field_' . $key . '_rental_tab',
				'label'     => __( 'Rental', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
			),
			array(
				'key'        => 'field_' . $key . '_rental',
				'label'      => __( 'Rental', 'mono' ),
				'name'       => 'rental',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					get_acf_content_field( $key . '_rental', 6 / 12 * 100 ),
					array(
						'key'           => 'field_' . $key . '_rental_image',
						'label'         => __( 'Image', 'mono' ),
						'name'          => 'image',
						'type'          => 'image',
						'instructions'  => __( 'Block image.', 'mono' ),
						'return_format' => 'id',
						'library'       => 'all',
						'preview_size'  => 'medium',
						'wrapper'       => array( 'width' => 6 / 12 * 100 ),
					),
					array(
						'key'          => 'field_' . $key . '_rental_rentals',
						'label'        => __( 'Rentals', 'mono' ),
						'name'         => 'rentals',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => __( 'Add Rental', 'mono' ),
						'sub_fields'   => array(
							array(
								'key'             => 'field_' . $key . '_rental_rentals_title',
								'label'           => __( 'Title', 'mono' ),
								'name'            => 'title',
								'type'            => 'text',
								'placeholder'     => 'Title',
								'parent_repeater' => 'field_' . $key . '_rental_rentals',
							),
							array(
								'key'             => 'field_' . $key . '_rental_rentals_text',
								'label'           => __( 'Text', 'mono' ),
								'name'            => 'text',
								'type'            => 'wysiwyg',
								'tabs'            => 'all',
								'toolbar'         => 'full',
								'media_upload'    => 0,
								'parent_repeater' => 'field_' . $key . '_rental_rentals',
							),
							array(
								'key'             => 'field_' . $key . '_rental_rentals_caption',
								'label'           => __( 'Caption', 'mono' ),
								'name'            => 'caption',
								'type'            => 'text',
								'placeholder'     => __( 'Caption', 'mono' ),
								'parent_repeater' => 'field_' . $key . '_rental_rentals',
							),
						),
					),
				),
			),
			array(
				'key'       => 'field_' . $key . '_references_tab',
				'label'     => __( 'References', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
			),
			array(
				'key'        => 'field_' . $key . '_references',
				'label'      => __( 'References', 'mono' ),
				'name'       => 'references',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					get_acf_content_field( $key . '_references' ),
					array(
						'key'           => 'field_' . $key . '_references_references',
						'label'         => __( 'References', 'mono' ),
						'name'          => 'references',
						'type'          => 'taxonomy',
						'required'      => 0,
						'taxonomy'      => 'reference_cat',
						'add_term'      => 0,
						'save_terms'    => 0,
						'load_terms'    => 0,
						'return_format' => 'id',
						'field_type'    => 'multi_select',
						'allow_null'    => 0,
					),
				),
			),
			array(
				'key'       => 'field_' . $key . '_contact_tab',
				'label'     => __( 'Contact', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
			),
			array(
				'key'        => 'field_' . $key . '_contact',
				'label'      => __( 'Contact', 'mono' ),
				'name'       => 'contact',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_' . $key . '_contact_form_id',
						'label'         => __( 'Form', 'mono' ),
						'name'          => 'form_id',
						'type'          => 'post_object',
						'post_type'     => array( 'wpcf7_contact_form' ),
						'post_status'   => '',
						'taxonomy'      => '',
						'return_format' => 'id',
						'multiple'      => 0,
						'allow_null'    => 0,
					),
					array(
						'key'        => 'field_' . $key . '_contact_maps',
						'label'      => __( 'Maps', 'mono' ),
						'name'       => 'maps',
						'type'       => 'group',
						'layout'     => 'block',
						'sub_fields' => array(
							array(
								'key'           => 'field_' . $key . '_contact_maps_0',
								'label'         => __( 'Image Mobile', 'mono' ),
								'name'          => 0,
								'type'          => 'image',
								'required'      => 0,
								'return_format' => 'id',
								'library'       => 'all',
								'preview_size'  => 'medium',
								'wrapper' => array( 'width' => 6 / 12 * 100  )
							),
							array(
								'key'           => 'field_' . $key . '_contact_maps_1',
								'label'         => __( 'Image Desktop', 'mono' ),
								'name'          => 1,
								'type'          => 'image',
								'required'      => 0,
								'return_format' => 'id',
								'library'       => 'all',
								'preview_size'  => 'medium',
								'wrapper' => array( 'width' => 6 / 12 * 100  )
							),
						),
					),
				),
			),
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
