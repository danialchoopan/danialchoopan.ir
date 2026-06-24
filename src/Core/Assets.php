<?php
namespace DevPortfolio\Core;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Handles asset enqueuing.
 */
class Assets {
	private static $instance = null;

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	public function enqueue_assets() {
		wp_enqueue_style( 'devportfolio-main', get_template_directory_uri() . '/assets/css/main.css', [], '2.0.0' );

        // Prism.js for code highlighting
        wp_enqueue_style( 'prism-tomorrow', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css', [], '1.29.0' );
		wp_enqueue_script( 'prism-core', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js', [], '1.29.0', true );
		wp_enqueue_script( 'prism-autoloader', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js', ['prism-core'], '1.29.0', true );

        // Custom JS
        wp_enqueue_script( 'devportfolio-main-js', get_template_directory_uri() . '/assets/js/main.js', [], '2.0.0', true );
	}
}
