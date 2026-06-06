	<footer class="bg-zinc-950 border-t border-zinc-900 py-24 relative overflow-hidden">
		<div class="container mx-auto px-6 relative z-10">
			<div class="grid grid-cols-1 md:grid-cols-4 gap-16 mb-20">
				<div class="col-span-1 md:col-span-2">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-xl font-black mb-8 inline-block tracking-tighter">
						<span class="text-primary">/</span><?php bloginfo( 'name' ); ?>
					</a>
					<p class="text-zinc-500 mb-8 max-w-sm text-base leading-relaxed font-medium">
						<?php bloginfo( 'description' ); ?>
					</p>
					<div class="flex gap-4">
						<?php
						$social_links = devportfolio_get_social_links();
						foreach ( $social_links as $platform => $url ) :
							?>
							<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center rounded-lg bg-zinc-900 border border-zinc-800 text-zinc-500 hover:text-white hover:border-primary transition-all duration-300">
								<span class="sr-only"><?php echo esc_html( ucfirst( $platform ) ); ?></span>
								<div class="w-5 h-5"><?php echo devportfolio_get_svg( $platform ); ?></div>
							</a>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="col-span-1">
					<h4 class="font-black text-[10px] uppercase tracking-[0.3em] text-zinc-600 mb-8"><?php esc_html_e( 'System', 'devportfolio' ); ?></h4>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => 'flex flex-col space-y-4 text-zinc-500 text-[11px] font-bold uppercase tracking-widest',
							'fallback_cb'    => '__return_false',
						)
					);
					?>
				</div>

				<div class="col-span-1">
					<h4 class="font-black text-[10px] uppercase tracking-[0.3em] text-zinc-600 mb-8"><?php esc_html_e( 'Status', 'devportfolio' ); ?></h4>
					<div class="flex items-center gap-3 text-accent text-xs font-black uppercase tracking-widest">
						<span class="relative flex h-2 w-2">
							<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
							<span class="relative inline-flex rounded-full h-2 w-2 bg-accent"></span>
						</span>
						<?php esc_html_e( 'Accepting Proposals', 'devportfolio' ); ?>
					</div>
				</div>
			</div>

			<div class="pt-8 border-t border-zinc-900 flex flex-col md:flex-row justify-between items-center gap-6">
				<p class="text-zinc-700 text-[10px] font-black uppercase tracking-widest">
					&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <span class="mx-2 opacity-30">|</span> <?php esc_html_e( 'Zero Dependency Core', 'devportfolio' ); ?>
				</p>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
