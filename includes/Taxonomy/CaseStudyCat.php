<?php // phpcs:ignore
/**
 * Class Case Study Cat
 *
 * PHP version 8.0.0
 *
 * @author  Jérémy Levron <jeremylevron@19h47.fr> (https://19h47.fr)
 *
 * @package WordPress
 * @subpackage Mono\Taxonomy
 */

namespace Mono\Taxonomy;

/**
 * Case Study Cat
 */
class CaseStudyCat {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'init', array( $this, 'register' ) );
		add_action( 'admin_head', array( $this, 'css' ) );
		add_filter( 'manage_edit-case_study_cat_columns', array( $this, 'add_custom_columns' ) );
		add_action( 'manage_case_study_cat_custom_column', array( $this, 'render_custom_columns' ), 10, 3 );
	}


	/**
	 * CSS
	 *
	 * @return bool
	 */
	public function css(): bool {
		global $current_screen;

		if ( 'product' !== $current_screen->post_type && 'case_study_cat' === $current_screen->taxonomy ) {
			return false;
		}

		?>
		<style>
			/* .fixed .column-thumbnails {} */

			.column-thumbnails div {
				display: flex;
				column-gap: 10px;
			}

			.column-thumbnails a {
				display: block;
			}
			.column-thumbnails a img {
				display: inline-block;
				vertical-align: middle;
				width: 80px;
				height: 80px;
				object-fit: contain;
				object-position: center;
				overflow: hidden;
			}
		</style>
		<?php

		return true;
	}


	/**
	 * Add custom columns
	 *
	 * @param array $columns Array of columns.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/manage_post_type_posts_columns/
	 *
	 * @return array $new_columns
	 */
	public function add_custom_columns( array $columns ): array {
		$new_columns = array(
			'thumbnails' => __( 'Thumbnails', 'mono' ),
		);

		return array_merge( $new_columns, $columns );
	}



	/**
	 * Render custom columns
	 *
	 * @param string $string Custom column output. Default empty.
	 * @param string $column_name Name of the column.
	 * @param int    $term_id Term ID.
	 * @link https://developer.wordpress.org/reference/hooks/manage_this-screen-taxonomy_custom_column/
	 *
	 * @return void
	 */
	public function render_custom_columns( string $string, string $column_name, int $term_id ): void {
		switch ( $column_name ) {
			case 'thumbnails':
				$thumbnails = get_field( 'thumbnails', 'term_' . $term_id );
				$html       = array( '—' );

				if ( is_array( $thumbnails ) ) {
					$html = array();

					foreach ( $thumbnails as $thumbnail ) {

						$image  = '<a href="' . esc_attr( get_edit_term_link( $term_id, 'case_study_cat' ) ) . '"';
						$image .= '>';
						$image .= wp_get_attachment_image( $thumbnail );
						$image .= '</a>';

						$html[] = $image;
					}
				}

				echo wp_kses_post( '<div>' . implode( '', $html ) . '</div>' );

				break;
		}
	}


	/**
	 * Register custom taxonomy
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_taxonomy/
	 *
	 * @return void
	 */
	public function register(): void {

		$labels = array(
			'name'                       => _x( 'Case Study Categories', 'case study category general name', 'mono' ),
			'singular_name'              => _x( 'Category', 'case study category singular name', 'mono' ),
			'search_items'               => __( 'Search Categories', 'mono' ),
			'all_items'                  => __( 'All Categories', 'mono' ),
			'popular_items'              => __( 'Popular Categories', 'mono' ),
			'edit_item'                  => __( 'Edit Category', 'mono' ),
			'view_item'                  => __( 'View Category', 'mono' ),
			'update_item'                => __( 'Update Category', 'mono' ),
			'add_new_item'               => __( 'Add New Category', 'mono' ),
			'new_item_name'              => __( 'New Category Name', 'mono' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'mono' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'mono' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories', 'mono' ),
			'not_found'                  => __( 'No categories found.', 'mono' ),
			'no_terms'                   => __( 'No categories', 'mono' ),
			'items_list_navigation'      => __( 'Categories list navigation', 'mono' ),
			'items_list'                 => __( 'Categories list', 'mono' ),
			/* translators: Case study cat heading when selecting from the most used terms. */
			'most_used'                  => _x( 'Most Used', 'product cat', 'mono' ),
			'back_to_items'              => __( '&larr; Back to Categories', 'mono' ),
		);

		$rewrite = array(
			'hierarchical' => true,
			'with_front' => false
		);

		$args = array(
			'labels'             => $labels,
			'hierarchical'       => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
			'show_in_rest'       => true,
			'rewrite'            => $rewrite,
		);

		register_taxonomy( 'case_study_cat', array( 'case_study' ), $args );
	}
}
