<?php
/**
 * Skills Section — Terminal-style skill bars with neon glow.
 *
 * @package DanialPortfolio
 */

$skills_subtitle    = get_theme_mod( 'skills_subtitle', 'مهارت‌های فنی' );
$skills_title       = get_theme_mod( 'skills_title', 'تکنولوژی‌ها و ابزارها' );
$skills_term_title  = get_theme_mod( 'skills_terminal_title', 'skills.sh — ~/danial' );
$skills_columns     = get_theme_mod( 'skills_columns', '2' );

// Collect active skills (only those with a name set)
$skills = [];
for ( $i = 1; $i <= 12; $i++ ) {
	$name  = get_theme_mod( "skill_{$i}_name", '' );
	$level = (int) get_theme_mod( "skill_{$i}_level", 80 );
	$color = get_theme_mod( "skill_{$i}_color", '' );
	if ( ! empty( $name ) ) {
		$skills[] = [
			'name'  => $name,
			'level' => max( 0, min( 100, $level ) ),
			'color' => $color,
		];
	}
}
?>

<section class="py-24 bg-surface-darkest relative overflow-hidden">
    <!-- Subtle grid background -->
    <div class="absolute inset-0 grid-pattern opacity-20"></div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Section Header -->
        <div class="flex flex-col items-end mb-16 text-right rtl">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-4"><?php echo esc_html( $skills_subtitle ); ?></span>
            <h2 class="text-4xl md:text-5xl font-black text-white tracking-tighter"><?php echo esc_html( $skills_title ); ?></h2>
        </div>

        <?php if ( ! empty( $skills ) ) : ?>
        <!-- Terminal Window -->
        <div class="bg-[#0a0a0a] rounded-xl border border-border shadow-2xl overflow-hidden max-w-5xl mx-auto skills-terminal">
            <!-- Terminal Header Bar -->
            <div class="bg-[#1a1a1a] px-4 py-3 border-b border-border flex items-center justify-between">
                <div class="flex gap-1.5">
                    <div class="w-3 h-3 rounded-full bg-[#FF5F56]"></div>
                    <div class="w-3 h-3 rounded-full bg-[#FFBD2E]"></div>
                    <div class="w-3 h-3 rounded-full bg-[#27C93F]"></div>
                </div>
                <div class="text-[10px] text-zinc-500 uppercase tracking-widest font-mono"><?php echo esc_html( $skills_term_title ); ?></div>
                <div class="w-16"></div>
            </div>

            <!-- Terminal Body -->
            <div class="p-6 md:p-8">
                <!-- Command line prompt -->
                <div class="flex items-center gap-2 mb-6 font-mono text-sm">
                    <span class="text-[#39FF14]">danial@portfolio</span>
                    <span class="text-zinc-600">:</span>
                    <span class="text-[#6C9EFF]">~</span>
                    <span class="text-zinc-600">$</span>
                    <span class="text-white skills-typing">./show_skills.sh --verbose --all</span>
                    <span class="terminal-cursor">█</span>
                </div>

                <!-- Skills Grid -->
                <div class="grid grid-cols-1 <?php echo $skills_columns === '2' ? 'md:grid-cols-2' : ''; ?> gap-x-8 gap-y-5">
                    <?php foreach ( $skills as $index => $skill ) :
                        $bar_color = ! empty( $skill['color'] ) ? $skill['color'] : 'var(--c-primary)';
                        $bar_id    = 'skill-bar-' . $index;
                    ?>
                    <div class="skill-item" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                        <!-- Skill Header -->
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-[#39FF14] font-mono text-xs">▶</span>
                                <span class="text-white font-mono text-sm font-bold"><?php echo esc_html( $skill['name'] ); ?></span>
                            </div>
                            <span class="text-zinc-500 font-mono text-xs skill-level-text" data-target="<?php echo esc_attr( $skill['level'] ); ?>">0%</span>
                        </div>

                        <!-- Progress Bar Container -->
                        <div class="relative h-3 bg-[#1a1a1a] rounded-sm overflow-hidden border border-border/30">
                            <!-- Progress Bar Fill -->
                            <div class="skill-bar h-full rounded-sm relative overflow-hidden"
                                 data-width="<?php echo esc_attr( $skill['level'] ); ?>"
                                 style="width: 0%; background: <?php echo esc_attr( $bar_color ); ?>; box-shadow: 0 0 10px <?php echo esc_attr( $bar_color ); ?>40, 0 0 20px <?php echo esc_attr( $bar_color ); ?>20;">
                                <!-- Neon shimmer -->
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent skill-shimmer"></div>
                            </div>
                            <!-- Glow line at the end -->
                            <div class="skill-glow absolute top-0 bottom-0 w-0.5 opacity-0"
                                 style="background: <?php echo esc_attr( $bar_color ); ?>; box-shadow: 0 0 8px <?php echo esc_attr( $bar_color ); ?>, 0 0 16px <?php echo esc_attr( $bar_color ); ?>;"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Terminal footer line -->
                <div class="mt-6 pt-4 border-t border-border/30 font-mono text-xs text-zinc-600 flex items-center gap-2">
                    <span class="text-[#39FF14]">✓</span>
                    <span><?php echo count( $skills ); ?> skills loaded — <?php echo esc_html( $skills_title ); ?></span>
                </div>
            </div>
        </div>
        <?php else : ?>
        <!-- Empty state -->
        <div class="max-w-5xl mx-auto text-center py-16">
            <p class="text-zinc-600 font-mono text-sm">// Skills section is empty. Add skills from Customizer → Skills Section.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Skills Terminal Neon Effects */
.skills-terminal {
    position: relative;
}
.skills-terminal::before {
    content: '';
    position: absolute;
    inset: -1px;
    border-radius: 0.75rem;
    padding: 1px;
    background: linear-gradient(135deg, var(--c-primary) 0%, transparent 50%, var(--c-secondary) 100%);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    opacity: 0.3;
    pointer-events: none;
}

/* Skill item entrance animation */
.skill-item {
    opacity: 0;
    transform: translateX(-10px);
    animation: skillSlideIn 0.4s ease-out forwards;
}
@keyframes skillSlideIn {
    to { opacity: 1; transform: translateX(0); }
}

/* Skill bar animation */
.skill-bar {
    transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Neon shimmer on bar */
.skill-shimmer {
    animation: skillShimmer 2s ease-in-out infinite;
    animation-delay: 1.5s;
}
@keyframes skillShimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(200%); }
}

/* Typing animation for command */
.skills-typing {
    overflow: hidden;
    white-space: nowrap;
    border-right: 2px solid var(--c-secondary);
    width: 0;
    display: inline-block;
    animation: typing 2s steps(35, end) forwards, blink 0.5s step-end infinite alternate;
    animation-delay: 0.5s;
}

/* Scanline overlay for terminal */
.skills-terminal::after {
    content: '';
    position: absolute;
    inset: 0;
    pointer-events: none;
    background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,0.03) 2px, rgba(0,0,0,0.03) 4px);
    z-index: 1;
    border-radius: 0.75rem;
}

/* Light mode adjustments */
.light-mode .skills-terminal {
    background: #fafafa;
    border-color: var(--c-border);
}
.light-mode .skills-terminal .bg-\[\\#1a1a1a\] {
    background: var(--c-surface-d) !important;
}
.light-mode .skills-terminal .text-white {
    color: var(--c-text) !important;
}
</style>
