<?php
$hero_title = get_theme_mod('hero_title', 'برنامه‌نویسی با حالِ تو');
$hero_bio   = get_theme_mod('hero_bio', 'ویب‌کد استودیو، فضایی برای خلق نرم‌افزارهای مدرن با رویکردی نوآورانه. ما ایده‌های فنی شما را به کدهای تمیز و قابل مقیاس تبدیل می‌کنیم.');
$primary_cta_text = get_theme_mod('hero_cta_primary_text', 'شروع پروژه');
$primary_cta_url  = get_theme_mod('hero_cta_primary_url', '#');
$secondary_cta_text = get_theme_mod('hero_cta_secondary_text', 'مشاهده نمونه کارها');
$secondary_cta_url  = get_theme_mod('hero_cta_secondary_url', '#');
?>

<section class="relative min-h-[90vh] flex items-center py-20 grid-pattern">
    <div class="container mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <!-- Terminal Block (Left on Desktop, Top on Mobile) -->
        <div class="order-2 lg:order-1">
            <div class="bg-surface-darkest rounded-xl border border-border shadow-2xl overflow-hidden font-mono text-sm leading-relaxed">
                <div class="bg-surface-high px-4 py-3 border-b border-border flex items-center justify-between">
                    <div class="flex gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-[#FF5F56]"></div>
                        <div class="w-3 h-3 rounded-full bg-[#FFBD2E]"></div>
                        <div class="w-3 h-3 rounded-full bg-[#27C93F]"></div>
                    </div>
                    <div class="text-[10px] text-zinc-500 uppercase tracking-widest">vibecode_main.py — 64x32</div>
                </div>
                <div class="p-6 text-zinc-400 space-y-1">
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">1</span><span><span class="text-secondary">:class</span> <span class="text-primary">VibeStudio</span></span></div>
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">2</span><span>    <span class="text-secondary">:def</span> <span class="text-white">__init__</span>(<span class="text-zinc-500">self</span>)</span></div>
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">3</span><span>        <span class="text-zinc-500">self.vision</span> = <span class="text-secondary">"Pure Excellence"</span></span></div>
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">4</span><span>        <span class="text-zinc-500">self.stack</span> = [<span class="text-secondary">"React"</span>, <span class="text-secondary">"Python"</span>, <span class="text-secondary">"Go"</span>]</span></div>
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">5</span></div>
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">6</span><span>    <span class="text-secondary">:async def</span> <span class="text-white">build_future</span>(<span class="text-zinc-500">self, project</span>)</span></div>
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">7</span><span><span class="text-primary">#print</span>(f<span class="text-secondary">"Compiling {project} with ⚡ vibes..."</span>)</span></div>
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">8</span><span>        <span class="text-white">return await</span> <span class="text-zinc-500">self.deploy</span>(<span class="text-zinc-500">project</span>)</span></div>
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">9</span></div>
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">10</span><span>Initialize the studio...</span></div>
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">11</span><span>    {}studio = <span class="text-primary">VibeStudio</span></span></div>
                    <div class="flex gap-4"><span class="text-zinc-700 w-4">12</span><span><span class="text-secondary">#await</span> <span class="text-zinc-500">studio.build_future</span>(<span class="text-secondary">"Your_Dream_App"</span>)</span></div>
                </div>
            </div>
        </div>

        <!-- Content Block (Right on Desktop) -->
        <div class="order-1 lg:order-2 text-right rtl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface border border-border mb-8">
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500">SYSTEM.READY()</span>
                <svg class="w-3 h-3 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/></svg>
            </div>

            <h1 class="text-5xl md:text-7xl font-black mb-8 tracking-tighter leading-[1.1] text-white">
                <?php echo esc_html($hero_title); ?>
            </h1>

            <p class="text-zinc-400 text-lg mb-12 max-w-xl ml-auto leading-relaxed">
                <?php echo esc_html($hero_bio); ?>
            </p>

            <div class="flex flex-wrap items-center justify-end gap-4">
                <a href="<?php echo esc_url($primary_cta_url); ?>" class="px-8 py-4 bg-primary text-surface text-[12px] font-black uppercase tracking-widest rounded-sm hover:opacity-90 transition-opacity">
                    <?php echo esc_html($primary_cta_text); ?>
                </a>
                <a href="<?php echo esc_url($secondary_cta_url); ?>" class="px-8 py-4 border border-border text-white text-[12px] font-black uppercase tracking-widest rounded-sm hover:bg-surface-high transition-colors">
                    <?php echo esc_html($secondary_cta_text); ?>
                </a>
            </div>
        </div>
    </div>
</section>
