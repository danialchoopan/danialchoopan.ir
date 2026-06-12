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
 * Register Custom Post Types.
 */
function devportfolio_register_cpts() {
	// Portfolio CPT
	$portfolio_labels = array(
		'name'               => _x( 'Portfolios', 'post type general name', 'devportfolio' ),
		'singular_name'      => _x( 'Portfolio', 'post type singular name', 'devportfolio' ),
		'menu_name'          => _x( 'Portfolios', 'admin menu', 'devportfolio' ),
		'all_items'          => __( 'All Portfolios', 'devportfolio' ),
		'add_new_item'       => __( 'Add New Portfolio', 'devportfolio' ),
		'search_items'       => __( 'Search Portfolios', 'devportfolio' ),
	);

	$portfolio_args = array(
		'labels'             => $portfolio_labels,
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

	register_post_type( 'portfolio', $portfolio_args );

	register_taxonomy( 'portfolio_category', array( 'portfolio' ), array(
		'hierarchical'      => true,
		'label'             => __( 'Categories', 'devportfolio' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfolio-category' ),
		'show_in_rest'      => true,
	) );

	// Contact Messages CPT
	$message_labels = array(
		'name'               => _x( 'Contact Messages', 'post type general name', 'devportfolio' ),
		'singular_name'      => _x( 'Contact Message', 'post type singular name', 'devportfolio' ),
		'menu_name'          => _x( 'Messages', 'admin menu', 'devportfolio' ),
		'all_items'          => __( 'All Messages', 'devportfolio' ),
	);

	$message_args = array(
		'labels'             => $message_labels,
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'capability_type'    => 'post',
		'capabilities'       => array( 'create_posts' => false ), // No manual creation
		'map_meta_cap'       => true,
		'supports'           => array( 'title', 'editor' ),
	);

	register_post_type( 'contact_messages', $message_args );
}
add_action( 'init', 'devportfolio_register_cpts' );

/**
 * Theme Options Page
 */
function devportfolio_add_admin_menu() {
	add_menu_page(
		__( 'Theme Options', 'devportfolio' ),
		__( 'Theme Options', 'devportfolio' ),
		'manage_options',
		'devportfolio_options',
		'devportfolio_options_page'
	);
}
add_action( 'admin_menu', 'devportfolio_add_admin_menu' );

function devportfolio_settings_init() {
	register_setting( 'devportfolio_options_group', 'devportfolio_settings' );

	add_settings_section(
		'devportfolio_general_section',
		__( 'General Settings', 'devportfolio' ),
		null,
		'devportfolio_options'
	);

	add_settings_field(
		'site_language',
		__( 'Site Language', 'devportfolio' ),
		'devportfolio_language_render',
		'devportfolio_options',
		'devportfolio_general_section'
	);

	add_settings_field(
		'contact_email',
		__( 'Contact Email', 'devportfolio' ),
		'devportfolio_email_render',
		'devportfolio_options',
		'devportfolio_general_section'
	);

	add_settings_field(
		'contact_phone',
		__( 'Phone Number', 'devportfolio' ),
		'devportfolio_phone_render',
		'devportfolio_options',
		'devportfolio_general_section'
	);

	add_settings_field(
		'github_url',
		__( 'GitHub URL', 'devportfolio' ),
		'devportfolio_github_render',
		'devportfolio_options',
		'devportfolio_general_section'
	);

	add_settings_field(
		'linkedin_url',
		__( 'LinkedIn URL', 'devportfolio' ),
		'devportfolio_linkedin_render',
		'devportfolio_options',
		'devportfolio_general_section'
	);
}
add_action( 'admin_init', 'devportfolio_settings_init' );

function devportfolio_language_render() {
	$options = get_option( 'devportfolio_settings' );
	?>
	<select name='devportfolio_settings[site_language]'>
		<option value='en' <?php selected( $options['site_language'] ?? 'en', 'en' ); ?>>English</option>
		<option value='fa' <?php selected( $options['site_language'] ?? 'en', 'fa' ); ?>>Farsi</option>
	</select>
	<?php
}

function devportfolio_email_render() {
	$options = get_option( 'devportfolio_settings' );
	?>
	<input type='email' name='devportfolio_settings[contact_email]' value='<?php echo esc_attr( $options['contact_email'] ?? '' ); ?>' class='regular-text'>
	<?php
}

function devportfolio_phone_render() {
	$options = get_option( 'devportfolio_settings' );
	?>
	<input type='text' name='devportfolio_settings[contact_phone]' value='<?php echo esc_attr( $options['contact_phone'] ?? '' ); ?>' class='regular-text'>
	<?php
}

function devportfolio_github_render() {
	$options = get_option( 'devportfolio_settings' );
	?>
	<input type='url' name='devportfolio_settings[github_url]' value='<?php echo esc_attr( $options['github_url'] ?? '' ); ?>' class='regular-text'>
	<?php
}

function devportfolio_linkedin_render() {
	$options = get_option( 'devportfolio_settings' );
	?>
	<input type='url' name='devportfolio_settings[linkedin_url]' value='<?php echo esc_attr( $options['linkedin_url'] ?? '' ); ?>' class='regular-text'>
	<?php
}

function devportfolio_options_page() {
	?>
	<form action='options.php' method='post'>
		<h2>DevPortfolio Pro Options</h2>
		<?php
		settings_fields( 'devportfolio_options_group' );
		do_settings_sections( 'devportfolio_options' );
		submit_button();
		?>
	</form>
	<?php
}

/**
 * Handle Locale based on settings.
 */
function devportfolio_locale( $locale ) {
	$options = get_option( 'devportfolio_settings' );
	$lang = $options['site_language'] ?? 'en';

	if ( 'fa' === $lang ) {
		return 'fa_IR';
	}
	return 'en_US';
}
add_filter( 'locale', 'devportfolio_locale' );

/**
 * Add RTL/LTR and Font classes to body.
 */
function devportfolio_body_classes( $classes ) {
	$options = get_option( 'devportfolio_settings' );
	$lang = $options['site_language'] ?? 'en';

	if ( 'fa' === $lang ) {
		$classes[] = 'rtl';
	} else {
		$classes[] = 'ltr';
	}

	$classes[] = 'font-vazir';
	return $classes;
}
add_filter( 'body_class', 'devportfolio_body_classes' );

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
	// Local Assets
	wp_enqueue_style( 'devportfolio-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.6.0' );
	wp_enqueue_style( 'devportfolio-style', get_stylesheet_uri(), array(), '1.6.0' );
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
	// Hero Section
	$wp_customize->add_section( 'devportfolio_hero', array( 'title' => __( 'Hero Section', 'devportfolio' ), 'priority' => 30 ) );
	$wp_customize->add_setting( 'hero_title', array( 'default' => 'Building Resilience through Code.', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'hero_title', array( 'label' => __( 'Hero Title', 'devportfolio' ), 'section' => 'devportfolio_hero' ) );
	$wp_customize->add_setting( 'hero_bio', array( 'default' => 'Focused on high-performance distributed systems and engineering excellence.', 'sanitize_callback' => 'sanitize_textarea_field' ) );
	$wp_customize->add_control( 'hero_bio', array( 'label' => __( 'Hero Bio', 'devportfolio' ), 'section' => 'devportfolio_hero', 'type' => 'textarea' ) );
	$wp_customize->add_setting( 'hero_cta_primary_text', array( 'default' => 'Analyze Work', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'hero_cta_primary_text', array( 'label' => __( 'Primary CTA Text', 'devportfolio' ), 'section' => 'devportfolio_hero' ) );
	$wp_customize->add_setting( 'hero_cta_primary_url', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'hero_cta_primary_url', array( 'label' => __( 'Primary CTA URL', 'devportfolio' ), 'section' => 'devportfolio_hero' ) );

	$wp_customize->add_section( 'devportfolio_homepage', array( 'title' => __( 'Homepage Layout', 'devportfolio' ), 'priority' => 40 ) );
	$wp_customize->add_setting( 'homepage_order', array( 'default' => 'hero,tech,portfolio,blog', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'homepage_order', array( 'label' => __( 'Section Order', 'devportfolio' ), 'section' => 'devportfolio_homepage' ) );
}
add_action( 'customize_register', 'devportfolio_customize_register' );
