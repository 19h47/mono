<?php // phpcs:ignore
/**
 * Init
 *
 * @package WordPress
 * @subpackage Mono
 */

namespace Mono\Admin;

/**
 * Init
 */
class Init {

	/**
	 * Runs initialization tasks.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/admin_init/
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'admin_init', array( $this, 'add_settings_sections' ) );
		add_action( 'admin_init', array( $this, 'add_settings_fields' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'uploader_script' ) );
	}

	/**
	 * Add Settings Sections
	 */
	public function add_settings_sections() {
		foreach ( array( 'theme', 'socials' ) as $section ) {
			add_settings_section(
				'settings_section_' . $section,
				'',
				array( $this, 'section_callback_function' ),
				$section
			);
		}
	}

	/**
	 * Add settings fields
	 *
	 * @return void
	 */
	public function add_settings_fields(): void {

		add_settings_field(
			'instagram',
			__( 'Instagram', 'mono' ),
			array( $this, 'text_callback_function' ),
			'socials',
			'settings_section_socials',
			array(
				'type'        => 'url',
				'name'        => 'socials[instagram]',
				'placeholder' => 'https://instagram.com/artvandelay',
				'description' => __( 'Enter the Instagram URL here.', 'mono' ),
				'value'       => get_option( 'socials' )['instagram'] ?? '',
			)
		);

		add_settings_field(
			'facebook',
			__( 'Facebook', 'mono' ),
			array( $this, 'text_callback_function' ),
			'socials',
			'settings_section_socials',
			array(
				'type'        => 'url',
				'name'        => 'socials[facebook]',
				'placeholder' => 'https://facebook.com/artvandelay',
				'description' => __( 'Enter the Facebook URL here.', 'mono' ),
				'value'       => get_option( 'socials' )['facebook'] ?? '',
			)
		);

		add_settings_field(
			'linkedin',
			__( 'LinkedIn', 'mono' ),
			array( $this, 'text_callback_function' ),
			'socials',
			'settings_section_socials',
			array(
				'type'        => 'url',
				'name'        => 'socials[linkedin]',
				'placeholder' => 'https://www.linkedin.com/artvandelay',
				'description' => __( 'Enter the LinkedIn URL here.', 'mono' ),
				'value'       => get_option( 'socials' )['linkedin'] ?? '',
			)
		);

		add_settings_field(
			'pinterest',
			__( 'Pinterest', 'mono' ),
			array( $this, 'text_callback_function' ),
			'socials',
			'settings_section_socials',
			array(
				'type'        => 'url',
				'name'        => 'socials[pinterest]',
				'placeholder' => 'https://www.pinterest.com/artvandelay',
				'description' => __( 'Enter the Pinterest URL here.', 'mono' ),
				'value'       => get_option( 'socials' )['pinterest'] ?? '',
			)
		);

		add_settings_field(
			'youtube',
			__( 'YouTube', 'mono' ),
			array( $this, 'text_callback_function' ),
			'socials',
			'settings_section_socials',
			array(
				'type'        => 'url',
				'name'        => 'socials[youtube]',
				'placeholder' => 'https://www.youtube.com/artvandelay',
				'description' => __( 'Enter the YouTube URL here.', 'mono' ),
				'value'       => get_option( 'socials' )['youtube'] ?? '',
			)
		);

		add_settings_field(
			'public_email',
			__( 'Public Email Address', 'mono' ),
			array( $this, 'email_callback_function' ),
			'theme',
			'settings_section_theme',
			array(
				'name'        => 'theme[public_email]',
				'label'       => __( 'Email', 'mono' ),
				'description' => __( 'This email address is used for public purposes.', 'mono' ),
				'placeholder' => 'artvandelay@vandelayindustries.com',
				'value'       => get_option( 'theme' )['public_email'] ?? '',
			)
		);

		add_settings_field(
			'phone_number',
			__( 'Phone Number', 'mono' ),
			array( $this, 'text_callback_function' ),
			'theme',
			'settings_section_theme',
			array(
				'name'        => 'theme[phone_number]',
				'label'       => __( 'Phone Number', 'mono' ),
				'placeholder' => '0192837465',
				'value'       => get_option( 'theme' )['phone_number'] ?? '',
			)
		);

		add_settings_field(
			'page_for_contact',
			__( 'Contact Page', 'mono' ),
			array( $this, 'dropdown_pages_callback_function' ),
			'theme',
			'settings_section_theme',
			array(
				'value' => get_option( 'theme' )['page_for_contact_'] ?? '',
				'name'  => 'theme[page_for_contact]',
			)
		);

		add_settings_field(
			'address',
			__( 'Address', 'mono' ),
			array( $this, 'textarea_callback_function' ),
			'theme',
			'settings_section_theme',
			array(
				'id'          => 'address',
				'name'        => 'theme[address]',
				'rows'        => 4,
				'value'       => get_option( 'theme' )['address'] ?? '',
				'description' => __( 'This address is used for public purposes.', 'mono' ),
				'placeholder' => __( 'Address', 'mono' ),
			)
		);

		add_settings_field(
			'authorname',
			__( 'Author Name', 'mono' ),
			array( $this, 'text_callback_function' ),
			'theme',
			'settings_section_theme',
			array(
				'id'          => 'authorname',
				'name'        => 'theme[authorname]',
				'value'       => get_option( 'theme' )['authorname'] ?? '',
				'placeholder' => __( 'Author Name', 'mono' ),
			)
		);

		add_settings_field(
			'authordescription',
			__( 'Author Description', 'mono' ),
			array( $this, 'textarea_callback_function' ),
			'theme',
			'settings_section_theme',
			array(
				'id'          => 'authordescription',
				'name'        => 'theme[authordescription]',
				'rows'        => 4,
				'value'       => get_option( 'theme' )['authordescription'] ?? '',
				'placeholder' => __( 'Author Description', 'mono' ),
			)
		);

		add_settings_field(
			'authorcareer',
			__( 'Author Career', 'mono' ),
			array( $this, 'textarea_callback_function' ),
			'theme',
			'settings_section_theme',
			array(
				'id'          => 'authorcareer',
				'name'        => 'theme[authorcareer]',
				'rows'        => 4,
				'value'       => get_option( 'theme' )['authorcareer'] ?? '',
				'placeholder' => __( 'Author Career', 'mono' ),
			)
		);

		add_settings_field(
			'authorimage',
			__( 'Author Image', 'mono' ),
			array( $this, 'uploader_callback_function' ),
			'theme',
			'settings_section_theme',
			array(
				'id'          => 'authorimage',
				'name'        => 'theme[authorimage]',
				'value'       => get_option( 'theme' )['authorimage'] ?? '',
				'placeholder' => __( 'Author Image', 'mono' ),
			)
		);
	}


	/**
	 * Textarea callback function
	 *
	 * @param array $args Arguments.
	 *
	 * @see https://core.trac.wordpress.org/browser/tags/5.6/src/wp-includes/post-template.php#L1163
	 * @return void
	 */
	public function uploader_callback_function( array $args ): void {
		$img_id  = get_option( 'theme' )['authorimage'] ?? 0;
		$img_src = wp_get_attachment_image_src( $img_id, 'full' );

		?>
		<input
			type="hidden" placeholder="<?php echo esc_attr( $args['placeholder'] ); ?>"
			name="<?php echo esc_attr( $args['name'] ); ?>"
			id="<?php echo esc_attr( $args['name'] ); ?>"
			value="<?php echo esc_attr( $img_id ); ?>"
		>
		<div class="custom-img-container">
		<?php if ( $img_src ) : ?>
			<img src="<?php echo $img_src[0]; ?>" alt="" style="max-width:100%;" />
		<?php endif; ?>
		</div>
		<a class="button" onclick="upload_image('<?php echo $args['name']; ?>');"><?php _e( 'Upload Image', 'mono' ); ?></a>
		<?php
	}


	public function uploader_script() {
		wp_enqueue_media();

		?>
		<script>

		function upload_image(id) {
			console.log(id);

			//Extend the wp.media object
			const frame = wp.media.frames.file_frame = wp.media({
				title: '<?php _e( 'Choose Image', 'mono' ); ?>',
				button: {
					text: '<?php _e( 'Choose Image', 'mono' ); ?>'
				},
				multiple: false
			});

			// When a file is selected, grab the URL and set it as the text field's value
			frame.on('select', function() {
				// Get media attachment details from the frame state
				const attachment = frame.state().get('selection').first().toJSON();
				const url = attachment['url'];
				console.log(document.getElementById(id));
				document.getElementById(id).value = attachment['id'];
			});

			// Open the uploader dialog
			frame.open();
		}
		</script>
		<?php
	}


	/**
	 * Contacts callback function
	 *
	 * @return void
	 */
	public function section_callback_function(): void {
		echo '';
	}

	/**
	 * Dropdown pages callback function
	 *
	 * @param array $args Arguments.
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_dropdown_pages/
	 *
	 * @return void
	 */
	public function dropdown_pages_callback_function( array $args ): void {
		wp_dropdown_pages(
			array(
				'selected' => $args['value'],
				'name'     => $args['name'],
			)
		);

		if ( isset( $args['description'] ) && ! empty( $args['description'] ) ) {
			echo wp_kses_post( '<p class="description">' . $args['description'] . '</p>' );
		}
	}

	/**
	 * Text callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function text_callback_function( array $args ): void {
		wp_form_controls_input(
			array(
				'type'        => $args['type'] ?? 'text',
				'name'        => $args['name'],
				'value'       => $args['value'],
				'placeholder' => $args['placeholder'] ?? '',
				'description' => $args['description'] ?? '',
			),
		);
	}

	/**
	 * Email callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function email_callback_function( $args ): void {
		wp_form_controls_input(
			array(
				'type'        => 'email',
				'name'        => $args['name'],
				'value'       => $args['value'] ?? '',
				'placeholder' => $args['placeholder'],
				'description' => $args['description'],
				'attributes'  => array(
					'pattern'      => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
					'autocomplete' => 'email',
					'aria-label'   => $args['label'],
				),
			)
		);
	}

	/**
	 * URL callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function url_callback_function( $args ): void {
		wp_form_controls_input(
			array(
				'type'        => 'url',
				'name'        => $args['name'],
				'value'       => get_option( $args['name'] ),
				'placeholder' => $args['placeholder'],
				'description' => $args['description'],
			)
		);
	}

	/**
	 * Textarea callback function
	 *
	 * @param array $args Arguments.
	 *
	 * @see https://core.trac.wordpress.org/browser/tags/5.6/src/wp-includes/post-template.php#L1163
	 * @return void
	 */
	public function textarea_callback_function( array $args ): void {
		wp_form_controls_textarea( $args );
	}

	/**
	 * Register settings
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_setting/
	 *
	 * @return void
	 */
	public function register_settings(): void {
		register_setting( 'socials', 'socials', array( $this, 'sanitize' ) );
		register_setting( 'theme', 'theme', array( $this, 'sanitize' ) );
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ) {
		$new_input = array();

		foreach ( array( 'authorname', 'authorimage', 'phone_number', 'public_email', 'linkedin', 'facebook', 'instagram', 'youtube', 'pinterest' ) as $setting ) {
			if ( isset( $input[ $setting ] ) ) {
				$new_input[ $setting ] = sanitize_text_field( $input[ $setting ] );
			}
		}

		foreach ( array( 'page_for_contact' ) as $setting ) {
			if ( isset( $input[ $setting ] ) ) {
				$new_input[ $setting ] = sanitize_text_field( $input[ $setting ] );
			}
		}

		foreach ( array( 'address', 'authordescription', 'authorcareer' ) as $setting ) {
			if ( isset( $input[ $setting ] ) ) {
				$new_input[ $setting ] = sanitize_textarea_field( $input[ $setting ] );
			}
		}

		return $new_input;
	}
}
