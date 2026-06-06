<?php
/**
 * The template for displaying portfolio archive pages
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-32 grid-pattern relative bg-white dark:bg-zinc-950">
	<div class="container mx-auto px-6 relative z-10">
		<header class="max-w-4xl mb-32">
			<h1 class="text-6xl md:text-8xl font-black mb-10 tracking-tighter text-zinc-900 dark:text-white uppercase"><?php esc_html_e( 'Systems', 'devportfolio' ); ?></h1>
			<p class="text-xl text-zinc-600 dark:text-zinc-500 font-medium leading-relaxed max-w-2xl"><?php esc_html_e( 'A repository of technical solutions and engineering patterns.', 'devportfolio' ); ?></p>
		</header>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-16">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article class="group relative bg-white dark:bg-zinc-900/30 border border-zinc-200 dark:border-zinc-800 rounded-[40px] overflow-hidden hover:border-primary/30 transition-all duration-700">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="h-64 overflow-hidden">
							<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-700' ) ); ?>
						</div>
					<?php endif; ?>
					<div class="p-12">
						<div class="flex items-center justify-between mb-10 text-zinc-400 dark:text-zinc-600">
							<svg class="w-10 h-10 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
							<span class="text-[9px] font-black uppercase tracking-[0.3em]">
								<?php $t = get_the_terms(get_the_ID(), 'portfolio_category'); if($t) echo esc_html($t[0]->name); ?>
							</span>
						</div>

						<h2 class="text-3xl md:text-4xl font-black mb-6 text-zinc-900 dark:text-white group-hover:text-primary transition-colors leading-tight tracking-tight">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>

						<p class="text-lg text-zinc-600 dark:text-zinc-500 font-medium leading-relaxed mb-10 line-clamp-2"><?php echo esc_html(get_the_excerpt()); ?></p>

						<div class="flex flex-wrap gap-3 mb-12">
							<?php
							$stack = get_post_meta( get_the_ID(), 'tech_stack', true );
							if ( $stack ) {
								$techs = explode( ',', $stack );
								foreach ( $techs as $tech ) {
									echo '<span class="px-5 py-2 bg-zinc-100 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-black uppercase tracking-widest text-zinc-500 rounded-xl">' . esc_html( trim( $tech ) ) . '</span>';
								}
							}
							?>
						</div>

						<div class="flex items-center justify-between pt-10 border-t border-zinc-100 dark:border-zinc-900">
							<a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-zinc-500 hover:text-zinc-900 dark:hover:text-white group-hover:gap-6 transition-all">
								<?php esc_html_e( 'System Specs', 'devportfolio' ); ?>
								<svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
							</a>
						</div>
					</div>
				</article>
			<?php endwhile; the_posts_navigation(); else : ?>
				<p class="text-zinc-600 uppercase font-black tracking-widest"><?php esc_html_e( 'No systems currently indexed.', 'devportfolio' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
