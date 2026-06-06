<?php
/**
 * Single Portfolio - Premium Edition
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-32 grid-pattern relative">
	<div class="absolute top-0 left-0 w-full h-screen bg-primary/5 blur-[120px] pointer-events-none"></div>

	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="container mx-auto px-6 relative z-10">
				<!-- Project Header -->
				<div class="max-w-5xl mx-auto mb-24 text-center">
					<div class="inline-flex items-center gap-3 px-4 py-2 mb-10 text-[10px] font-black tracking-[0.3em] text-accent uppercase bg-accent/10 border border-accent/20 rounded-full">
						<span class="w-2 h-2 bg-accent rounded-full animate-pulse"></span>
						<?php
						$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
						if ( $terms ) echo esc_html( $terms[0]->name );
						?>
					</div>

					<h1 class="text-6xl md:text-8xl font-black mb-12 tracking-tighter text-white leading-[0.9]"><?php the_title(); ?></h1>

					<div class="flex flex-wrap justify-center gap-10 text-zinc-500 font-bold text-xs uppercase tracking-widest">
						<div class="flex items-center gap-3">
							<i class="far fa-calendar text-primary"></i>
							<span><?php echo get_the_date(); ?></span>
						</div>
						<?php if ( get_post_meta( get_the_ID(), 'client', true ) ) : ?>
							<div class="flex items-center gap-3">
								<i class="far fa-user text-primary"></i>
								<span><?php echo esc_html( get_post_meta( get_the_ID(), 'client', true ) ); ?></span>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Hero Visual -->
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mb-32 rounded-[64px] overflow-hidden border border-zinc-800 shadow-[0_40px_100px_rgba(0,0,0,0.5)]">
						<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto' ) ); ?>
					</div>
				<?php endif; ?>

				<!-- Project Architecture -->
				<div class="grid grid-cols-1 lg:grid-cols-12 gap-24 items-start">
					<div class="lg:col-span-8">
						<div class="prose prose-zinc prose-invert max-w-none
									prose-headings:font-black prose-headings:tracking-tighter prose-headings:text-white
									prose-p:text-zinc-400 prose-p:text-xl prose-p:leading-relaxed
									prose-a:text-accent prose-a:no-underline">

							<div class="flex items-center gap-4 mb-10">
								<h2 class="text-4xl m-0"><?php esc_html_e( 'The Challenge', 'devportfolio' ); ?></h2>
								<div class="h-px flex-1 bg-zinc-900 mt-2"></div>
							</div>

							<div class="mb-20">
								<?php
								$challenge = get_post_meta( get_the_ID(), 'challenge', true );
								if ( $challenge ) {
									echo wp_kses_post( wpautop( $challenge ) );
								} else {
									the_excerpt();
								}
								?>
							</div>

							<div class="flex items-center gap-4 mb-10">
								<h2 class="text-4xl m-0"><?php esc_html_e( 'Implemented Solution', 'devportfolio' ); ?></h2>
								<div class="h-px flex-1 bg-zinc-900 mt-2"></div>
							</div>

							<div class="mb-20">
								<?php the_content(); ?>
							</div>
						</div>
					</div>

					<aside class="lg:col-span-4 sticky top-32">
						<div class="p-12 bg-zinc-900/50 border border-zinc-800 rounded-[48px] relative overflow-hidden">
							<div class="absolute top-0 right-0 w-32 h-32 bg-accent/5 blur-3xl rounded-full"></div>

							<h3 class="text-2xl font-black mb-10 text-white tracking-tight"><?php esc_html_e( 'System Specs', 'devportfolio' ); ?></h3>

							<div class="space-y-12">
								<div>
									<h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500 mb-6"><?php esc_html_e( 'Core Technologies', 'devportfolio' ); ?></h4>
									<div class="flex flex-wrap gap-3">
										<?php
										$tech_stack = get_post_meta( get_the_ID(), 'tech_stack', true );
										if ( $tech_stack ) {
											$techs = explode( ',', $tech_stack );
											foreach ( $techs as $tech ) {
												echo '<span class="px-5 py-2 bg-zinc-950 border border-zinc-800 text-[10px] font-black uppercase tracking-widest text-zinc-400 rounded-xl">' . esc_html( trim( $tech ) ) . '</span>';
											}
										}
										?>
									</div>
								</div>

								<div class="pt-10 border-t border-zinc-800 flex flex-col gap-6">
									<?php if ( get_post_meta( get_the_ID(), 'github_url', true ) ) : ?>
										<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'github_url', true ) ); ?>" target="_blank" class="flex items-center justify-center gap-4 py-6 px-8 bg-zinc-800 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-zinc-700 transition-all">
											<i class="fab fa-github text-xl"></i>
											<?php esc_html_e( 'Analyze Code', 'devportfolio' ); ?>
										</a>
									<?php endif; ?>
									<?php if ( get_post_meta( get_the_ID(), 'live_url', true ) ) : ?>
										<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'live_url', true ) ); ?>" target="_blank" class="flex items-center justify-center gap-4 py-6 px-8 bg-accent text-zinc-950 font-black text-xs uppercase tracking-widest rounded-2xl hover:scale-105 transition-all shadow-[0_20px_50px_rgba(16,185,129,0.3)]">
											<i class="fas fa-external-link-alt"></i>
											<?php esc_html_e( 'Live System', 'devportfolio' ); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>

						<!-- Navigation -->
						<div class="mt-12 flex justify-between items-center px-8 text-[10px] font-black uppercase tracking-widest text-zinc-500">
							<?php previous_post_link( '%link', '<i class="fas fa-arrow-left mr-3 text-primary"></i> ' . esc_html__( 'Previous', 'devportfolio' ) ); ?>
							<?php next_post_link( '%link', esc_html__( 'Next', 'devportfolio' ) . ' <i class="fas fa-arrow-right ml-3 text-primary"></i>' ); ?>
						</div>
					</aside>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
