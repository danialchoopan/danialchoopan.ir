<?php
/**
 * Theme.php — Main theme bootstrap class (Singleton).
 *
 * Orchestrates initialization of all theme components:
 *   1. Core: Setup, Assets, PostTypes, I18n
 *   2. Integrations: GitHub API
 *   3. Features: SEO, Rank, Challenge, Performance
 *   4. Web: Ajax handler
 *   5. Admin: Dashboard, Customizer (admin-only)
 *
 * @package DanialPortfolio
 * @subpackage Core
 */

namespace DevPortfolio\Core;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

final class Theme {
	private static $instance = null;

	private function __construct() {
		$this->init();
	}

	/** Get or create the singleton instance. */
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Initialize all theme components.
	 *
	 * Each class self-registers its WordPress hooks in its constructor,
	 * so simply calling ::instance() is enough to activate it.
	 */
	private function init() {
		// ── Core Components ────────────────────────────────────────
		Setup::instance();      // Theme support, menus, seed data
		Assets::instance();     // Enqueue CSS/JS
		PostTypes::instance();  // CPTs + admin columns
		I18n::instance();       // Multi-language, RTL, body classes

		// ── Integrations ───────────────────────────────────────────
		\DevPortfolio\Integrations\GitHub::instance();

		// ── Features ───────────────────────────────────────────────
		\DevPortfolio\Features\Rank::instance();          // Developer rank shortcode
		\DevPortfolio\Features\Challenge::instance();     // Daily coding challenge
		\DevPortfolio\Features\Performance::instance();   // Content filters, content locker
		\DevPortfolio\Features\SEO::instance();           // Open Graph, JSON-LD

		// ── Web (AJAX) ─────────────────────────────────────────────
		\DevPortfolio\Web\Ajax::instance();

		// ── Admin-Only ─────────────────────────────────────────────
		if ( is_admin() ) {
			\DevPortfolio\Admin\Dashboard::instance();
			\DevPortfolio\Admin\Customizer::instance();
		}
	}
}
