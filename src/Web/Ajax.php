<?php
/**
 * Ajax.php — Handles all AJAX requests (contact form submissions).
 *
 * @package DanialPortfolio
 * @subpackage Web
 */

namespace DevPortfolio\Web;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class Ajax {
	private static $instance = null;

	/** Get singleton instance. */
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Hook into WordPress AJAX actions. */
	private function __construct() {
		add_action( 'wp_ajax_submit_contact_form', [ $this, 'handle_contact_submission' ] );
		add_action( 'wp_ajax_nopriv_submit_contact_form', [ $this, 'handle_contact_submission' ] );
	}

	/**
	 * Process the contact form submission.
	 *
	 * - Validates required fields (name, email, message).
	 * - Saves to `contact_messages` CPT with sender meta.
	 * - Sends an email notification to the site admin.
	 * - Returns JSON response to the frontend.
	 */
	public function handle_contact_submission() {
		// Verify nonce for security
		check_ajax_referer( 'devportfolio_contact_nonce', 'security' );

		// Sanitize and validate input
		$name    = sanitize_text_field( $_POST['name'] ?? '' );
		$email   = sanitize_email( $_POST['email'] ?? '' );
		$subject = sanitize_text_field( $_POST['subject'] ?? '' );
		$message = sanitize_textarea_field( $_POST['message'] ?? '' );

		// Reject empty required fields
		if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
			wp_send_json_error( [
				'message' => __( 'Please fill all required fields.', 'devportfolio' ),
			] );
		}

		// Reject invalid email
		if ( ! is_email( $email ) ) {
			wp_send_json_error( [
				'message' => __( 'Please enter a valid email address.', 'devportfolio' ),
			] );
		}

		// Save message as a custom post type so it appears in WP Admin
		$post_id = wp_insert_post( [
			'post_title'   => $subject ?: sprintf( __( 'Message from %s', 'devportfolio' ), $name ),
			'post_content' => $message,
			'post_type'    => 'contact_messages',
			'post_status'  => 'publish',
			'meta_input'   => [
				'_contact_email'  => $email,
				'_contact_name'   => $name,
				'_contact_ip'     => $this->get_client_ip(),
				'_contact_status' => 'unread',
				'_contact_date'   => current_time( 'mysql' ),
			],
		] );

		if ( $post_id ) {
			// Send email notification to admin
			$this->send_admin_notification( $name, $email, $subject, $message );

			wp_send_json_success( [
				'message' => __( 'Your message has been sent successfully!', 'devportfolio' ),
			] );
		}

		wp_send_json_error( [
			'message' => __( 'Something went wrong. Please try again.', 'devportfolio' ),
		] );
	}

	/**
	 * Send an email notification to the site admin about a new contact message.
	 *
	 * @param string $name    Sender name.
	 * @param string $email   Sender email.
	 * @param string $subject Message subject.
	 * @param string $message Message body.
	 */
	private function send_admin_notification( $name, $email, $subject, $message ) {
		$admin_email = get_option( 'admin_email' );
		$site_name   = get_bloginfo( 'name' );
		$subject_line = sprintf(
			/* translators: 1: site name, 2: sender name */
			__( '[%1$s] New message from %2$s', 'devportfolio' ),
			$site_name,
			$name
		);

		$body = sprintf(
			"You have received a new message from your contact form.\n\n" .
			"Name: %s\nEmail: %s\nSubject: %s\n\nMessage:\n%s\n\n" .
			"--\nSent from %s",
			$name,
			$email,
			$subject ?: '(no subject)',
			$message,
			$site_name
		);

		$headers = [
			'Content-Type: text/plain; charset=UTF-8',
			sprintf( 'Reply-To: %s <%s>', $name, $email ),
		];

		wp_mail( $admin_email, $subject_line, $body, $headers );
	}

	/**
	 * Get the client's IP address for spam tracking.
	 *
	 * @return string IP address or empty string.
	 */
	private function get_client_ip() {
		$ip = '';
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_CLIENT_IP'] ) );
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) );
		} elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
			$ip = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
		}
		return $ip;
	}
}
