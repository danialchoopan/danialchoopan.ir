<?php
/**
 * Theme functions and definitions
 *
 * @package DevPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

// Require Autoloader
require_once get_template_directory() . '/src/Core/Autoloader.php';

// Register Autoloader
\DevPortfolio\Core\Autoloader::register();

// Initialize Theme
\DevPortfolio\Core\Theme::instance();

/**
 * Custom Nav Walker for Header
 */
class DevPortfolio_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $active_class = in_array('current-menu-item', $classes) ? 'text-white border-b-2 border-primary pb-1' : 'hover:text-white transition-colors';

        $output .= '<a href="' . esc_url($item->url) . '" class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 ' . $active_class . '">';
        $output .= $item->title;
        $output .= '</a>';
    }
}

if ( ! function_exists( 'vibecode_terminal_dots' ) ) {
    function vibecode_terminal_dots() {
        return '
        <div class="flex gap-1.5 mb-4">
            <div class="w-2.5 h-2.5 rounded-full bg-[#FF5F56]"></div>
            <div class="w-2.5 h-2.5 rounded-full bg-[#FFBD2E]"></div>
            <div class="w-2.5 h-2.5 rounded-full bg-[#27C93F]"></div>
        </div>';
    }
}

if ( ! function_exists( 'devportfolio_reading_time' ) ) {
    function devportfolio_reading_time( $content ) {
        $word_count = str_word_count( strip_tags( $content ) );
        $reading_time = ceil( $word_count / 200 );
        return $reading_time;
    }
}
