<?php
/**
 * Setup.php — Registers theme support, menus, and initial data.
 *
 * Runs on the 'after_setup_theme' hook to configure:
 *   - Theme support features (thumbnails, title-tag, HTML5, etc.)
 *   - Navigation menu locations
 *   - Text domain for translations
 *   - Auto-creates a Home page on first activation
 *
 * @package DanialPortfolio
 * @subpackage Core
 */

namespace DevPortfolio\Core;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class Setup {
	private static $instance = null;

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'after_setup_theme', [ $this, 'theme_setup' ] );
		add_action( 'after_switch_theme', [ $this, 'seed_data' ] );
	}

	/**
	 * Register core WordPress theme features.
	 */
	public function theme_setup() {
		// Load translations from /languages directory
		load_theme_textdomain( 'devportfolio', get_template_directory() . '/languages' );

		// Core theme supports
		add_theme_support( 'automatic-feed-links' );  // RSS/Atom in <head>
		add_theme_support( 'title-tag' );              // Let WP manage <title>
		add_theme_support( 'post-thumbnails' );        // Featured images
		add_theme_support( 'custom-logo' );            // Custom logo upload
		add_theme_support( 'html5', [                  // Modern HTML5 markup
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		] );

		// Register navigation menu locations
		register_nav_menus( [
			'primary' => __( 'Primary Menu', 'devportfolio' ),
			'footer'  => __( 'Footer Menu', 'devportfolio' ),
		] );
	}

	/**
	 * Seed initial data when the theme is first activated.
	 *
	 * Creates a blank "Home" page and sets it as the static front page.
	 * Only runs once (tracked via 'devportfolio_seeded' option).
	 */
	public function seed_data() {
		if ( get_option( 'devportfolio_seeded' ) ) {
			return;
		}

		// Create Home page
		$home_id = wp_insert_post( [
			'post_title'   => 'Home',
			'post_content' => '',
			'post_status'  => 'publish',
			'post_type'    => 'page',
		] );

		if ( $home_id ) {
			update_option( 'page_on_front', $home_id );
			update_option( 'show_on_front', 'page' );
		}

		// Create About page (use meta_input for page template — page_template key is not valid)
		$about_id = wp_insert_post( [
			'post_title'   => 'About',
			'post_content' => '',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'meta_input'   => [ '_wp_page_template' => 'page-about.php' ],
		] );

		// Create Contact page
		$contact_id = wp_insert_post( [
			'post_title'   => 'Contact',
			'post_content' => '',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'meta_input'   => [ '_wp_page_template' => 'page-contact.php' ],
		] );

		update_option( 'devportfolio_seeded', 1 );
	}
}
