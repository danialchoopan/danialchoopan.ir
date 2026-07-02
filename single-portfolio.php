<?php
/**
 * The template for displaying all single portfolio items
 */

get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('container mx-auto px-6 py-20'); ?>>
    <header class="mb-12">
        <div class="flex items-center gap-4 mb-4">
            <?php
            $terms = get_the_terms( get_the_ID(), 'portfolio_category' );
            if ( $terms && ! is_wp_error( $terms ) ) :
                foreach ( $terms as $term ) : ?>
                    <span class="text-[10px] font-black uppercase tracking-widest text-primary border border-primary/30 px-3 py-1 rounded-sm">
                        <?php echo esc_html( $term->name ); ?>
                    </span>
                <?php endforeach;
            endif; ?>
        </div>
        <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter mb-8 leading-none">
            <?php the_title(); ?>
        </h1>
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="relative group overflow-hidden border border-border bg-surface-high">
                <?php the_post_thumbnail('full', ['class' => 'w-full h-auto grayscale group-hover:grayscale-0 transition-all duration-700 scale-105 group-hover:scale-100']); ?>
            </div>
        <?php endif; ?>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
        <div class="lg:col-span-8">
            <div class="prose prose-invert prose-primary max-w-none">
                <div class="p-8 border border-border bg-surface-container relative mb-12">
                    <?php echo danial_terminal_dots(); ?>
                    <h2 class="text-zinc-500 font-mono text-sm uppercase tracking-widest mb-6"><?php echo esc_html( get_theme_mod( 'portfolio_context_label', '// PROJECT_CONTEXT' ) ); ?></h2>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

        <aside class="lg:col-span-4 space-y-8">
            <div class="p-8 border border-border bg-surface-high rounded-sm">
                <h3 class="text-xs font-black uppercase tracking-widest text-zinc-500 mb-6"><?php echo esc_html( get_theme_mod( 'portfolio_stack_label', 'Stack' ) ); ?></h3>
                <div class="flex flex-wrap gap-2">
                    <?php
                    $stack = get_post_meta( get_the_ID(), '_portfolio_stack', true );
                    if ( $stack ) :
                        $tags = explode(',', $stack);
                        foreach ($tags as $tag) : ?>
                            <span class="px-3 py-1 bg-surface text-zinc-400 font-mono text-[11px] border border-border hover:border-primary hover:text-primary transition-colors cursor-default">
                                <?php echo esc_html(trim($tag)); ?>
                            </span>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>

			<?php echo wp_kses_post( do_shortcode( '[dev_rank]' ) ); ?>
        </aside>
    </div>
</article>

<?php get_footer();
