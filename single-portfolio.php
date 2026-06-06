<?php
/**
 * Single Portfolio - High Performance Edition
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

					<h1 class="text-6xl md:text-8xl font-black mb-12 tracking-tighter text-white leading-[0.9]"><?php the_title(); ?></h1>

					<div class="flex flex-wrap justify-center gap-10 text-zinc-500 font-bold text-[10px] uppercase tracking-widest">
						<div class="flex items-center gap-3">
							<div class="w-4 h-4 text-primary"><?php echo devportfolio_get_svg('calendar'); ?></div>
							<span><?php echo get_the_date(); ?></span>
						</div>
					</div>
				</div>

				<div class="grid grid-cols-1 lg:grid-cols-12 gap-24">
					<div class="lg:col-span-8">
						<div class="prose prose-zinc prose-invert max-w-none
									prose-headings:font-black prose-headings:tracking-tighter prose-headings:text-white
									prose-p:text-zinc-400 prose-p:text-xl prose-p:leading-relaxed
									prose-a:text-accent prose-a:no-underline">

							<div class="flex items-center gap-4 mb-10">
								<h2 class="text-4xl m-0 tracking-tighter uppercase"><?php esc_html_e( 'Problem', 'devportfolio' ); ?></h2>
								<div class="h-px flex-1 bg-zinc-900 mt-2"></div>
							</div>
							<div class="mb-20"><?php the_excerpt(); ?></div>

							<div class="flex items-center gap-4 mb-10">
								<h2 class="text-4xl m-0 tracking-tighter uppercase"><?php esc_html_e( 'Solution', 'devportfolio' ); ?></h2>
								<div class="h-px flex-1 bg-zinc-900 mt-2"></div>
							</div>
							<div class="mb-20"><?php the_content(); ?></div>
						</div>
					</div>

					<aside class="lg:col-span-4 sticky top-32">
						<div class="p-12 bg-zinc-900/50 border border-zinc-800 rounded-[40px]">
							<h3 class="text-2xl font-black mb-10 text-white tracking-tighter uppercase"><?php esc_html_e( 'Specs', 'devportfolio' ); ?></h3>

							<div class="space-y-12">
								<div>
									<h4 class="text-[9px] font-black uppercase tracking-[0.3em] text-zinc-600 mb-6"><?php esc_html_e( 'Stack', 'devportfolio' ); ?></h4>
									<div class="flex flex-wrap gap-3">
										<?php
										$stack = get_post_meta( get_the_ID(), 'tech_stack', true );
										if ( $stack ) {
											$techs = explode( ',', $stack );
											foreach ( $techs as $tech ) {
												echo '<span class="px-5 py-2 bg-zinc-950 border border-zinc-800 text-[9px] font-black uppercase tracking-widest text-zinc-500 rounded-xl">' . esc_html( trim( $tech ) ) . '</span>';
											}
										}
										?>
									</div>
								</div>

								<div class="pt-10 border-t border-zinc-800 flex flex-col gap-6">
									<?php if ( get_post_meta( get_the_ID(), 'github_url', true ) ) : ?>
										<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'github_url', true ) ); ?>" target="_blank" class="flex items-center justify-center gap-4 py-6 px-8 bg-zinc-800 text-white font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-zinc-700 transition-all">
											<div class="w-5 h-5"><?php echo devportfolio_get_svg('github'); ?></div>
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
