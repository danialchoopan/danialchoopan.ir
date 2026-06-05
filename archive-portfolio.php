<?php
/**
 * The template for displaying portfolio archive pages
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-24">
	<div class="container mx-auto px-6">
		<header class="mb-16 text-center">
			<h1 class="text-4xl md:text-6xl font-bold mb-6"><?php esc_html_e( 'Selected Work', 'devportfolio' ); ?></h1>
			<p class="text-xl text-secondary dark:text-gray-400 max-w-2xl mx-auto">
				<?php esc_html_e( 'Exploring complex problems through code and architecture.', 'devportfolio' ); ?>
			</p>
		</header>

		<!-- Category Filter -->
		<div class="flex flex-wrap justify-center gap-4 mb-16">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>" class="px-6 py-2 bg-primary text-white font-bold rounded-full transition-all">
				<?php esc_html_e( 'All Projects', 'devportfolio' ); ?>
			</a>
			<?php
			$terms = get_terms( array( 'taxonomy' => 'portfolio_category', 'hide_empty' => true ) );
			foreach ( $terms as $term ) :
				?>
				<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="px-6 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 font-bold rounded-full transition-all">
					<?php echo esc_html( $term->name ); ?>
				</a>
			<?php endforeach; ?>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
					<article class="group bg-white dark:bg-dark border border-gray-100 dark:border-gray-800 rounded-3xl overflow-hidden hover:shadow-2xl transition-all">
						<div class="aspect-[16/10] overflow-hidden">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-700' ) ); ?>
							<?php else : ?>
								<div class="w-full h-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
									<i class="fas fa-project-diagram text-5xl text-gray-300"></i>
								</div>
							<?php endif; ?>
						</div>
						<div class="p-10">
							<div class="flex flex-wrap gap-2 mb-6">
								<?php
								$project_terms = get_the_terms( get_the_ID(), 'portfolio_category' );
								if ( $project_terms ) {
									foreach ( $project_terms as $term ) {
										echo '<span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase rounded-md">' . esc_html( $term->name ) . '</span>';
									}
								}
								?>
							</div>
							<h2 class="text-2xl font-bold mb-4 group-hover:text-primary transition-colors">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<p class="text-secondary dark:text-gray-400 mb-8 line-clamp-2">
								<?php echo esc_html( get_the_excerpt() ); ?>
							</p>

							<!-- Technology Badges (from custom fields) -->
							<div class="flex flex-wrap gap-2 mb-8">
								<?php
								$tech_stack = get_post_meta( get_the_ID(), 'tech_stack', true );
								if ( $tech_stack ) {
									$techs = explode( ',', $tech_stack );
									foreach ( $techs as $tech ) {
										echo '<span class="px-2 py-1 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 text-[10px] font-medium rounded-md">' . esc_html( trim( $tech ) ) . '</span>';
									}
								}
								?>
							</div>

							<div class="flex items-center justify-between pt-6 border-t border-gray-50 dark:border-gray-800">
								<a href="<?php the_permalink(); ?>" class="text-sm font-bold flex items-center gap-2 group-hover:gap-3 transition-all">
									<?php esc_html_e( 'View Details', 'devportfolio' ); ?>
									<svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
								</a>

								<div class="flex gap-4">
									<?php if ( get_post_meta( get_the_ID(), 'github_url', true ) ) : ?>
										<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'github_url', true ) ); ?>" target="_blank" class="text-secondary hover:text-dark dark:hover:text-white transition-colors">
											<i class="fab fa-github text-xl"></i>
										</a>
									<?php endif; ?>
									<?php if ( get_post_meta( get_the_ID(), 'live_url', true ) ) : ?>
										<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'live_url', true ) ); ?>" target="_blank" class="text-secondary hover:text-dark dark:hover:text-white transition-colors">
											<i class="fas fa-external-link-alt text-lg"></i>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</article>
					<?php
				endwhile;

				the_posts_navigation();

			else :
				echo '<p class="text-center">' . esc_html__( 'No projects found.', 'devportfolio' ) . '</p>';
			endif;
			?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
