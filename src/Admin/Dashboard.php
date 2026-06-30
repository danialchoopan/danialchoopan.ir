<?php
/**
 * Dashboard.php — Custom admin dashboard page for Danial Portfolio.
 *
 * Provides:
 *   - Theme settings page (GitHub token, language, etc.)
 *   - Recent messages overview widget
 *   - Quick links to Customizer
 *
 * @package DanialPortfolio
 * @subpackage Admin
 */

namespace DevPortfolio\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class Dashboard {
	private static $instance = null;
	private $option_name = 'devportfolio_settings';

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'admin_menu', [ $this, 'add_menu' ] );
		add_action( 'admin_init', [ $this, 'register_settings' ] );
		add_action( 'admin_head', [ $this, 'admin_styles' ] );
	}

	/**
	 * Register the admin menu page under "Danial Portfolio".
	 */
	public function add_menu() {
		add_menu_page(
			__( 'Danial Portfolio', 'devportfolio' ),
			'Danial Portfolio',
			'manage_options',
			'danial-portfolio-admin',
			[ $this, 'render_dashboard' ],
			'dashicons-admin-multisite',
			60
		);

		// Sub-menu: Settings
		add_submenu_page(
			'danial-portfolio-admin',
			__( 'Theme Settings', 'devportfolio' ),
			__( 'Settings', 'devportfolio' ),
			'manage_options',
			'danial-portfolio-admin',
			[ $this, 'render_dashboard' ]
		);
	}

	/**
	 * Register theme settings and sections.
	 */
	public function register_settings() {
		register_setting( 'devportfolio_options_group', $this->option_name, [
			'sanitize_callback' => [ $this, 'sanitize_settings' ],
		] );

		// ── General Section ────────────────────────────────────────
		add_settings_section(
			'danial_general_section',
			__( 'General Configuration', 'devportfolio' ),
			[ $this, 'general_section_desc' ],
			'danial-portfolio-admin'
		);

		add_settings_field(
			'github_token',
			__( 'GitHub Personal Access Token', 'devportfolio' ),
			[ $this, 'render_field' ],
			'danial-portfolio-admin',
			'danial_general_section',
			[ 'id' => 'github_token', 'type' => 'password', 'desc' => __( 'Used for fetching repository data. Optional but increases API rate limits.', 'devportfolio' ) ]
		);

		add_settings_field(
			'github_handle',
			__( 'GitHub Username', 'devportfolio' ),
			[ $this, 'render_field' ],
			'danial-portfolio-admin',
			'danial_general_section',
			[ 'id' => 'github_handle', 'type' => 'text', 'desc' => __( 'Your GitHub username for repo widgets and rank calculation.', 'devportfolio' ) ]
		);

		// ── Notifications Section ───────────────────────────────────
		add_settings_section(
			'danial_notifications_section',
			__( 'Email Notifications', 'devportfolio' ),
			[ $this, 'notifications_section_desc' ],
			'danial-portfolio-admin'
		);

		add_settings_field(
			'notify_email',
			__( 'Notification Email', 'devportfolio' ),
			[ $this, 'render_field' ],
			'danial-portfolio-admin',
			'danial_notifications_section',
			[ 'id' => 'notify_email', 'type' => 'email', 'desc' => __( 'Where to send contact form notifications. Defaults to admin email.', 'devportfolio' ) ]
		);

		// ── Social Links Section ────────────────────────────────────
		add_settings_section(
			'danial_social_section',
			__( 'Social Media Links', 'devportfolio' ),
			[ $this, 'social_section_desc' ],
			'danial-portfolio-admin'
		);

		$social_links = [
			'github_url'   => [ 'label' => 'GitHub URL',    'type' => 'url' ],
			'twitter_url'  => [ 'label' => 'Twitter / X URL', 'type' => 'url' ],
			'linkedin_url' => [ 'label' => 'LinkedIn URL',  'type' => 'url' ],
			'telegram_url' => [ 'label' => 'Telegram URL',  'type' => 'url' ],
			'instagram_url'=> [ 'label' => 'Instagram URL', 'type' => 'url' ],
			'email_address'=> [ 'label' => 'Public Email',  'type' => 'email' ],
		];

		foreach ( $social_links as $id => $config ) {
			add_settings_field(
				$id,
				$config['label'],
				[ $this, 'render_field' ],
				'danial-portfolio-admin',
				'danial_social_section',
				[ 'id' => $id, 'type' => $config['type'], 'desc' => '' ]
			);
		}
	}

	/** Sanitize all settings before saving. */
	public function sanitize_settings( $input ) {
		$clean = [];
		$clean['github_token']   = sanitize_text_field( $input['github_token'] ?? '' );
		$clean['github_handle']  = sanitize_text_field( $input['github_handle'] ?? '' );
		$clean['notify_email']   = is_email( $input['notify_email'] ?? '' ) ? $input['notify_email'] : '';
		$clean['github_url']     = esc_url_raw( $input['github_url'] ?? '' );
		$clean['twitter_url']    = esc_url_raw( $input['twitter_url'] ?? '' );
		$clean['linkedin_url']   = esc_url_raw( $input['linkedin_url'] ?? '' );
		$clean['telegram_url']   = esc_url_raw( $input['telegram_url'] ?? '' );
		$clean['instagram_url']  = esc_url_raw( $input['instagram_url'] ?? '' );
		$clean['email_address']  = is_email( $input['email_address'] ?? '' ) ? $input['email_address'] : '';
		return $clean;
	}

	/** Generic field renderer — avoids repetitive render methods. */
	public function render_field( $args ) {
		$options = get_option( $this->option_name );
		$value   = $options[ $args['id'] ] ?? '';
		$type    = $args['type'] ?? 'text';
		printf(
			'<input type="%s" name="%s[%s]" value="%s" class="regular-text" />',
			esc_attr( $type ),
			esc_attr( $this->option_name ),
			esc_attr( $args['id'] ),
			esc_attr( $value )
		);
		if ( ! empty( $args['desc'] ) ) {
			printf( '<p class="description">%s</p>', esc_html( $args['desc'] ) );
		}
	}

	/** Section descriptions */
	public function general_section_desc() {
		echo '<p>' . esc_html__( 'Configure your GitHub integration and general theme behavior.', 'devportfolio' ) . '</p>';
	}
	public function notifications_section_desc() {
		echo '<p>' . esc_html__( 'Control where contact form notifications are sent.', 'devportfolio' ) . '</p>';
	}
	public function social_section_desc() {
		echo '<p>' . esc_html__( 'Add your social media URLs. Leave blank to hide from the frontend.', 'devportfolio' ) . '</p>';
	}

	/**
	 * Render the main admin dashboard page.
	 *
	 * Shows: settings form, recent messages, quick stats, and
	 * a link to the Customizer for visual settings.
	 */
	public function render_dashboard() {
		$messages = $this->get_recent_messages( 5 );
		$stats    = $this->get_message_stats();
		?>
		<div class="wrap danial-admin">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<!-- ── Quick Stats Row ──────────────────────────────── -->
			<div class="danial-stats-row" style="display:flex;gap:16px;margin:20px 0;flex-wrap:wrap;">
				<div class="danial-stat-card" style="flex:1;min-width:180px;padding:20px;background:#fff;border-left:4px solid #FFD700;box-shadow:0 1px 4px rgba(0,0,0,.1);">
					<h3 style="margin:0;font-size:28px;font-weight:800;"><?php echo esc_html( $stats['total'] ); ?></h3>
					<p style="margin:4px 0 0;color:#666;font-size:13px;"><?php esc_html_e( 'Total Messages', 'devportfolio' ); ?></p>
				</div>
				<div class="danial-stat-card" style="flex:1;min-width:180px;padding:20px;background:#fff;border-left:4px solid #FF5F56;box-shadow:0 1px 4px rgba(0,0,0,.1);">
					<h3 style="margin:0;font-size:28px;font-weight:800;"><?php echo esc_html( $stats['unread'] ); ?></h3>
					<p style="margin:4px 0 0;color:#666;font-size:13px;"><?php esc_html_e( 'Unread Messages', 'devportfolio' ); ?></p>
				</div>
				<div class="danial-stat-card" style="flex:1;min-width:180px;padding:20px;background:#fff;border-left:4px solid #27C93F;box-shadow:0 1px 4px rgba(0,0,0,.1);">
					<h3 style="margin:0;font-size:28px;font-weight:800;"><?php echo esc_html( wp_count_posts( 'portfolio' )->publish ?? 0 ); ?></h3>
					<p style="margin:4px 0 0;color:#666;font-size:13px;"><?php esc_html_e( 'Portfolio Items', 'devportfolio' ); ?></p>
				</div>
				<div class="danial-stat-card" style="flex:1;min-width:180px;padding:20px;background:#fff;border-left:4px solid #39FF14;box-shadow:0 1px 4px rgba(0,0,0,.1);">
					<h3 style="margin:0;font-size:28px;font-weight:800;"><?php echo esc_html( wp_count_posts( 'testimonials' )->publish ?? 0 ); ?></h3>
					<p style="margin:4px 0 0;color:#666;font-size:13px;"><?php esc_html_e( 'Testimonials', 'devportfolio' ); ?></p>
				</div>
			</div>

			<!-- ── Quick Links ───────────────────────────────────── -->
			<div style="margin:20px 0;display:flex;gap:12px;flex-wrap:wrap;">
				<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary" style="background:#FFD700;border-color:#FFD700;color:#131313;font-weight:700;">
					<?php esc_html_e( 'Open Customizer', 'devportfolio' ); ?>
				</a>
				<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=portfolio' ) ); ?>" class="button">
					<?php esc_html_e( 'Manage Portfolio', 'devportfolio' ); ?>
				</a>
				<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=contact_messages' ) ); ?>" class="button">
					<?php esc_html_e( 'View Messages', 'devportfolio' ); ?>
				</a>
				<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=testimonials' ) ); ?>" class="button">
					<?php esc_html_e( 'Manage Testimonials', 'devportfolio' ); ?>
				</a>
			</div>

			<!-- ── Settings Form ─────────────────────────────────── -->
			<div style="display:flex;gap:24px;flex-wrap:wrap;">
				<div style="flex:2;min-width:400px;">
					<h2><?php esc_html_e( 'Theme Settings', 'devportfolio' ); ?></h2>
					<form action="options.php" method="post" style="background:#fff;padding:20px;box-shadow:0 1px 4px rgba(0,0,0,.1);">
						<?php
						settings_fields( 'devportfolio_options_group' );
						do_settings_sections( 'danial-portfolio-admin' );
						submit_button( __( 'Save Settings', 'devportfolio' ) );
						?>
					</form>
				</div>

				<!-- ── Recent Messages Sidebar ───────────────────── -->
				<div style="flex:1;min-width:300px;">
					<h2><?php esc_html_e( 'Recent Messages', 'devportfolio' ); ?></h2>
					<div style="background:#fff;padding:16px;box-shadow:0 1px 4px rgba(0,0,0,.1);">
						<?php if ( empty( $messages ) ) : ?>
							<p style="color:#999;"><?php esc_html_e( 'No messages yet.', 'devportfolio' ); ?></p>
						<?php else : ?>
							<?php foreach ( $messages as $msg ) :
								$name   = get_post_meta( $msg->ID, '_contact_name', true );
								$email  = get_post_meta( $msg->ID, '_contact_email', true );
								$status = get_post_meta( $msg->ID, '_contact_status', true ) ?: 'unread';
							?>
								<div style="padding:12px 0;border-bottom:1px solid #eee;<?php echo $status === 'unread' ? 'font-weight:700;' : ''; ?>">
									<div style="display:flex;justify-content:space-between;">
										<strong><?php echo esc_html( $name ); ?></strong>
										<span style="font-size:11px;color:#999;"><?php echo esc_html( human_time_diff( strtotime( $msg->post_date ), current_time( 'timestamp' ) ) ); ?> ago</span>
									</div>
									<div style="font-size:12px;color:#666;margin-top:2px;">
										<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
									</div>
									<div style="font-size:13px;margin-top:4px;color:#333;">
										<?php echo esc_html( wp_trim_words( $msg->post_content, 15 ) ); ?>
									</div>
									<div style="margin-top:6px;">
										<a href="<?php echo esc_url( admin_url( 'post.php?post=' . $msg->ID . '&action=edit' ) ); ?>" style="font-size:11px;color:#FFD700;text-decoration:none;">
											<?php esc_html_e( 'View Message', 'devportfolio' ); ?> &rarr;
										</a>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
						<p style="margin-top:12px;">
							<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=contact_messages' ) ); ?>" style="color:#FFD700;font-size:13px;">
								<?php esc_html_e( 'View All Messages', 'devportfolio' ); ?> &rarr;
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Get recent contact messages.
	 *
	 * @param int $count Number of messages to retrieve.
	 * @return array WP_Post objects.
	 */
	private function get_recent_messages( $count = 5 ) {
		return get_posts( [
			'post_type'      => 'contact_messages',
			'posts_per_page' => $count,
			'orderby'        => 'date',
			'order'          => 'DESC',
		] );
	}

	/**
	 * Get message count statistics.
	 *
	 * @return array with 'total' and 'unread' counts.
	 */
	private function get_message_stats() {
		$total  = wp_count_posts( 'contact_messages' )->publish ?? 0;
		$unread = 0;
		$messages = get_posts( [
			'post_type'      => 'contact_messages',
			'posts_per_page' => -1,
			'meta_key'       => '_contact_status',
			'meta_value'     => 'unread',
		] );
		$unread = count( $messages );
		return [ 'total' => (int) $total, 'unread' => (int) $unread ];
	}

	/** Inject minimal admin CSS for the dashboard layout. */
	public function admin_styles() {
		$screen = get_current_screen();
		if ( ! $screen || $screen->id !== 'danial-portfolio-admin' ) {
			return;
		}
		?>
		<style>
			.danial-admin h1 { margin-bottom: 8px; }
			.danial-admin h2 { font-size: 16px; margin: 20px 0 10px; }
			.danial-stat-card h3 { color: #1d2327; }
			.danial-admin .form-table th { width: 200px; }
		</style>
		<?php
	}
}
