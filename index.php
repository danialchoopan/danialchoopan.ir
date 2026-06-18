<?php get_header(); ?>

<section class="py-24 bg-surface min-h-screen grid-pattern">
    <div class="container mx-auto px-6">
        <div class="flex flex-col items-end mb-16 text-right rtl">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-4">آرشیو مطالب</span>
            <h1 class="text-5xl md:text-6xl font-black text-white tracking-tighter">وبلاگ فنی</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Sidebar -->
            <aside class="lg:col-span-4 order-2 lg:order-1 space-y-12">
                <!-- Search -->
                <div class="bg-surface-darkest border border-border p-8 text-right rtl">
                    <h3 class="text-[10px] font-black text-primary uppercase tracking-[0.3em] mb-6">SEARCH_DATABASE</h3>
                    <form action="<?php echo home_url('/'); ?>" method="get" class="relative">
                        <input type="text" name="s" placeholder="جستجو در مطالب..." class="w-full bg-surface border border-border px-4 py-3 text-sm text-white focus:border-primary outline-none transition-colors rtl">
                        <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-500 hover:text-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </form>
                </div>

                <!-- Categories -->
                <div class="bg-surface-darkest border border-border p-8 text-right rtl">
                    <h3 class="text-[10px] font-black text-primary uppercase tracking-[0.3em] mb-6">CATEGORIES</h3>
                    <ul class="space-y-4">
                        <?php
                        $categories = get_categories();
                        foreach($categories as $cat) : ?>
                            <li class="flex justify-between items-center text-xs font-bold uppercase tracking-widest group">
                                <span class="text-zinc-500">(<?php echo $cat->count; ?>)</span>
                                <a href="<?php echo get_category_link($cat->term_id); ?>" class="text-zinc-400 group-hover:text-white transition-colors"><?php echo $cat->name; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>

            <!-- Main Feed -->
            <div class="lg:col-span-8 order-1 lg:order-2 space-y-8">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article class="group bg-surface-darkest border border-border hover:border-primary transition-colors flex flex-col md:flex-row gap-8 overflow-hidden text-right rtl">
                        <div class="md:w-64 aspect-square flex-shrink-0 bg-surface border-l border-border md:rtl:border-l-0 md:rtl:border-r">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500']); ?>
                            <?php else : ?>
                                <div class="w-full h-full grid-pattern opacity-10"></div>
                            <?php endif; ?>
                        </div>

                        <div class="p-8 flex-grow">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-[10px] font-bold text-primary uppercase tracking-widest"><?php the_category(', '); ?></span>
                                <time class="text-[10px] text-zinc-500 font-bold uppercase tracking-widest"><?php echo get_the_date(); ?></time>
                            </div>

                            <h2 class="text-2xl font-black text-white mb-4 leading-tight group-hover:text-primary transition-colors">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <p class="text-zinc-500 text-sm mb-8 leading-relaxed line-clamp-2">
                                <?php echo get_the_excerpt(); ?>
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-[10px] text-zinc-500 font-bold uppercase tracking-widest">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <?php echo devportfolio_reading_time(get_the_content()); ?> دقیقه مطالعه
                                </div>
                                <a href="<?php the_permalink(); ?>" class="text-[10px] font-black text-white uppercase tracking-widest hover:text-primary transition-colors">مطالعه کامل</a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; endif; ?>

                <div class="pt-12">
                    <?php the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => 'قبلی',
                        'next_text' => 'بعدی',
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
