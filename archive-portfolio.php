<?php
/**
 * Portfolio Archive - Premium Edition
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-32 grid-pattern relative">
	<div class="absolute top-0 right-0 w-full max-w-4xl h-screen bg-accent/5 blur-[120px] pointer-events-none"></div>

	<div class="container mx-auto px-6 relative z-10">
		<header class="max-w-4xl mb-32">
			<div class="flex items-center gap-4 text-xs font-black uppercase tracking-[0.3em] text-accent mb-6">
				<span>03 // PROJECT REPOSITORY</span>
				<div class="w-12 h-px bg-accent/30"></div>
			</div>
			<h1 class="text-6xl md:text-8xl font-black mb-10 tracking-tighter text-white leading-tight">
				<?php esc_html_e( 'Selected', 'devportfolio' ); ?> <br>
				<span class="text-accent italic"><?php esc_html_e( 'Systems.', 'devportfolio' ); ?></span>
			</h1>
			<p class="text-xl text-zinc-500 font-medium leading-relaxed max-w-2xl">
				<?php esc_html_e( 'A detailed record of engineering challenges, architectural decisions, and implemented solutions.', 'devportfolio' ); ?>
			</p>
		</header>

		<!-- Taxonomy Filter -->
		<div class="flex flex-wrap items-center gap-4 mb-24 pb-8 border-b border-zinc-900">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>" class="px-8 py-3 bg-white text-zinc-950 font-black text-[10px] uppercase tracking-widest rounded-full transition-all">
				<?php esc_html_e( 'All Repos', 'devportfolio' ); ?>
			</a>
			<?php
			$terms = get_terms( array( 'taxonomy' => 'portfolio_category', 'hide_empty' => true ) );
			foreach ( $terms as $term ) :
				?>
				<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="px-8 py-3 bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white hover:border-zinc-700 font-black text-[10px] uppercase tracking-widest rounded-full transition-all">
					<?php echo esc_html( $term->name ); ?>
				</a>
			<?php endforeach; ?>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-16">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
					<article class="group relative bg-zinc-900/30 border border-zinc-800 rounded-[48px] overflow-hidden hover:border-accent/30 transition-all duration-700">
						<div class="aspect-[16/10] overflow-hidden">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000' ) ); ?>
							<?php else : ?>
								<div class="w-full h-full bg-zinc-900 flex items-center justify-center">
									<i class="fas fa-microchip text-7xl text-zinc-800 group-hover:text-accent/20 transition-colors duration-700"></i>
								</div>
							<?php endif; ?>
						</div>

						<div class="p-12 md:p-16">
							<div class="flex items-center gap-4 mb-8">
								<span class="text-[10px] font-black uppercase tracking-[0.2em] text-accent">
									<?php
									$project_terms = get_the_terms( get_the_ID(), 'portfolio_category' );
									if ( $project_terms ) echo esc_html( $project_terms[0]->name );
									?>
								</span>
								<div class="h-px flex-1 bg-zinc-900"></div>
							</div>

							<h2 class="text-4xl font-black mb-8 text-white group-hover:text-accent transition-colors leading-tight">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>

							<p class="text-lg text-zinc-500 font-medium leading-relaxed mb-10 line-clamp-3">
								<?php echo esc_html( get_the_excerpt() ); ?>
							</p>

							<div class="flex flex-wrap gap-3 mb-12">
								<?php
								$tech_stack = get_post_meta( get_the_ID(), 'tech_stack', true );
								if ( $tech_stack ) {
									$techs = explode( ',', $tech_stack );
									foreach ( $techs as $tech ) {
										echo '<span class="px-5 py-2 bg-zinc-950 border border-zinc-800 text-[10px] font-black uppercase tracking-widest text-zinc-400 rounded-xl group-hover:border-zinc-700 transition-colors">' . esc_html( trim( $tech ) ) . '</span>';
									}
								}
								?>
							</div>

							<div class="flex items-center justify-between pt-10 border-t border-zinc-900">
								<a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-4 text-xs font-black uppercase tracking-widest text-white group-hover:gap-6 transition-all">
									<?php esc_html_e( 'System Analysis', 'devportfolio' ); ?>
									<i class="fas fa-arrow-right text-accent"></i>
								</a>

								<div class="flex gap-4">
									<?php if ( get_post_meta( get_the_ID(), 'github_url', true ) ) : ?>
										<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'github_url', true ) ); ?>" target="_blank" class="text-zinc-600 hover:text-white transition-all">
											<i class="fab fa-github text-2xl"></i>
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
				echo '<p class="text-zinc-500">' . esc_html__( 'No projects documented in this sector.', 'devportfolio' ) . '</p>';
			endif;
			?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
