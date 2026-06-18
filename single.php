<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article class="bg-surface min-h-screen">
        <header class="relative py-32 border-b border-border grid-pattern">
            <div class="container mx-auto px-6 text-right rtl">
                <div class="flex justify-end gap-4 mb-8">
                    <?php
                    $categories = get_the_category();
                    foreach($categories as $cat) : ?>
                        <span class="px-2 py-1 bg-primary text-surface text-[8px] font-bold uppercase tracking-widest"><?php echo $cat->name; ?></span>
                    <?php endforeach; ?>
                </div>

                <h1 class="text-4xl md:text-6xl font-black text-white mb-8 tracking-tighter leading-tight max-w-4xl ml-auto">
                    <?php the_title(); ?>
                </h1>

                <div class="flex flex-wrap items-center justify-end gap-8 text-[10px] font-bold text-zinc-500 uppercase tracking-widest">
                    <div class="flex items-center gap-2">
                        <span><?php echo get_the_date(); ?></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="flex items-center gap-2 border-r border-border pr-8 rtl:border-r-0 rtl:border-l rtl:pr-0 rtl:pl-8">
                        <span><?php echo devportfolio_reading_time(get_the_content()); ?> دقیقه مطالعه</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>
        </header>

        <div class="container mx-auto px-6 py-24">
            <div class="max-w-4xl mx-auto">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="mb-16 border border-border bg-surface-darkest overflow-hidden shadow-2xl">
                        <?php the_post_thumbnail('full', ['class' => 'w-full h-auto']); ?>
                    </div>
                <?php endif; ?>

                <div class="prose prose-invert prose-zinc max-w-none text-right rtl
                            prose-headings:font-black prose-headings:tracking-tighter prose-headings:text-white
                            prose-p:text-zinc-400 prose-p:leading-relaxed prose-p:text-lg
                            prose-strong:text-white prose-a:text-primary
                            prose-code:text-secondary prose-pre:bg-surface-darkest prose-pre:border prose-pre:border-border">
                    <?php the_content(); ?>
                </div>

                <footer class="mt-24 pt-12 border-t border-border flex flex-col md:flex-row justify-between items-center gap-8 rtl">
                    <div class="text-right">
                        <span class="text-[10px] font-black text-zinc-600 uppercase tracking-widest block mb-4">برچسب‌ها</span>
                        <div class="flex flex-wrap gap-2 justify-end">
                            <?php the_tags('<span class="px-3 py-1 bg-surface-high border border-border text-[10px] font-bold text-zinc-400 uppercase tracking-widest">', '</span><span class="px-3 py-1 bg-surface-high border border-border text-[10px] font-bold text-zinc-400 uppercase tracking-widest">', '</span>'); ?>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 flex items-center justify-center border border-border text-zinc-400 hover:text-primary hover:border-primary transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                    </div>
                </footer>
            </div>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
