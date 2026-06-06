<?php
/**
 * The template for displaying single portfolio items
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-32 grid-pattern relative">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="container mx-auto px-6 relative z-10">
				<div class="max-w-5xl mx-auto mb-32 text-center">
					<div class="inline-flex items-center gap-3 px-4 py-2 mb-10 text-[9px] font-black tracking-[0.3em] text-accent uppercase bg-accent/10 border border-accent/20 rounded-full">
						<span class="w-2 h-2 bg-accent rounded-full animate-pulse"></span>
						<?php $t = get_the_terms(get_the_ID(), 'portfolio_category'); if($t) echo esc_html($t[0]->name); ?>
					</div>

					<h1 class="text-6xl md:text-8xl font-black mb-12 tracking-tighter text-zinc-900 dark:text-white leading-[0.9]"><?php the_title(); ?></h1>

					<div class="flex flex-wrap justify-center gap-10 text-zinc-500 font-bold text-[10px] uppercase tracking-widest">
						<div class="flex items-center gap-3">
							<svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
							<span><?php echo get_the_date(); ?></span>
						</div>
					</div>
				</div>

				<div class="grid grid-cols-1 lg:grid-cols-12 gap-24">
					<div class="lg:col-span-8">
						<div class="prose prose-zinc dark:prose-invert max-w-none
									prose-headings:font-black prose-headings:tracking-tighter prose-headings:text-zinc-900 dark:prose-headings:text-white
									prose-p:text-zinc-700 dark:prose-p:text-zinc-400 prose-p:text-xl prose-p:leading-relaxed
									prose-a:text-accent prose-a:no-underline">

							<div class="flex items-center gap-4 mb-10">
								<h2 class="text-4xl m-0 tracking-tighter uppercase"><?php esc_html_e( 'Problem', 'devportfolio' ); ?></h2>
								<div class="h-px flex-1 bg-zinc-200 dark:bg-zinc-900 mt-2"></div>
							</div>
							<div class="mb-20"><?php the_excerpt(); ?></div>

							<div class="flex items-center gap-4 mb-10">
								<h2 class="text-4xl m-0 tracking-tighter uppercase"><?php esc_html_e( 'Solution', 'devportfolio' ); ?></h2>
								<div class="h-px flex-1 bg-zinc-200 dark:bg-zinc-900 mt-2"></div>
							</div>
							<div class="mb-20"><?php the_content(); ?></div>
						</div>
					</div>

					<aside class="lg:col-span-4 sticky top-32">
						<div class="p-12 bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 rounded-[40px]">
							<h3 class="text-2xl font-black mb-10 text-zinc-900 dark:text-white tracking-tighter uppercase"><?php esc_html_e( 'Specs', 'devportfolio' ); ?></h3>

							<div class="space-y-12">
								<div>
									<h4 class="text-[9px] font-black uppercase tracking-[0.3em] text-zinc-400 dark:text-zinc-600 mb-6"><?php esc_html_e( 'Stack', 'devportfolio' ); ?></h4>
									<div class="flex flex-wrap gap-3">
										<?php
										$stack = get_post_meta( get_the_ID(), 'tech_stack', true );
										if ( $stack ) {
											$techs = explode( ',', $stack );
											foreach ( $techs as $tech ) {
												echo '<span class="px-5 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-black uppercase tracking-widest text-zinc-500 rounded-xl">' . esc_html( trim( $tech ) ) . '</span>';
											}
										}
										?>
									</div>
								</div>

								<div class="pt-10 border-t border-zinc-100 dark:border-zinc-900 flex flex-col gap-6">
									<?php if ( get_post_meta( get_the_ID(), 'github_url', true ) ) : ?>
										<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'github_url', true ) ); ?>" target="_blank" class="flex items-center justify-center gap-4 py-6 px-8 bg-zinc-900 dark:bg-zinc-800 text-white font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-zinc-800 dark:hover:bg-zinc-700 transition-all">
											<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
											<?php esc_html_e( 'Analyze Code', 'devportfolio' ); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</aside>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
