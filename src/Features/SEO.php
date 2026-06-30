<?php
/**
 * SEO.php — Handles search engine optimization meta tags.
 *
 * Outputs:
 *   - Open Graph tags (og:title, og:type, og:url, og:image)
 *   - JSON-LD structured data (Person schema)
 *
 * @package DanialPortfolio
 * @subpackage Features
 */

namespace DevPortfolio\Features;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class SEO {
	private static $instance = null;

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'wp_head', [ $this, 'render_og_tags' ], 1 );
		add_action( 'wp_head', [ $this, 'render_json_ld' ], 1 );
	}

	/**
	 * Output Open Graph meta tags for social sharing.
	 *
	 * Generates og:title, og:type, og:url, and og:image for singular pages.
	 */
	public function render_og_tags() {
		if ( ! is_singular() ) {
			return;
		}

		$site_name = get_bloginfo( 'name' );
		$title     = get_the_title();
		$url       = get_permalink();
		$image     = get_the_post_thumbnail_url( get_the_ID(), 'large' );

		echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
		echo '<meta property="og:type" content="article">' . "\n";
		echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";

		if ( $image ) {
			echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
		}

		// Twitter Card
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	}

	/**
	 * Output JSON-LD structured data for search engines.
	 *
	 * Generates Person schema with site name, URL, job title, and social links.
	 */
	public function render_json_ld() {
		$schema = [
			'@context' => 'https://schema.org',
			'@type'    => 'Person',
			'name'     => get_bloginfo( 'name' ),
			'url'      => home_url( '/' ),
			'jobTitle' => get_theme_mod( 'hero_title', 'Software Engineer' ),
			'sameAs'   => array_filter( [
				get_theme_mod( 'github_url', '' ),
				get_theme_mod( 'twitter_url', '' ),
				get_theme_mod( 'linkedin_url', '' ),
			] ),
		];

		// Remove empty social URLs
		$schema['sameAs'] = array_values( array_filter( $schema['sameAs'] ) );

		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
	}
}
