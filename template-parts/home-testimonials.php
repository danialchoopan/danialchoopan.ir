<?php
/**
 * Testimonials Section — Displays client testimonials on the homepage.
 *
 * Pulls from the 'testimonials' CPT and displays them in a
 * responsive grid. Falls back to placeholder content if none exist.
 *
 * @package DanialPortfolio
 */

$subtitle = get_theme_mod( 'testimonials_subtitle', 'نظرات مشتریان' );
$title    = get_theme_mod( 'testimonials_title', 'چه می‌گویند' );

$args = [
	'post_type'      => 'testimonials',
	'posts_per_page' => 6,
	'orderby'        => 'date',
	'order'          => 'DESC',
];
$query = new WP_Query( $args );
?>

<section class="py-24 bg-surface-darkest">
    <div class="container mx-auto px-6">
        <!-- Section Header -->
        <div class="flex flex-col items-end mb-16 text-right rtl">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-4"><?php echo esc_html( $subtitle ); ?></span>
            <h2 class="text-4xl md:text-5xl font-black text-white tracking-tighter"><?php echo esc_html( $title ); ?></h2>
        </div>

        <?php if ( $query->have_posts() ) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while ( $query->have_posts() ) : $query->the_post();
                $client_name = get_post_meta( get_the_ID(), '_testimonial_client_name', true );
                $client_role = get_post_meta( get_the_ID(), '_testimonial_client_role', true );
                $rating      = (int) get_post_meta( get_the_ID(), '_testimonial_rating', true );
                $rating      = max( 1, min( 5, $rating ) );
            ?>
                <div class="p-8 bg-surface border border-border hover:border-primary transition-all duration-500 text-right rtl">
                    <!-- Star Rating -->
                    <div class="mb-6 text-primary">
                        <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                            <span class="text-lg"><?php echo $i < $rating ? '&#9733;' : '&#9734;'; ?></span>
                        <?php endfor; ?>
                    </div>

                    <!-- Testimonial Content -->
                    <p class="text-zinc-400 text-sm leading-relaxed mb-8 italic">
                        "<?php echo esc_html( get_the_content() ); ?>"
                    </p>

                    <!-- Client Info -->
                    <div class="flex items-center gap-4">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="w-12 h-12 rounded-full overflow-hidden border border-border flex-shrink-0">
                                <?php the_post_thumbnail( 'thumbnail', [ 'class' => 'w-full h-full object-cover' ] ); ?>
                            </div>
                        <?php else : ?>
                            <div class="w-12 h-12 rounded-full bg-surface-high border border-border flex items-center justify-center flex-shrink-0">
                                <span class="text-primary font-bold text-lg"><?php echo esc_html( ! empty( $client_name ) ? mb_substr( $client_name, 0, 1 ) : '?' ); ?></span>
                            </div>
                        <?php endif; ?>
                        <div>
                            <h4 class="text-white font-bold text-sm"><?php echo esc_html( $client_name ); ?></h4>
                            <p class="text-zinc-500 text-xs"><?php echo esc_html( $client_role ); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>

        <?php else : ?>
        <!-- Fallback placeholders when no testimonials exist -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
                <div class="p-8 bg-surface border border-border opacity-50 text-right rtl">
                    <div class="mb-6 text-primary">
                        <?php for ( $s = 0; $s < 5; $s++ ) : ?>
                            <span class="text-lg">&#9733;</span>
                        <?php endfor; ?>
                    </div>
                    <p class="text-zinc-400 text-sm leading-relaxed mb-8 italic">
                        "<?php esc_html_e( 'Sample testimonial — add your client reviews from the admin panel.', 'devportfolio' ); ?>"
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-surface-high border border-border flex items-center justify-center">
                            <span class="text-primary font-bold text-lg"><?php echo $i; ?></span>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-sm"><?php printf( esc_html__( 'Client %d', 'devportfolio' ), $i ); ?></h4>
                            <p class="text-zinc-500 text-xs"><?php esc_html_e( 'Role / Company', 'devportfolio' ); ?></p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
