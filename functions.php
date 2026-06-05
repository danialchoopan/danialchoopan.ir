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
	wp_enqueue_style( 'devportfolio-fonts', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;400;700&display=swap', array(), null );

	// Font Awesome.
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

	// Tailwind CSS via CDN with Typography plugin for zero-config production-ready setup.
	wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com?plugins=typography', array(), null, false );

	// Theme main stylesheet.
	wp_enqueue_style( 'devportfolio-style', get_stylesheet_uri(), array(), '1.1.0' );

	// Custom Tailwind Config - Premium Dark Mode Aesthetic.
	wp_add_inline_script( 'tailwind-cdn', "
		tailwind.config = {
			darkMode: 'class',
			theme: {
				extend: {
					colors: {
						primary: {
							DEFAULT: '#6366f1', // Indigo 500
							light: '#818cf8',
							dark: '#4f46e5',
						},
						accent: {
							DEFAULT: '#10b981', // Emerald 500
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
 * Seed Programmatic Data upon theme activation.
 */
function devportfolio_seed_data() {
	if ( get_option( 'devportfolio_data_seeded' ) ) {
		return;
	}

	// 1. Create Portfolio Categories.
	$categories = array( 'Web Development', 'Mobile Apps', 'Cloud Architecture' );
	$term_ids   = array();
	foreach ( $categories as $cat ) {
		$term = wp_insert_term( $cat, 'portfolio_category' );
		if ( ! is_wp_error( $term ) ) {
			$term_ids[ $cat ] = $term['term_id'];
		}
	}

	// 2. Create Sample Portfolios.
	$portfolios = array(
		array(
			'title'   => 'E-commerce Microservices Platform',
			'content' => 'A scalable microservices architecture built with Node.js and Go, handling 10k+ concurrent users.',
			'excerpt' => 'Scalable microservices architecture for global retail.',
			'tech'    => 'Node.js, Go, Kubernetes, AWS',
			'cat'     => 'Cloud Architecture',
		),
		array(
			'title'   => 'AI-Powered Analytics Dashboard',
			'content' => 'Real-time data visualization dashboard with predictive analytics using React and Python.',
			'excerpt' => 'Advanced data visualization with machine learning integration.',
			'tech'    => 'React, Python, D3.js, FastAPI',
			'cat'     => 'Web Development',
		),
	);

	foreach ( $portfolios as $p ) {
		$post_id = wp_insert_post(
			array(
				'post_title'   => $p['title'],
				'post_content' => $p['content'],
				'post_excerpt' => $p['excerpt'],
				'post_status'  => 'publish',
				'post_type'    => 'portfolio',
			)
		);
		if ( $post_id ) {
			update_post_meta( $post_id, 'tech_stack', $p['tech'] );
			if ( isset( $term_ids[ $p['cat'] ] ) ) {
				wp_set_object_terms( $post_id, $term_ids[ $p['cat'] ], 'portfolio_category' );
			}
		}
	}

	// 3. Create Sample Blog Posts.
	$posts = array(
		array(
			'title'   => 'Mastering Clean Architecture in Node.js',
			'content' => 'Deep dive into decoupling business logic from infrastructure... <pre><code>class UseCase { execute() { ... } }</code></pre>',
			'excerpt' => 'Learn how to build maintainable Node.js applications.',
		),
		array(
			'title'   => 'Optimizing React Performance for Enterprise',
			'content' => 'Techniques for reducing bundle size and improving TTI in large-scale apps.',
			'excerpt' => 'Best practices for high-performance React applications.',
		),
	);

	foreach ( $posts as $p ) {
		wp_insert_post(
			array(
				'post_title'   => $p['title'],
				'post_content' => $p['content'],
				'post_excerpt' => $p['excerpt'],
				'post_status'  => 'publish',
				'post_type'    => 'post',
			)
		);
	}

	// 4. Set up Navigation Menu.
	$menu_name = 'Main Menu';
	$menu_id   = wp_create_nav_menu( $menu_name );

	if ( ! is_wp_error( $menu_id ) ) {
		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'  => 'Home',
			'menu-item-url'    => home_url( '/' ),
			'menu-item-status' => 'publish',
		) );
		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'  => 'Portfolio',
			'menu-item-url'    => get_post_type_archive_link( 'portfolio' ),
			'menu-item-status' => 'publish',
		) );
		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'  => 'Blog',
			'menu-item-url'    => get_post_type_archive_link( 'post' ),
			'menu-item-status' => 'publish',
		) );

		set_theme_mod( 'nav_menu_locations', array( 'primary' => $menu_id ) );
	}

	// 5. Set static front page.
	$home_page_id = wp_insert_post(
		array(
			'post_title'  => 'Home',
			'post_status' => 'publish',
			'post_type'   => 'page',
		)
	);
	if ( $home_page_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_page_id );
	}

	// Mark as seeded.
	update_option( 'devportfolio_data_seeded', true );
}
add_action( 'after_switch_theme', 'devportfolio_seed_data' );

/**
 * Estimate reading time in minutes.
 */
function devportfolio_reading_time( $content ) {
	$word_count = str_word_count( strip_tags( $content ) );
	$reading_time = ceil( $word_count / 200 );
	return $reading_time;
}

/**
 * Get social links.
 */
function devportfolio_get_social_links() {
	return array(
		'github'   => 'https://github.com/danialchoopan',
		'linkedin' => 'https://linkedin.com/in/danialchoopan',
	);
}
