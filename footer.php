</main>

<footer class="bg-surface border-t border-border py-20">
	<div class="container mx-auto px-6">
		<div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-20">
            <div class="md:col-span-2">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-3xl font-black tracking-tighter text-white mb-6 block">
                    <?php bloginfo( 'name' ); ?>
                </a>
                <p class="text-zinc-500 font-mono text-sm leading-relaxed max-w-sm">
                    <?php bloginfo('description'); ?>
                </p>
            </div>

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

            <div>
                <h4 class="text-[10px] font-black uppercase tracking-widest text-white mb-6"><?php esc_html_e('Social', 'devportfolio'); ?></h4>
                <div class="flex flex-col gap-4 text-xs font-bold text-zinc-500 uppercase tracking-widest">
                    <a href="<?php echo esc_url(get_theme_mod('github_url', '#')); ?>" class="hover:text-primary transition-colors">GitHub</a>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center pt-12 border-t border-border/30 gap-8">
			<div class="text-[10px] font-bold uppercase tracking-widest text-zinc-600">
				© <?php echo date('Y'); ?> <?php bloginfo('name'); ?> // <?php echo esc_html(get_theme_mod('footer_copyright', 'ALL RIGHTS RESERVED ©')); ?>
			</div>

			<div class="flex items-center gap-8">
				<a href="#top" class="text-[10px] font-bold uppercase tracking-widest text-primary hover:underline"><?php esc_html_e('Back_to_top ↑', 'devportfolio'); ?></a>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
