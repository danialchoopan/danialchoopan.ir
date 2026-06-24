<?php
namespace DevPortfolio\Integrations;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Handles GitHub API integration with caching.
 */
class GitHub {
	private static $instance = null;
	private string $api_url = 'https://api.github.com';

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {}

	public function get_user_repos( string $username ) {
		$cache_key = 'github_repos_' . $username;
		$cached = get_transient( $cache_key );

		if ( $cached !== false ) {
			return $cached;
		}

		$options = get_option( 'devportfolio_settings' );
		$token = $options['github_token'] ?? '';

		$args = [
			'headers' => [
				'User-Agent' => 'DevPortfolio-Theme',
			]
		];

		if ( ! empty( $token ) ) {
			$args['headers']['Authorization'] = 'token ' . $token;
		}

		$response = wp_remote_get( $this->api_url . "/users/{$username}/repos?sort=updated&per_page=6", $args );

		if ( is_wp_error( $response ) ) {
			return [];
		}

		$body = wp_remote_retrieve_body( $response );
		$repos = json_decode( $body, true );

		if ( ! is_array( $repos ) ) {
			return [];
		}

		set_transient( $cache_key, $repos, HOUR_IN_SECONDS * 12 );

		return $repos;
	}
}
