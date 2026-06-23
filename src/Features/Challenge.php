<?php
namespace DevPortfolio\Features;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Daily Coding Challenge Shortcode.
 */
class Challenge {
	private static ?Challenge $instance = null;
    private array $challenges = [
        [ 'q' => 'Write a function to reverse a string in PHP.', 'diff' => 'Easy' ],
        [ 'q' => 'Explain the Singleton pattern and its usage.', 'diff' => 'Medium' ],
        [ 'q' => 'How does the WordPress Hook system work?', 'diff' => 'Medium' ]
    ];

	public static function instance(): Challenge {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_shortcode( 'daily_challenge', [ $this, 'render_challenge' ] );
	}

	public function render_challenge(): string {
		$day = (int) date('d');
        $index = $day % count($this->challenges);
        $challenge = $this->challenges[$index];

		ob_start();
		?>
		<div class="p-8 border-2 border-primary bg-surface relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 bg-primary text-surface font-black text-[10px] uppercase"><?php echo esc_html($challenge['diff']); ?></div>
			<h3 class="text-xl font-black text-white mb-4"><?php esc_html_e( 'Daily Coding Challenge', 'devportfolio' ); ?></h3>
			<p class="text-zinc-400 font-mono text-sm leading-relaxed mb-6">
                > <?php echo esc_html($challenge['q']); ?>
            </p>
            <a href="#comments" class="inline-block px-6 py-3 border border-primary text-primary text-[10px] font-black uppercase tracking-widest hover:bg-primary hover:text-surface transition-all">
                Submit Solution
            </a>
		</div>
		<?php
		return ob_get_clean();
	}
}
