<?php
/**
 * The front page template file
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main>
	<!-- Hero Section -->
	<section class="relative min-h-[80vh] flex items-center pt-20 overflow-hidden grid-pattern">
		<div class="absolute inset-0 bg-gradient-to-b from-transparent via-zinc-950/20 to-zinc-950"></div>

		<div class="container mx-auto px-6 relative z-10">
			<div class="max-w-4xl">
				<div class="inline-flex items-center gap-3 px-3 py-1 mb-8 text-[9px] font-black tracking-[0.3em] text-accent uppercase bg-accent/10 border border-accent/20 rounded-full">
					<span class="w-1.5 h-1.5 bg-accent rounded-full animate-pulse"></span>
					<?php esc_html_e( 'System Architecture // Senior Software Engineer', 'devportfolio' ); ?>
				</div>

				<h1 class="text-6xl md:text-8xl font-black mb-10 leading-[0.85] tracking-tighter text-white">
					<?php esc_html_e( 'Building', 'devportfolio' ); ?> <br>
					<span class="text-primary italic"><?php esc_html_e( 'Resilient', 'devportfolio' ); ?></span> <br>
					<?php esc_html_e( 'Infrastructure.', 'devportfolio' ); ?>
				</h1>

				<p class="text-lg md:text-xl text-zinc-500 mb-12 leading-relaxed max-w-2xl font-medium">
					<?php esc_html_e( 'Focused on high-performance distributed systems, engineering excellence, and clean code architecture.', 'devportfolio' ); ?>
				</p>

				<div class="flex flex-wrap gap-6">
					<a href="#portfolio" class="px-10 py-5 bg-primary hover:bg-primary-dark text-white font-black text-[11px] uppercase tracking-[0.2em] rounded-xl transition-all shadow-[0_20px_50px_rgba(79,70,229,0.2)] hover:-translate-y-1">
						<?php esc_html_e( 'Analyze Work', 'devportfolio' ); ?>
					</a>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="px-10 py-5 bg-zinc-900 border border-zinc-800 text-white font-black text-[11px] uppercase tracking-[0.2em] rounded-xl transition-all hover:bg-zinc-800">
						<?php esc_html_e( 'Technical Blog', 'devportfolio' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Technical Stack Section -->
	<section class="py-32 bg-zinc-950">
		<div class="container mx-auto px-6">
			<div class="text-center mb-20">
				<h2 class="text-4xl font-black mb-4 tracking-tight text-white uppercase tracking-widest"><?php esc_html_e( 'Technical DNA', 'devportfolio' ); ?></h2>
				<p class="text-zinc-500 font-medium"><?php esc_html_e( 'Core technical competencies across the modern engineering stack.', 'devportfolio' ); ?></p>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
				<?php
				$stacks = array(
					array(
						'title' => 'Backend',
						'items' => array( 'Node.js', 'Go', 'PHP / WP', 'Python' ),
					),
					array(
						'title' => 'Infrastructure',
						'items' => array( 'AWS', 'Docker', 'Kubernetes', 'CI/CD' ),
					),
					array(
						'title' => 'Frontend',
						'items' => array( 'React', 'Tailwind CSS', 'TypeScript', 'Next.js' ),
					),
				);

				foreach ( $stacks as $stack ) :
					?>
					<div class="p-10 bg-zinc-900/50 border border-zinc-800 rounded-[32px] hover:border-primary/30 transition-all duration-500">
						<h3 class="text-xl font-black mb-6 text-white uppercase tracking-widest"><?php echo esc_html( $stack['title'] ); ?></h3>
						<div class="flex flex-wrap gap-2">
							<?php foreach ( $stack['items'] as $item ) : ?>
								<span class="px-4 py-2 bg-zinc-800 text-zinc-400 text-[10px] font-black uppercase tracking-widest rounded-lg"><?php echo esc_html( $item ); ?></span>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Latest Portfolio Section -->
	<section id="portfolio" class="py-32 bg-zinc-900/20">
		<div class="container mx-auto px-6">
			<div class="flex justify-between items-end mb-20">
				<div>
					<h2 class="text-3xl font-black tracking-tight text-white uppercase tracking-widest"><?php esc_html_e( 'Selected Work', 'devportfolio' ); ?></h2>
				</div>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>" class="text-[10px] font-black uppercase tracking-[0.2em] text-primary hover:translate-x-2 transition-transform inline-flex items-center gap-2">
					<?php esc_html_e( 'Full Repository', 'devportfolio' ); ?>
					<svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
				</a>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
				<?php
				$portfolio_query = new WP_Query(
					array(
						'post_type'      => 'portfolio',
						'posts_per_page' => 3,
					)
				);

				if ( $portfolio_query->have_posts() ) :
					while ( $portfolio_query->have_posts() ) :
						$portfolio_query->the_post();
						?>
						<article class="group bg-zinc-900/50 border border-zinc-800 rounded-[32px] overflow-hidden hover:border-primary/30 transition-all duration-500">
							<div class="aspect-video overflow-hidden bg-zinc-800">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-700' ) ); ?>
								<?php else : ?>
									<div class="w-full h-full flex items-center justify-center">
										<svg class="w-12 h-12 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
									</div>
								<?php endif; ?>
							</div>
							<div class="p-10">
								<span class="text-[9px] font-black uppercase tracking-widest text-primary mb-4 block">
									<?php
									$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
									if ( $terms ) echo esc_html( $terms[0]->name );
									?>
								</span>
								<h3 class="text-2xl font-black mb-4 text-white group-hover:text-primary transition-colors tracking-tight">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<p class="text-zinc-500 text-sm font-medium mb-10 line-clamp-2">
									<?php echo esc_html( get_the_excerpt() ); ?>
								</p>
								<div class="flex items-center justify-between pt-6 border-t border-zinc-800">
									<a href="<?php the_permalink(); ?>" class="text-[10px] font-black uppercase tracking-widest text-zinc-400 group-hover:text-white transition-all">
										<?php esc_html_e( 'Analyze Case', 'devportfolio' ); ?>
									</a>
								</div>
							</div>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					echo '<p class="col-span-full text-center text-zinc-600 font-bold uppercase tracking-widest">' . esc_html__( 'No projects indexed.', 'devportfolio' ) . '</p>';
				endif;
				?>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
