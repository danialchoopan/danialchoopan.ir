<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('container mx-auto px-6 py-24'); ?>>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <header class="max-w-4xl mx-auto mb-16 text-center">
            <div class="flex justify-center items-center gap-4 mb-8">
                <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) :
                    foreach ( $categories as $cat ) : ?>
                        <span class="px-2 py-1 bg-primary text-surface text-[8px] font-bold uppercase tracking-widest">
                            <?php echo esc_html( $cat->name ); ?>
                        </span>
                    <?php endforeach;
                endif; ?>
                <span class="text-zinc-600 text-[10px] font-mono">/ / <?php echo esc_html( get_the_date() ); ?></span>
            </div>

            <h1 class="text-4xl md:text-6xl font-black text-white tracking-tighter mb-8 leading-tight">
                <?php the_title(); ?>
            </h1>

            <div class="flex items-center justify-center gap-6 text-[10px] font-black uppercase tracking-widest text-zinc-500">
                <span><?php echo sprintf( esc_html__( '%1$s %2$s', 'devportfolio' ), devportfolio_reading_time( get_the_content() ), esc_html( get_theme_mod( 'single_reading_time_label', 'MIN_READ' ) ) ); ?></span>
                <span class="w-1 h-1 rounded-full bg-zinc-700"></span>
                <span><?php echo esc_html( get_the_author() ); ?></span>
            </div>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="max-w-5xl mx-auto mb-16 border border-border overflow-hidden rounded-sm">
                <?php the_post_thumbnail('full', ['class' => 'w-full h-auto grayscale hover:grayscale-0 transition-all duration-1000']); ?>
            </div>
        <?php endif; ?>

        <div class="max-w-3xl mx-auto">
            <div class="prose prose-invert prose-primary max-w-none prose-pre:p-0 prose-pre:bg-transparent">
                <?php the_content(); ?>
            </div>

            <footer class="mt-20 pt-12 border-t border-border/50">
                <?php the_post_navigation([
                    'prev_text' => '<span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest block mb-2">' . esc_html( get_theme_mod( 'single_prev_text', 'PREVIOUS_LOG' ) ) . '</span> <span class="text-white font-bold">%title</span>',
                    'next_text' => '<span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest block mb-2">' . esc_html( get_theme_mod( 'single_next_text', 'NEXT_LOG' ) ) . '</span> <span class="text-white font-bold">%title</span>',
                ]); ?>
            </footer>

            <?php if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif; ?>
        </div>

    <?php endwhile; endif; ?>
</article>

<?php get_footer(); ?>
