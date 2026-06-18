<?php get_header(); ?>

<section class="py-24 bg-surface min-h-screen grid-pattern">
    <div class="container mx-auto px-6">
        <div class="flex flex-col items-end mb-16 text-right rtl">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-4">آرشیو آثار</span>
            <h1 class="text-5xl md:text-6xl font-black text-white tracking-tighter">نمونه کارها</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="group relative aspect-[4/5] overflow-hidden bg-surface-darkest border border-border">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', ['class' => 'absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 group-hover:opacity-40 transition-all duration-700']); ?>
                    <?php endif; ?>

                    <div class="absolute inset-0 bg-gradient-to-t from-surface via-surface/20 to-transparent"></div>

                    <div class="absolute inset-0 p-8 flex flex-col justify-end text-right rtl">
                        <div class="mb-4">
                            <?php
                            $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                            if ($categories) : ?>
                                <span class="text-[10px] font-bold text-primary uppercase tracking-widest">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <h2 class="text-2xl font-black text-white mb-2 tracking-tight">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <p class="text-zinc-400 text-xs mb-6 line-clamp-2">
                            <?php echo get_the_excerpt(); ?>
                        </p>

                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-[10px] font-black text-white uppercase tracking-widest group/link">
                            مشاهده جزئیات
                            <svg class="w-4 h-4 text-primary group-hover/link:translate-x-[-4px] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </a>
                    </div>
                </article>
            <?php endwhile; endif; ?>
        </div>

        <div class="mt-16 flex justify-center">
            <?php the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => 'قبلی',
                'next_text' => 'بعدی',
                'class' => 'text-white'
            )); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
