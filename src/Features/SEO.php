<?php
namespace DevPortfolio\Features;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Handles SEO (JSON-LD, Open Graph).
 */
class SEO {
	private static $instance = null;

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'wp_head', [ $this, 'render_og_tags' ] );
		add_action( 'wp_head', [ $this, 'render_json_ld' ] );
	}

	public function render_og_tags() {
		if ( is_singleton() ) {
            global $post;
            echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '">';
            echo '<meta property="og:type" content="article">';
            echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '">';
        }
	}

	public function render_json_ld() {
		$data = [
            '@context' => 'https://schema.org',
            '@type'    => 'Person',
            'name'     => get_bloginfo('name'),
            'url'      => home_url('/')
        ];
        echo '<script type="application/ld+json">' . json_encode($data) . '</script>';
	}
}
