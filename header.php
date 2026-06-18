<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <style>
        .grid-pattern {
            background-image: radial-gradient(rgba(255, 215, 0, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="fixed top-0 left-0 right-0 z-50 bg-surface/80 backdrop-blur-md border-b border-border/50">
	<div class="container mx-auto px-6 h-20 flex items-center justify-between">
		<div class="flex items-center gap-12">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-xl font-black tracking-tighter text-white">
				VIBECODE_STUDIO
			</a>

			<nav class="hidden md:flex items-center gap-8">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'flex items-center gap-8 text-[11px] font-bold uppercase tracking-widest text-zinc-400',
					'fallback_cb'    => false,
					'items_wrap'     => '%3$s',
				) );
				?>
                <!-- Fallback menu if not set -->
                <?php if ( ! has_nav_menu( 'primary' ) ) : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-[11px] font-bold uppercase tracking-widest text-white border-b-2 border-primary pb-1">HOME</a>
                    <a href="#" class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 hover:text-white transition-colors">PORTFOLIO</a>
                    <a href="#" class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 hover:text-white transition-colors">BLOG</a>
                    <a href="#" class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 hover:text-white transition-colors">CONTACT</a>
                <?php endif; ?>
			</nav>
		</div>

		<div class="flex items-center gap-6">
			<a href="#" class="hidden sm:block px-4 py-2 bg-primary text-surface text-[10px] font-black uppercase tracking-widest rounded-sm hover:opacity-90 transition-opacity">
				HIRE_ME
			</a>
		</div>
	</div>
</header>

<main class="pt-20 min-h-screen">
