<?php
namespace DevPortfolio\Core;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Basic PSR-4-like autoloader for the theme.
 */
class Autoloader {
	public static function register() {
		spl_autoload_register( [ __CLASS__, 'autoload' ] );
	}

	public static function autoload( $class ) {
		if ( strpos( $class, 'DevPortfolio\\' ) !== 0 ) {
			return;
		}

		$relative_class = substr( $class, 13 );
		$file           = get_template_directory() . '/src/' . str_replace( '\\', '/', $relative_class ) . '.php';

		if ( file_exists( $file ) ) {
			require_once $file;
		}
	}
}
