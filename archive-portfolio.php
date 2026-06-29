<?php
/**
 * The template for displaying portfolio archives
 */

get_header();
$cols = get_theme_mod('portfolio_columns', '3');
$grid_class = "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{$cols} gap-8";
?>

<div class="container mx-auto px-6 py-20">
    <header class="mb-20">
        <h1 class="text-6xl md:text-8xl font-black text-white tracking-tighter mb-4 uppercase">
            <?php esc_html_e('Built_With_Code', 'devportfolio'); ?>
        </h1>
        <p class="text-zinc-500 font-mono text-sm max-w-2xl">
            <?php esc_html_e('// A curated collection of technical challenges, architectural solutions, and full-stack implementations.', 'devportfolio'); ?>
        </p>
    </header>

    <div class="<?php echo esc_attr($grid_class); ?>">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article class="group relative border border-border bg-surface-high hover:border-primary/50 transition-all duration-500">
                <a href="<?php the_permalink(); ?>" class="absolute inset-0 z-10"></a>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="aspect-video overflow-hidden grayscale group-hover:grayscale-0 transition-all duration-500">
                        <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500']); ?>
                    </div>
                <?php endif; ?>
                <div class="p-8">
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="text-xl font-black text-white group-hover:text-primary transition-colors">
                            <?php the_title(); ?>
                        </h2>
                        <svg class="w-5 h-5 text-zinc-600 group-hover:text-primary transition-colors -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                    <div class="text-zinc-400 text-sm line-clamp-2">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</div>

<?php get_footer();
