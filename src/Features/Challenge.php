<?php
/**
 * Challenge.php — Daily Coding Challenge shortcode.
 *
 * Provides [daily_challenge] shortcode that rotates through
 * a predefined list of coding challenges based on the day of month.
 *
 * @package DanialPortfolio
 * @subpackage Features
 */

namespace DevPortfolio\Features;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class Challenge {
	private static $instance = null;

	/** Pool of challenges that rotate daily. */
	private $challenges = [
		[ 'q' => 'Write a function to reverse a string in PHP.',                           'diff' => 'Easy' ],
		[ 'q' => 'Explain the Singleton pattern and its usage.',                           'diff' => 'Medium' ],
		[ 'q' => 'How does the WordPress Hook system work?',                               'diff' => 'Medium' ],
		[ 'q' => 'Implement a binary search algorithm in any language.',                    'diff' => 'Medium' ],
		[ 'q' => 'Explain the difference between REST and GraphQL.',                        'diff' => 'Easy' ],
		[ 'q' => 'Write a function to check if a string is a valid parentheses sequence.', 'diff' => 'Easy' ],
		[ 'q' => 'Design a rate limiter using a token bucket algorithm.',                   'diff' => 'Hard' ],
	];

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Register the [daily_challenge] shortcode. */
	private function __construct() {
		add_shortcode( 'daily_challenge', [ $this, 'render_challenge' ] );
	}

	/**
	 * Render the daily challenge widget.
	 *
	 * Selects a challenge based on the current day of month,
	 * cycling through the pool.
	 *
	 * @return string HTML output of the challenge widget.
	 */
	public function render_challenge() {
		$day      = (int) date( 'd' );
		$index    = $day % count( $this->challenges );
		$challenge = $this->challenges[ $index ];

		ob_start();
		?>
		<div class="p-8 border-2 border-primary bg-surface relative overflow-hidden group">
			<!-- Difficulty Badge -->
			<div class="absolute top-0 right-0 p-4 bg-primary text-surface font-black text-[10px] uppercase">
				<?php echo esc_html( $challenge['diff'] ); ?>
			</div>

			<h3 class="text-xl font-black text-white mb-4"><?php esc_html_e( 'Daily Coding Challenge', 'devportfolio' ); ?></h3>
			<p class="text-zinc-400 font-mono text-sm leading-relaxed mb-6">
				> <?php echo esc_html( $challenge['q'] ); ?>
			</p>
			<a href="#comments" class="inline-block px-6 py-3 border border-primary text-primary text-[10px] font-black uppercase tracking-widest hover:bg-primary hover:text-surface transition-all">
				<?php esc_html_e( 'Submit Solution', 'devportfolio' ); ?>
			</a>
		</div>
		<?php
		return ob_get_clean();
	}
}
