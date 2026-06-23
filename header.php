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
				<?php bloginfo( 'name' ); ?>
			</a>

			<nav class="hidden md:flex items-center gap-8">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'flex items-center gap-8 text-[11px] font-bold uppercase tracking-widest text-zinc-400',
                        'items_wrap'     => '%3$s',
                        'walker'         => new DevPortfolio_Walker_Nav_Menu()
                    ) );
                } else { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-[11px] font-bold uppercase tracking-widest text-white border-b-2 border-primary pb-1">HOME</a>
                    <a href="#" class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 hover:text-white transition-colors">PORTFOLIO</a>
                    <a href="#" class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 hover:text-white transition-colors">BLOG</a>
                    <a href="#" class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 hover:text-white transition-colors">CONTACT</a>
                <?php } ?>
			</nav>
		</div>

		<div class="flex items-center gap-6">
			<a href="#" class="hidden sm:block px-4 py-2 bg-primary text-surface text-[10px] font-black uppercase tracking-widest rounded-sm hover:opacity-90 transition-opacity">
				HIRE_ME
			</a>

            <button id="mobile-menu-toggle" class="md:hidden text-white focus:outline-none p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
		</div>
	</div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 bg-surface-darkest z-[60] flex flex-col items-center justify-center translate-x-full transition-transform duration-500 md:hidden">
        <button id="mobile-menu-close" class="absolute top-6 right-6 text-white p-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <nav class="flex flex-col items-center gap-8 text-2xl font-black uppercase tracking-tighter text-zinc-500">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'flex flex-col items-center gap-8',
                    'items_wrap'     => '%3$s',
                ) );
            } else { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-white">HOME</a>
                <a href="#" class="hover:text-white transition-colors">PORTFOLIO</a>
                <a href="#" class="hover:text-white transition-colors">BLOG</a>
                <a href="#" class="hover:text-white transition-colors">CONTACT</a>
            <?php } ?>
            <a href="#" class="mt-8 px-8 py-4 bg-primary text-surface text-sm font-black rounded-sm">HIRE_ME</a>
        </nav>
    </div>
</header>

<script>
    const toggle = document.getElementById('mobile-menu-toggle');
    const close = document.getElementById('mobile-menu-close');
    const menu = document.getElementById('mobile-menu');

    if(toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.classList.remove('translate-x-full');
        });
        close.addEventListener('click', () => {
            menu.classList.add('translate-x-full');
        });
    }
</script>

<main class="pt-20 min-h-screen">
