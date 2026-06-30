<section class="py-24 bg-surface-darkest">
    <div class="container mx-auto px-6">
        <div class="flex flex-col items-end mb-16 text-right rtl">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-4"><?php echo esc_html( get_theme_mod( 'blog_subtitle', 'آخرین نوشته‌ها' ) ); ?></span>
            <h2 class="text-4xl md:text-5xl font-black text-white tracking-tighter"><?php echo esc_html( get_theme_mod( 'blog_title', 'وبلاگ فنی' ) ); ?></h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <?php
            $args = array(
                'posts_per_page' => (int) get_theme_mod( 'blog_posts_per_page', 4 ),
            );
            $query = new WP_Query($args);
            $posts = $query->posts;

            if ($posts) :
                $featured = array_shift($posts);
                ?>
                <!-- Featured Post -->
                <div class="lg:col-span-7">
                    <article class="group relative bg-surface border border-border overflow-hidden">
                        <div class="aspect-video relative overflow-hidden">
                            <?php if (has_post_thumbnail($featured->ID)) : ?>
                                <?php echo get_the_post_thumbnail($featured->ID, 'large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-700']); ?>
                            <?php else : ?>
                                <div class="w-full h-full bg-surface-high grid-pattern opacity-20"></div>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-surface/40 group-hover:bg-surface/20 transition-colors"></div>
                        </div>

                        <div class="p-8 text-right rtl">
                            <div class="flex justify-between items-center mb-6">
                                <span class="px-2 py-1 bg-primary text-surface text-[8px] font-bold uppercase tracking-widest">FEATURED_POST</span>
                                <time class="text-[10px] text-zinc-500 font-bold uppercase tracking-widest"><?php echo get_the_date('', $featured->ID); ?></time>
                            </div>

                            <h3 class="text-3xl md:text-4xl font-black text-white mb-6 leading-tight">
                                <a href="<?php echo esc_url( get_permalink( $featured->ID ) ); ?>" class="hover:text-primary transition-colors">
                                    <?php echo esc_html( get_the_title( $featured->ID ) ); ?>
                                </a>
                            </h3>

                            <p class="text-zinc-400 mb-8 leading-relaxed line-clamp-3">
                                <?php echo esc_html( get_the_excerpt( $featured->ID ) ); ?>
                            </p>

                            <a href="<?php echo esc_url( get_permalink( $featured->ID ) ); ?>" class="inline-flex items-center gap-2 text-[10px] font-black text-white uppercase tracking-widest group/link">
                                مطالعه ادامه مطلب
                                <svg class="w-4 h-4 text-primary group-hover/link:translate-x-[-4px] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- Secondary Posts -->
                <div class="lg:col-span-5 space-y-6">
                    <?php foreach ($posts as $post) : ?>
                        <article class="flex gap-6 items-start bg-surface/50 border border-border p-4 hover:border-primary transition-colors text-right rtl">
                            <div class="w-24 h-24 flex-shrink-0 bg-surface border border-border overflow-hidden">
                                <?php if (has_post_thumbnail($post->ID)) : ?>
                                    <?php echo get_the_post_thumbnail($post->ID, 'thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                                <?php endif; ?>
                            </div>
                            <div class="flex-grow">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-[8px] font-bold text-primary uppercase tracking-widest"><?php
                                        $post_cats = get_the_category( $post->ID );
                                        echo esc_html( ! empty( $post_cats ) ? $post_cats[0]->name : 'TECH' );
                                    ?></span>
                                    <time class="text-[8px] text-zinc-500 font-bold uppercase tracking-widest"><?php echo get_the_date('', $post->ID); ?></time>
                                </div>
                                <h4 class="text-lg font-black text-white mb-2 leading-snug">
                                    <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="hover:text-primary transition-colors">
                                        <?php echo esc_html( get_the_title( $post->ID ) ); ?>
                                    </a>
                                </h4>
                                <div class="flex items-center gap-2 text-[8px] text-zinc-500 font-bold uppercase tracking-widest">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <?php echo devportfolio_reading_time($post->post_content); ?> دقیقه مطالعه
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
