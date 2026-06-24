<?php
namespace DevPortfolio\Core;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Handles Custom Post Types Registration
 */
class PostTypes {
	private static $instance = null;

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'init', [ $this, 'register_cpts' ] );
	}

	public function register_cpts() {
		// Portfolio CPT
		register_post_type( 'portfolio', [
			'labels'             => [
				'name'               => _x( 'Portfolios', 'post type general name', 'devportfolio' ),
				'singular_name'      => _x( 'Portfolio', 'post type singular name', 'devportfolio' ),
				'menu_name'          => _x( 'Portfolios', 'admin menu', 'devportfolio' ),
				'all_items'          => __( 'All Portfolios', 'devportfolio' ),
				'add_new_item'       => __( 'Add New Portfolio', 'devportfolio' ),
				'search_items'       => __( 'Search Portfolios', 'devportfolio' ),
			],
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => [ 'slug' => 'portfolio' ],
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
			'show_in_rest'       => true,
		] );

		register_taxonomy( 'portfolio_category', [ 'portfolio' ], [
			'hierarchical'      => true,
			'label'             => __( 'Categories', 'devportfolio' ),
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'            => [ 'slug' => 'portfolio-category' ],
			'show_in_rest'      => true,
		] );

		// Contact Messages CPT
		register_post_type( 'contact_messages', [
			'labels'             => [
				'name'               => _x( 'Contact Messages', 'post type general name', 'devportfolio' ),
				'singular_name'      => _x( 'Contact Message', 'post type singular name', 'devportfolio' ),
				'menu_name'          => _x( 'Messages', 'admin menu', 'devportfolio' ),
				'all_items'          => __( 'All Messages', 'devportfolio' ),
			],
			'public'             => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'capability_type'    => 'post',
			'map_meta_cap'       => true,
			'supports'           => [ 'title', 'editor' ],
		] );
	}
}
