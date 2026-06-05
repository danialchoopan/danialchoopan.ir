<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth dark">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
	<style>
		:root {
			--color-zinc-950: #09090b;
		}
		.grid-pattern {
			background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
			background-size: 30px 30px;
		}
	</style>
</head>
<body <?php body_class( 'font-vazir bg-zinc-950 text-zinc-100 selection:bg-primary/30 selection:text-primary-light' ); ?>>
	<?php wp_body_open(); ?>

	<header class="sticky top-0 z-50 bg-zinc-950/80 backdrop-blur-xl border-b border-zinc-800/50">
		<div class="container mx-auto px-6 py-5 flex justify-between items-center">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-black tracking-tighter group flex items-center gap-2">
					<span class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white text-base">D</span>
					<span class="bg-gradient-to-r from-white to-zinc-400 bg-clip-text text-transparent group-hover:to-primary transition-all duration-500">
						<?php bloginfo( 'name' ); ?>
					</span>
				</a>
			</div>

			<nav class="hidden md:flex items-center space-x-10 rtl:space-x-reverse">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'flex space-x-10 rtl:space-x-reverse font-bold text-sm uppercase tracking-widest text-zinc-400',
						'fallback_cb'    => '__return_false',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);
				?>
				<div class="h-4 w-px bg-zinc-800 mx-2"></div>
				<div class="language-switcher flex items-center gap-4">
					<?php
					$current_lang = is_rtl() ? 'FA' : 'EN';
					$other_lang    = is_rtl() ? 'EN' : 'FA';
					?>
					<span class="text-[10px] font-black px-2 py-0.5 bg-primary/20 text-primary border border-primary/30 rounded"><?php echo esc_html( $current_lang ); ?></span>
					<a href="#" class="text-[10px] font-bold text-zinc-500 hover:text-white transition-colors uppercase tracking-widest"><?php echo esc_html( $other_lang ); ?></a>
				</div>
			</nav>

			<button id="menu-toggle" class="md:hidden flex flex-col gap-1.5 p-2 group">
				<span class="w-6 h-0.5 bg-zinc-300 group-hover:bg-primary transition-all"></span>
				<span class="w-6 h-0.5 bg-zinc-300 group-hover:bg-primary transition-all"></span>
			</button>
		</div>

		<!-- Mobile Menu -->
		<div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 w-full bg-zinc-900 border-b border-zinc-800 p-8 shadow-2xl animate-in fade-in slide-in-from-top-4">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'flex flex-col space-y-6 font-bold text-lg uppercase tracking-widest',
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

		// Custom menu styling for WP active classes
		document.querySelectorAll('.current-menu-item a').forEach(el => {
			el.classList.add('text-primary');
			el.classList.remove('text-zinc-400');
		});
	</script>
