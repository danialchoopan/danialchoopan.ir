<?php
namespace DevPortfolio\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Advanced Customizer for theme-wide settings and CSS variables.
 */
class Customizer {
	private static $instance = null;

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'customize_register', [ $this, 'register' ] );
		add_action( 'wp_head', [ $this, 'render_css_variables' ], 1 );
	}

	public function register( $wp_customize ) {
		// Colors & Skins Section
		$wp_customize->add_section( 'devportfolio_colors', [
			'title'    => __( 'Advanced Styling & Skins', 'devportfolio' ),
			'priority' => 30,
		] );

		$wp_customize->add_setting( 'primary_color', [
			'default'           => '#FFD700',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'primary_color', [
			'label'    => __( 'Primary Brand Color', 'devportfolio' ),
			'section'  => 'devportfolio_colors',
		] ) );

        // Spacing Section (Responsive)
        $wp_customize->add_section( 'devportfolio_spacing', [
			'title'    => __( 'Responsive Spacing', 'devportfolio' ),
			'priority' => 40,
		] );

        $wp_customize->add_setting( 'container_padding_desktop', [
			'default'           => '24',
			'sanitize_callback' => 'absint',
		] );

        $wp_customize->add_control( 'container_padding_desktop', [
			'label'    => __( 'Container Padding (Desktop) px', 'devportfolio' ),
			'section'  => 'devportfolio_spacing',
            'type'     => 'number',
		] );
	}

	public function render_css_variables() {
		$primary = get_theme_mod( 'primary_color', '#FFD700' );
        $desktop_padding = get_theme_mod( 'container_padding_desktop', '24' );
		?>
		<style id="devportfolio-css-vars">
			:root {
				--primary: <?php echo esc_html( $primary ); ?>;
                --container-padding-desktop: <?php echo esc_html( $desktop_padding ); ?>px;
			}
            .bg-primary { background-color: var(--primary) !important; }
            .text-primary { color: var(--primary) !important; }
            .border-primary { border-color: var(--primary) !important; }
		</style>
		<?php
	}
}
