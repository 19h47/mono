<?php
/**
 * Front page
 *
 * @package WordPress
 * @subpackage Mono
 * @since 0.0.0
 */

use Timber\{ Timber };

$templates = array( 'pages/front-page.html.twig' );

$data = Timber::context();

Timber::render( $templates, $data );
