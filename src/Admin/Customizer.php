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
		// Section: Typography
		$wp_customize->add_section( 'devportfolio_typography', [
			'title'    => __( 'Typography Settings', 'devportfolio' ),
			'priority' => 25,
		] );

		$wp_customize->add_setting( 'font_family_body', [
			'default'           => 'Vazirmatn',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'font_family_body', [
			'label'    => __( 'Body Font Family', 'devportfolio' ),
			'section'  => 'devportfolio_typography',
			'type'     => 'select',
            'choices'  => [
                'Vazirmatn' => 'Vazirmatn',
                'Inter'     => 'Inter',
                'Roboto'    => 'Roboto',
                'Sora'      => 'Sora'
            ]
		] );

		// Section: Colors & Skins
		$wp_customize->add_section( 'devportfolio_colors', [
			'title'    => __( 'Colors & Skins', 'devportfolio' ),
			'priority' => 30,
		] );

		$wp_customize->add_setting( 'primary_color', [
			'default'           => '#FFD700',
			'sanitize_callback' => 'sanitize_hex_color',
		] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'primary_color', [
			'label'    => __( 'Primary Brand Color', 'devportfolio' ),
			'section'  => 'devportfolio_colors',
		] ) );

        $wp_customize->add_setting( 'secondary_color', [
			'default'           => '#39FF14',
			'sanitize_callback' => 'sanitize_hex_color',
		] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'secondary_color', [
			'label'    => __( 'Secondary Accent Color', 'devportfolio' ),
			'section'  => 'devportfolio_colors',
		] ) );

        // Section: Layout & Footer
        $wp_customize->add_section( 'devportfolio_layout', [
			'title'    => __( 'Layout & Footer', 'devportfolio' ),
			'priority' => 40,
		] );

        $wp_customize->add_setting( 'footer_copyright', [
			'default'           => 'ALL RIGHTS RESERVED ©',
			'sanitize_callback' => 'sanitize_text_field',
		] );
        $wp_customize->add_control( 'footer_copyright', [
			'label'    => __( 'Footer Copyright Text', 'devportfolio' ),
			'section'  => 'devportfolio_layout',
            'type'     => 'text',
		] );

        $wp_customize->add_setting( 'portfolio_columns', [
			'default'           => '3',
			'sanitize_callback' => 'absint',
		] );
        $wp_customize->add_control( 'portfolio_columns', [
			'label'    => __( 'Portfolio Archive Columns', 'devportfolio' ),
			'section'  => 'devportfolio_layout',
            'type'     => 'select',
            'choices'  => [
                '1' => '1 Column',
                '2' => '2 Columns',
                '3' => '3 Columns',
                '4' => '4 Columns'
            ]
		] );

        // Section: Theme Features
        $wp_customize->add_section( 'devportfolio_features', [
			'title'    => __( 'Theme Features', 'devportfolio' ),
			'priority' => 50,
		] );

        $wp_customize->add_setting( 'enable_preloader', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
        $wp_customize->add_control( 'enable_preloader', [
			'label'    => __( 'Enable Preloader', 'devportfolio' ),
			'section'  => 'devportfolio_features',
            'type'     => 'checkbox',
		] );

        $wp_customize->add_setting( 'enable_scroll_reveal', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
        $wp_customize->add_control( 'enable_scroll_reveal', [
			'label'    => __( 'Enable Scroll Reveal Animations', 'devportfolio' ),
			'section'  => 'devportfolio_features',
            'type'     => 'checkbox',
		] );
	}

	public function render_css_variables() {
		$primary = get_theme_mod( 'primary_color', '#FFD700' );
        $secondary = get_theme_mod( 'secondary_color', '#39FF14' );
        $font_body = get_theme_mod( 'font_family_body', 'Vazirmatn' );

		?>
		<style id="devportfolio-dynamic-css">
			:root {
				--primary-color: <?php echo esc_html( $primary ); ?>;
                --secondary-color: <?php echo esc_html( $secondary ); ?>;
                --font-body: '<?php echo esc_html( $font_body ); ?>', sans-serif;
			}
            body { font-family: var(--font-body); }
            .bg-primary { background-color: var(--primary-color) !important; }
            .text-primary { color: var(--primary-color) !important; }
            .border-primary { border-color: var(--primary-color) !important; }
            .bg-secondary { background-color: var(--secondary-color) !important; }
            .text-secondary { color: var(--secondary-color) !important; }
		</style>
		<?php
	}
}
