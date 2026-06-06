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
	// Make theme available for translation.
	load_theme_textdomain( 'devportfolio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'devportfolio' ),
			'footer'  => esc_html__( 'Footer Menu', 'devportfolio' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'devportfolio_setup' );

/**
 * Enqueue scripts and styles.
 */
function devportfolio_scripts() {
	// Google Fonts: Vazirmatn.
	wp_enqueue_style( 'devportfolio-fonts', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;400;700;900&display=swap', array(), null );

	// Tailwind CSS via CDN with Typography plugin.
	wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com?plugins=typography', array(), null, false );

	// Theme main stylesheet.
	wp_enqueue_style( 'devportfolio-style', get_stylesheet_uri(), array(), '1.2.0' );

	// Custom Tailwind Config.
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
 * Estimate reading time in minutes.
 */
function devportfolio_reading_time( $content ) {
	$word_count = str_word_count( strip_tags( $content ) );
	$reading_time = ceil( $word_count / 200 );
	return $reading_time;
}

/**
 * Programmatically Seed Data upon theme activation.
 */
function devportfolio_seed_data() {
	if ( get_option( 'devportfolio_seeded_v4' ) ) {
		return;
	}

	// Create Categories.
	$cat_ids = array();
	$categories = array( 'Systems Architecture', 'Infrastructure', 'Engineering' );
	foreach ( $categories as $cat ) {
		$term = wp_insert_term( $cat, 'portfolio_category' );
		if ( ! is_wp_error( $term ) ) {
			$cat_ids[ $cat ] = $term['term_id'];
		}
	}

	// Seed Portfolios.
	$portfolios = array(
		array(
			'title'   => 'Global Edge Gateway',
			'excerpt' => 'A low-latency system handling multi-region traffic routing.',
			'cat'     => 'Infrastructure',
			'tech'    => 'Go, Rust, AWS',
		),
		array(
			'title'   => 'Distributed Ledger DB',
			'excerpt' => 'Architecting an immutable transaction pipeline for high-scale fin-tech.',
			'cat'     => 'Systems Architecture',
			'tech'    => 'Node.js, PostgreSQL, Kubernetes',
		),
	);

	foreach ( $portfolios as $p ) {
		$post_id = wp_insert_post( array(
			'post_title'   => $p['title'],
			'post_content' => 'Deep technical analysis of the solution architecture...',
			'post_excerpt' => $p['excerpt'],
			'post_status'  => 'publish',
			'post_type'    => 'portfolio',
		) );
		if ( $post_id ) {
			update_post_meta( $post_id, 'tech_stack', $p['tech'] );
			if ( isset( $cat_ids[ $p['cat'] ] ) ) {
				wp_set_object_terms( $post_id, $cat_ids[ $p['cat'] ], 'portfolio_category' );
			}
		}
	}

	// Seed Blog Posts.
	$posts = array(
		array( 'title' => 'The Cost of Abstraction', 'content' => 'Performance trade-offs in modern frameworks... <pre><code>console.log("optimizing");</code></pre>' ),
		array( 'title' => 'Scaling Node.js Beyond the Event Loop', 'content' => 'Worker threads and multi-process architecture for enterprise applications.' ),
	);

	foreach ( $posts as $p ) {
		wp_insert_post( array(
			'post_title'   => $p['title'],
			'post_content' => $p['content'],
			'post_status'  => 'publish',
			'post_type'    => 'post',
		) );
	}

	update_option( 'devportfolio_seeded_v4', true );
}
add_action( 'after_switch_theme', 'devportfolio_seed_data' );

/**
 * Register Portfolio Custom Meta Boxes.
 */
function devportfolio_add_portfolio_meta_boxes() {
	add_meta_box(
		'portfolio_details',
		__( 'Portfolio Details', 'devportfolio' ),
		'devportfolio_portfolio_meta_box_callback',
		'portfolio',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'devportfolio_add_portfolio_meta_boxes' );

function devportfolio_portfolio_meta_box_callback( $post ) {
	wp_nonce_field( 'devportfolio_portfolio_meta_box', 'devportfolio_portfolio_meta_box_nonce' );

	$tech_stack = get_post_meta( $post->ID, 'tech_stack', true );
	$github_url = get_post_meta( $post->ID, 'github_url', true );

	echo '<div style="margin-bottom: 20px;">';
	echo '<label for="tech_stack" style="display:block; font-weight:bold; margin-bottom:5px;">' . esc_html__( 'Technology Stack (comma separated)', 'devportfolio' ) . '</label>';
	echo '<input type="text" id="tech_stack" name="tech_stack" value="' . esc_attr( $tech_stack ) . '" style="width:100%;" placeholder="e.g. Node.js, Go, Docker">';
	echo '</div>';

	echo '<div>';
	echo '<label for="github_url" style="display:block; font-weight:bold; margin-bottom:5px;">' . esc_html__( 'GitHub URL', 'devportfolio' ) . '</label>';
	echo '<input type="url" id="github_url" name="github_url" value="' . esc_attr( $github_url ) . '" style="width:100%;" placeholder="https://github.com/...">';
	echo '</div>';
}

function devportfolio_save_portfolio_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['devportfolio_portfolio_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['devportfolio_portfolio_meta_box_nonce'], 'devportfolio_portfolio_meta_box' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['tech_stack'] ) ) {
		update_post_meta( $post_id, 'tech_stack', sanitize_text_field( $_POST['tech_stack'] ) );
	}
	if ( isset( $_POST['github_url'] ) ) {
		update_post_meta( $post_id, 'github_url', esc_url_raw( $_POST['github_url'] ) );
	}
}
add_action( 'save_post', 'devportfolio_save_portfolio_meta_box_data' );
