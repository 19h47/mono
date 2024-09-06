<?php
/**
 * Mono functions and definitions
 *
 * @package WordPress
 * @subpackage Mono
 */

// Autoloader.
require_once get_template_directory() . '/vendor/autoload.php';

Timber\Timber::init();
Mono\Init::run_services();
