<?php
namespace DevPortfolio\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Handles the custom admin dashboard and settings.
 */
class Dashboard {
	private static $instance = null;
	private string $option_name = 'devportfolio_settings';

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'admin_menu', [ $this, 'add_menu' ] );
		add_action( 'admin_init', [ $this, 'register_settings' ] );
	}

	public function add_menu() {
		add_menu_page(
			__( 'DevPortfolio Settings', 'devportfolio' ),
			'DevPortfolio',
			'manage_options',
			'devportfolio-admin',
			[ $this, 'render_dashboard' ],
			'dashicons-code-standards',
			60
		);
	}

	public function register_settings() {
		register_setting( 'devportfolio_options_group', $this->option_name );

		add_settings_section(
			'devportfolio_general_section',
			__( 'General Configuration', 'devportfolio' ),
			null,
			'devportfolio-admin'
		);

		add_settings_field(
			'github_token',
			__( 'GitHub Personal Access Token', 'devportfolio' ),
			[ $this, 'render_github_token' ],
			'devportfolio-admin',
			'devportfolio_general_section'
		);
	}

	public function render_github_token() {
		$options = get_option( $this->option_name );
		$val = $options['github_token'] ?? '';
		echo '<input type="password" name="' . esc_attr( $this->option_name ) . '[github_token]" value="' . esc_attr( $val ) . '" class="regular-text">';
		echo '<p class="description">' . esc_html__( 'Used for fetching repository data via GitHub API.', 'devportfolio' ) . '</p>';
	}

	public function render_dashboard() {
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
				<?php
				settings_fields( 'devportfolio_options_group' );
				do_settings_sections( 'devportfolio-admin' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}
}
