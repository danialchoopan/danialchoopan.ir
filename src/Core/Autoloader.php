<?php
/**
 * Autoloader.php — PSR-4-style class autoloader for the theme.
 *
 * Maps the DevPortfolio\* namespace to the src/ directory.
 * Example: DevPortfolio\Admin\Customizer → src/Admin/Customizer.php
 *
 * @package DanialPortfolio
 * @subpackage Core
 */

namespace DevPortfolio\Core;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class Autoloader {

	/**
	 * Register the autoloader with PHP's SPL autoload stack.
	 */
	public static function register() {
		spl_autoload_register( [ __CLASS__, 'autoload' ] );
	}

	/**
	 * Resolve a class name to its file path and include it.
	 *
	 * @param string $class The fully-qualified class name to autoload.
	 */
	public static function autoload( $class ) {
		// Only handle classes in our namespace
		$prefix = 'DevPortfolio\\';
		if ( strpos( $class, $prefix ) !== 0 ) {
			return;
		}

		// Strip the namespace prefix to get the relative path
		$relative_class = substr( $class, strlen( $prefix ) );
		$file = get_template_directory() . '/src/' . str_replace( '\\', '/', $relative_class ) . '.php';

		if ( file_exists( $file ) ) {
			require_once $file;
		}
	}
}
