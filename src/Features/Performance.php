<?php
/**
 * Performance.php — Content filters and performance optimizations.
 *
 * Features:
 *   - [code] shortcode for wrapping code blocks in comments
 *   - Content locker: hides post content for logged-out users (tag: locked)
 *   - Placeholder for future WebP auto-conversion
 *
 * @package DanialPortfolio
 * @subpackage Features
 */

namespace DevPortfolio\Features;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class Performance {
	private static $instance = null;

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		// Placeholder for WebP auto-conversion on image upload
		add_filter( 'wp_handle_upload', [ $this, 'generate_webp_on_upload' ] );

		// Parse [code]...[/code] shortcodes in comments
		add_filter( 'comment_text', [ $this, 'parse_comment_code' ] );

		// Content locker: hide content for non-logged-in users on tagged posts
		add_filter( 'the_content', [ $this, 'content_locker' ] );
	}

	/**
	 * Placeholder for future WebP auto-conversion.
	 *
	 * @param array $upload Upload data.
	 * @return array Unmodified upload data.
	 */
	public function generate_webp_on_upload( $upload ) {
		// TODO: Implement WebP conversion using Imagick or GD
		return $upload;
	}

	/**
	 * Convert [code] shortcodes to HTML <pre><code> blocks in comments.
	 *
	 * Usage in comments: [code]your code here[/code]
	 *
	 * @param  string $text Comment text with potential [code] tags.
	 * @return string Comment text with HTML code blocks.
	 */
	public function parse_comment_code( $text ) {
		$text = str_replace( '[code]', '<pre><code class="language-clike">', $text );
		$text = str_replace( '[/code]', '</code></pre>', $text );
		return $text;
	}

	/**
	 * Lock post content for non-logged-in users.
	 *
	 * Posts tagged with "locked" will show a login prompt instead of content.
	 *
	 * @param  string $content The post content.
	 * @return string Modified content (locked or original).
	 */
	public function content_locker( $content ) {
		if ( is_single() && has_tag( 'locked' ) && ! is_user_logged_in() ) {
			$login_url = wp_login_url( get_permalink() );
			return '<div class="p-8 border-2 border-dashed border-primary text-center my-12">
				<h3 class="text-xl font-black mb-4 text-white">CONTENT_LOCKED</h3>
				<p class="text-zinc-500 mb-6">' . esc_html__( 'This technical guide is reserved for registered developers.', 'devportfolio' ) . '</p>
				<a href="' . esc_url( $login_url ) . '" class="inline-block px-6 py-3 bg-primary text-surface font-black uppercase tracking-widest text-[10px]">' . esc_html__( 'Login to Unlock', 'devportfolio' ) . '</a>
			</div>';
		}
		return $content;
	}
}
