<?php
/**
 * Assets.php — Enqueues all frontend CSS and JavaScript.
 *
 * Everything is loaded offline: local Vazirmatn font, local CSS,
 * local JS. No external CDNs required.
 *
 * @package DanialPortfolio
 * @subpackage Core
 */

namespace DevPortfolio\Core;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

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
		// Main theme stylesheet (style.css metadata)
		wp_enqueue_style( 'danial-style', get_stylesheet_uri(), [], '3.0.0' );

		// All utilities + custom styles + font-face declarations (offline)
		wp_enqueue_style( 'danial-main', get_template_directory_uri() . '/assets/css/main.css', [], '3.0.0' );

		// Code highlighting (conditional)
		if ( get_theme_mod( 'enable_code_highlight', true ) ) {
			wp_enqueue_style( 'prism-tomorrow', get_template_directory_uri() . '/assets/css/prism-tomorrow.min.css', [], '1.29.0' );
			wp_enqueue_script( 'prism-core', get_template_directory_uri() . '/assets/js/prism.min.js', [], '1.29.0', true );
			wp_enqueue_script( 'prism-autoloader', get_template_directory_uri() . '/assets/js/prism-autoloader.min.js', [ 'prism-core' ], '1.29.0', true );
		}

		// Main JS (offline)
		wp_enqueue_script( 'danial-main-js', get_template_directory_uri() . '/assets/js/main.js', [], '3.0.0', true );

		// Localize settings for JS
		wp_localize_script( 'danial-main-js', 'danialSettings', [
			'ajax_url'         => admin_url( 'admin-ajax.php' ),
			'nonce'            => wp_create_nonce( 'devportfolio_contact_nonce' ),
			'terminal_speed'   => (int) get_theme_mod( 'hero_animation_speed', 180 ),
			'particles_count'  => (int) get_theme_mod( 'hero_particles_count', 20 ),
			'preloader_duration' => (int) get_theme_mod( 'anim_preloader_duration', 1800 ),
			'counter_speed'    => (int) get_theme_mod( 'anim_counter_speed', 25 ),
			'show_particles'   => (bool) get_theme_mod( 'enable_particles', true ),
			'show_glow'        => (bool) get_theme_mod( 'enable_ambient_glow', true ),
			'show_glitch'      => (bool) get_theme_mod( 'enable_glitch_effect', true ),
			'show_scanline'    => (bool) get_theme_mod( 'enable_scanline', true ),
			'contact_success'  => get_theme_mod( 'contact_success_msg', 'پیام شما با موفقیت ارسال شد!' ),
			'contact_error'    => get_theme_mod( 'contact_error_msg', 'خطایی رخ داده. لطفاً دوباره تلاش کنید.' ),
			'contact_sending'  => get_theme_mod( 'contact_sending_msg', 'در حال ارسال...' ),
		] );
	}
}
