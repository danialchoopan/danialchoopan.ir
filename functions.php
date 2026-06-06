<?php
/**
 * DevPortfolio Pro functions and definitions - High Performance Edition
 *
 * @package DevPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function devportfolio_setup() {
	load_theme_textdomain( 'devportfolio', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'devportfolio' ),
			'footer'  => esc_html__( 'Footer Menu', 'devportfolio' ),
		)
	);

	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
}
add_action( 'after_setup_theme', 'devportfolio_setup' );

/**
 * Enqueue scripts and styles.
 */
function devportfolio_scripts() {
	wp_enqueue_style( 'devportfolio-fonts', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;400;700;900&display=swap', array(), null );

	// Tailwind CSS via CDN with Typography plugin for zero-config production-ready setup.
	wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com?plugins=typography', array(), null, false );

	wp_enqueue_style( 'devportfolio-style', get_stylesheet_uri(), array(), '1.2.0' );

	// Custom Tailwind Config - Premium Dark Mode Aesthetic.
	wp_add_inline_script( 'tailwind-cdn', "
		tailwind.config = {
			darkMode: 'class',
			theme: {
				extend: {
					colors: {
						primary: {
							DEFAULT: '#6366f1',
							light: '#818cf8',
							dark: '#4f46e5',
						},
						accent: {
							DEFAULT: '#10b981',
							light: '#34d399',
							dark: '#059669',
						},
						zinc: {
							950: '#09090b',
						}
					},
					fontFamily: {
						vazir: ['Vazirmatn', 'sans-serif'],
					},
				},
			},
		}
	" );
}
add_action( 'wp_enqueue_scripts', 'devportfolio_scripts' );

/**
 * Register Portfolio Custom Post Type.
 */
function devportfolio_register_portfolio_cpt() {
	$labels = array(
		'name'               => _x( 'Portfolios', 'post type general name', 'devportfolio' ),
		'singular_name'      => _x( 'Portfolio', 'post type singular name', 'devportfolio' ),
		'menu_name'          => _x( 'Portfolios', 'admin menu', 'devportfolio' ),
		'add_new_item'       => __( 'Add New Portfolio', 'devportfolio' ),
		'all_items'          => __( 'All Portfolios', 'devportfolio' ),
		'search_items'       => __( 'Search Portfolios', 'devportfolio' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'portfolio', $args );

	register_taxonomy( 'portfolio_category', array( 'portfolio' ), array(
		'hierarchical'      => true,
		'label'             => __( 'Categories', 'devportfolio' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfolio-category' ),
		'show_in_rest'      => true,
	) );
}
add_action( 'init', 'devportfolio_register_portfolio_cpt' );

/**
 * Inline SVG Helper for High Performance.
 */
function devportfolio_get_svg( $icon ) {
	$icons = array(
		'github'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>',
		'linkedin' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
		'terminal' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><polyline points="4 17 10 11 4 5"></polyline><line x1="12" y1="19" x2="20" y2="19"></line></svg>',
		'external' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>',
		'arrow-right' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
		'calendar' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>',
		'clock' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
		'code' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>',
		'cubes' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>',
	);
	return isset( $icons[ $icon ] ) ? $icons[ $icon ] : '';
}

/**
 * Programmatic Seed Data - Minimalist Edition.
 */
function devportfolio_seed_data() {
	if ( get_option( 'devportfolio_data_seeded_v3' ) ) {
		return;
	}

	$cats = array( 'Architecture', 'Infrastructure', 'Backend' );
	$term_ids = array();
	foreach ( $cats as $cat ) {
		$term = wp_insert_term( $cat, 'portfolio_category' );
		if ( ! is_wp_error( $term ) ) $term_ids[ $cat ] = $term['term_id'];
	}

	// Portfolios.
	$items = array(
		array( 'title' => 'High-Concurrency Pipeline', 'cat' => 'Infrastructure' ),
		array( 'title' => 'Distributed Auth Service', 'cat' => 'Architecture' ),
		array( 'title' => 'Real-time Analytics Engine', 'cat' => 'Backend' ),
	);

	foreach ( $items as $i ) {
		$id = wp_insert_post( array(
			'post_title'   => $i['title'],
			'post_content' => 'High-performance engineering solution details.',
			'post_status'  => 'publish',
			'post_type'    => 'portfolio',
		) );
		if ( $id && isset( $term_ids[ $i['cat'] ] ) ) {
			wp_set_object_terms( $id, $term_ids[ $i['cat'] ], 'portfolio_category' );
			update_post_meta( $id, 'tech_stack', 'Go, Docker, Kubernetes' );
		}
	}

	// Blog Posts.
	for ( $x = 1; $x <= 2; $x++ ) {
		wp_insert_post( array(
			'post_title'   => "Technical Log #$x: Engineering Optimization",
			'post_content' => "Deep dive into performance patterns... <pre><code>// benchmark code here</code></pre>",
			'post_status'  => 'publish',
		) );
	}

	update_option( 'devportfolio_data_seeded_v3', true );
}
add_action( 'after_switch_theme', 'devportfolio_seed_data' );

/**
 * Reading time estimation.
 */
function devportfolio_reading_time( $content ) {
	return ceil( str_word_count( strip_tags( $content ) ) / 200 );
}

/**
 * Social Links.
 */
function devportfolio_get_social_links() {
	return array(
		'github'   => 'https://github.com/danialchoopan',
		'linkedin' => 'https://linkedin.com/in/danialchoopan',
	);
}
