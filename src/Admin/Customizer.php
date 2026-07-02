<?php
namespace DevPortfolio\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

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
		// Section: Typography (Vazirmatn only, size controls)
		$wp_customize->add_section( 'danial_typography', [
			'title'    => __( 'Typography', 'devportfolio' ),
			'priority' => 25,
		] );

		$wp_customize->add_setting( 'font_size_body', [
			'default'           => '16',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'font_size_body', [
			'label'    => __( 'Body Font Size (px)', 'devportfolio' ),
			'section'  => 'danial_typography',
			'type'     => 'number',
		] );

		$wp_customize->add_setting( 'font_size_h1', [
			'default'           => '48',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'font_size_h1', [
			'label'    => __( 'Heading H1 Size (px)', 'devportfolio' ),
			'section'  => 'danial_typography',
			'type'     => 'number',
		] );

		$wp_customize->add_setting( 'font_size_h2', [
			'default'           => '36',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'font_size_h2', [
			'label'    => __( 'Heading H2 Size (px)', 'devportfolio' ),
			'section'  => 'danial_typography',
			'type'     => 'number',
		] );

		$wp_customize->add_setting( 'line_height_body', [
			'default'           => '1.7',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'line_height_body', [
			'label'    => __( 'Body Line Height', 'devportfolio' ),
			'section'  => 'danial_typography',
			'type'     => 'text',
		] );

		// Section: Colors & Skins
		$wp_customize->add_section( 'danial_colors', [
			'title'    => __( 'Colors & Skins', 'devportfolio' ),
			'priority' => 30,
		] );

		$wp_customize->add_setting( 'primary_color', [
			'default'           => '#FFD700',
			'sanitize_callback' => 'sanitize_hex_color',
		] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'primary_color', [
			'label'    => __( 'Primary Brand Color', 'devportfolio' ),
			'section'  => 'danial_colors',
		] ) );

        $wp_customize->add_setting( 'secondary_color', [
			'default'           => '#39FF14',
			'sanitize_callback' => 'sanitize_hex_color',
		] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'secondary_color', [
			'label'    => __( 'Secondary Accent Color', 'devportfolio' ),
			'section'  => 'danial_colors',
		] ) );

		$wp_customize->add_setting( 'bg_color', [
			'default'           => '#131313',
			'sanitize_callback' => 'sanitize_hex_color',
		] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'bg_color', [
			'label'    => __( 'Background Color', 'devportfolio' ),
			'section'  => 'danial_colors',
		] ) );

		$wp_customize->add_setting( 'surface_darkest_color', [
			'default'           => '#0e0e0e',
			'sanitize_callback' => 'sanitize_hex_color',
		] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'surface_darkest_color', [
			'label'    => __( 'Darkest Surface Color', 'devportfolio' ),
			'section'  => 'danial_colors',
		] ) );

		$wp_customize->add_setting( 'surface_high_color', [
			'default'           => '#2a2a2a',
			'sanitize_callback' => 'sanitize_hex_color',
		] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'surface_high_color', [
			'label'    => __( 'High Surface Color', 'devportfolio' ),
			'section'  => 'danial_colors',
		] ) );

		$wp_customize->add_setting( 'border_color', [
			'default'           => '#262626',
			'sanitize_callback' => 'sanitize_hex_color',
		] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'border_color', [
			'label'    => __( 'Border Color', 'devportfolio' ),
			'section'  => 'danial_colors',
		] ) );

		// Section: Hero Settings
		$wp_customize->add_section( 'danial_hero', [
			'title'    => __( 'Hero Section', 'devportfolio' ),
			'priority' => 35,
		] );

		$wp_customize->add_setting( 'hero_title', [
			'default'           => 'برنامه‌نویسی با حالِ تو',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'hero_title', [
			'label'   => __( 'Hero Title', 'devportfolio' ),
			'section' => 'danial_hero',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'hero_bio', [
			'default'           => ' Danial Portfolio فضایی برای خلق نرم‌افزارهای مدرن با رویکردی نوآورانه. ما ایده‌های فنی شما را به کدهای تمیز و قابل مقیاس تبدیل می‌کنیم.',
			'sanitize_callback' => 'sanitize_textarea_field',
		] );
		$wp_customize->add_control( 'hero_bio', [
			'label'   => __( 'Hero Bio', 'devportfolio' ),
			'section' => 'danial_hero',
			'type'    => 'textarea',
		] );

		$wp_customize->add_setting( 'hero_cta_primary_text', [
			'default'           => 'شروع پروژه',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'hero_cta_primary_text', [
			'label'   => __( 'Primary CTA Text', 'devportfolio' ),
			'section' => 'danial_hero',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'hero_cta_primary_url', [
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( 'hero_cta_primary_url', [
			'label'   => __( 'Primary CTA URL', 'devportfolio' ),
			'section' => 'danial_hero',
			'type'    => 'url',
		] );

		$wp_customize->add_setting( 'hero_cta_secondary_text', [
			'default'           => 'مشاهده نمونه کارها',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'hero_cta_secondary_text', [
			'label'   => __( 'Secondary CTA Text', 'devportfolio' ),
			'section' => 'danial_hero',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'hero_cta_secondary_url', [
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( 'hero_cta_secondary_url', [
			'label'   => __( 'Secondary CTA URL', 'devportfolio' ),
			'section' => 'danial_hero',
			'type'    => 'url',
		] );

		$wp_customize->add_setting( 'show_hero_terminal', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_hero_terminal', [
			'label'   => __( 'Show Terminal in Hero', 'devportfolio' ),
			'section' => 'danial_hero',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'hero_text_position', [
			'default'           => 'right',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'hero_text_position', [
			'label'   => __( 'Hero Text Position', 'devportfolio' ),
			'section' => 'danial_hero',
			'type'    => 'select',
			'choices' => [
				'right' => 'Right (default)',
				'left'  => 'Left',
				'center'=> 'Center',
			],
		] );

		// Section: Layout & Footer
        $wp_customize->add_section( 'danial_layout', [
			'title'    => __( 'Layout & Footer', 'devportfolio' ),
			'priority' => 40,
		] );

        $wp_customize->add_setting( 'footer_copyright', [
			'default'           => 'ALL RIGHTS RESERVED',
			'sanitize_callback' => 'sanitize_text_field',
		] );
        $wp_customize->add_control( 'footer_copyright', [
			'label'    => __( 'Footer Copyright Text', 'devportfolio' ),
			'section'  => 'danial_layout',
            'type'     => 'text',
		] );

        $wp_customize->add_setting( 'portfolio_columns', [
			'default'           => '3',
			'sanitize_callback' => 'absint',
		] );
        $wp_customize->add_control( 'portfolio_columns', [
			'label'    => __( 'Portfolio Archive Columns', 'devportfolio' ),
			'section'  => 'danial_layout',
            'type'     => 'select',
            'choices'  => [
                '1' => '1 Column',
                '2' => '2 Columns',
                '3' => '3 Columns',
                '4' => '4 Columns'
            ]
		] );

		$wp_customize->add_setting( 'container_width', [
			'default'           => '1200',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'container_width', [
			'label'   => __( 'Container Max Width (px)', 'devportfolio' ),
			'section' => 'danial_layout',
			'type'    => 'number',
		] );

		// Section: Social Links
		$wp_customize->add_section( 'danial_social', [
			'title'    => __( 'Social Links', 'devportfolio' ),
			'priority' => 45,
		] );

		$wp_customize->add_setting( 'github_url', [
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( 'github_url', [
			'label'   => __( 'GitHub URL', 'devportfolio' ),
			'section' => 'danial_social',
			'type'    => 'url',
		] );

		$wp_customize->add_setting( 'github_handle', [
			'default'           => 'danialchoopan',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'github_handle', [
			'label'   => __( 'GitHub Username', 'devportfolio' ),
			'section' => 'danial_social',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'twitter_url', [
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( 'twitter_url', [
			'label'   => __( 'Twitter / X URL', 'devportfolio' ),
			'section' => 'danial_social',
			'type'    => 'url',
		] );

		$wp_customize->add_setting( 'linkedin_url', [
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( 'linkedin_url', [
			'label'   => __( 'LinkedIn URL', 'devportfolio' ),
			'section' => 'danial_social',
			'type'    => 'url',
		] );

		$wp_customize->add_setting( 'telegram_url', [
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( 'telegram_url', [
			'label'   => __( 'Telegram URL', 'devportfolio' ),
			'section' => 'danial_social',
			'type'    => 'url',
		] );

		// Section: Homepage Sections
		$wp_customize->add_section( 'danial_homepage', [
			'title'    => __( 'Homepage Sections', 'devportfolio' ),
			'priority' => 46,
		] );

		$wp_customize->add_setting( 'homepage_order', [
			'default'           => 'hero,skills,tech,stats,portfolio,blog',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'homepage_order', [
			'label'       => __( 'Section Order (comma-separated)', 'devportfolio' ),
			'description' => __( 'Available: hero, skills, tech, stats, portfolio, testimonials, cta, blog', 'devportfolio' ),
			'section'     => 'danial_homepage',
			'type'        => 'text',
		] );

		$wp_customize->add_setting( 'show_tech_section', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_tech_section', [
			'label'   => __( 'Show Tech/Services Section', 'devportfolio' ),
			'section' => 'danial_homepage',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'show_skills_section', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_skills_section', [
			'label'   => __( 'Show Skills Section', 'devportfolio' ),
			'section' => 'danial_homepage',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'show_stats_section', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_stats_section', [
			'label'   => __( 'Show Stats Section', 'devportfolio' ),
			'section' => 'danial_homepage',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'show_portfolio_section', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_portfolio_section', [
			'label'   => __( 'Show Portfolio Section', 'devportfolio' ),
			'section' => 'danial_homepage',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'show_blog_section', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_blog_section', [
			'label'   => __( 'Show Blog Section', 'devportfolio' ),
			'section' => 'danial_homepage',
			'type'    => 'checkbox',
		] );

		// Section: Stats
		$wp_customize->add_section( 'danial_stats', [
			'title'    => __( 'Stats Section', 'devportfolio' ),
			'priority' => 47,
		] );

		$wp_customize->add_setting( 'stat_1_number', [
			'default'           => '+120',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'stat_1_number', [
			'label'   => __( 'Stat 1 Number', 'devportfolio' ),
			'section' => 'danial_stats',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'stat_1_label', [
			'default'           => 'پروژه‌های موفق',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'stat_1_label', [
			'label'   => __( 'Stat 1 Label', 'devportfolio' ),
			'section' => 'danial_stats',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'stat_2_number', [
			'default'           => '45k',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'stat_2_number', [
			'label'   => __( 'Stat 2 Number', 'devportfolio' ),
			'section' => 'danial_stats',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'stat_2_label', [
			'default'           => 'خط کد پاک',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'stat_2_label', [
			'label'   => __( 'Stat 2 Label', 'devportfolio' ),
			'section' => 'danial_stats',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'stat_3_number', [
			'default'           => '+15',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'stat_3_number', [
			'label'   => __( 'Stat 3 Number', 'devportfolio' ),
			'section' => 'danial_stats',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'stat_3_label', [
			'default'           => 'تکنولوژی مورد استفاده',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'stat_3_label', [
			'label'   => __( 'Stat 3 Label', 'devportfolio' ),
			'section' => 'danial_stats',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'stat_4_number', [
			'default'           => '99%',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'stat_4_number', [
			'label'   => __( 'Stat 4 Number', 'devportfolio' ),
			'section' => 'danial_stats',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'stat_4_label', [
			'default'           => 'رضایت مشتریان',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'stat_4_label', [
			'label'   => __( 'Stat 4 Label', 'devportfolio' ),
			'section' => 'danial_stats',
			'type'    => 'text',
		] );

		// Section: Services
		$wp_customize->add_section( 'danial_services', [
			'title'    => __( 'Services Section', 'devportfolio' ),
			'priority' => 48,
		] );

		$wp_customize->add_setting( 'tech_section_subtitle', [
			'default' => 'خدمات ما',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'tech_section_subtitle', [
			'label' => __( 'Services Subtitle', 'devportfolio' ),
			'section' => 'danial_services',
			'type' => 'text',
		] );

		$wp_customize->add_setting( 'tech_section_title', [
			'default' => 'پکیج‌های تخصصی',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'tech_section_title', [
			'label' => __( 'Services Title', 'devportfolio' ),
			'section' => 'danial_services',
			'type' => 'text',
		] );

		for ( $i = 1; $i <= 4; $i++ ) {
			$wp_customize->add_setting( "service_{$i}_title", [
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field',
			] );
			$wp_customize->add_control( "service_{$i}_title", [
				'label' => sprintf( __( 'Service %d Title', 'devportfolio' ), $i ),
				'section' => 'danial_services',
				'type' => 'text',
			] );

			$wp_customize->add_setting( "service_{$i}_desc", [
				'default' => '',
				'sanitize_callback' => 'sanitize_textarea_field',
			] );
			$wp_customize->add_control( "service_{$i}_desc", [
				'label' => sprintf( __( 'Service %d Description', 'devportfolio' ), $i ),
				'section' => 'danial_services',
				'type' => 'textarea',
			] );
		}

		// Section: Theme Features
        $wp_customize->add_section( 'danial_features', [
			'title'    => __( 'Theme Features', 'devportfolio' ),
			'priority' => 50,
		] );

        $wp_customize->add_setting( 'enable_preloader', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
        $wp_customize->add_control( 'enable_preloader', [
			'label'    => __( 'Enable Preloader', 'devportfolio' ),
			'section'  => 'danial_features',
            'type'     => 'checkbox',
		] );

        $wp_customize->add_setting( 'enable_scroll_reveal', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
        $wp_customize->add_control( 'enable_scroll_reveal', [
			'label'    => __( 'Enable Scroll Reveal Animations', 'devportfolio' ),
			'section'  => 'danial_features',
            'type'     => 'checkbox',
		] );

		$wp_customize->add_setting( 'enable_code_highlight', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'enable_code_highlight', [
			'label'    => __( 'Enable Code Syntax Highlighting', 'devportfolio' ),
			'section'  => 'danial_features',
            'type'     => 'checkbox',
		] );

		// ── Testimonials Section ────────────────────────────────────
		$wp_customize->add_section( 'danial_testimonials', [
			'title'    => __( 'Testimonials Section', 'devportfolio' ),
			'priority' => 52,
		] );

		$wp_customize->add_setting( 'show_testimonials_section', [
			'default'           => false,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_testimonials_section', [
			'label'   => __( 'Show Testimonials on Homepage', 'devportfolio' ),
			'section' => 'danial_testimonials',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'testimonials_subtitle', [
			'default'           => 'نظرات مشتریان',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'testimonials_subtitle', [
			'label'   => __( 'Testimonials Subtitle', 'devportfolio' ),
			'section' => 'danial_testimonials',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'testimonials_title', [
			'default'           => 'چه می‌گویند',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'testimonials_title', [
			'label'   => __( 'Testimonials Title', 'devportfolio' ),
			'section' => 'danial_testimonials',
			'type'    => 'text',
		] );

		// ── CTA Section ─────────────────────────────────────────────
		$wp_customize->add_section( 'danial_cta', [
			'title'    => __( 'Call to Action Section', 'devportfolio' ),
			'priority' => 54,
		] );

		$wp_customize->add_setting( 'show_cta_section', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_cta_section', [
			'label'   => __( 'Show CTA on Homepage', 'devportfolio' ),
			'section' => 'danial_cta',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'cta_title', [
			'default'           => 'آماده‌اید پروژه بعدی را شروع کنیم؟',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'cta_title', [
			'label'   => __( 'CTA Title', 'devportfolio' ),
			'section' => 'danial_cta',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'cta_description', [
			'default'           => 'بیایید با هم یک نرم‌افزار فوق‌العاده بسازیم. همین الان تماس بگیرید.',
			'sanitize_callback' => 'sanitize_textarea_field',
		] );
		$wp_customize->add_control( 'cta_description', [
			'label'   => __( 'CTA Description', 'devportfolio' ),
			'section' => 'danial_cta',
			'type'    => 'textarea',
		] );

		$wp_customize->add_setting( 'cta_button_text', [
			'default'           => 'شروع پروژه',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'cta_button_text', [
			'label'   => __( 'CTA Button Text', 'devportfolio' ),
			'section' => 'danial_cta',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'cta_button_url', [
			'default'           => '#contact',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( 'cta_button_url', [
			'label'   => __( 'CTA Button URL', 'devportfolio' ),
			'section' => 'danial_cta',
			'type'    => 'url',
		] );

		// ── 404 Page Settings ───────────────────────────────────────
		$wp_customize->add_section( 'danial_404', [
			'title'    => __( '404 Page', 'devportfolio' ),
			'priority' => 56,
		] );

		$wp_customize->add_setting( '404_title', [
			'default'           => '404',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( '404_title', [
			'label'   => __( '404 Page Title', 'devportfolio' ),
			'section' => 'danial_404',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( '404_message', [
			'default'           => 'صفحه مورد نظر یافت نشد.',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( '404_message', [
			'label'   => __( '404 Page Message', 'devportfolio' ),
			'section' => 'danial_404',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( '404_home_button', [
			'default'           => 'بازگشت به صفحه اصلی',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( '404_home_button', [
			'label'   => __( 'Back to Home Button', 'devportfolio' ),
			'section' => 'danial_404',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( '404_back_button', [
			'default'           => 'بازگشت',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( '404_back_button', [
			'label'   => __( 'Go Back Button', 'devportfolio' ),
			'section' => 'danial_404',
			'type'    => 'text',
		] );

		// ── Blog Section ──────────────────────────────────────────────
		$wp_customize->add_section( 'danial_blog', [
			'title'    => __( 'Blog Section', 'devportfolio' ),
			'priority' => 58,
		] );

		$wp_customize->add_setting( 'blog_subtitle', [
			'default'           => 'آخرین نوشته‌ها',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_subtitle', [
			'label'   => __( 'Blog Subtitle', 'devportfolio' ),
			'section' => 'danial_blog',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'blog_title', [
			'default'           => 'وبلاگ فنی',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_title', [
			'label'   => __( 'Blog Title', 'devportfolio' ),
			'section' => 'danial_blog',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'blog_posts_per_page', [
			'default'           => '4',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'blog_posts_per_page', [
			'label'   => __( 'Posts per Page', 'devportfolio' ),
			'section' => 'danial_blog',
			'type'    => 'number',
		] );

		// ── Blog Archive Page ──────────────────────────────────────────
		$wp_customize->add_section( 'danial_blog_archive', [
			'title'    => __( 'Blog Archive Page', 'devportfolio' ),
			'priority' => 59,
		] );

		$wp_customize->add_setting( 'blog_archive_title', [
			'default'           => 'وبلاگ فنی',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_archive_title', [
			'label'   => __( 'Archive Page Title', 'devportfolio' ),
			'section' => 'danial_blog_archive',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'blog_archive_subtitle', [
			'default'           => 'آرشیو مطالب',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_archive_subtitle', [
			'label'   => __( 'Archive Page Subtitle', 'devportfolio' ),
			'section' => 'danial_blog_archive',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'blog_search_placeholder', [
			'default'           => 'جستجو در مطالب...',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_search_placeholder', [
			'label'   => __( 'Search Placeholder', 'devportfolio' ),
			'section' => 'danial_blog_archive',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'blog_categories_label', [
			'default'           => 'دسته‌بندی‌ها',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_categories_label', [
			'label'   => __( 'Categories Label', 'devportfolio' ),
			'section' => 'danial_blog_archive',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'blog_search_label', [
			'default'           => 'جستجو',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_search_label', [
			'label'   => __( 'Search Button Label', 'devportfolio' ),
			'section' => 'danial_blog_archive',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'blog_read_more_text', [
			'default'           => 'مطالعه کامل',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_read_more_text', [
			'label'   => __( 'Read More Text', 'devportfolio' ),
			'section' => 'danial_blog_archive',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'blog_reading_time_label', [
			'default'           => 'دقیقه مطالعه',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_reading_time_label', [
			'label'   => __( 'Reading Time Label', 'devportfolio' ),
			'section' => 'danial_blog_archive',
			'type'    => 'text',
		] );

		// ── Single Post Settings ──────────────────────────────────────
		$wp_customize->add_section( 'danial_single_post', [
			'title'    => __( 'Single Post', 'devportfolio' ),
			'priority' => 59,
		] );

		$wp_customize->add_setting( 'single_reading_time_label', [
			'default'           => 'MIN_READ',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'single_reading_time_label', [
			'label'   => __( 'Reading Time Label (e.g. MIN_READ)', 'devportfolio' ),
			'section' => 'danial_single_post',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'single_prev_text', [
			'default'           => 'PREVIOUS_LOG',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'single_prev_text', [
			'label'   => __( 'Previous Post Label', 'devportfolio' ),
			'section' => 'danial_single_post',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'single_next_text', [
			'default'           => 'NEXT_LOG',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'single_next_text', [
			'label'   => __( 'Next Post Label', 'devportfolio' ),
			'section' => 'danial_single_post',
			'type'    => 'text',
		] );

		// ── Single Portfolio Settings ─────────────────────────────────
		$wp_customize->add_section( 'danial_single_portfolio', [
			'title'    => __( 'Single Portfolio', 'devportfolio' ),
			'priority' => 60,
		] );

		$wp_customize->add_setting( 'portfolio_context_label', [
			'default'           => '// PROJECT_CONTEXT',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'portfolio_context_label', [
			'label'   => __( 'Project Context Label', 'devportfolio' ),
			'section' => 'danial_single_portfolio',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'portfolio_stack_label', [
			'default'           => 'Stack',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'portfolio_stack_label', [
			'label'   => __( 'Stack Section Label', 'devportfolio' ),
			'section' => 'danial_single_portfolio',
			'type'    => 'text',
		] );

		// ── Header Section ─────────────────────────────────────────────
		$wp_customize->add_section( 'danial_header', [
			'title'    => __( 'Header Settings', 'devportfolio' ),
			'priority' => 60,
		] );

		$wp_customize->add_setting( 'header_button_text', [
			'default'           => 'HIRE_ME',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'header_button_text', [
			'label'   => __( 'Header CTA Button Text', 'devportfolio' ),
			'section' => 'danial_header',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'header_button_url', [
			'default'           => '#contact',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( 'header_button_url', [
			'label'   => __( 'Header CTA Button URL', 'devportfolio' ),
			'section' => 'danial_header',
			'type'    => 'url',
		] );

		$wp_customize->add_setting( 'show_header_cta', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_header_cta', [
			'label'   => __( 'Show Header CTA Button', 'devportfolio' ),
			'section' => 'danial_header',
			'type'    => 'checkbox',
		] );

		// ── Footer Section ─────────────────────────────────────────────
		$wp_customize->add_section( 'danial_footer', [
			'title'    => __( 'Footer Settings', 'devportfolio' ),
			'priority' => 62,
		] );

		$wp_customize->add_setting( 'footer_description', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		] );
		$wp_customize->add_control( 'footer_description', [
			'label'       => __( 'Footer Description', 'devportfolio' ),
			'description' => __( 'Shown below the site name in footer. Leave empty for site tagline.', 'devportfolio' ),
			'section'     => 'danial_footer',
			'type'        => 'textarea',
		] );

		$wp_customize->add_setting( 'show_footer_nav', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_footer_nav', [
			'label'   => __( 'Show Navigation in Footer', 'devportfolio' ),
			'section' => 'danial_footer',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'footer_back_to_top_text', [
			'default'           => 'Back_to_top',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'footer_back_to_top_text', [
			'label'   => __( 'Back to Top Text', 'devportfolio' ),
			'section' => 'danial_footer',
			'type'    => 'text',
		] );

		// ── Portfolio Section ───────────────────────────────────────────
		$wp_customize->add_section( 'danial_portfolio', [
			'title'    => __( 'Portfolio Section', 'devportfolio' ),
			'priority' => 64,
		] );

		$wp_customize->add_setting( 'portfolio_subtitle', [
			'default'           => 'گزیده آثار',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'portfolio_subtitle', [
			'label'   => __( 'Portfolio Subtitle', 'devportfolio' ),
			'section' => 'danial_portfolio',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'portfolio_title', [
			'default'           => 'پروژه‌های اخیر',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'portfolio_title', [
			'label'   => __( 'Portfolio Title', 'devportfolio' ),
			'section' => 'danial_portfolio',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'portfolio_items_count', [
			'default'           => '-1',
			'sanitize_callback' => 'intval',
		] );
		$wp_customize->add_control( 'portfolio_items_count', [
			'label'       => __( 'Portfolio Items Count', 'devportfolio' ),
			'description' => __( 'Set to -1 to show all items', 'devportfolio' ),
			'label'   => __( 'Portfolio Items Count', 'devportfolio' ),
			'section' => 'danial_portfolio',
			'type'    => 'number',
		] );

		$wp_customize->add_setting( 'portfolio_view_all_text', [
			'default'           => 'مشاهده همه',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'portfolio_view_all_text', [
			'label'   => __( 'View All Button Text', 'devportfolio' ),
			'section' => 'danial_portfolio',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'portfolio_view_all_url', [
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( 'portfolio_view_all_url', [
			'label'   => __( 'View All Button URL', 'devportfolio' ),
			'section' => 'danial_portfolio',
			'type'    => 'url',
		] );

		// ══════════════════════════════════════════════════════════════
		// NEW SECTIONS — More user control
		// ══════════════════════════════════════════════════════════════

		// ── Branding & Logo ─────────────────────────────────────────
		$wp_customize->add_section( 'danial_branding', [
			'title'    => __( 'Branding & Logo', 'devportfolio' ),
			'priority' => 20,
		] );

		$wp_customize->add_setting( 'site_logo', [
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'site_logo', [
			'label'   => __( 'Site Logo Image', 'devportfolio' ),
			'section' => 'danial_branding',
		] ) );

		$wp_customize->add_setting( 'logo_width', [
			'default'           => '120',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'logo_width', [
			'label'   => __( 'Logo Max Width (px)', 'devportfolio' ),
			'section' => 'danial_branding',
			'type'    => 'number',
		] );

		$wp_customize->add_setting( 'show_tagline', [
			'default'           => false,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_tagline', [
			'label'   => __( 'Show Site Tagline in Header', 'devportfolio' ),
			'section' => 'danial_branding',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'favicon_icon', [
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'favicon_icon', [
			'label'   => __( 'Favicon / Site Icon', 'devportfolio' ),
			'section' => 'danial_branding',
		] ) );

		// ── Header Advanced ─────────────────────────────────────────
		$wp_customize->add_section( 'danial_header_adv', [
			'title'    => __( 'Header Advanced', 'devportfolio' ),
			'priority' => 61,
		] );

		$wp_customize->add_setting( 'header_height', [
			'default'           => '80',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'header_height', [
			'label'   => __( 'Header Height (px)', 'devportfolio' ),
			'section' => 'danial_header_adv',
			'type'    => 'number',
		] );

		$wp_customize->add_setting( 'header_bg_opacity', [
			'default'           => '80',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'header_bg_opacity', [
			'label'       => __( 'Header Background Opacity (%)', 'devportfolio' ),
			'description' => __( '0 = transparent, 100 = fully opaque', 'devportfolio' ),
			'section'     => 'danial_header_adv',
			'type'        => 'number',
		] );

		$wp_customize->add_setting( 'header_border', [
			'default'           => 'true',
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'header_border', [
			'label'   => __( 'Show Header Bottom Border', 'devportfolio' ),
			'section' => 'danial_header_adv',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'header_blur', [
			'default'           => 'true',
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'header_blur', [
			'label'   => __( 'Header Backdrop Blur', 'devportfolio' ),
			'section' => 'danial_header_adv',
			'type'    => 'checkbox',
		] );

		// ── Hero Advanced ───────────────────────────────────────────
		$wp_customize->add_section( 'danial_hero_adv', [
			'title'    => __( 'Hero Advanced', 'devportfolio' ),
			'priority' => 36,
		] );

		$wp_customize->add_setting( 'hero_min_height', [
			'default'           => '90',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'hero_min_height', [
			'label'   => __( 'Hero Min Height (vh)', 'devportfolio' ),
			'section' => 'danial_hero_adv',
			'type'    => 'number',
		] );

		$wp_customize->add_setting( 'hero_animation_speed', [
			'default'           => '180',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'hero_animation_speed', [
			'label'       => __( 'Terminal Line Speed (ms)', 'devportfolio' ),
			'description' => __( 'Milliseconds between each line appearing', 'devportfolio' ),
			'section'     => 'danial_hero_adv',
			'type'        => 'number',
		] );

		$wp_customize->add_setting( 'hero_particles_count', [
			'default'           => '20',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'hero_particles_count', [
			'label'   => __( 'Floating Particles Count', 'devportfolio' ),
			'section' => 'danial_hero_adv',
			'type'    => 'number',
		] );

		$wp_customize->add_setting( 'hero_show_particles', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'hero_show_particles', [
			'label'   => __( 'Show Floating Particles', 'devportfolio' ),
			'section' => 'danial_hero_adv',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'hero_show_glow', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'hero_show_glow', [
			'label'   => __( 'Show Ambient Glow Orbs', 'devportfolio' ),
			'section' => 'danial_hero_adv',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'hero_show_scanline', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'hero_show_scanline', [
			'label'   => __( 'Show Terminal Scanline Effect', 'devportfolio' ),
			'section' => 'danial_hero_adv',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'hero_show_glitch', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'hero_show_glitch', [
			'label'   => __( 'Show Title Glitch Effect', 'devportfolio' ),
			'section' => 'danial_hero_adv',
			'type'    => 'checkbox',
		] );

		// ── Terminal Code Lines ─────────────────────────────────────
		$wp_customize->add_section( 'danial_terminal', [
			'title'    => __( 'Terminal Code', 'devportfolio' ),
			'priority' => 37,
		] );

		for ( $i = 1; $i <= 12; $i++ ) {
			$wp_customize->add_setting( "terminal_line_{$i}", [
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			] );
			$wp_customize->add_control( "terminal_line_{$i}", [
				'label' => sprintf( __( 'Line %d', 'devportfolio' ), $i ),
				'section' => 'danial_terminal',
				'type'    => 'text',
			] );
		}

		// ── Skills Section ────────────────────────────────────────────
		$wp_customize->add_section( 'danial_skills', [
			'title'    => __( 'Skills Section', 'devportfolio' ),
			'priority' => 38,
		] );

		$wp_customize->add_setting( 'skills_subtitle', [
			'default'           => 'مهارت‌های فنی',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'skills_subtitle', [
			'label'   => __( 'Skills Subtitle', 'devportfolio' ),
			'section' => 'danial_skills',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'skills_title', [
			'default'           => 'تکنولوژی‌ها و ابزارها',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'skills_title', [
			'label'   => __( 'Skills Title', 'devportfolio' ),
			'section' => 'danial_skills',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'skills_terminal_title', [
			'default'           => 'skills.sh — ~/danial',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'skills_terminal_title', [
			'label'   => __( 'Terminal Window Title', 'devportfolio' ),
			'section' => 'danial_skills',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'skills_columns', [
			'default'           => '2',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'skills_columns', [
			'label'   => __( 'Columns (1 or 2)', 'devportfolio' ),
			'section' => 'danial_skills',
			'type'    => 'select',
			'choices' => [
				'1' => '1 Column',
				'2' => '2 Columns',
			],
		] );

		for ( $i = 1; $i <= 12; $i++ ) {
			$wp_customize->add_setting( "skill_{$i}_name", [
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			] );
			$wp_customize->add_control( "skill_{$i}_name", [
				'label' => sprintf( __( 'Skill %d Name', 'devportfolio' ), $i ),
				'section' => 'danial_skills',
				'type'    => 'text',
			] );

			$wp_customize->add_setting( "skill_{$i}_level", [
				'default'           => '80',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( "skill_{$i}_level", [
				'label' => sprintf( __( 'Skill %d Level (0-100)', 'devportfolio' ), $i ),
				'section' => 'danial_skills',
				'type'    => 'number',
			] );

			$wp_customize->add_setting( "skill_{$i}_color", [
				'default'           => '',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, "skill_{$i}_color", [
				'label' => sprintf( __( 'Skill %d Color (empty = primary)', 'devportfolio' ), $i ),
				'section' => 'danial_skills',
			] ) );
		}

		// ── Footer Advanced ─────────────────────────────────────────
		$wp_customize->add_section( 'danial_footer_adv', [
			'title'    => __( 'Footer Advanced', 'devportfolio' ),
			'priority' => 63,
		] );

		$wp_customize->add_setting( 'footer_columns', [
			'default'           => '4',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'footer_columns', [
			'label'   => __( 'Footer Grid Columns', 'devportfolio' ),
			'section' => 'danial_footer_adv',
			'type'    => 'select',
			'choices' => [ '2' => '2', '3' => '3', '4' => '4' ],
		] );

		$wp_customize->add_setting( 'footer_bg_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
		] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', [
			'label'   => __( 'Footer Background (empty = same as body)', 'devportfolio' ),
			'section' => 'danial_footer_adv',
		] ) );

		$wp_customize->add_setting( 'footer_padding', [
			'default'           => '80',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'footer_padding', [
			'label'   => __( 'Footer Top Padding (px)', 'devportfolio' ),
			'section' => 'danial_footer_adv',
			'type'    => 'number',
		] );

		$wp_customize->add_setting( 'show_footer_social', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_footer_social', [
			'label'   => __( 'Show Social Links in Footer', 'devportfolio' ),
			'section' => 'danial_footer_adv',
			'type'    => 'checkbox',
		] );

		// ── Contact Form Settings ───────────────────────────────────
		$wp_customize->add_section( 'danial_contact', [
			'title'    => __( 'Contact Form', 'devportfolio' ),
			'priority' => 65,
		] );

		$wp_customize->add_setting( 'contact_success_msg', [
			'default'           => 'پیام شما با موفقیت ارسال شد!',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'contact_success_msg', [
			'label'   => __( 'Success Message', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'contact_error_msg', [
			'default'           => 'خطایی رخ داده. لطفاً دوباره تلاش کنید.',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'contact_error_msg', [
			'label'   => __( 'Error Message', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'contact_sending_msg', [
			'default'           => 'در حال ارسال...',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'contact_sending_msg', [
			'label'   => __( 'Sending Message', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'contact_name_label', [
			'default'           => 'نام شما',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'contact_name_label', [
			'label'   => __( 'Name Field Label', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'contact_email_label', [
			'default'           => 'ایمیل',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'contact_email_label', [
			'label'   => __( 'Email Field Label', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'contact_subject_label', [
			'default'           => 'موضوع',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'contact_subject_label', [
			'label'   => __( 'Subject Field Label', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'contact_message_label', [
			'default'           => 'پیام',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'contact_message_label', [
			'label'   => __( 'Message Field Label', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'contact_submit_text', [
			'default'           => 'ارسال پیام',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'contact_submit_text', [
			'label'   => __( 'Submit Button Text', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'contact_page_title', [
			'default'           => 'ارتباط با ما',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'contact_page_title', [
			'label'   => __( 'Contact Page Title', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'contact_page_subtitle', [
			'default'           => 'بیایید متصل شویم',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'contact_page_subtitle', [
			'label'   => __( 'Contact Page Subtitle', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'contact_page_description', [
			'default'           => 'پروژه‌ای در ذهن دارید؟ یا فقط می‌خواهید سلام کنید؟ من همیشه آماده بحث در مورد تکنولوژی‌های جدید و همکاری‌های هیجان‌انگیز هستم.',
			'sanitize_callback' => 'sanitize_textarea_field',
		] );
		$wp_customize->add_control( 'contact_page_description', [
			'label'   => __( 'Contact Page Description', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'textarea',
		] );

		$wp_customize->add_setting( 'contact_social_title', [
			'default'           => 'شبکه‌های اجتماعی',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'contact_social_title', [
			'label'   => __( 'Social Media Title', 'devportfolio' ),
			'section' => 'danial_contact',
			'type'    => 'text',
		] );

		// ── About Page Settings ─────────────────────────────────────
		$wp_customize->add_section( 'danial_about', [
			'title'    => __( 'About Page', 'devportfolio' ),
			'priority' => 66,
		] );

		$wp_customize->add_setting( 'about_subtitle', [
			'default'           => 'درباره ما',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'about_subtitle', [
			'label'   => __( 'About Subtitle', 'devportfolio' ),
			'section' => 'danial_about',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'about_description', [
			'default'           => 'ما یک تیم کوچک اما قدرتمند از توسعه‌دهندگان ارشد هستیم.',
			'sanitize_callback' => 'sanitize_textarea_field',
		] );
		$wp_customize->add_control( 'about_description', [
			'label'   => __( 'About Description (below title)', 'devportfolio' ),
			'section' => 'danial_about',
			'type'    => 'textarea',
		] );

		$wp_customize->add_setting( 'about_avatar', [
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'about_avatar', [
			'label'   => __( 'About Page Avatar', 'devportfolio' ),
			'section' => 'danial_about',
		] ) );

		// ── Floating WhatsApp Button ────────────────────────────────
		$wp_customize->add_section( 'danial_whatsapp', [
			'title'    => __( 'WhatsApp Button', 'devportfolio' ),
			'priority' => 67,
		] );

		$wp_customize->add_setting( 'show_whatsapp', [
			'default'           => false,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'show_whatsapp', [
			'label'   => __( 'Show WhatsApp Floating Button', 'devportfolio' ),
			'section' => 'danial_whatsapp',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'whatsapp_number', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'whatsapp_number', [
			'label'       => __( 'WhatsApp Phone Number', 'devportfolio' ),
			'description' => __( 'With country code, e.g. 989121234567', 'devportfolio' ),
			'section'     => 'danial_whatsapp',
			'type'        => 'text',
		] );

		$wp_customize->add_setting( 'whatsapp_message', [
			'default'           => 'سلام، می‌خواهم در مورد پروژه صحبت کنم.',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'whatsapp_message', [
			'label'   => __( 'Default WhatsApp Message', 'devportfolio' ),
			'section' => 'danial_whatsapp',
			'type'    => 'text',
		] );

		// ── Custom Code Injection ───────────────────────────────────
		$wp_customize->add_section( 'danial_custom_code', [
			'title'    => __( 'Custom Code', 'devportfolio' ),
			'priority' => 68,
		] );

		$wp_customize->add_setting( 'custom_head_code', [
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		] );
		$wp_customize->add_control( 'custom_head_code', [
			'label'       => __( 'Custom Code in <head>', 'devportfolio' ),
			'description' => __( 'For analytics, meta tags, verification codes. HTML allowed.', 'devportfolio' ),
			'section'     => 'danial_custom_code',
			'type'        => 'textarea',
		] );

		$wp_customize->add_setting( 'custom_footer_code', [
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		] );
		$wp_customize->add_control( 'custom_footer_code', [
			'label'       => __( 'Custom Code before </body>', 'devportfolio' ),
			'description' => __( 'For scripts, chat widgets, etc. HTML allowed.', 'devportfolio' ),
			'section'     => 'danial_custom_code',
			'type'        => 'textarea',
		] );

		// ── Custom CSS ──────────────────────────────────────────────
		$wp_customize->add_section( 'danial_custom_css', [
			'title'    => __( 'Custom CSS', 'devportfolio' ),
			'priority' => 69,
		] );

		$wp_customize->add_setting( 'custom_css_code', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'custom_css_code', [
			'label'       => __( 'Custom CSS', 'devportfolio' ),
			'description' => __( 'Add your own CSS rules. No need for <style> tags.', 'devportfolio' ),
			'section'     => 'danial_custom_css',
			'type'        => 'textarea',
		] );

		// ── Animation Speed ─────────────────────────────────────────
		$wp_customize->add_section( 'danial_animations', [
			'title'    => __( 'Animation Speed', 'devportfolio' ),
			'priority' => 70,
		] );

		$wp_customize->add_setting( 'anim_scroll_reveal', [
			'default'           => '700',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'anim_scroll_reveal', [
			'label'       => __( 'Scroll Reveal Duration (ms)', 'devportfolio' ),
			'description' => __( 'How long each reveal animation takes', 'devportfolio' ),
			'section'     => 'danial_animations',
			'type'        => 'number',
		] );

		$wp_customize->add_setting( 'anim_preloader_duration', [
			'default'           => '1800',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'anim_preloader_duration', [
			'label'       => __( 'Preloader Duration (ms)', 'devportfolio' ),
			'description' => __( 'How long the preloader stays visible', 'devportfolio' ),
			'section'     => 'danial_animations',
			'type'        => 'number',
		] );

		$wp_customize->add_setting( 'anim_counter_speed', [
			'default'           => '25',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'anim_counter_speed', [
			'label'       => __( 'Counter Animation Speed (ms)', 'devportfolio' ),
			'description' => __( 'Milliseconds between each count step', 'devportfolio' ),
			'section'     => 'danial_animations',
			'type'        => 'number',
		] );

		$wp_customize->add_setting( 'enable_particles', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'enable_particles', [
			'label'   => __( 'Enable Floating Particles Globally', 'devportfolio' ),
			'section' => 'danial_animations',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'enable_ambient_glow', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'enable_ambient_glow', [
			'label'   => __( 'Enable Ambient Glow Orbs', 'devportfolio' ),
			'section' => 'danial_animations',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'enable_glitch_effect', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'enable_glitch_effect', [
			'label'   => __( 'Enable Glitch Text Effect', 'devportfolio' ),
			'section' => 'danial_animations',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'enable_scanline', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'enable_scanline', [
			'label'   => __( 'Enable CRT Scanline Effect', 'devportfolio' ),
			'section' => 'danial_animations',
			'type'    => 'checkbox',
		] );

		// ── Portfolio Advanced ──────────────────────────────────────
		$wp_customize->add_section( 'danial_portfolio_adv', [
			'title'    => __( 'Portfolio Advanced', 'devportfolio' ),
			'priority' => 71,
		] );

		$wp_customize->add_setting( 'portfolio_image_ratio', [
			'default'           => '4/5',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'portfolio_image_ratio', [
			'label'   => __( 'Portfolio Image Aspect Ratio', 'devportfolio' ),
			'section' => 'danial_portfolio_adv',
			'type'    => 'select',
			'choices' => [
				'16/9' => '16:9 (Widescreen)',
				'4/3'  => '4:3 (Standard)',
				'4/5'  => '4:5 (Portrait)',
				'1/1'  => '1:1 (Square)',
			],
		] );

		$wp_customize->add_setting( 'portfolio_hover_effect', [
			'default'           => 'grayscale',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'portfolio_hover_effect', [
			'label'   => __( 'Portfolio Image Hover Effect', 'devportfolio' ),
			'section' => 'danial_portfolio_adv',
			'type'    => 'select',
			'choices' => [
				'grayscale' => 'Grayscale to Color',
				'scale'     => 'Scale Up',
				'zoom'      => 'Zoom + Overlay',
				'none'      => 'None',
			],
		] );

		$wp_customize->add_setting( 'portfolio_show_excerpt', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'portfolio_show_excerpt', [
			'label'   => __( 'Show Excerpt on Portfolio Cards', 'devportfolio' ),
			'section' => 'danial_portfolio_adv',
			'type'    => 'checkbox',
		] );

		// ── Blog Advanced ───────────────────────────────────────────
		$wp_customize->add_section( 'danial_blog_adv', [
			'title'    => __( 'Blog Advanced', 'devportfolio' ),
			'priority' => 72,
		] );

		$wp_customize->add_setting( 'blog_excerpt_length', [
			'default'           => '20',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( 'blog_excerpt_length', [
			'label'   => __( 'Excerpt Word Count', 'devportfolio' ),
			'section' => 'danial_blog_adv',
			'type'    => 'number',
		] );

		$wp_customize->add_setting( 'blog_read_more_text', [
			'default'           => 'مطالعه کامل',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_read_more_text', [
			'label'   => __( 'Read More Text', 'devportfolio' ),
			'section' => 'danial_blog_adv',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'blog_show_author', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'blog_show_author', [
			'label'   => __( 'Show Author Name', 'devportfolio' ),
			'section' => 'danial_blog_adv',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'blog_show_reading_time', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'blog_show_reading_time', [
			'label'   => __( 'Show Reading Time', 'devportfolio' ),
			'section' => 'danial_blog_adv',
			'type'    => 'checkbox',
		] );

		$wp_customize->add_setting( 'blog_show_categories', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		] );
		$wp_customize->add_control( 'blog_show_categories', [
			'label'   => __( 'Show Categories', 'devportfolio' ),
			'section' => 'danial_blog_adv',
			'type'    => 'checkbox',
		] );

		// ── Home Blog Section Text ───────────────────────────────────
		$wp_customize->add_section( 'danial_home_blog_text', [
			'title'    => __( 'Blog Section Text', 'devportfolio' ),
			'priority' => 73,
		] );

		$wp_customize->add_setting( 'blog_featured_label', [
			'default'           => 'نوشته ویژه',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_featured_label', [
			'label'   => __( 'Featured Post Label', 'devportfolio' ),
			'section' => 'danial_home_blog_text',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'blog_read_more_link', [
			'default'           => 'مطالعه ادامه مطلب',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_read_more_link', [
			'label'   => __( 'Read More Link Text', 'devportfolio' ),
			'section' => 'danial_home_blog_text',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'blog_minutes_reading', [
			'default'           => 'دقیقه مطالعه',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'blog_minutes_reading', [
			'label'   => __( 'Minutes Reading Label', 'devportfolio' ),
			'section' => 'danial_home_blog_text',
			'type'    => 'text',
		] );

		// ── Home Portfolio Section Text ──────────────────────────────
		$wp_customize->add_section( 'danial_home_portfolio_text', [
			'title'    => __( 'Portfolio Section Text', 'devportfolio' ),
			'priority' => 74,
		] );

		$wp_customize->add_setting( 'portfolio_view_details', [
			'default'           => 'مشاهده جزئیات',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'portfolio_view_details', [
			'label'   => __( 'View Details Text', 'devportfolio' ),
			'section' => 'danial_home_portfolio_text',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'portfolio_sample_prefix', [
			'default'           => 'پروژه نمونه شماره',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'portfolio_sample_prefix', [
			'label'   => __( 'Sample Project Prefix', 'devportfolio' ),
			'section' => 'danial_home_portfolio_text',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'portfolio_coming_soon', [
			'default'           => 'در حال آماده‌سازی برای نمایش...',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'portfolio_coming_soon', [
			'label'   => __( 'Coming Soon Text', 'devportfolio' ),
			'section' => 'danial_home_portfolio_text',
			'type'    => 'text',
		] );

		// ── Social Meta (SEO) ──────────────────────────────────────
		$wp_customize->add_section( 'danial_social_meta', [
			'title'    => __( 'Social Sharing (SEO)', 'devportfolio' ),
			'priority' => 73,
		] );

		$wp_customize->add_setting( 'og_default_image', [
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'og_default_image', [
			'label'   => __( 'Default Share Image (OG Image)', 'devportfolio' ),
			'section' => 'danial_social_meta',
		] ) );

		$wp_customize->add_setting( 'og_default_description', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		] );
		$wp_customize->add_control( 'og_default_description', [
			'label'   => __( 'Default Share Description', 'devportfolio' ),
			'section' => 'danial_social_meta',
			'type'    => 'textarea',
		] );
	}

	/**
	 * Render dynamic CSS variables from Customizer settings.
	 *
	 * Outputs a <style> block in <head> that overrides Tailwind colors
	 * based on user's Customizer selections. This allows full color
	 * customization without rebuilding Tailwind.
	 */
	public function render_css_variables() {
		$primary         = get_theme_mod( 'primary_color', '#FFD700' );
		$secondary       = get_theme_mod( 'secondary_color', '#39FF14' );
		$bg              = get_theme_mod( 'bg_color', '#131313' );
		$surface_darkest = get_theme_mod( 'surface_darkest_color', '#0e0e0e' );
		$surface_high    = get_theme_mod( 'surface_high_color', '#2a2a2a' );
		$border          = get_theme_mod( 'border_color', '#262626' );
		$font_size       = get_theme_mod( 'font_size_body', '16' );
		$font_size_h1    = get_theme_mod( 'font_size_h1', '48' );
		$font_size_h2    = get_theme_mod( 'font_size_h2', '36' );
		$line_height     = get_theme_mod( 'line_height_body', '1.7' );
		$header_height   = get_theme_mod( 'header_height', '80' );
		$header_opacity  = get_theme_mod( 'header_bg_opacity', '80' );
		$hero_min_h      = get_theme_mod( 'hero_min_height', '90' );
		$footer_padding  = get_theme_mod( 'footer_padding', '80' );
		$custom_css      = get_theme_mod( 'custom_css_code', '' );
		$custom_head     = get_theme_mod( 'custom_head_code', '' );
		$custom_footer   = get_theme_mod( 'custom_footer_code', '' );
		?>
		<style id="danial-dynamic-css">
			:root {
				--c-primary: <?php echo esc_html( $primary ); ?>;
				--c-secondary: <?php echo esc_html( $secondary ); ?>;
				--c-bg: <?php echo esc_html( $bg ); ?>;
				--c-surface: <?php echo esc_html( $bg ); ?>;
				--c-surface-d: <?php echo esc_html( $surface_darkest ); ?>;
				--c-surface-h: <?php echo esc_html( $surface_high ); ?>;
				--c-border: <?php echo esc_html( $border ); ?>;
				--font-size-body: <?php echo absint( $font_size ); ?>px;
				--font-size-h1: <?php echo absint( $font_size_h1 ); ?>px;
				--font-size-h2: <?php echo absint( $font_size_h2 ); ?>px;
				--line-height-body: <?php echo esc_html( $line_height ); ?>;
				--header-height: <?php echo absint( $header_height ); ?>px;
				--header-opacity: <?php echo intval( $header_opacity ); ?>%;
				--hero-min-height: <?php echo absint( $hero_min_h ); ?>vh;
				--footer-padding: <?php echo absint( $footer_padding ); ?>px;
			}
			body { font-family: 'Vazirmatn', system-ui, sans-serif; font-size: var(--font-size-body); line-height: var(--line-height-body); }
			h1 { font-size: var(--font-size-h1); }
			h2 { font-size: var(--font-size-h2); }
			#main-header { height: var(--header-height); }
			.min-h-\[90vh\] { min-height: var(--hero-min-height); }
			footer { padding-top: var(--footer-padding); }
			<?php if ( ! get_theme_mod( 'header_border', true ) ) : ?>
			#main-header { border-bottom: none !important; }
			<?php endif; ?>
			<?php if ( ! get_theme_mod( 'header_blur', true ) ) : ?>
			#main-header { backdrop-filter: none !important; -webkit-backdrop-filter: none !important; }
			<?php endif; ?>
			<?php echo $custom_css ? wp_strip_all_tags( $custom_css ) : ''; ?>
		</style>
		<?php
		// Output custom <head> code
		if ( $custom_head ) {
			echo "\n" . $custom_head . "\n";
		}
		// Output custom footer code via wp_footer
		if ( $custom_footer ) {
			add_action( 'wp_footer', function() use ( $custom_footer ) {
				echo "\n" . $custom_footer . "\n";
			} );
		}
	}
}