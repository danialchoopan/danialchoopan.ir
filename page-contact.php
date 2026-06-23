<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>

<section class="py-24 bg-surface min-h-screen grid-pattern">
    <div class="container mx-auto px-6">
        <div class="flex flex-col items-end mb-24 text-right rtl">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-4">ارتباط با ما</span>
            <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter italic">بیایید متصل شویم</h1>
            <p class="text-zinc-500 max-w-2xl mt-8 text-lg leading-relaxed">پروژه‌ای در ذهن دارید؟ یا فقط می‌خواهید سلام کنید؟ من همیشه آماده گفتگو در مورد تکنولوژی‌های جدید و همکاری‌های هیجان‌انگیز هستم.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Left Side: Social & Info -->
            <div class="lg:col-span-5 space-y-12 order-2 lg:order-1">
                <!-- Social Links -->
                <div class="space-y-4">
                    <h3 class="text-primary font-black uppercase tracking-widest text-xs mb-8 text-right rtl">شبکه‌های اجتماعی</h3>

                    <a href="#" class="flex items-center justify-between p-6 bg-surface-darkest border border-border hover:border-primary transition-all group rtl">
                        <svg class="w-5 h-5 text-zinc-500 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-bold text-white uppercase tracking-widest">GitHub / <?php echo esc_attr(get_theme_mod('github_handle', 'Dev')); ?></span>
                            <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </div>
                    </a>

                    <a href="#" class="flex items-center justify-between p-6 bg-surface-darkest border border-border hover:border-primary transition-all group rtl">
                        <svg class="w-5 h-5 text-zinc-500 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-bold text-white uppercase tracking-widest">LinkedIn / <?php echo esc_attr(get_theme_mod('linkedin_handle', 'Dev')); ?></span>
                            <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </div>
                    </a>
                </div>

                <!-- Code Block Info -->
                <div class="bg-surface-darkest border border-border overflow-hidden font-mono text-xs">
                    <div class="bg-surface-high px-4 py-2 border-b border-border flex gap-1.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-[#FF5F56]"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-[#FFBD2E]"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-[#27C93F]"></div>
                        <span class="ml-4 text-[8px] text-zinc-500 uppercase tracking-widest">connect.js</span>
                    </div>
                    <div class="p-6 text-zinc-400 space-y-1 rtl text-right">
                        <div><span class="text-primary">const</span> <span class="text-white">developer</span> = {</div>
                        <div class="pr-4">name: <span class="text-secondary">'<?php echo esc_attr(get_theme_mod('linkedin_handle', 'Dev')); ?>'</span>,</div>
                        <div class="pr-4">location: <span class="text-secondary">'Tehran, IR'</span>,</div>
                        <div class="pr-4">status: <span class="text-secondary">'Open for collaboration'</span>,</div>
                        <div class="pr-4">contact: <span class="text-primary">async</span> () => {</div>
                        <div class="pr-8"><span class="text-primary">await</span> <span class="text-white">mailer</span>.<span class="text-white">send</span>({</div>
                        <div class="pr-12">to: <span class="text-secondary">'studio@vibecode.ir'</span>,</div>
                        <div class="pr-12">subject: <span class="text-secondary">'Let\'s build something great'</span></div>
                        <div class="pr-8">});</div>
                        <div class="pr-4">}</div>
                        <div>};</div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="lg:col-span-7 order-1 lg:order-2">
                <div class="bg-surface-darkest border border-border p-8 md:p-12 text-right rtl">
                    <div class="flex justify-between items-center mb-12">
                        <div class="flex items-center gap-2 text-primary font-bold text-[10px] uppercase tracking-widest">
                            <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                            ارسال پیام مستقیم
                        </div>
                        <span class="text-zinc-600 font-mono text-[10px]">V_CONTACT_42.D</span>
                    </div>

                    <form action="#" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-zinc-500 block">نام شما__</label>
                                <input type="text" placeholder="نام خود را اینجا بنویسید..." class="w-full bg-surface border border-border px-6 py-4 text-white focus:border-primary outline-none transition-colors">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-zinc-500 block">ایمیل__</label>
                                <input type="email" placeholder="example@vibecode.ir" class="w-full bg-surface border border-border px-6 py-4 text-white focus:border-primary outline-none transition-colors ltr text-left">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-zinc-500 block">موضوع__</label>
                            <input type="text" placeholder="همکاری، پروژه جدید، ..." class="w-full bg-surface border border-border px-6 py-4 text-white focus:border-primary outline-none transition-colors">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-zinc-500 block">پیام شما__</label>
                            <textarea rows="6" placeholder="توضیحات پروژه خود را اینجا بنویسید..." class="w-full bg-surface border border-border px-6 py-4 text-white focus:border-primary outline-none transition-colors resize-none"></textarea>
                        </div>

                        <div class="pt-8">
                            <button type="submit" class="w-full md:w-auto px-12 py-5 bg-primary text-surface text-[12px] font-black uppercase tracking-widest hover:opacity-90 transition-opacity flex items-center justify-center gap-4 group">
                                ارسال پیام
                                <svg class="w-5 h-5 group-hover:translate-x-[-4px] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
