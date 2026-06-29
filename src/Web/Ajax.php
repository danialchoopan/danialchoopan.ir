<?php
namespace DevPortfolio\Web;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Handles AJAX requests.
 */
class Ajax {
	private static $instance = null;

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'wp_ajax_submit_contact_form', [ $this, 'handle_contact_submission' ] );
		add_action( 'wp_ajax_nopriv_submit_contact_form', [ $this, 'handle_contact_submission' ] );
	}

	public function handle_contact_submission() {
		check_ajax_referer( 'devportfolio_contact_nonce', 'security' );

		$name    = sanitize_text_field( $_POST['name'] );
		$email   = sanitize_email( $_POST['email'] );
		$subject = sanitize_text_field( $_POST['subject'] );
		$message = sanitize_textarea_field( $_POST['message'] );

		if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
			wp_send_json_error( [ 'message' => __( 'Please fill all required fields.', 'devportfolio' ) ] );
		}

		$post_id = wp_insert_post( [
			'post_title'   => $subject ?: "New Message from {$name}",
			'post_content' => $message,
			'post_type'    => 'contact_messages',
			'post_status'  => 'publish',
            'meta_input'   => [
                '_contact_email' => $email,
                '_contact_name'  => $name
            ]
		] );

		if ( $post_id ) {
            // Optional: wp_mail( get_option('admin_email'), $subject, "From: $name <$email>\n\n$message" );
			wp_send_json_success( [ 'message' => __( 'Your message has been sent successfully.', 'devportfolio' ) ] );
		}

		wp_send_json_error( [ 'message' => __( 'Something went wrong. Please try again.', 'devportfolio' ) ] );
	}
}
