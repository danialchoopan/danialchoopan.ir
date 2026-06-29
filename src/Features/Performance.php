<?php
namespace DevPortfolio\Features;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Handles Performance optimizations and content filters.
 */
class Performance {
	private static $instance = null;

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_filter( 'wp_handle_upload', [ $this, 'generate_webp_on_upload' ] );
        add_filter( 'comment_text', [ $this, 'parse_comment_code' ] );
        add_filter( 'the_content', [ $this, 'content_locker' ] );
	}

	public function generate_webp_on_upload( $upload ) {
		return $upload;
	}

    public function parse_comment_code( $text ) {
		$text = str_replace( '[code]', '<pre><code class="language-clike">', $text );
		$text = str_replace( '[/code]', '</code></pre>', $text );
		return $text;
	}

    public function content_locker( $content ) {
		if ( is_single() && has_tag('locked') && ! is_user_logged_in() ) {
			return '<div class="p-8 border-2 border-dashed border-primary text-center my-12">
				<h3 class="text-xl font-black mb-4">CONTENT_LOCKED</h3>
				<p class="text-zinc-500 mb-6">This technical guide is reserved for registered developers.</p>
				<a href="' . wp_login_url() . '" class="px-6 py-3 bg-primary text-surface font-black uppercase tracking-widest text-[10px]">Login to Unlock</a>
			</div>';
		}
		return $content;
	}
}
