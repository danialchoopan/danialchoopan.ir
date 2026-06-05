	<footer class="bg-zinc-950 border-t border-zinc-900 py-20 relative overflow-hidden">
		<!-- Background glow -->
		<div class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 w-full max-w-4xl h-96 bg-primary/10 blur-[120px] rounded-full pointer-events-none"></div>

		<div class="container mx-auto px-6 relative z-10">
			<div class="grid grid-cols-1 md:grid-cols-4 gap-16 mb-20">
				<div class="col-span-1 md:col-span-2">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-black mb-8 inline-block">
						<span class="text-primary tracking-tighter">/</span><?php bloginfo( 'name' ); ?>
					</a>
					<p class="text-zinc-400 mb-8 max-w-md text-lg leading-relaxed">
						<?php bloginfo( 'description' ); ?>
					</p>
					<div class="flex gap-4">
						<?php
						$social_links = devportfolio_get_social_links();
						foreach ( $social_links as $platform => $url ) :
							?>
							<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="w-12 h-12 flex items-center justify-center rounded-xl bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white hover:border-primary hover:bg-primary/5 transition-all duration-300">
								<span class="sr-only"><?php echo esc_html( ucfirst( $platform ) ); ?></span>
								<i class="fab fa-<?php echo esc_attr( $platform ); ?> text-xl"></i>
							</a>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="col-span-1">
					<h4 class="font-black text-xs uppercase tracking-[0.2em] text-zinc-500 mb-8"><?php esc_html_e( 'Navigation', 'devportfolio' ); ?></h4>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => 'flex flex-col space-y-4 text-zinc-400 font-medium',
							'fallback_cb'    => '__return_false',
						)
					);
					?>
				</div>

				<div class="col-span-1">
					<h4 class="font-black text-xs uppercase tracking-[0.2em] text-zinc-500 mb-8"><?php esc_html_e( 'Availability', 'devportfolio' ); ?></h4>
					<div class="p-6 bg-zinc-900/50 border border-zinc-800 rounded-2xl">
						<div class="flex items-center gap-3 text-accent mb-2">
							<span class="relative flex h-3 w-3">
								<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
								<span class="relative inline-flex rounded-full h-3 w-3 bg-accent"></span>
							</span>
							<span class="font-bold text-sm"><?php esc_html_e( 'Open for Projects', 'devportfolio' ); ?></span>
						</div>
						<p class="text-zinc-500 text-xs leading-relaxed">
							<?php esc_html_e( 'Currently accepting high-impact engineering opportunities for Q3/Q4 2024.', 'devportfolio' ); ?>
						</p>
					</div>
				</div>
			</div>

			<div class="pt-8 border-t border-zinc-900 flex flex-col md:flex-row justify-between items-center gap-6">
				<p class="text-zinc-600 text-sm font-medium">
					&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <span class="mx-2 opacity-30">|</span> <?php esc_html_e( 'Built with Clean Architecture', 'devportfolio' ); ?>
				</p>
				<div class="flex items-center gap-6 text-zinc-600 text-xs font-bold uppercase tracking-widest">
					<a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Privacy', 'devportfolio' ); ?></a>
					<a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Terms', 'devportfolio' ); ?></a>
				</div>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
