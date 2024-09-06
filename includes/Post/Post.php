<?php // phpcs:ignore
/**
 * Class Post
 *
 * @package WordPress
 * @subpackage Mono
 */

namespace Mono\Post;

use Timber\{ Timber };

/**
 * Post class
 */
class Post {

	/**
	 * Runs initialization tasks.
	 *
	 * @access public
	 */
	public function run() {
		add_action( 'wp_ajax_load_posts', array( $this, 'load_posts' ) );
		add_action( 'wp_ajax_nopriv_load_posts', array( $this, 'load_posts' ) );
	}


	/**
	 * Load Posts
	 *
	 * @return mixed
	 */
	public function load_posts() {
		if ( ! isset( $_GET['nonce'] ) && ! wp_verify_nonce( sanitize_key( $_GET['nonce'] ), 'security' ) ) {
			return false;
		}

		$offset         = (int) $_GET['offset'] ?? 0; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$post_type      = (string) $_GET['postType']; // phpcs:ignore
		$taxonomies     = json_decode( wp_unslash( $_GET['taxonomies'] ) ) ?? array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$posts_per_page = sanitize_text_field( wp_unslash( $_GET['postsPerPage'] ) ) ?? -1; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$filters        = json_decode( wp_unslash( $_GET['filters'] ) ) ?? array();

		$args = array(
			'post_type'           => $post_type,
			'post_status'         => 'publish',
			'posts_per_page'      => $posts_per_page,
			'offset'              => $offset,
		);

		if ( $taxonomies ) {
			foreach ( $taxonomies as $taxonomy ) {
				if ( $taxonomy->term_id ) {
					$args['tax_query'][] = array(
						'taxonomy' => $taxonomy->taxonomy,
						'field'    => 'term_id',
						'terms'    => $taxonomy->term_id,
					);
				}
			}

			if ( $args['tax_query'] ) {
				$args['tax_query']['relation'] = 'OR';
			}
		}

		if ( is_array( $filters ) ) {
			$filters_query = array( 'relation' => 'OR' );

			foreach ( $filters as $filter ) {
				$filters_query[] = array(
					'taxonomy' => $filter->taxonomy,
					'field'    => 'term_id',
					'terms'    => $filter->term_id,
				);
			}

			$args['tax_query'][] = $filters_query;
		}

		$context          = Timber::context();
		$context['posts'] = Timber::get_posts( $args );

		$html = wp_json_encode( Timber::compile( 'components/collection-case-study.html.twig', $context ) );

		wp_send_json(
			array(
				'html'       => $html,
				'foundPosts' => $context['posts']->found_posts,
			)
		);

		wp_die();
	}
}
