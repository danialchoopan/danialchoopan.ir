<?php
/**
 * DevPortfolio Pro functions and definitions
 *
 * @package DevPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Portfolio Custom Post Type.
 */
function devportfolio_register_portfolio_cpt() {
	$labels = array(
		'name'               => _x( 'Portfolios', 'post type general name', 'devportfolio' ),
		'singular_name'      => _x( 'Portfolio', 'post type singular name', 'devportfolio' ),
		'menu_name'          => _x( 'Portfolios', 'admin menu', 'devportfolio' ),
		'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'devportfolio' ),
		'add_new'            => _x( 'Add New', 'portfolio', 'devportfolio' ),
		'add_new_item'       => __( 'Add New Portfolio', 'devportfolio' ),
		'new_item'           => __( 'New Portfolio', 'devportfolio' ),
		'edit_item'          => __( 'Edit Portfolio', 'devportfolio' ),
		'view_item'          => __( 'View Portfolio', 'devportfolio' ),
		'all_items'          => __( 'All Portfolios', 'devportfolio' ),
		'search_items'       => __( 'Search Portfolios', 'devportfolio' ),
		'not_found'          => __( 'No portfolios found.', 'devportfolio' ),
		'not_found_in_trash' => __( 'No portfolios found in Trash.', 'devportfolio' ),
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

	// Register Portfolio Category Taxonomy.
	$cat_labels = array(
		'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'devportfolio' ),
		'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'devportfolio' ),
		'search_items'      => __( 'Search Categories', 'devportfolio' ),
		'all_items'         => __( 'All Categories', 'devportfolio' ),
		'parent_item'       => __( 'Parent Category', 'devportfolio' ),
		'parent_item_colon' => __( 'Parent Category:', 'devportfolio' ),
		'edit_item'         => __( 'Edit Category', 'devportfolio' ),
		'update_item'       => __( 'Update Category', 'devportfolio' ),
		'add_new_item'      => __( 'Add New Category', 'devportfolio' ),
		'new_item_name'     => __( 'New Category Name', 'devportfolio' ),
		'menu_name'         => __( 'Categories', 'devportfolio' ),
	);

	$cat_args = array(
		'hierarchical'      => true,
		'labels'            => $cat_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfolio-category' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'portfolio_category', array( 'portfolio' ), $cat_args );
}
add_action( 'init', 'devportfolio_register_portfolio_cpt' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function devportfolio_setup() {
	load_theme_textdomain( 'devportfolio', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'devportfolio' ),
			'footer'  => esc_html__( 'Footer Menu', 'devportfolio' ),
		)
	);

	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
}
add_action( 'after_setup_theme', 'devportfolio_setup' );

/**
 * Enqueue scripts and styles.
 */
function devportfolio_scripts() {
	wp_enqueue_style( 'devportfolio-fonts', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;400;700;900&display=swap', array(), null );
	wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com?plugins=typography', array(), null, false );
	wp_enqueue_style( 'devportfolio-style', get_stylesheet_uri(), array(), '1.3.0' );

	wp_add_inline_script( 'tailwind-cdn', "
		tailwind.config = {
			darkMode: 'class',
			theme: {
				extend: {
					colors: {
						primary: { DEFAULT: '#6366f1', light: '#818cf8', dark: '#4f46e5' },
						accent: { DEFAULT: '#10b981', light: '#34d399', dark: '#059669' },
						zinc: { 950: '#09090b' }
					},
					fontFamily: { vazir: ['Vazirmatn', 'sans-serif'] },
				},
			},
		}
	" );
}
add_action( 'wp_enqueue_scripts', 'devportfolio_scripts' );

/**
 * Estimate reading time in minutes.
 */
function devportfolio_reading_time( $content ) {
	$word_count = str_word_count( strip_tags( $content ) );
	return ceil( $word_count / 200 );
}

/**
 * WP Customizer API implementation.
 */
function devportfolio_customize_register( $wp_customize ) {
	// Header Section.
	$wp_customize->add_section( 'devportfolio_header', array( 'title' => __( 'Header Settings', 'devportfolio' ), 'priority' => 30 ) );
	$wp_customize->add_setting( 'header_logo_text', array( 'default' => 'DP', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'header_logo_text', array( 'label' => __( 'Logo Initials', 'devportfolio' ), 'section' => 'devportfolio_header', 'type' => 'text' ) );
	$wp_customize->add_setting( 'header_bg_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_bg_image', array( 'label' => __( 'Header Banner', 'devportfolio' ), 'section' => 'devportfolio_header' ) ) );

	// Hero Section.
	$wp_customize->add_section( 'devportfolio_hero', array( 'title' => __( 'Hero Section', 'devportfolio' ), 'priority' => 40 ) );
	$wp_customize->add_setting( 'hero_title', array( 'default' => 'Building Resilience through Code.', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'hero_title', array( 'label' => __( 'Hero Title', 'devportfolio' ), 'section' => 'devportfolio_hero', 'type' => 'text' ) );
	$wp_customize->add_setting( 'hero_bio', array( 'default' => 'Focused on distributed systems and engineering excellence.', 'sanitize_callback' => 'sanitize_textarea_field' ) );
	$wp_customize->add_control( 'hero_bio', array( 'label' => __( 'Hero Bio', 'devportfolio' ), 'section' => 'devportfolio_hero', 'type' => 'textarea' ) );
	$wp_customize->add_setting( 'hero_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_image', array( 'label' => __( 'Profile Image', 'devportfolio' ), 'section' => 'devportfolio_hero' ) ) );

	// Portfolio/Blog.
	$wp_customize->add_section( 'devportfolio_layout', array( 'title' => __( 'Layout Settings', 'devportfolio' ), 'priority' => 50 ) );
	$wp_customize->add_setting( 'portfolio_cols', array( 'default' => '3', 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'portfolio_cols', array( 'label' => __( 'Portfolio Grid Columns', 'devportfolio' ), 'section' => 'devportfolio_layout', 'type' => 'number' ) );

	// Footer.
	$wp_customize->add_section( 'devportfolio_footer', array( 'title' => __( 'Footer Settings', 'devportfolio' ), 'priority' => 60 ) );
	$wp_customize->add_setting( 'footer_copy', array( 'default' => 'Hand-crafted for performance', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'footer_copy', array( 'label' => __( 'Copyright Text', 'devportfolio' ), 'section' => 'devportfolio_footer', 'type' => 'text' ) );
	$wp_customize->add_setting( 'github_url', array( 'default' => 'https://github.com/danialchoopan', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'github_url', array( 'label' => __( 'GitHub URL', 'devportfolio' ), 'section' => 'devportfolio_footer', 'type' => 'url' ) );
	$wp_customize->add_setting( 'linkedin_url', array( 'default' => 'https://linkedin.com/in/danialchoopan', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'linkedin_url', array( 'label' => __( 'LinkedIn URL', 'devportfolio' ), 'section' => 'devportfolio_footer', 'type' => 'url' ) );
}
add_action( 'customize_register', 'devportfolio_customize_register' );

/**
 * Programmatic Seed Data.
 */
function devportfolio_seed_data() {
	if ( get_option( 'devportfolio_seeded_v5' ) ) return;

	$cats = array( 'Systems', 'DevOps', 'Frontend' );
	foreach ( $cats as $c ) wp_insert_term( $c, 'portfolio_category' );

	for ( $i = 1; $i <= 3; $i++ ) {
		$id = wp_insert_post( array( 'post_title' => "Project Alpha $i", 'post_content' => 'High-end engineering project details.', 'post_status' => 'publish', 'post_type' => 'portfolio' ) );
		if ( $id ) update_post_meta( $id, 'tech_stack', 'Go, Docker, AWS' );
	}

	for ( $i = 1; $i <= 2; $i++ ) {
		wp_insert_post( array( 'post_title' => "Technical Deep Dive #$i", 'post_content' => 'Advanced patterns in scalable systems... <pre><code>const x = 1;</code></pre>', 'post_status' => 'publish' ) );
	}

	update_option( 'devportfolio_seeded_v5', true );
}
add_action( 'after_switch_theme', 'devportfolio_seed_data' );
