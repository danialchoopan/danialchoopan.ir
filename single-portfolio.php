<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article class="bg-surface min-h-screen">
        <!-- Hero Header -->
        <header class="relative py-32 grid-pattern border-b border-border">
            <div class="container mx-auto px-6 text-right rtl">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-high border border-border mb-8">
                    <span class="text-[10px] font-black uppercase tracking-widest text-primary">PROJECT_ANALYSIS</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-black text-white mb-8 tracking-tighter">
                    <?php the_title(); ?>
                </h1>

                <div class="flex flex-wrap items-center justify-end gap-12 text-zinc-500 uppercase tracking-widest text-[10px] font-bold">
                    <div class="flex flex-col items-end">
                        <span class="text-zinc-700 mb-2">دسته‌بندی</span>
                        <span class="text-white"><?php echo get_the_terms(get_the_ID(), 'portfolio_category')[0]->name ?? 'N/A'; ?></span>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-zinc-700 mb-2">زمان اجرا</span>
                        <span class="text-white"><?php echo get_the_date('Y'); ?></span>
                    </div>
                </div>
            </div>
        </header>

        <div class="container mx-auto px-6 py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                <!-- Sidebar Info -->
                <aside class="lg:col-span-4 space-y-12 order-2 lg:order-1">
                    <!-- Tech Stack -->
                    <div class="bg-surface-darkest border border-border p-8 text-right rtl">
                        <h3 class="text-xs font-black text-white uppercase tracking-widest mb-6 border-b border-border pb-4">Stack</h3>
                        <div class="flex flex-wrap gap-2 justify-end">
                            <?php
                            $stack = get_post_meta(get_the_ID(), 'portfolio_stack', true);
                            if ($stack) :
                                $tags = explode(',', $stack);
                                foreach ($tags as $tag) : ?>
                                    <span class="px-3 py-1 bg-surface-high border border-border text-[10px] font-bold text-zinc-400 uppercase tracking-widest"><?php echo trim($tag); ?></span>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="p-8 border border-primary/20 bg-primary/5 text-right rtl">
                        <h3 class="text-xs font-black text-primary uppercase tracking-widest mb-4">پروژه مشابه دارید؟</h3>
                        <p class="text-zinc-400 text-sm mb-6">ما آماده‌ایم تا ایده‌های فنی شما را به واقعیت تبدیل کنیم.</p>
                        <a href="#" class="inline-block px-6 py-3 bg-primary text-surface text-[10px] font-black uppercase tracking-widest rounded-sm">شروع همکاری</a>
                    </div>
                </aside>

                <!-- Content -->
                <div class="lg:col-span-8 order-1 lg:order-2">
                    <div class="aspect-video bg-surface-darkest border border-border overflow-hidden mb-16">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
                        <?php endif; ?>
                    </div>

                    <div class="prose prose-invert prose-zinc max-w-none text-right rtl
                                prose-headings:font-black prose-headings:tracking-tighter prose-headings:text-white
                                prose-p:text-zinc-400 prose-p:leading-relaxed prose-p:text-lg
                                prose-strong:text-white prose-a:text-primary">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
