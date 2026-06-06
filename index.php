<?php
/**
 * The main template file
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-32 grid-pattern relative">
	<div class="container mx-auto px-6 relative z-10">
		<header class="max-w-3xl mb-32">
			<h1 class="text-6xl md:text-8xl font-black mb-10 tracking-tighter text-white uppercase"><?php esc_html_e( 'Logs', 'devportfolio' ); ?></h1>
			<p class="text-xl text-zinc-500 font-medium leading-relaxed"><?php esc_html_e( 'Technical deep dives, architectural patterns, and system retrospectives.', 'devportfolio' ); ?></p>
		</header>

		<div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
			<div class="lg:col-span-8 space-y-32">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'group' ); ?>>
						<div class="flex flex-col gap-10">
							<div class="max-w-3xl">
								<div class="flex flex-wrap items-center gap-6 text-[9px] font-black uppercase tracking-[0.2em] text-zinc-600 mb-8">
									<span class="flex items-center gap-2">
										<svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
										<?php echo get_the_date(); ?>
									</span>
									<span class="w-1 h-1 bg-zinc-800 rounded-full"></span>
									<span class="flex items-center gap-2">
										<svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
										<?php echo esc_html( devportfolio_reading_time( get_the_content() ) ); ?> <?php esc_html_e( 'min read', 'devportfolio' ); ?>
									</span>
								</div>

								<h2 class="text-4xl font-black mb-6 text-white group-hover:text-primary transition-colors tracking-tight leading-tight">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>

								<p class="text-lg text-zinc-500 font-medium leading-relaxed mb-10 line-clamp-3">
									<?php echo esc_html( get_the_excerpt() ); ?>
								</p>

								<a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-white group-hover:gap-6 transition-all">
									<?php esc_html_e( 'Initialize Read', 'devportfolio' ); ?>
									<svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
								</a>
							</div>
						</div>
					</article>
				<?php endwhile; the_posts_navigation(); else : ?>
					<p class="text-zinc-600 font-bold uppercase tracking-widest"><?php esc_html_e( 'No logs found.', 'devportfolio' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
