<?php
namespace DevPortfolio\Core;

class Setup {
	private static ?Setup $instance = null;
	public static function instance(): Setup {
		if ( self::$instance === null ) { self::$instance = new self(); }
		return self::$instance;
	}
	private function __construct() {
		add_action( 'after_setup_theme', [ $this, 'setup' ] );
	}
	public function setup(): void {
		load_theme_textdomain( 'devportfolio', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo' );
		register_nav_menus( [ 'primary' => __( 'Primary Menu', 'devportfolio' ) ] );
	}
}
