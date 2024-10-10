<?php // phpcs:ignore
/**
 * Bootstraps WordPress theme related functions, most importantly enqueuing javascript and styles.
 *
 * @package WordPress
 * @subpackage Mono
 */

namespace Mono;

/**
 * Init
 */
class Init {

	/**
	 * Store all the classes inside an array
	 *
	 * @return array Full list of classes
	 */
	public static function get_services(): array {
		return array(
			Theme::class,
			Admin\Init::class,
			Admin\Menu::class,
			Setup\Enqueue::class,
			Setup\Context::class,
			WPSettings::class,
			Setup\QueryVars::class,
			Setup\Textdomain::class,
			Setup\Twig::class,
			Post\CaseStudy::class,
			PostTemplate\BodyClass::class,
			Taxonomy\CaseStudyCat::class,
			Template\PostStates::class,
			Plugins\ACF\IncludeFields\CaseStudyPostFields::class,
			Plugins\ACF\IncludeFields\FrontPageFields::class,
			Plugins\ACF\IncludeFields\ThemeFields::class,
			Plugins\ACF\Input\AdminEnqueueScripts::class,
			Plugins\ACF\Init::class,
			Vite::class,
			WPImageEditor::class,
			Menu::class,
		);
	}


	/**
	 * Loop through the classes, initialize them, and call the run() method if it exists
	 *
	 * @return void
	 */
	public static function run_services(): void {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );

			if ( method_exists( $service, 'run' ) ) {
				$service->run();
			}
		}
	}


	/**
	 * Initialize the class
	 *
	 * @param  string $class class name from the services array.
	 * @return object
	 */
	private static function instantiate( string $class ): object {
		return new $class();
	}
}
