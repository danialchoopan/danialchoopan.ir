<?php
/**
 * Front Page Template — Renders the homepage with configurable sections.
 *
 * Section order is controlled via Customizer → Homepage Sections.
 * Each section can be individually toggled on/off.
 *
 * Available sections: hero, tech, stats, portfolio, cta, blog
 *
 * @package DanialPortfolio
 */

get_header();

// Read section order from Customizer (comma-separated string)
$order    = get_theme_mod( 'homepage_order', 'hero,tech,stats,portfolio,cta,blog' );
$sections = array_map( 'trim', explode( ',', $order ) );

foreach ( $sections as $section ) {
	switch ( $section ) {
		case 'hero':
			get_template_part( 'template-parts/home-hero' );
			break;

		case 'tech':
			if ( get_theme_mod( 'show_tech_section', true ) ) {
				get_template_part( 'template-parts/home-tech' );
			}
			break;

		case 'stats':
			if ( get_theme_mod( 'show_stats_section', true ) ) {
				get_template_part( 'template-parts/home-stats' );
			}
			break;

		case 'portfolio':
			if ( get_theme_mod( 'show_portfolio_section', true ) ) {
				get_template_part( 'template-parts/home-portfolio' );
			}
			break;

		case 'testimonials':
			if ( get_theme_mod( 'show_testimonials_section', false ) ) {
				get_template_part( 'template-parts/home-testimonials' );
			}
			break;

		case 'cta':
			if ( get_theme_mod( 'show_cta_section', true ) ) {
				get_template_part( 'template-parts/home-cta' );
			}
			break;

		case 'blog':
			if ( get_theme_mod( 'show_blog_section', true ) ) {
				get_template_part( 'template-parts/home-blog' );
			}
			break;
	}
}

get_footer();
