<?php // phpcs:ignore
/**
 * WordPress helpers function
 *
 * @package Mono
 */


/**
 * Retrieve the classes for the html element as an array.
 *
 * @param  string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 * @access public
 */
function get_html_class( $class = '' ): array {
	$classes = array();
	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}
	$classes = array_map( 'esc_attr', $classes );
	/**
	 * Filter the list of CSS html classes for the current post or page.
	 *
	 * @param array  $classes An array of html classes.
	 * @param string $class   A comma-separated list of additional classes added to the html.
	 */
	$classes = apply_filters( 'html_class', $classes, $class );

	return array_unique( $classes );
}


/**
 * Display the classes for the html element.
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return string
 */
function html_class( $class = '' ): string {
	// Separates classes with a single space, collates classes for html element.
	return 'class="' . join( ' ', get_html_class( $class ) ) . '"';
}


/**
 * List webfonts used by the theme.
 *
 * Returns an array of name and url.
 *
 * @since  1.0.0
 * @return array
 * @access public
 */
function get_webfonts(): array {
	return array();
}


/**
 * Get ACF content field
 *
 * @param string $key Key.
 * @param int    $width Wrapper width. (Default 100)
 * @param bool   $wysiwyg Wysiwyg. (Default false)
 * @param bool   $link Link field. (Default true)
 *
 * @return array
 */
function get_acf_content_field( string $key, int $width = 100, bool $wysiwyg = false, bool $link = true ): array {
	$sub_fields = array(
		array(
			'key'          => 'field_' . $key . '_content_title',
			'label'        => __( 'Title', 'mono' ),
			'name'         => 'title',
			'type'         => 'textarea',
			'rows'         => 3,
			'instructions' => __( 'Title block.', 'mono' ) . '<br>' . __( 'Line breaks are allowed.', 'mono' ),
			'placeholder'  => __( 'Title', 'mono' ),
		),
		array(
			'key'          => 'field_' . $key . '_content_text',
			'label'        => __( 'Text', 'mono' ),
			'name'         => 'text',
			'type'         => $wysiwyg ? 'wysiwyg' : 'textarea',
			'instructions' => __( 'Text block. (Optionnal)', 'mono' ) . ( $wysiwyg ? '' : '<br>' . __( 'Line breaks are allowed.', 'mono' ) ),
			'rows'         => 3,
			'placeholder'  => __( 'Text', 'mono' ),
			'new_lines'    => '',
		),
	);

	if ( $link ) {
		$sub_fields[] = array(
			'key'           => 'field_' . $key . '_content_link',
			'label'         => __( 'Link', 'mono' ),
			'name'          => 'link',
			'type'          => 'link',
			'return_format' => 'array',
			'instructions'  => __( 'Link block. (Optional)', 'mono' ),
		);
	}

	return array(
		'key'          => 'field_' . $key . '_content',
		'label'        => __( 'Content', 'mono' ),
		'name'         => 'content',
		'type'         => 'group',
		'layout'       => 'block',
		'instructions' => __( 'Content block.', 'mono' ),
		'wrapper'      => array(
			'width' => $width,
		),
		'sub_fields'   => $sub_fields,
	);
}


/**
 * Mono create variations
 *
 * @param array $attributes Attributes array.
 *
 * @see https://stackoverflow.com/a/53004833
 *
 * @return array
 */
function enodis_create_variations( array $attributes ) : array {

	if ( empty( $attributes ) ) {
		return array();
	}

	function traverse( $attributes, $parent_ind ) {
		$r  = array();
		$pr = '';

		if ( ! is_numeric( $parent_ind ) ) {
			$pr = $parent_ind . '-';
		}

		foreach ( $attributes as $ind => $el ) {
			if ( is_array( $el ) ) {
				$r = array_merge( $r, traverse( $el, $pr . ( is_numeric( $ind ) ? '' : $ind ) ) );
			} elseif ( is_numeric( $ind ) ) {
				$r[] = $pr . $el;
			} else {
				$r[] = $pr . $ind . '-' . $el;
			}
		}

		return $r;
	}

	// 1. Go through entire array and transform elements that are arrays into elements, collect keys
	$keys = array();
	$size = 1;

	foreach ( $attributes as $key => $elems ) {
		if ( is_array( $elems ) ) {
			$rr = array();

			foreach ( $elems as $ind => $elem ) {
				if ( is_array( $elem ) ) {
					$rr = array_merge( $rr, traverse( $elem, $ind ) );
				} else {
					$rr[] = $elem;
				}
			}

			$attributes[ $key ] = $rr;
			$size         *= count( $rr );
		}

		$keys[] = $key;
	}

	// 2. Go through all new elems and make variations
	$rez = array();

	for ( $i = 0; $i < $size; $i++ ) {
		$rez[ $i ] = array();

		foreach ( $attributes as $key => $value ) {
			$current           = current( $attributes[ $key ] );
			$rez[ $i ][ $key ] = $current;
		}

		foreach ( $keys as $key ) {
			if ( ! next( $attributes[ $key ] ) ) {
				reset( $attributes[ $key ] );
			} else {
				break;
			}
		}
	}

	return $rez;
}
