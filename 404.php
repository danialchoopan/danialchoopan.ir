<?php
/**
 * 404 Page Template — Displayed when no content matches the request.
 *
 * Shows a stylized error page consistent with the theme design.
 *
 * @package DanialPortfolio
 */

get_header();

$not_found_title   = get_theme_mod( '404_title', '404' );
$not_found_message = get_theme_mod( '404_message', 'صفحه مورد نظر یافت نشد.' );
?>

<section class="min-h-screen flex items-center justify-center bg-surface grid-pattern">
    <div class="container mx-auto px-6 text-center">
        <!-- Terminal Window -->
        <div class="max-w-lg mx-auto bg-surface-darkest border border-border rounded-xl overflow-hidden mb-12">
            <div class="bg-surface-high px-4 py-3 border-b border-border flex items-center justify-between">
                <div class="flex gap-1.5">
                    <div class="w-3 h-3 rounded-full bg-[#FF5F56]"></div>
                    <div class="w-3 h-3 rounded-full bg-[#FFBD2E]"></div>
                    <div class="w-3 h-3 rounded-full bg-[#27C93F]"></div>
                </div>
                <div class="text-[10px] text-zinc-500 uppercase tracking-widest">error.log</div>
            </div>
            <div class="p-8 font-mono text-sm">
                <div class="flex gap-4 mb-2">
                    <span class="text-zinc-700 w-4">1</span>
                    <span><span class="text-secondary">$</span> navigate --to "<?php echo esc_url( home_url() ); ?>"</span>
                </div>
                <div class="flex gap-4 mb-2">
                    <span class="text-zinc-700 w-4">2</span>
                    <span class="text-[#FF5F56]">Error: PAGE_NOT_FOUND (<?php echo esc_html( $not_found_title ); ?>)</span>
                </div>
                <div class="flex gap-4 mb-2">
                    <span class="text-zinc-700 w-4">3</span>
                    <span class="text-zinc-500"><?php echo esc_html( $not_found_message ); ?></span>
                </div>
                <div class="flex gap-4">
                    <span class="text-zinc-700 w-4">4</span>
                    <span><span class="text-secondary">$</span> <span class="typing-animation">try --solution</span></span>
                </div>
            </div>
        </div>

        <!-- Big 404 Number -->
        <div class="text-[120px] md:text-[200px] font-black text-primary/10 leading-none tracking-tighter mb-8 select-none">
            <?php echo esc_html( $not_found_title ); ?>
        </div>

        <!-- Message -->
        <p class="text-zinc-500 text-lg mb-12 max-w-md mx-auto">
            <?php echo esc_html( $not_found_message ); ?>
        </p>

        <!-- Actions -->
        <div class="flex flex-wrap justify-center gap-4">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="px-8 py-4 bg-primary text-surface text-[12px] font-black uppercase tracking-widest rounded-sm hover:opacity-90 transition-opacity">
                <?php echo esc_html( get_theme_mod( '404_home_button', 'بازگشت به صفحه اصلی' ) ); ?>
            </a>
            <button onclick="history.back()" class="px-8 py-4 border border-border text-white text-[12px] font-black uppercase tracking-widest rounded-sm hover:bg-surface-high transition-colors">
                <?php echo esc_html( get_theme_mod( '404_back_button', 'بازگشت' ) ); ?>
            </button>
        </div>
    </div>
</section>

<?php get_footer(); ?>
