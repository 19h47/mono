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
	'title'   => __( 'Error 404, this page does not exist', 'mono' ),
	'content' => '<p>' . __( 'This is not always an easy task...', 'mono' ) . '</p>',
);

Timber::render( $templates, $data );
