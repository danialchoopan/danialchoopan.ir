<?php
/**
 * Template Name: About Page
 */
get_header(); ?>

<section class="py-24 bg-surface min-h-screen grid-pattern">
    <div class="container mx-auto px-6">
        <div class="flex flex-col items-end mb-24 text-right rtl">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-4">درباره ما</span>
            <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter italic"><?php bloginfo('name'); ?></h1>
            <p class="text-zinc-500 max-w-2xl mt-8 text-lg leading-relaxed">ما یک تیم کوچک اما قدرتمند از توسعه‌دهندگان ارشد هستیم که بر روی خلق نرم‌افزارهای با کیفیت بالا تمرکز داریم.</p>
        </div>

        <div class="max-w-4xl ml-auto text-right rtl prose prose-invert prose-zinc prose-lg
                    prose-headings:font-black prose-headings:tracking-tighter prose-headings:text-white
                    prose-p:text-zinc-400 prose-p:leading-relaxed">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
