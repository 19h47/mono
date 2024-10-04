<?php // phpcs:ignore
/**
 * Case Study Post Fields
 *
 * @package WordPress
 * @subpackage Mono
 */

namespace Mono\Plugins\ACF\IncludeFields;

/**
 * Case Study Post Fields
 */
class CaseStudyPostFields {
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
		$key            = 'case_study_post';
		$hide_on_screen = array();

		$location = array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'case_study',
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
				'selected'  => 0,
			),
			array(
				'key'          => 'field_' . $key . '_general',
				'label'        => __( 'General', 'mono' ),
				'name'         => 'general',
				'type'         => 'group',
				'instructions' => __( 'General information about the case study.', 'mono' ),
				'layout'       => 'block',
				'sub_fields'   => array(
					array(
						'key'            => 'field_' . $key . '_general_color',
						'label'          => __( 'Color', 'mono' ),
						'name'           => 'color',
						'type'           => 'color_picker',
						'instructions'   => __( 'Please select the case study color.', 'mono' ),
						'default_value'  => '#01A767',
						'return_format'  => 'array',
						'enable_opacity' => 0,
					),
					array(
						'key'          => 'field_' . $key . '_general_content',
						'label'        => __( 'Content', 'mono' ),
						'name'         => 'content',
						'type'         => 'textarea',
						'rows'         => 2,
						'instructions' => __( 'Content block.', 'mono' ) . '<br>' . __( 'Line breaks are allowed.', 'mono' ) . '<br>' . __( 'HTML is allowed. For instance use <code>&lt;strong&gt;My word&lt;/strong&gt;</code> to make the world bold.', 'mono' ),
					),
					array(
						'key'          => 'field_' . $key . '_general_date',
						'label'        => __( 'Date', 'mono' ),
						'name'         => 'date',
						'type'         => 'text',
						'instructions' => __( 'Please indicate the date of the case study, for example <em>January 2024</em>.', 'mono' ),
						'placeholder'  => __( 'Date', 'mono' ),
					),
					array(
						'key'          => 'field_' . $key . '_general_place',
						'label'        => __( 'Place', 'mono' ),
						'name'         => 'place',
						'type'         => 'text',
						'instructions' => __( 'Please indicate the location of the case study.', 'mono' ),
						'placeholder'  => __( 'Place', 'mono' ),
					),
					array(
						'key'          => 'field_' . $key . '_general_missions',
						'label'        => __( 'Missions', 'mono' ),
						'name'         => 'missions',
						'type'         => 'text',
						'instructions' => __( 'Please indicate the missions carried out.', 'mono' ),
						'placeholder'  => __( 'Mission', 'mono' ),
					),
					array(
						'key'          => 'field_' . $key . '_general_area',
						'label'        => __( 'Area', 'mono' ),
						'name'         => 'area',
						'type'         => 'text',
						'instructions' => __( 'Please indicate the surface area of the case study, for example <em>100m²</em>.', 'mono' ),
						'placeholder'  => __( 'Area', 'mono' ),
						'wrapper'      => array( 'width' => 6 / 12 * 100 ),
					),
					array(
						'key'          => 'field_' . $key . '_general_delivery_date',
						'label'        => __( 'Delivery date', 'mono' ),
						'name'         => 'delivery_date',
						'type'         => 'text',
						'instructions' => __( 'Please indicate the case study delivery date.', 'mono' ),
						'placeholder'  => __( 'Delivery date', 'mono' ),
						'wrapper'      => array( 'width' => 6 / 12 * 100 ),
					),
					array(
						'key'          => 'field_' . $key . '_general_other_information',
						'label'        => __( 'Other information', 'mono' ),
						'name'         => 'other_information',
						'type'         => 'repeater',
						'instructions' => __( 'Please add any other information.', 'mono' ),
						'layout'       => 'block',
						'button_label' => __( 'Add other information', 'mono' ),
						'sub_fields'   => array(
							array(
								'key'             => 'field_' . $key . '_general_other_information_label',
								'label'           => __( 'Label', 'mono' ),
								'name'            => 'label',
								'type'            => 'text',
								'instructions'    => __( 'Information label, for example <em>Visual Identity</em> or <em>Photos</em>.', 'mono' ),
								'wrapper'         => array(
									'width' => 6 / 12 * 100,
								),
								'placeholder'     => __( 'Label', 'mono' ),
								'parent_repeater' => 'field_' . $key . '_general_other_information',
							),
							array(
								'key'             => 'field_' . $key . '_general_other_information_text',
								'label'           => __( 'Text', 'mono' ),
								'name'            => 'text',
								'type'            => 'text',
								'instructions'    => __( 'Information text, for example <em>Art Vandelay</em>.', 'mono' ),
								'wrapper'         => array(
									'width' => 6 / 12 * 100,
								),
								'placeholder'     => __( 'Text', 'mono' ),
								'parent_repeater' => 'field_' . $key . '_general_other_information',
							),
						),
					),
				),
			),
			array(
				'key'       => 'field_' . $key . '_gallery_tab',
				'label'     => __( 'Gallery', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
				'selected'  => 0,
			),
			array(
				'key'           => 'field_' . $key . '_gallery',
				'label'         => __( 'Gallery', 'mono' ),
				'name'          => 'gallery',
				'type'          => 'gallery',
				'instructions'  => __( 'Please add as many images as needed in the gallery.<br>The order can be changed simply by dragging and dropping the image.', 'mono' ),
				'return_format' => 'id',
				'library'       => 'all',
				'insert'        => 'append',
				'preview_size'  => 'medium',
			),
		);

		acf_add_local_field_group(
			array(
				'key'            => 'group_' . $key,
				'title'          => __( 'Case Study Post Fields', 'mono' ),
				'fields'         => $fields,
				'location'       => $location,
				'menu_order'     => 0,
				'hide_on_screen' => $hide_on_screen,
			)
		);
	}
}
