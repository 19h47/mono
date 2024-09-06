<?php
/**
 * 404
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Mono
 * @since 0.0.0
 */

use Timber\{ Timber };

$templates    = array( 'pages/404.html.twig' );
$data         = Timber::context();
$data['post'] = array(
	'title'   => __( 'Oops! That page can&rsquo;t be found.', 'mono' ),
	'content' => '<p>' . __( 'It looks like nothing was found at this location.', 'mono' ) . '</p>',
);

Timber::render( $templates, $data );
