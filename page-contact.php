<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>

<section class="py-24 bg-surface min-h-screen grid-pattern">
    <div class="container mx-auto px-6">
        <div class="flex flex-col items-end mb-24 text-right rtl">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-4"><?php esc_html_e('Contact Us', 'devportfolio'); ?></span>
            <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter italic"><?php esc_html_e('Let\'s Connect', 'devportfolio'); ?></h1>
            <p class="text-zinc-500 max-w-2xl mt-8 text-lg leading-relaxed"><?php esc_html_e('Have a project in mind? Or just want to say hello? I am always open to discussing new technologies and exciting collaborations.', 'devportfolio'); ?></p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Info & Social -->
            <div class="lg:col-span-5 space-y-12 order-2 lg:order-1">
                <div class="space-y-4">
                    <h3 class="text-primary font-black uppercase tracking-widest text-xs mb-8 text-right rtl"><?php esc_html_e('Social Media', 'devportfolio'); ?></h3>
                    <a href="<?php echo esc_url(get_theme_mod('github_url', '#')); ?>" class="flex items-center justify-between p-6 bg-surface-darkest border border-border hover:border-primary transition-all group rtl">
                        <svg class="w-5 h-5 text-zinc-500 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-bold text-white uppercase tracking-widest">GitHub / <?php echo esc_attr(get_theme_mod('github_handle', 'Dev')); ?></span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="lg:col-span-7 order-1 lg:order-2">
                <div class="bg-surface-darkest border border-border p-8 md:p-12 text-right rtl">
                    <div id="contact-status" class="mb-6 hidden p-4 text-xs font-bold uppercase tracking-widest"></div>
                    <form id="portfolio-contact-form" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-zinc-500 block"><?php esc_html_e('Your Name', 'devportfolio'); ?>__</label>
                                <input type="text" name="name" required class="w-full bg-surface border border-border px-6 py-4 text-white focus:border-primary outline-none transition-colors">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-zinc-500 block"><?php esc_html_e('Email', 'devportfolio'); ?>__</label>
                                <input type="email" name="email" required class="w-full bg-surface border border-border px-6 py-4 text-white focus:border-primary outline-none transition-colors ltr text-left">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-zinc-500 block"><?php esc_html_e('Subject', 'devportfolio'); ?>__</label>
                            <input type="text" name="subject" class="w-full bg-surface border border-border px-6 py-4 text-white focus:border-primary outline-none transition-colors">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-zinc-500 block"><?php esc_html_e('Message', 'devportfolio'); ?>__</label>
                            <textarea name="message" rows="6" required class="w-full bg-surface border border-border px-6 py-4 text-white focus:border-primary outline-none transition-colors resize-none"></textarea>
                        </div>
                        <div class="pt-8">
                            <button type="submit" class="w-full md:w-auto px-12 py-5 bg-primary text-surface text-[12px] font-black uppercase tracking-widest hover:opacity-90 transition-opacity flex items-center justify-center gap-4 group">
                                <?php esc_html_e('Send Message', 'devportfolio'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
