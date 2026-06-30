<?php
/**
 * Rank.php — Developer Rank Calculator shortcode.
 *
 * Provides [dev_rank] shortcode that displays a visual "score out of 100"
 * based on the developer's GitHub repository count.
 *
 * Score formula: min(100, 50 + (repo_count * 5))
 *
 * @package DanialPortfolio
 * @subpackage Features
 */

namespace DevPortfolio\Features;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class Rank {
	private static $instance = null;

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Register the [dev_rank] shortcode. */
	private function __construct() {
		add_shortcode( 'dev_rank', [ $this, 'render_rank' ] );
	}

	/**
	 * Calculate developer rank based on GitHub repos.
	 *
	 * Uses the GitHub handle from Customizer settings.
	 * Results are cached via GitHub API transients.
	 *
	 * @return int Rank score between 0 and 100.
	 */
	public function calculate_rank() {
		$handle = get_theme_mod( 'github_handle', 'danialchoopan' );
		$repos  = count( \DevPortfolio\Integrations\GitHub::instance()->get_user_repos( $handle ) );
		$score  = 50 + ( $repos * 5 );
		return min( 100, $score );
	}

	/**
	 * Render the rank shortcode output.
	 *
	 * @return string HTML output of the rank widget.
	 */
	public function render_rank() {
		$rank = $this->calculate_rank();
		ob_start();
		?>
		<div class="p-6 border border-primary bg-surface-high rounded-sm">
			<h3 class="text-xs font-black uppercase tracking-widest text-zinc-500 mb-4"><?php esc_html_e( 'Developer Rank', 'devportfolio' ); ?></h3>
			<div class="flex items-end gap-4">
				<span class="text-6xl font-black text-white"><?php echo esc_html( $rank ); ?></span>
				<span class="text-xs font-bold text-primary mb-2">/ 100</span>
			</div>
			<div class="w-full bg-surface h-1 mt-4">
				<div class="bg-primary h-full transition-all duration-1000" style="width: <?php echo esc_attr( $rank ); ?>%"></div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
