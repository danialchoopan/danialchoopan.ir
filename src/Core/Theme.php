<?php
namespace DevPortfolio\Core;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Main Theme Class (Singleton)
 */
final class Theme {
	private static $instance = null;

	private function __construct() {
		$this->init();
	}

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function init() {
		// Initialize Core components
		Setup::instance();
		Assets::instance();
		PostTypes::instance();
		I18n::instance();

        // Initialize Integrations
        \DevPortfolio\Integrations\GitHub::instance();

        // Initialize Features
        \DevPortfolio\Features\Rank::instance();
        \DevPortfolio\Features\Challenge::instance();
        \DevPortfolio\Features\Performance::instance();
        \DevPortfolio\Features\SEO::instance();
        \DevPortfolio\Web\Ajax::instance();

        if ( is_admin() ) {
            \DevPortfolio\Admin\Dashboard::instance();
            \DevPortfolio\Admin\Customizer::instance();
        }
	}
}
