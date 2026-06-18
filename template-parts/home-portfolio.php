<section class="py-24 bg-surface">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-end mb-16 rtl">
            <div class="text-right">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-4 block">گزیده آثار</span>
                <h2 class="text-4xl md:text-5xl font-black text-white tracking-tighter">پروژه‌های اخیر</h2>
            </div>
            <a href="#" class="hidden md:block px-6 py-3 border border-border text-white text-[10px] font-black uppercase tracking-widest hover:bg-surface-high transition-colors">
                مشاهده همه
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => 3,
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
                    <article class="group relative aspect-[4/5] overflow-hidden bg-surface-darkest border border-border">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', ['class' => 'absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 group-hover:opacity-40 transition-all duration-700']); ?>
                        <?php endif; ?>

                        <div class="absolute inset-0 bg-gradient-to-t from-surface via-surface/20 to-transparent"></div>

                        <div class="absolute inset-0 p-8 flex flex-col justify-end text-right rtl">
                            <div class="mb-4 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500">
                                <?php
                                $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                                if ($categories) : ?>
                                    <span class="text-[10px] font-bold text-primary uppercase tracking-widest">
                                        <?php echo esc_html($categories[0]->name); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <h3 class="text-2xl font-black text-white mb-2 tracking-tight">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <p class="text-zinc-400 text-xs mb-6 line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                <?php echo get_the_excerpt(); ?>
                            </p>

                            <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-[10px] font-black text-white uppercase tracking-widest group/link">
                                مشاهده جزئیات
                                <svg class="w-4 h-4 text-primary group-hover/link:translate-x-[-4px] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            </a>
                        </div>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <!-- Dummy Items for showcase if no posts -->
                <?php for($i=1; $i<=3; $i++): ?>
                    <div class="aspect-[4/5] bg-surface-high border border-border p-8 flex flex-col justify-end text-right rtl opacity-50">
                        <div class="w-12 h-1 bg-primary mb-4"></div>
                        <h3 class="text-2xl font-black text-white mb-2">پروژه نمونه شماره <?php echo $i; ?></h3>
                        <p class="text-zinc-500 text-xs">در حال آماده‌سازی برای نمایش...</p>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
