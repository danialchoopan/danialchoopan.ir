<?php
namespace DevPortfolio\Features;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Developer Rank Calculator.
 */
class Rank {
	private static ?Rank $instance = null;

	public static function instance(): Rank {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_shortcode( 'dev_rank', [ $this, 'render_rank' ] );
	}

	public function calculate_rank(): int {
        // Mock logic: Experience years + Repo count * 2
        $repos = count(\DevPortfolio\Integrations\GitHub::instance()->get_user_repos('danialchoopan'));
        $score = 50 + ($repos * 5);
		return min( 100, $score );
	}

	public function render_rank(): string {
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
				<div class="bg-primary h-full" style="width: <?php echo esc_attr( $rank ); ?>%"></div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
