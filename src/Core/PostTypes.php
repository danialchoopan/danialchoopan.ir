<?php
/**
 * PostTypes.php — Registers all Custom Post Types and Taxonomies.
 *
 * CPTs:
 *   - portfolio        : Project showcase items.
 *   - contact_messages  : Contact form submissions (private, admin-only).
 *   - testimonials      : Client testimonials and reviews.
 *   - clients           : Client/brand logos.
 *
 * @package DanialPortfolio
 * @subpackage Core
 */

namespace DevPortfolio\Core;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

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

		// Admin column customization for contact_messages
		add_filter( 'manage_contact_messages_posts_columns', [ $this, 'contact_messages_columns' ] );
		add_action( 'manage_contact_messages_posts_custom_column', [ $this, 'contact_messages_column_data' ], 10, 2 );
		add_filter( 'manage_edit-contact_messages_sortable_columns', [ $this, 'contact_messages_sortable_columns' ] );

		// Admin column customization for testimonials
		add_filter( 'manage_testimonials_posts_columns', [ $this, 'testimonials_columns' ] );
		add_action( 'manage_testimonials_posts_custom_column', [ $this, 'testimonials_column_data' ], 10, 2 );
	}

	/**
	 * Register all Custom Post Types and Taxonomies.
	 */
	public function register_cpts() {
		// ── Portfolio CPT ──────────────────────────────────────────────
		register_post_type( 'portfolio', [
			'labels'             => [
				'name'               => _x( 'Portfolios', 'post type general name', 'devportfolio' ),
				'singular_name'      => _x( 'Portfolio', 'post type singular name', 'devportfolio' ),
				'menu_name'          => _x( 'Portfolios', 'admin menu', 'devportfolio' ),
				'all_items'          => __( 'All Portfolios', 'devportfolio' ),
				'add_new_item'       => __( 'Add New Portfolio', 'devportfolio' ),
				'edit_item'          => __( 'Edit Portfolio', 'devportfolio' ),
				'new_item'           => __( 'New Portfolio', 'devportfolio' ),
				'view_item'          => __( 'View Portfolio', 'devportfolio' ),
				'search_items'       => __( 'Search Portfolios', 'devportfolio' ),
				'not_found'          => __( 'No portfolios found.', 'devportfolio' ),
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

		// ── Portfolio Categories Taxonomy ──────────────────────────────
		register_taxonomy( 'portfolio_category', [ 'portfolio' ], [
			'hierarchical'      => true,
			'label'             => __( 'Portfolio Categories', 'devportfolio' ),
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => [ 'slug' => 'portfolio-category' ],
			'show_in_rest'      => true,
		] );

		// ── Contact Messages CPT (admin-only, private) ─────────────────
		register_post_type( 'contact_messages', [
			'labels'             => [
				'name'               => _x( 'Messages', 'post type general name', 'devportfolio' ),
				'singular_name'      => _x( 'Message', 'post type singular name', 'devportfolio' ),
				'menu_name'          => _x( 'Messages', 'admin menu', 'devportfolio' ),
				'all_items'          => __( 'All Messages', 'devportfolio' ),
				'add_new_item'       => __( 'Add New Message', 'devportfolio' ),
				'edit_item'          => __( 'View Message', 'devportfolio' ),
				'not_found'          => __( 'No messages found.', 'devportfolio' ),
			],
			'public'             => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'capability_type'    => 'post',
			'map_meta_cap'       => true,
			'supports'           => [ 'title', 'editor' ],
			'menu_icon'          => 'dashicons-email-alt',
			'menu_position'      => 25,
		] );

		// ── Testimonials CPT ───────────────────────────────────────────
		register_post_type( 'testimonials', [
			'labels'             => [
				'name'               => _x( 'Testimonials', 'post type general name', 'devportfolio' ),
				'singular_name'      => _x( 'Testimonial', 'post type singular name', 'devportfolio' ),
				'menu_name'          => _x( 'Testimonials', 'admin menu', 'devportfolio' ),
				'all_items'          => __( 'All Testimonials', 'devportfolio' ),
				'add_new_item'       => __( 'Add New Testimonial', 'devportfolio' ),
				'edit_item'          => __( 'Edit Testimonial', 'devportfolio' ),
				'new_item'           => __( 'New Testimonial', 'devportfolio' ),
				'not_found'          => __( 'No testimonials found.', 'devportfolio' ),
			],
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => [ 'slug' => 'testimonial' ],
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
			'show_in_rest'       => true,
		] );
	}

	// ─── Contact Messages Admin Columns ────────────────────────────────

	/**
	 * Define custom columns for the Contact Messages list table.
	 *
	 * @param  array $columns Existing columns.
	 * @return array Modified columns.
	 */
	public function contact_messages_columns( $columns ) {
		$new_columns = [];
		$new_columns['cb']          = $columns['cb'];
		$new_columns['sender_name'] = __( 'From', 'devportfolio' );
		$new_columns['sender_email']= __( 'Email', 'devportfolio' );
		$new_columns['title']       = __( 'Subject', 'devportfolio' );
		$new_columns['date']        = __( 'Date', 'devportfolio' );
		$new_columns['status']      = __( 'Status', 'devportfolio' );
		return $new_columns;
	}

	/**
	 * Output data for each custom column row.
	 *
	 * @param string $column  Column name.
	 * @param int    $post_id Post ID.
	 */
	public function contact_messages_column_data( $column, $post_id ) {
		switch ( $column ) {
			case 'sender_name':
				echo esc_html( get_post_meta( $post_id, '_contact_name', true ) );
				break;
			case 'sender_email':
				$email = get_post_meta( $post_id, '_contact_email', true );
				echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
				break;
			case 'status':
				$status = get_post_meta( $post_id, '_contact_status', true ) ?: 'unread';
				$label  = $status === 'unread'
					? '<span style="color:#FFD700;font-weight:bold;">&#9679; Unread</span>'
					: '<span style="color:#22c55e;">&#9679; Read</span>';
				echo $label;
				break;
		}
	}

	/**
	 * Make the date column sortable.
	 *
	 * @param  array $columns Sortable columns.
	 * @return array
	 */
	public function contact_messages_sortable_columns( $columns ) {
		$columns['date'] = 'date';
		return $columns;
	}

	// ─── Testimonials Admin Columns ────────────────────────────────────

	/**
	 * Custom columns for the Testimonials list table.
	 */
	public function testimonials_columns( $columns ) {
		$new_columns = [];
		$new_columns['cb']             = $columns['cb'];
		$new_columns['client_name']    = __( 'Client Name', 'devportfolio' );
		$new_columns['client_role']    = __( 'Role / Company', 'devportfolio' );
		$new_columns['title']          = __( 'Testimonial', 'devportfolio' );
		$new_columns['rating']         = __( 'Rating', 'devportfolio' );
		$new_columns['date']           = $columns['date'];
		return $new_columns;
	}

	/**
	 * Output data for testimonial custom columns.
	 */
	public function testimonials_column_data( $column, $post_id ) {
		switch ( $column ) {
			case 'client_name':
				echo esc_html( get_post_meta( $post_id, '_testimonial_client_name', true ) );
				break;
			case 'client_role':
				echo esc_html( get_post_meta( $post_id, '_testimonial_client_role', true ) );
				break;
			case 'rating':
				$rating = (int) get_post_meta( $post_id, '_testimonial_rating', true );
				$rating = max( 1, min( 5, $rating ) );
				echo str_repeat( '&#9733;', $rating ) . str_repeat( '&#9734;', 5 - $rating );
				break;
		}
	}
}
