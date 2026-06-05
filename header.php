<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'font-vazir bg-white text-dark dark:bg-dark dark:text-white' ); ?>>
	<?php wp_body_open(); ?>

	<header class="sticky top-0 z-50 bg-white/80 dark:bg-dark/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
		<div class="container mx-auto px-6 py-4 flex justify-between items-center">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold tracking-tight">
					<?php bloginfo( 'name' ); ?>
				</a>
			</div>

			<nav class="hidden md:flex items-center space-x-8 rtl:space-x-reverse">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'flex space-x-8 rtl:space-x-reverse font-medium',
						'fallback_cb'    => '__return_false',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);
				?>
				<div class="language-switcher flex items-center gap-4">
					<?php
					// Simple language switcher placeholder - in a real app, this would use a plugin like WPML or Polylang
					$current_lang = is_rtl() ? 'FA' : 'EN';
					$other_lang    = is_rtl() ? 'EN' : 'FA';
					?>
					<span class="text-sm font-bold px-2 py-1 bg-primary text-white rounded"><?php echo esc_html( $current_lang ); ?></span>
					<a href="#" class="text-sm opacity-60 hover:opacity-100 transition-opacity"><?php echo esc_html( $other_lang ); ?></a>
				</div>
			</nav>

			<button id="menu-toggle" class="md:hidden flex flex-col gap-1.5 p-2">
				<span class="w-6 h-0.5 bg-dark dark:bg-white transition-all"></span>
				<span class="w-6 h-0.5 bg-dark dark:bg-white transition-all"></span>
				<span class="w-6 h-0.5 bg-dark dark:bg-white transition-all"></span>
			</button>
		</div>

		<!-- Mobile Menu -->
		<div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 w-full bg-white dark:bg-dark border-b border-gray-100 dark:border-gray-800 p-6 shadow-xl">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'flex flex-col space-y-4 font-medium',
					'fallback_cb'    => '__return_false',
				)
			);
			?>
		</div>
	</header>

	<script>
		document.getElementById('menu-toggle').addEventListener('click', function() {
			const menu = document.getElementById('mobile-menu');
			menu.classList.toggle('hidden');
		});
	</script>
