<?php
/**
 * GitHub.php — GitHub API integration with transient caching.
 *
 * Fetches public repository data for the configured GitHub user.
 * Results are cached for 12 hours using WordPress Transients API.
 *
 * Requires a Personal Access Token for higher API rate limits (optional).
 *
 * @package DanialPortfolio
 * @subpackage Integrations
 */

namespace DevPortfolio\Integrations;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class GitHub {
	private static $instance = null;

	/** GitHub API base URL. */
	private $api_url = 'https://api.github.com';

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {}

	/**
	 * Fetch public repositories for a GitHub user.
	 *
	 * Results are cached for 12 hours using transients.
	 * If a Personal Access Token is configured, it's used
	 * to avoid rate limiting.
	 *
	 * @param  string $username GitHub username to fetch repos for.
	 * @return array  Array of repository data (or empty array on error).
	 */
	public function get_user_repos( $username ) {
		$cache_key = 'github_repos_' . sanitize_key( $username );
		$cached    = get_transient( $cache_key );

		// Return cached data if available
		if ( false !== $cached ) {
			return $cached;
		}

		// Get GitHub token from theme settings
		$options = get_option( 'devportfolio_settings' );
		$token   = $options['github_token'] ?? '';

		// Build request headers
		$args = [
			'headers' => [
				'User-Agent' => 'DanialPortfolio-Theme',
				'Accept'     => 'application/vnd.github.v3+json',
			],
			'timeout' => 15,
		];

		// Add authorization header if token is set
		if ( ! empty( $token ) ) {
			$args['headers']['Authorization'] = 'token ' . $token;
		}

		// Fetch from GitHub API (sorted by most recently updated, max 6)
		$response = wp_remote_get(
			$this->api_url . '/users/' . rawurlencode( $username ) . '/repos?sort=updated&per_page=6',
			$args
		);

		// Handle request errors
		if ( is_wp_error( $response ) ) {
			return [];
		}

		$body = wp_remote_retrieve_body( $response );
		$repos = json_decode( $body, true );

		if ( ! is_array( $repos ) ) {
			return [];
		}

		// Cache for 12 hours
		set_transient( $cache_key, $repos, HOUR_IN_SECONDS * 12 );

		return $repos;
	}
}
