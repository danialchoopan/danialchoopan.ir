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
		'all_items'          => __( 'All Portfolios', 'devportfolio' ),
		'add_new_item'       => __( 'Add New Portfolio', 'devportfolio' ),
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
 * Functional Language Switcher Logic.
 */
function devportfolio_locale( $locale ) {
	if ( isset( $_GET['lang'] ) ) {
		if ( 'fa' === $_GET['lang'] ) {
			return 'fa_IR';
		} elseif ( 'en' === $_GET['lang'] ) {
			return 'en_US';
		}
	}
	return $locale;
}
add_filter( 'locale', 'devportfolio_locale' );

/**
 * Sets up theme defaults.
 */
function devportfolio_setup() {
	load_theme_textdomain( 'devportfolio', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );

	register_nav_menus( array( 'primary' => __( 'Primary Menu', 'devportfolio' ), 'footer' => __( 'Footer Menu', 'devportfolio' ) ) );
}
add_action( 'after_setup_theme', 'devportfolio_setup' );

/**
 * Enqueue scripts and styles.
 */
function devportfolio_scripts() {
	wp_enqueue_style( 'devportfolio-fonts', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;400;700;900&display=swap', array(), null );
	wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com?plugins=typography', array(), null, false );
	wp_enqueue_style( 'devportfolio-style', get_stylesheet_uri(), array(), '1.5.0' );

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
 * Reading time estimation.
 */
function devportfolio_reading_time( $content ) {
	return ceil( str_word_count( strip_tags( $content ) ) / 200 );
}

/**
 * WP Customizer implementation.
 */
function devportfolio_customize_register( $wp_customize ) {
	// 1. Hero Section Background & Opacity.
	$wp_customize->add_section( 'devportfolio_hero', array( 'title' => __( 'Hero Section', 'devportfolio' ), 'priority' => 30 ) );

	$wp_customize->add_setting( 'hero_title', array( 'default' => 'Building Resilience through Code.', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'hero_title', array( 'label' => __( 'Hero Title', 'devportfolio' ), 'section' => 'devportfolio_hero' ) );

	$wp_customize->add_setting( 'hero_bio', array( 'default' => 'Focused on high-performance distributed systems and engineering excellence.', 'sanitize_callback' => 'sanitize_textarea_field' ) );
	$wp_customize->add_control( 'hero_bio', array( 'label' => __( 'Hero Bio', 'devportfolio' ), 'section' => 'devportfolio_hero', 'type' => 'textarea' ) );

	$wp_customize->add_setting( 'hero_cta_primary_text', array( 'default' => 'Analyze Work', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'hero_cta_primary_text', array( 'label' => __( 'Primary CTA Text', 'devportfolio' ), 'section' => 'devportfolio_hero' ) );
	$wp_customize->add_setting( 'hero_cta_primary_url', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'hero_cta_primary_url', array( 'label' => __( 'Primary CTA URL', 'devportfolio' ), 'section' => 'devportfolio_hero' ) );

	$wp_customize->add_setting( 'hero_cta_secondary_text', array( 'default' => 'Technical Blog', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'hero_cta_secondary_text', array( 'label' => __( 'Secondary CTA Text', 'devportfolio' ), 'section' => 'devportfolio_hero' ) );
	$wp_customize->add_setting( 'hero_cta_secondary_url', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'hero_cta_secondary_url', array( 'label' => __( 'Secondary CTA URL', 'devportfolio' ), 'section' => 'devportfolio_hero' ) );

	$wp_customize->add_setting( 'hero_bg_img', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_bg_img', array( 'label' => __( 'Background Image', 'devportfolio' ), 'section' => 'devportfolio_hero' ) ) );
	$wp_customize->add_setting( 'hero_bg_opacity', array( 'default' => '20', 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'hero_bg_opacity', array( 'label' => __( 'Background Opacity (%)', 'devportfolio' ), 'section' => 'devportfolio_hero', 'type' => 'range', 'input_attrs' => array( 'min' => 0, 'max' => 100 ) ) );

	// Social Icons Section
	$wp_customize->add_section( 'devportfolio_social', array( 'title' => __( 'Social Links', 'devportfolio' ), 'priority' => 35 ) );
	$wp_customize->add_setting( 'github_url', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'github_url', array( 'label' => __( 'GitHub URL', 'devportfolio' ), 'section' => 'devportfolio_social' ) );
	$wp_customize->add_setting( 'linkedin_url', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'linkedin_url', array( 'label' => __( 'LinkedIn URL', 'devportfolio' ), 'section' => 'devportfolio_social' ) );

	// 2. Homepage Section Reordering (Sortable Blocks).
	$wp_customize->add_section( 'devportfolio_homepage', array( 'title' => __( 'Homepage Layout', 'devportfolio' ), 'priority' => 40 ) );
	$wp_customize->add_setting( 'homepage_order', array( 'default' => 'hero,tech,portfolio,blog', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'homepage_order', array( 'label' => __( 'Section Order (comma-separated: hero,tech,portfolio,blog)', 'devportfolio' ), 'section' => 'devportfolio_homepage' ) );

	// 3. Tech Stack Cards.
	for ( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_section( "tech_card_$i", array( 'title' => sprintf( __( 'Tech Card %d', 'devportfolio' ), $i ), 'priority' => 50 + $i ) );
		$wp_customize->add_setting( "tech_card_title_$i", array( 'default' => "Card $i", 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( "tech_card_title_$i", array( 'label' => __( 'Title', 'devportfolio' ), 'section' => "tech_card_$i" ) );
		$wp_customize->add_setting( "tech_card_tags_$i", array( 'default' => 'PHP, Go, Node.js', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( "tech_card_tags_$i", array( 'label' => __( 'Tags (comma separated)', 'devportfolio' ), 'section' => "tech_card_$i" ) );
		$wp_customize->add_setting( "tech_card_img_$i", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "tech_card_img_$i", array( 'label' => __( 'Background Image', 'devportfolio' ), 'section' => "tech_card_$i" ) ) );
	}
}
add_action( 'customize_register', 'devportfolio_customize_register' );

/**
 * Programmatic Seeding with Unsplash Images.
 */
function devportfolio_seed_data() {
	if ( get_option( 'devportfolio_seeded_v9' ) ) return;

	// 1. Create Home and Blog Pages
	$home_page = get_page_by_path('home');
	if (!$home_page) {
		$home_id = wp_insert_post(array(
			'post_title'   => 'Home',
			'post_content' => '',
			'post_status'  => 'publish',
			'post_type'    => 'page',
		));
		update_option('page_on_front', $home_id);
		update_option('show_on_front', 'page');
	}

	$blog_page = get_page_by_path('blog');
	if (!$blog_page) {
		$blog_id = wp_insert_post(array(
			'post_title'   => 'Blog',
			'post_content' => '',
			'post_status'  => 'publish',
			'post_type'    => 'page',
		));
		update_option('page_for_posts', $blog_id);
	}

	$unsplash_images = array(
		'https://images.unsplash.com/photo-1555066931-4365d14bab8c', // Code
		'https://images.unsplash.com/photo-1498050108023-c5249f4df085', // Laptop
		'https://images.unsplash.com/photo-1461749280684-dccba630e2f6'  // Screen
	);

	foreach ( array( 'Infrastructure', 'Architecture' ) as $c ) wp_insert_term( $c, 'portfolio_category' );

	for ( $i = 0; $i < 3; $i++ ) {
		$id = wp_insert_post( array( 'post_title' => "Project " . ($i+1), 'post_content' => 'A deep dive into system architecture and performance optimization.', 'post_excerpt' => 'Scalable microservices architecture designed for high throughput and low latency.', 'post_status' => 'publish', 'post_type' => 'portfolio' ) );
		if ( $id ) {
			update_post_meta( $id, 'tech_stack', 'Go, AWS, Docker' );
			update_post_meta( $id, 'github_url', 'https://github.com' );
			// Meta key added for external thumbnail support (requires a plugin usually, but we use it as placeholder)
			update_post_meta( $id, '_thumbnail_ext_url', $unsplash_images[$i] );
		}
	}

	// 3. Create Sample Blog Posts
	for ( $i = 0; $i < 2; $i++ ) {
		wp_insert_post( array(
			'post_title'   => "Technical Log: " . ( $i === 0 ? 'Scaling Distributed Systems' : 'Architecting for Resilience' ),
			'post_content' => 'Detailed technical content about engineering excellence and modern architecture patterns.',
			'post_excerpt' => 'An in-depth retrospective on scaling infrastructure and ensuring system reliability under load.',
			'post_status'  => 'publish',
			'post_type'    => 'post'
		) );
	}

	update_option( 'devportfolio_seeded_v9', true );
}
add_action( 'after_switch_theme', 'devportfolio_seed_data' );
