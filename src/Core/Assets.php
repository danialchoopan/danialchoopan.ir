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
        // Main Theme Style (style.css)
        wp_enqueue_style( 'devportfolio-style', get_stylesheet_uri(), [], '2.1.0' );

        // Tailwind Compiled CSS
		wp_enqueue_style( 'devportfolio-main', get_template_directory_uri() . '/assets/css/main.css', [], '2.1.0' );

        // Prism.js
        wp_enqueue_style( 'prism-tomorrow', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css', [], '1.29.0' );
		wp_enqueue_script( 'prism-core', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js', [], '1.29.0', true );
		wp_enqueue_script( 'prism-autoloader', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js', ['prism-core'], '1.29.0', true );

        // Custom JS (No jQuery dependency for better compatibility)
        wp_enqueue_script( 'devportfolio-main-js', get_template_directory_uri() . '/assets/js/main.js', [], '2.1.0', true );

        wp_localize_script( 'devportfolio-main-js', 'devportfolio_ajax', [
            'url'   => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'devportfolio_contact_nonce' )
        ] );
	}
}
