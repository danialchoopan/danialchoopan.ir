<?php
/**
 * The template for displaying single portfolio items
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-24">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="container mx-auto px-6">
				<!-- Project Header -->
				<div class="max-w-4xl mx-auto mb-16 text-center">
					<div class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary/10 text-primary text-sm font-bold rounded-full mb-6">
						<?php
						$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
						if ( $terms ) {
							echo esc_html( $terms[0]->name );
						}
						?>
					</div>
					<h1 class="text-4xl md:text-6xl font-bold mb-8"><?php the_title(); ?></h1>
					<div class="flex flex-wrap justify-center gap-6 text-secondary dark:text-gray-400 font-medium">
						<div class="flex items-center gap-2">
							<i class="far fa-calendar-alt"></i>
							<span><?php echo get_the_date(); ?></span>
						</div>
						<?php if ( get_post_meta( get_the_ID(), 'client', true ) ) : ?>
							<div class="flex items-center gap-2">
								<i class="far fa-user"></i>
								<span><?php echo esc_html( get_post_meta( get_the_ID(), 'client', true ) ); ?></span>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Featured Image / Hero -->
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mb-24 rounded-3xl overflow-hidden shadow-2xl">
						<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto' ) ); ?>
					</div>
				<?php endif; ?>

				<!-- Project Content -->
				<div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
					<div class="lg:col-span-8">
						<div class="prose prose-lg md:prose-xl dark:prose-invert max-w-none prose-headings:font-bold prose-a:text-primary">
							<h2 class="text-3xl mb-8"><?php esc_html_e( 'The Challenge', 'devportfolio' ); ?></h2>
							<?php
							$challenge = get_post_meta( get_the_ID(), 'challenge', true );
							if ( $challenge ) {
								echo wp_kses_post( wpautop( $challenge ) );
							} else {
								the_excerpt();
							}
							?>

							<h2 class="text-3xl mt-16 mb-8"><?php esc_html_e( 'The Solution', 'devportfolio' ); ?></h2>
							<?php the_content(); ?>
						</div>
					</div>

					<aside class="lg:col-span-4">
						<div class="sticky top-32 space-y-8">
							<!-- Project Info Card -->
							<div class="p-8 bg-gray-50 dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800">
								<h3 class="text-xl font-bold mb-6"><?php esc_html_e( 'Technical Architecture', 'devportfolio' ); ?></h3>

								<div class="space-y-6">
									<div>
										<h4 class="text-xs font-bold uppercase tracking-widest text-secondary dark:text-gray-500 mb-3"><?php esc_html_e( 'Core Technologies', 'devportfolio' ); ?></h4>
										<div class="flex flex-wrap gap-2">
											<?php
											$tech_stack = get_post_meta( get_the_ID(), 'tech_stack', true );
											if ( $tech_stack ) {
												$techs = explode( ',', $tech_stack );
												foreach ( $techs as $tech ) {
													echo '<span class="px-3 py-1 bg-white dark:bg-dark border border-gray-200 dark:border-gray-700 text-xs font-bold rounded-lg">' . esc_html( trim( $tech ) ) . '</span>';
												}
											}
											?>
										</div>
									</div>

									<?php if ( get_post_meta( get_the_ID(), 'github_url', true ) || get_post_meta( get_the_ID(), 'live_url', true ) ) : ?>
										<div class="pt-6 border-t border-gray-200 dark:border-gray-800 flex flex-col gap-4">
											<?php if ( get_post_meta( get_the_ID(), 'github_url', true ) ) : ?>
												<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'github_url', true ) ); ?>" target="_blank" class="flex items-center justify-center gap-3 py-3 px-6 bg-dark dark:bg-white text-white dark:text-dark font-bold rounded-xl hover:opacity-90 transition-all">
													<i class="fab fa-github"></i>
													<?php esc_html_e( 'Source Code', 'devportfolio' ); ?>
												</a>
											<?php endif; ?>
											<?php if ( get_post_meta( get_the_ID(), 'live_url', true ) ) : ?>
												<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'live_url', true ) ); ?>" target="_blank" class="flex items-center justify-center gap-3 py-3 px-6 bg-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-primary/20">
													<i class="fas fa-external-link-alt"></i>
													<?php esc_html_e( 'Live Preview', 'devportfolio' ); ?>
												</a>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<!-- Navigation -->
							<div class="flex justify-between items-center px-4">
								<?php previous_post_link( '%link', '<i class="fas fa-arrow-left mr-2"></i> ' . esc_html__( 'Prev', 'devportfolio' ) ); ?>
								<?php next_post_link( '%link', esc_html__( 'Next', 'devportfolio' ) . ' <i class="fas fa-arrow-right ml-2"></i>' ); ?>
							</div>
						</div>
					</aside>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
