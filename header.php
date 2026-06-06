<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
	<script>
		// Inline script to prevent FOUC and handle dark mode preference
		if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
			document.documentElement.classList.add('dark');
		} else {
			document.documentElement.classList.remove('dark');
		}
	</script>
	<style>
		.grid-pattern {
			background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
			background-size: 40px 40px;
		}
		.light .grid-pattern {
			background-image: radial-gradient(rgba(0, 0, 0, 0.05) 1px, transparent 1px);
		}
	</style>
</head>
<body <?php body_class( 'font-vazir bg-white text-zinc-900 dark:bg-zinc-950 dark:text-zinc-100 selection:bg-primary/30' ); ?>>
	<?php wp_body_open(); ?>

	<?php
	$header_bg = get_theme_mod('header_bg_image');
	$logo_text = get_theme_mod('header_logo_text', 'DP');
	?>
	<header class="sticky top-0 z-50 bg-white/80 dark:bg-zinc-950/80 backdrop-blur-xl border-b border-zinc-200 dark:border-zinc-900/50" <?php echo $header_bg ? 'style="background-image:url('.esc_url($header_bg).'); background-size:cover;"' : ''; ?>>
		<div class="container mx-auto px-6 py-5 flex justify-between items-center">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-xl font-black tracking-tighter flex items-center gap-3 group">
					<span class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white text-xs font-black"><?php echo esc_html($logo_text); ?></span>
					<span class="bg-gradient-to-r from-zinc-900 to-zinc-500 dark:from-white dark:to-zinc-500 bg-clip-text text-transparent group-hover:to-primary transition-all duration-500">
						<?php bloginfo( 'name' ); ?>
					</span>
				</a>
			</div>

			<nav class="hidden md:flex items-center space-x-8 rtl:space-x-reverse">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'flex space-x-8 rtl:space-x-reverse font-bold text-[11px] uppercase tracking-[0.2em] text-zinc-500 dark:text-zinc-400',
						'fallback_cb'    => '__return_false',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);
				?>

				<div class="flex items-center gap-4 border-l border-zinc-200 dark:border-zinc-800 pl-8 rtl:pl-0 rtl:pr-8 rtl:border-l-0 rtl:border-r">
					<!-- Dark Mode Toggle -->
					<button id="theme-toggle" class="p-2 text-zinc-500 hover:text-primary transition-colors">
						<svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
						<svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
					</button>

					<div class="language-switcher flex items-center gap-2">
						<?php
						$current_lang = is_rtl() ? 'FA' : 'EN';
						$other_lang    = is_rtl() ? 'EN' : 'FA';
						?>
						<span class="text-[9px] font-black px-2 py-0.5 bg-primary/20 text-primary border border-primary/30 rounded"><?php echo esc_html( $current_lang ); ?></span>
						<a href="#" class="text-[9px] font-bold text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors uppercase tracking-[0.2em]"><?php echo esc_html( $other_lang ); ?></a>
					</div>
				</div>
			</nav>

			<button id="menu-toggle" class="md:hidden flex flex-col gap-1.5 p-2 group">
				<span class="w-5 h-0.5 bg-zinc-600 dark:bg-zinc-400 group-hover:bg-primary transition-all"></span>
				<span class="w-5 h-0.5 bg-zinc-600 dark:bg-zinc-400 group-hover:bg-primary transition-all"></span>
			</button>
		</div>

		<div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 w-full bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-800 p-8 shadow-2xl">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'flex flex-col space-y-6 font-bold text-sm uppercase tracking-widest',
					'fallback_cb'    => '__return_false',
				)
			);
			?>
		</div>
	</header>

	<script>
		// Theme Toggle Logic
		const themeToggleBtn = document.getElementById('theme-toggle');
		const darkIcon = document.getElementById('theme-toggle-dark-icon');
		const lightIcon = document.getElementById('theme-toggle-light-icon');

		if (document.documentElement.classList.contains('dark')) {
			lightIcon.classList.remove('hidden');
		} else {
			darkIcon.classList.remove('hidden');
		}

		themeToggleBtn.addEventListener('click', function() {
			darkIcon.classList.toggle('hidden');
			lightIcon.classList.toggle('hidden');

			if (localStorage.theme === 'dark') {
				document.documentElement.classList.remove('dark');
				localStorage.theme = 'light';
			} else {
				document.documentElement.classList.add('dark');
				localStorage.theme = 'dark';
			}
		});

		document.getElementById('menu-toggle').addEventListener('click', function() {
			document.getElementById('mobile-menu').classList.toggle('hidden');
		});
	</script>
