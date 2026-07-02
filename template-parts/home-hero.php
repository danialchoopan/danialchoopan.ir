<?php
/**
 * Hero Section — Landing area with animated terminal and intro text.
 *
 * @package DanialPortfolio
 */

$hero_title        = get_theme_mod( 'hero_title', 'برنامه‌نویسی با حالِ تو' );
$hero_bio          = get_theme_mod( 'hero_bio', 'Danial Portfolio، فضایی برای خلق نرم‌افزارهای مدرن با رویکردی نوآورانه. ما ایده‌های فنی شما را به کدهای تمیز و قابل مقیاس تبدیل می‌کنیم.' );
$primary_cta_text  = get_theme_mod( 'hero_cta_primary_text', 'شروع پروژه' );
$primary_cta_url   = get_theme_mod( 'hero_cta_primary_url', '#' );
$secondary_cta_text = get_theme_mod( 'hero_cta_secondary_text', 'مشاهده نمونه کارها' );
$secondary_cta_url  = get_theme_mod( 'hero_cta_secondary_url', '#' );
$show_terminal     = get_theme_mod( 'show_hero_terminal', true );
$show_glow         = get_theme_mod( 'hero_show_glow', true );
$show_scanline     = get_theme_mod( 'hero_show_scanline', true );
$show_glitch       = get_theme_mod( 'hero_show_glitch', true );
$hero_text_pos     = get_theme_mod( 'hero_text_position', 'right' );
?>

<section class="relative min-h-[90vh] flex items-center py-20 grid-pattern hero-particles overflow-hidden">
    <!-- Ambient glow orbs -->
    <?php if ( $show_glow ) : ?>
    <div class="ambient-glow" style="width:400px;height:400px;background:var(--c-primary);top:-10%;left:-5%;animation-delay:0s;"></div>
    <div class="ambient-glow" style="width:300px;height:300px;background:var(--c-secondary);bottom:-10%;right:-5%;animation-delay:3s;"></div>
    <div class="ambient-glow" style="width:250px;height:250px;background:var(--c-primary);top:50%;left:60%;animation-delay:5s;"></div>
    <?php endif; ?>
    <!-- Floating particles injected by JS -->

    <div class="container mx-auto px-6 grid grid-cols-1 <?php echo $show_terminal ? 'lg:grid-cols-2' : 'lg:grid-cols-1 max-w-4xl mx-auto'; ?> gap-16 items-center relative z-10">

        <?php
        // Determine layout order based on text position
        $terminal_first = ( $hero_text_pos === 'right' );
        $is_centered    = ( $hero_text_pos === 'center' || ! $show_terminal );
        ?>

        <!-- Terminal Block -->
        <?php if ( $show_terminal && ! $is_centered ) : ?>
        <div class="terminal-wrapper <?php echo ! $terminal_first ? 'lg:order-2' : ''; ?>">
            <div class="bg-surface-darkest rounded-xl border border-border shadow-2xl overflow-hidden font-mono text-sm leading-relaxed relative">
                <?php if ( $show_scanline ) : ?>
                <div class="scanline-overlay"></div>
                <?php endif; ?>
                <div class="bg-surface-high px-4 py-3 border-b border-border flex items-center justify-between">
                    <div class="flex gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-[#FF5F56]"></div>
                        <div class="w-3 h-3 rounded-full bg-[#FFBD2E]"></div>
                        <div class="w-3 h-3 rounded-full bg-[#27C93F]"></div>
                    </div>
                    <div class="text-[10px] text-zinc-500 uppercase tracking-widest">main.py — 64x32</div>
                </div>
                <div class="p-6 text-zinc-400 space-y-1">
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">1</span><span><span class="text-secondary">:class</span> <span class="text-primary">Studio</span></span></div>
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">2</span><span>    <span class="text-secondary">:def</span> <span class="text-white">__init__</span>(<span class="text-zinc-500">self</span>)</span></div>
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">3</span><span>        <span class="text-zinc-500">self.vision</span> = <span class="text-secondary">"Pure Excellence"</span></span></div>
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">4</span><span>        <span class="text-zinc-500">self.stack</span> = [<span class="text-secondary">"React"</span>, <span class="text-secondary">"Python"</span>, <span class="text-secondary">"Go"</span>]</span></div>
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">5</span></div>
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">6</span><span>    <span class="text-secondary">:async def</span> <span class="text-white">build_future</span>(<span class="text-zinc-500">self, project</span>)</span></div>
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">7</span><span><span class="text-primary">#print</span>(f<span class="text-secondary">"Compiling {project}..."</span>)</span></div>
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">8</span><span>        <span class="text-white">return await</span> <span class="text-zinc-500">self.deploy</span>(<span class="text-zinc-500">project</span>)</span></div>
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">9</span></div>
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">10</span><span class="text-zinc-500"># Initialize the studio</span></div>
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">11</span><span>studio = <span class="text-primary">Studio</span>()</span></div>
                    <div class="flex gap-4 terminal-line"><span class="text-zinc-700 w-4">12</span><span><span class="text-secondary">await</span> studio.<span class="text-white">build_future</span>(<span class="text-secondary">"Your_Dream_App"</span>)</span></div>
                    <!-- Blinking cursor line -->
                    <div class="flex gap-4 terminal-line" style="opacity:1"><span class="text-zinc-700 w-4">13</span><span><span class="terminal-cursor">█</span></span></div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Content Block -->
        <div class="<?php echo $is_centered ? 'text-center max-w-4xl mx-auto' : 'text-right rtl'; ?> <?php echo $show_terminal && ! $is_centered && ! $terminal_first ? 'lg:order-1' : ''; ?>">
            <div class="<?php echo $is_centered ? 'flex justify-center' : ( $hero_text_pos === 'left' ? '' : '' ); ?> mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface border border-border status-badge">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500" data-type="SYSTEM.READY()" data-type-speed="40"></span>
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                </div>
            </div>

            <h1 class="text-5xl md:text-7xl font-black mb-8 tracking-tighter leading-[1.1] text-white hero-title <?php echo $show_glitch ? 'glitch-text' : ''; ?>" <?php echo $show_glitch ? 'data-text="' . esc_attr( $hero_title ) . '"' : ''; ?>>
                <?php echo esc_html( $hero_title ); ?>
            </h1>

            <p class="text-zinc-400 text-lg mb-12 max-w-xl <?php echo $is_centered ? 'mx-auto' : ( $hero_text_pos === 'left' ? '' : 'ml-auto' ); ?> leading-relaxed">
                <?php echo esc_html( $hero_bio ); ?>
            </p>

            <div class="flex flex-wrap items-center <?php echo $is_centered ? 'justify-center' : ( $hero_text_pos === 'left' ? 'justify-start' : 'justify-end' ); ?> gap-4">
                <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="px-8 py-4 bg-primary text-surface text-[12px] font-black uppercase tracking-widest rounded-sm hover:opacity-90 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-primary/20">
                    <?php echo esc_html( $primary_cta_text ); ?>
                </a>
                <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="px-8 py-4 border border-border text-white text-[12px] font-black uppercase tracking-widest rounded-sm hover:bg-surface-high transition-all duration-300 hover:scale-105">
                    <?php echo esc_html( $secondary_cta_text ); ?>
                </a>
            </div>
        </div>
    </div>
</section>
