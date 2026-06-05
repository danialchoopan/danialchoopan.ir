	<footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 py-12">
		<div class="container mx-auto px-6">
			<div class="grid grid-cols-1 md:grid-cols-3 gap-12">
				<div class="col-span-1">
					<h3 class="text-xl font-bold mb-4"><?php bloginfo( 'name' ); ?></h3>
					<p class="text-secondary dark:text-gray-400 mb-6 max-w-xs">
						<?php bloginfo( 'description' ); ?>
					</p>
					<div class="flex gap-4">
						<?php
						$social_links = devportfolio_get_social_links();
						foreach ( $social_links as $platform => $url ) :
							?>
							<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center rounded-full bg-white dark:bg-dark border border-gray-200 dark:border-gray-700 hover:border-primary transition-colors">
								<span class="sr-only"><?php echo esc_html( ucfirst( $platform ) ); ?></span>
								<i class="fab fa-<?php echo esc_attr( $platform ); ?>"></i>
							</a>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="col-span-1">
					<h4 class="font-bold mb-4 uppercase tracking-wider text-sm"><?php esc_html_e( 'Quick Links', 'devportfolio' ); ?></h4>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => 'flex flex-col space-y-2 text-secondary dark:text-gray-400',
							'fallback_cb'    => '__return_false',
						)
					);
					?>
				</div>

				<div class="col-span-1 text-start md:text-end">
					<h4 class="font-bold mb-4 uppercase tracking-wider text-sm"><?php esc_html_e( 'Status', 'devportfolio' ); ?></h4>
					<div class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-full text-xs font-bold mb-4">
						<span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
						<?php esc_html_e( 'Available for hire', 'devportfolio' ); ?>
					</div>
					<p class="text-secondary dark:text-gray-400 text-sm">
						&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'devportfolio' ); ?>
					</p>
				</div>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
