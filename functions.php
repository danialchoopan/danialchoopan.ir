<?php
/**
 * Theme functions and definitions — Danial Portfolio v3.0
 *
 * This is the main entry point for the theme. It loads the autoloader,
 * initializes the core theme classes, and defines global helper functions.
 *
 * Architecture:
 *   - All classes live under src/ and use PSR-4-style autoloading.
 *   - Core classes: Theme, Setup, Assets, PostTypes, I18n, Autoloader.
 *   - Features: SEO, Rank, Challenge, Performance.
 *   - Integrations: GitHub API.
 *   - Admin: Dashboard, Customizer.
 *   - Web: Ajax (contact form handler).
 *
 * @package DanialPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

// ── Load Autoloader & Bootstrap ──────────────────────────────────────
// The autoloader maps DevPortfolio\* namespace to src/ directory.
require_once get_template_directory() . '/src/Core/Autoloader.php';
\DevPortfolio\Core\Autoloader::register();

// Theme::instance() boots all core, feature, and integration classes.
\DevPortfolio\Core\Theme::instance();

// ── Custom Navigation Menu Walker ────────────────────────────────────
/**
 * Renders navigation menu items with Tailwind CSS styling.
 *
 * Adds active-state classes (underline + white text) for the current page,
 * and hover transitions for other items.
 */
class DevPortfolio_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * Output a single menu item `<a>` element.
	 *
	 * @param string  &$output  The menu item's HTML output (passed by reference).
	 * @param WP_Post $item     Menu item data object.
	 * @param int     $depth    Depth of menu item (for sub-menus).
	 * @param object  $args     Menu arguments.
	 * @param int     $id       Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? [] : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Active item gets white text + bottom border highlight
		$is_active    = in_array( 'current-menu-item', $classes, true );
		$active_class = $is_active
			? 'text-white border-b-2 border-primary pb-1'
			: 'hover:text-white transition-colors';

		$output .= '<a href="' . esc_url( $item->url ) . '" class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 ' . $active_class . '">';
		$output .= esc_html( $item->title );
		$output .= '</a>';
	}
}

// ── Helper: Terminal Dots ────────────────────────────────────────────
/**
 * Returns the macOS-style terminal dot icons (red, yellow, green).
 *
 * Used in the hero terminal block and single portfolio pages.
 *
 * @return string HTML string of the three colored dots.
 */
if ( ! function_exists( 'danial_terminal_dots' ) ) {
	function danial_terminal_dots() {
		return '
		<div class="flex gap-1.5 mb-4">
			<div class="w-2.5 h-2.5 rounded-full bg-[#FF5F56]"></div>
			<div class="w-2.5 h-2.5 rounded-full bg-[#FFBD2E]"></div>
			<div class="w-2.5 h-2.5 rounded-full bg-[#27C93F]"></div>
		</div>';
	}
}

// Backward compatibility alias (kept for child themes / plugins using old name)
if ( ! function_exists( 'vibecode_terminal_dots' ) ) {
	function vibecode_terminal_dots() {
		return danial_terminal_dots();
	}
}

// ── Helper: Reading Time Calculator ──────────────────────────────────
/**
 * Calculates estimated reading time for a piece of content.
 *
 * Uses an average of 200 words per minute.
 *
 * @param  string $content The post content (HTML is stripped).
 * @return int    Estimated minutes (rounded up).
 */
if ( ! function_exists( 'devportfolio_reading_time' ) ) {
	function devportfolio_reading_time( $content ) {
		$word_count   = str_word_count( strip_tags( $content ) );
		$reading_time = (int) ceil( $word_count / 200 );
		return max( 1, $reading_time );
	}
}
