<?php
/**
 * I18n.php — Farsi-only locale + RTL support.
 *
 * @package DanialPortfolio
 * @subpackage Core
 */

namespace DevPortfolio\Core;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class I18n {
	private static $instance = null;

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_filter( 'locale', [ $this, 'handle_locale' ] );
		add_filter( 'body_class', [ $this, 'add_body_classes' ] );
	}

	/**
	 * Force Farsi locale. Check for ?lang=en override for preview.
	 */
	public function handle_locale( $locale ) {
		if ( isset( $_GET['lang'] ) && sanitize_text_field( wp_unslash( $_GET['lang'] ) ) === 'en' ) {
			return 'en_US';
		}
		return 'fa_IR';
	}

	/**
	 * Add body classes: RTL, feature flags.
	 */
	public function add_body_classes( $classes ) {
		$locale = get_locale();
		$classes[] = ( $locale === 'fa_IR' ) ? 'rtl' : 'ltr';

		$classes[] = 'bg-surface text-white selection:bg-primary selection:text-surface';

		if ( get_theme_mod( 'enable_preloader', true ) ) {
			$classes[] = 'preloader-enabled';
		}
		if ( get_theme_mod( 'enable_scroll_reveal', true ) ) {
			$classes[] = 'scroll-reveal-enabled';
		}

		return $classes;
	}
}
