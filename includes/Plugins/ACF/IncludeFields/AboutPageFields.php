<?php // phpcs:ignore
/**
 * About Page Fields
 *
 * @package WordPress
 * @subpackage Mono
 */

namespace Mono\Plugins\ACF\IncludeFields;

/**
 * About Page Fields
 */
class AboutPageFields {
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
		$key            = 'about_page';
		$hide_on_screen = array( 'the_content' );

		$location = array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/about-page.php',
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
					get_acf_content_field( $key . '_hero', 6 / 12 * 100, true, false ),
					array(
						'key'           => 'field_' . $key . '_hero_image',
						'label'         => __( 'Image', 'mono' ),
						'name'          => 'image',
						'type'          => 'image',
						'return_format' => 'id',
						'library'       => 'all',
						'preview_size'  => 'medium',
						'wrapper'       => array( 'width' => 6 / 12 * 100 ),
					),
					array(
						'key'          => 'field_' . $key . '_hero_innovations',
						'label'        => __( 'Innovations', 'mono' ),
						'name'         => 'innovations',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => __( 'Add Innovation', 'mono' ),
						'sub_fields'   => array(
							array(
								'key'             => 'field_' . $key . '_hero_innovations_inovation',
								'label'           => __( 'Text', 'mono' ),
								'name'            => 'text',
								'type'            => 'text',
								'placeholder'     => __( 'Text', 'mono' ),
								'parent_repeater' => 'field_' . $key . '_hero_innovations',
							),
						),
					),
				),
			),
			array(
				'key'       => 'field_' . $key . '_story_tab',
				'label'     => __( 'Story', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
			),
			array(
				'key'        => 'field_' . $key . '_story',
				'label'      => __( 'Story', 'mono' ),
				'name'       => 'story',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'         => 'field_' . $key . '_story_title',
						'label'       => __( 'Title', 'mono' ),
						'name'        => 'title',
						'type'        => 'text',
						'placeholder' => __( 'Title', 'mono' ),
					),
					array(
						'key'          => 'field_' . $key . '_story_stories',
						'label'        => __( 'Stories', 'mono' ),
						'name'         => 'stories',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => __( 'Add Story', 'mono' ),
						'sub_fields'   => array(
							array(
								'key'        => 'field_' . $key . '_story_stories_content',
								'label'      => __( 'Content', 'mono' ),
								'name'       => 'content',
								'type'       => 'group',
								'layout'     => 'block',
								'wrapper'    => array( 'width' => 6 / 12 * 100 ),
								'sub_fields' => array(
									array(
										'key'             => 'field_' . $key . '_story_stories_content_date',
										'label'           => __( 'Date', 'mono' ),
										'name'            => 'date',
										'type'            => 'text',
										'placeholder'     => __( 'Date', 'mono' ),
										'parent_repeater' => 'field_' . $key . '_story_stories',
									),
									array(
										'key'             => 'field_' . $key . '_story_stories_content_text',
										'label'           => __( 'Text', 'mono' ),
										'name'            => 'text',
										'type'            => 'textarea',
										'rows'            => 2,
										'placeholder'     => __( 'Text', 'mono' ),
										'parent_repeater' => 'field_' . $key . '_story_stories',
									),
								),
							),
							array(
								'key'             => 'field_' . $key . '_story_stories_image',
								'label'           => __( 'Image', 'mono' ),
								'name'            => 'image',
								'type'            => 'image',
								'return_format'   => 'id',
								'library'         => 'all',
								'preview_size'    => 'medium',
								'wrapper'         => array( 'width' => 6 / 12 * 100 ),
								'parent_repeater' => 'field_' . $key . '_story_stories',
							),
						),
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
						'instructions' => __( 'Text block.', 'mono' ) . '<br>' . __( 'Line breaks are allowed.', 'mono' ) . '<br>' . __( 'HTML is allowed. For instance use <code>&lt;strong&gt;My word&lt;/strong&gt;</code> to make the world bold.', 'mono' ),
						'placeholder'  => __( 'Text', 'mono' ),
					),
				),
			),
			array(
				'key'       => 'field_' . $key . '_rse_tab',
				'label'     => __( 'RSE', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
			),
			array(
				'key'        => 'field_' . $key . '_rse',
				'label'      => __( 'RSE', 'mono' ),
				'name'       => 'rse',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'         => 'field_' . $key . '_rse_title',
						'label'       => __( 'Title', 'mono' ),
						'name'        => 'title',
						'type'        => 'text',
						'placeholder' => __( 'Title', 'mono' ),
					),
					array(
						'key'         => 'field_' . $key . '_rse_subtitle',
						'label'       => __( 'Subtitle', 'mono' ),
						'name'        => 'subtitle',
						'type'        => 'text',
						'placeholder' => __( 'Subtitle', 'mono' ),
					),
					array(
						'key'         => 'field_' . $key . '_rse_catchphrase',
						'label'       => __( 'Catchphrase', 'mono' ),
						'name'        => 'catchphrase',
						'type'        => 'text',
						'placeholder' => __( 'Catchphrase', 'mono' ),
					),
					array(
						'key'         => 'field_' . $key . '_rse_text',
						'label'       => __( 'Text', 'mono' ),
						'name'        => 'text',
						'type'        => 'textarea',
						'placeholder' => __( 'Text', 'mono' ),
					),
					array(
						'key'          => 'field_' . $key . '_rse_images',
						'label'        => __( 'Images', 'mono' ),
						'name'         => 'images',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => __( 'Add Image', 'mono' ),
						'sub_fields'   => array(
							array(
								'key'             => 'field_' . $key . '_rse_images_image',
								'label'           => __( 'Image', 'mono' ),
								'name'            => 'image',
								'type'            => 'image',
								'return_format'   => 'id',
								'library'         => 'all',
								'preview_size'    => 'medium',
								'parent_repeater' => 'field_' . $key . '_rse_images',
							),
							array(
								'key'             => 'field_' . $key . '_rsee_images_caption',
								'label'           => __( 'Caption', 'mono' ),
								'name'            => 'caption',
								'type'            => 'text',
								'placeholder'     => __( 'Caption', 'mono' ),
								'parent_repeater' => 'field_' . $key . '_rse_images',
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
					array(
						'key'         => 'field_' . $key . '_references_title',
						'label'       => __( 'Title', 'mono' ),
						'name'        => 'title',
						'type'        => 'text',
						'placeholder' => __( 'Title', 'mono' ),
						'wrapper'     => array( 'width' => 6 / 12 * 100 ),
					),
					array(
						'key'           => 'field_' . $key . '_references_link',
						'label'         => __( 'Link', 'mono' ),
						'name'          => 'link',
						'type'          => 'link',
						'return_format' => 'array',
						'wrapper'       => array( 'width' => 6 / 12 * 100 ),
					),
					array(
						'key'          => 'field_' . $key . '_references_categories',
						'label'        => __( 'Categories', 'mono' ),
						'name'         => 'categories',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => __( 'Add Category', 'mono' ),
						'sub_fields'   => array(
							array(
								'key'             => 'field_' . $key . '_references_categories_title',
								'label'           => __( 'Title', 'mono' ),
								'name'            => 'title',
								'type'            => 'text',
								'placeholder'     => __( 'Title', 'mono' ),
								'parent_repeater' => 'field_' . $key . '_references_categories',
							),
							array(
								'key'             => 'field_' . $key . '_references_categories_categories',
								'label'           => __( 'Categories', 'mono' ),
								'name'            => 'categories',
								'type'            => 'repeater',
								'layout'          => 'block',
								'button_label'    => __( 'Add Category', 'mono' ),
								'sub_fields'      => array(
									array(
										'key'             => 'field_' . $key . '_references_categories_categories_category',
										'label'           => __( 'Category', 'mono' ),
										'name'            => 'category',
										'type'            => 'taxonomy',
										'taxonomy'        => 'reference_cat',
										'add_term'        => 0,
										'save_terms'      => 0,
										'load_terms'      => 0,
										'return_format'   => 'id',
										'field_type'      => 'select',
										'allow_null'      => 0,
										'parent_repeater' => 'field_' . $key . '_references_categories_categories',
										'wrapper'         => array( 'width' => 4 / 12 * 100 ),
									),
									array(
										'key'             => 'field_' . $key . '_references_categories_categories_related_products',
										'label'           => __( 'Related Products', 'mono' ),
										'name'            => 'related_products',
										'type'            => 'post_object',
										'post_type'       => array( 'product' ),
										'post_status'     => '',
										'taxonomy'        => '',
										'return_format'   => 'id',
										'multiple'        => 1,
										'allow_null'      => 0,
										'parent_repeater' => 'field_' . $key . '_references_categories_categories',
										'wrapper'         => array( 'width' => 8 / 12 * 100 ),
									),
								),
								'parent_repeater' => 'field_' . $key . '_references_categories',
							),
						),
					),
				),
			),
			array(
				'key'       => 'field_' . $key . '_partners_tab',
				'label'     => __( 'Partners', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
			),
			array(
				'key'        => 'field_' . $key . '_partners',
				'label'      => __( 'Partners', 'mono' ),
				'name'       => 'partners',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'         => 'field_' . $key . '_partners_title',
						'label'       => __( 'Title', 'mono' ),
						'name'        => 'title',
						'type'        => 'text',
						'placeholder' => __( 'Title', 'mono' ),
					),
					array(
						'key'          => 'field_' . $key . '_partners_partners',
						'label'        => __( 'Partners', 'mono' ),
						'name'         => 'partners',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => __( 'Add Partner', 'mono' ),
						'sub_fields'   => array(
							array(
								'key'             => 'field_' . $key . '_partners_partners_image',
								'label'           => __( 'Image', 'mono' ),
								'name'            => 'image',
								'type'            => 'image',
								'return_format'   => 'id',
								'library'         => 'all',
								'preview_size'    => 'medium',
								'parent_repeater' => 'field_' . $key . '_partners_partners',
							),
							array(
								'key'             => 'field_' . $key . '_partners_partners_title',
								'label'           => __( 'Title', 'mono' ),
								'name'            => 'title',
								'type'            => 'text',
								'placeholder'     => __( 'TItle', 'mono' ),
								'parent_repeater' => 'field_' . $key . '_partners_partners',
							),
							array(
								'key'             => 'field_' . $key . '_partners_partners_teext',
								'label'           => __( 'Text', 'mono' ),
								'name'            => 'text',
								'type'            => 'textarea',
								'placeholder'     => __( 'Text', 'mono' ),
								'parent_repeater' => 'field_' . $key . '_partners_partners',
							),
						),
					),
				),
			),
			array(
				'key'       => 'field_' . $key . '_projects_tab',
				'label'     => __( 'Projects', 'mono' ),
				'type'      => 'tab',
				'placement' => 'top',
				'endpoint'  => 0,
			),
			array(
				'key'        => 'field_' . $key . '_projects',
				'label'      => __( 'Projects', 'mono' ),
				'name'       => 'projects',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'         => 'field_' . $key . '_projects_title',
						'label'       => __( 'Title', 'mono' ),
						'name'        => 'title',
						'type'        => 'text',
						'placeholder' => __( 'Title', 'mono' ),
					),
					array(
						'key'          => 'field_' . $key . '_projects_projects',
						'label'        => __( 'Projects', 'mono' ),
						'name'         => 'projects',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => __( 'Add Project', 'mono' ),
						'sub_fields'   => array(
							array(
								'key'             => 'field_' . $key . '_projects_title',
								'label'           => __( 'Title', 'mono' ),
								'name'            => 'title',
								'type'            => 'text',
								'placeholder'     => __( 'Title', 'mono' ),
								'parent_repeater' => 'field_' . $key . '_projects_projects',
							),
							array(
								'key'             => 'field_' . $key . '_projects_text',
								'label'           => __( 'Text', 'mono' ),
								'name'            => 'text',
								'type'            => 'textarea',
								'placeholder'     => __( 'Text', 'mono' ),
								'parent_repeater' => 'field_' . $key . '_projects_projects',
							),
							array(
								'key'             => 'field_' . $key . '_projects_images',
								'label'           => __( 'Images', 'mono' ),
								'name'            => 'images',
								'type'            => 'gallery',
								'return_format'   => 'id',
								'library'         => 'all',
								'insert'          => 'append',
								'preview_size'    => 'medium',
								'parent_repeater' => 'field_' . $key . '_projects_projects',
							),
						),
					),
				),
			),
		);

		acf_add_local_field_group(
			array(
				'key'            => 'group_' . $key,
				'title'          => __( 'About Page Fields', 'mono' ),
				'fields'         => $fields,
				'location'       => $location,
				'menu_order'     => 0,
				'hide_on_screen' => $hide_on_screen,
			)
		);
	}
}
