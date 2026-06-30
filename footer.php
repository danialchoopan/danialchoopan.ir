</main>

<?php
$footer_desc       = get_theme_mod( 'footer_description', '' );
$footer_back_top   = get_theme_mod( 'footer_back_to_top_text', 'Back_to_top' );
$show_footer_nav   = get_theme_mod( 'show_footer_nav', true );
$show_footer_social = get_theme_mod( 'show_footer_social', true );
$footer_columns    = get_theme_mod( 'footer_columns', '4' );
$footer_bg         = get_theme_mod( 'footer_bg_color', '' );
$footer_bg_style   = $footer_bg ? 'background-color:' . esc_attr( $footer_bg ) . ';' : '';
?>

<footer class="bg-surface border-t border-border py-20" <?php echo $footer_bg_style ? 'style="' . $footer_bg_style . '"' : ''; ?>>
	<div class="container mx-auto px-6">
		<div class="grid grid-cols-1 md:grid-cols-<?php echo absint( $footer_columns ); ?> gap-12 mb-20">
            <div class="md:col-span-2">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-3xl font-black tracking-tighter text-white mb-6 block">
                    <?php bloginfo( 'name' ); ?>
                </a>
                <p class="text-zinc-500 font-mono text-sm leading-relaxed max-w-sm">
                    <?php echo $footer_desc ? esc_html( $footer_desc ) : get_bloginfo( 'description' ); ?>
                </p>
            </div>

            <?php if ( $show_footer_nav ) : ?>
            <div>
                <h4 class="text-[10px] font-black uppercase tracking-widest text-white mb-6"><?php esc_html_e('Navigation', 'devportfolio'); ?></h4>
                <div class="flex flex-col gap-4 text-xs font-bold text-zinc-500 uppercase tracking-widest">
                    <?php
                    if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'container'      => false,
                            'items_wrap'     => '%3$s',
                        ) );
                    } ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if ( $show_footer_social ) : ?>
            <div>
                <h4 class="text-[10px] font-black uppercase tracking-widest text-white mb-6"><?php esc_html_e('Social', 'devportfolio'); ?></h4>
                <div class="flex flex-col gap-4 text-xs font-bold text-zinc-500 uppercase tracking-widest">
                    <?php if ( get_theme_mod('github_url', '#') !== '#' ) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('github_url', '#')); ?>" class="hover:text-primary transition-colors">GitHub</a>
                    <?php endif; ?>
                    <?php if ( get_theme_mod('twitter_url', '#') !== '#' ) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('twitter_url', '#')); ?>" class="hover:text-primary transition-colors">Twitter / X</a>
                    <?php endif; ?>
                    <?php if ( get_theme_mod('linkedin_url', '#') !== '#' ) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('linkedin_url', '#')); ?>" class="hover:text-primary transition-colors">LinkedIn</a>
                    <?php endif; ?>
                    <?php if ( get_theme_mod('telegram_url', '#') !== '#' ) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('telegram_url', '#')); ?>" class="hover:text-primary transition-colors">Telegram</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center pt-12 border-t border-border/30 gap-8">
			<div class="text-[10px] font-bold uppercase tracking-widest text-zinc-600">
				&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> // <?php echo esc_html(get_theme_mod('footer_copyright', 'ALL RIGHTS RESERVED')); ?>
			</div>

			<div class="flex items-center gap-8">
				<a href="#top" class="text-[10px] font-bold uppercase tracking-widest text-primary hover:underline"><?php echo esc_html( $footer_back_top ); ?></a>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<?php if ( get_theme_mod( 'show_whatsapp', false ) && get_theme_mod( 'whatsapp_number', '' ) ) :
    $wa_number = preg_replace( '/[^0-9]/', '', get_theme_mod( 'whatsapp_number', '' ) );
    $wa_msg    = rawurlencode( get_theme_mod( 'whatsapp_message', 'سلام، می‌خواهم در مورد پروژه صحبت کنم.' ) );
?>
<a href="https://wa.me/<?php echo esc_attr( $wa_number ); ?>?text=<?php echo esc_attr( $wa_msg ); ?>" target="_blank" rel="noopener" class="fixed bottom-6 left-6 z-50 w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform" aria-label="WhatsApp">
    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>
<?php endif; ?>

</body>
</html>