<?php
/**
 * Single: Case Study
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Mono
 * @since 0.0.0
 */

use Timber\{ Timber };

$templates = array( 'pages/single-case-study.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
