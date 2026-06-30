<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( get_theme_mod('enable_preloader', true) ) : ?>
<div id="preloader" class="fixed inset-0 bg-surface z-[100] flex items-center justify-center transition-opacity duration-500">
    <div class="font-mono text-primary animate-pulse text-center">
        <div class="text-xs uppercase tracking-widest mb-2 opacity-50">Initializing...</div>
        <span class="typing-animation">CORE_SYSTEMS_LOAD_V3.0</span>
    </div>
</div>
<?php endif; ?>

<?php
$site_logo    = get_theme_mod( 'site_logo', '' );
$logo_width   = get_theme_mod( 'logo_width', '120' );
$show_tagline = get_theme_mod( 'show_tagline', false );
?>

<header class="fixed top-0 left-0 right-0 z-50 bg-surface/80 backdrop-blur-md border-b border-border/50 transition-all duration-300" id="main-header">
	<div class="container mx-auto px-6 h-20 flex items-center justify-between">
		<div class="flex items-center gap-12">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3">
				<?php if ( $site_logo ) : ?>
					<img src="<?php echo esc_url( $site_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="max-height:40px;width:auto;max-width:<?php echo absint( $logo_width ); ?>px;">
				<?php else : ?>
					<span class="text-xl font-black tracking-tighter text-white"><?php bloginfo( 'name' ); ?></span>
				<?php endif; ?>
				<?php if ( $show_tagline && get_bloginfo( 'description' ) ) : ?>
					<span class="text-[10px] text-zinc-500 hidden lg:block"><?php bloginfo( 'description' ); ?></span>
				<?php endif; ?>
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
                } ?>
			</nav>
		</div>

		<div class="flex items-center gap-6">
            <button id="dark-mode-toggle" class="text-zinc-400 hover:text-white transition-colors p-2" aria-label="Toggle Dark Mode">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>

			<?php if ( get_theme_mod( 'show_header_cta', true ) ) : ?>
			<a href="<?php echo esc_url( get_theme_mod( 'header_button_url', '#contact' ) ); ?>" class="hidden sm:block px-4 py-2 bg-primary text-surface text-[10px] font-black uppercase tracking-widest rounded-sm hover:opacity-90 transition-opacity">
				<?php echo esc_html( get_theme_mod( 'header_button_text', 'HIRE_ME' ) ); ?>
			</a>
			<?php endif; ?>

            <button id="mobile-menu-toggle" class="md:hidden text-white focus:outline-none p-2" aria-label="Open Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
		</div>
	</div>

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
            } ?>
            <?php if ( get_theme_mod( 'show_header_cta', true ) ) : ?>
            <a href="<?php echo esc_url( get_theme_mod( 'header_button_url', '#contact' ) ); ?>" class="mt-8 px-8 py-4 bg-primary text-surface text-sm font-black rounded-sm"><?php echo esc_html( get_theme_mod( 'header_button_text', 'HIRE_ME' ) ); ?></a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main class="min-h-screen pt-20" id="top">
