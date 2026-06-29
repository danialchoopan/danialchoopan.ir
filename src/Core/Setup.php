<?php
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

	public function theme_setup() {
		load_theme_textdomain( 'devportfolio', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );

		register_nav_menus( [ 'primary' => __( 'Primary Menu', 'devportfolio' ) ] );
	}

	public function seed_data() {
		if ( get_option( 'devportfolio_seeded' ) ) {
			return;
		}

		// Create Home Page
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

		update_option( 'devportfolio_seeded', 1 );
	}
}
