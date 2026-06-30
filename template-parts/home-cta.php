<?php
/**
 * CTA Section — Call-to-action banner on the homepage.
 *
 * @package DanialPortfolio
 */

$cta_title       = get_theme_mod( 'cta_title', 'آماده‌اید پروژه بعدی را شروع کنیم؟' );
$cta_description = get_theme_mod( 'cta_description', 'بیایید با هم یک نرم‌افزار فوق‌العاده بسازیم. همین الان تماس بگیرید.' );
$cta_button_text = get_theme_mod( 'cta_button_text', 'شروع پروژه' );
$cta_button_url  = get_theme_mod( 'cta_button_url', '#contact' );
?>

<section class="py-24 bg-surface border-y border-border relative overflow-hidden">
    <!-- Background Grid Pattern -->
    <div class="absolute inset-0 grid-pattern opacity-30"></div>

    <div class="container mx-auto px-6 relative z-10 text-center">
        <h2 class="text-4xl md:text-6xl font-black text-white tracking-tighter mb-8 leading-tight">
            <?php echo esc_html( $cta_title ); ?>
        </h2>
        <p class="text-zinc-400 text-lg mb-12 max-w-2xl mx-auto leading-relaxed">
            <?php echo esc_html( $cta_description ); ?>
        </p>
        <a href="<?php echo esc_url( $cta_button_url ); ?>" class="inline-block px-12 py-5 bg-primary text-surface text-[12px] font-black uppercase tracking-widest rounded-sm hover:opacity-90 transition-opacity">
            <?php echo esc_html( $cta_button_text ); ?>
        </a>
    </div>
</section>
