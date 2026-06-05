<?php
/**
 * The front page template file
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main>
	<!-- Hero Section -->
	<section class="relative py-24 md:py-32 overflow-hidden">
		<div class="container mx-auto px-6 relative z-10">
			<div class="max-w-3xl">
				<div class="inline-block px-4 py-1.5 mb-6 text-sm font-bold tracking-wider text-primary uppercase bg-primary/10 rounded-full">
					<?php esc_html_e( 'Senior Software Engineer', 'devportfolio' ); ?>
				</div>
				<h1 class="text-5xl md:text-7xl font-bold mb-8 leading-tight">
					<?php esc_html_e( 'Building Scalable', 'devportfolio' ); ?> <br>
					<span class="text-primary"><?php esc_html_e( 'Clean Architecture', 'devportfolio' ); ?></span> <?php esc_html_e( 'Solutions', 'devportfolio' ); ?>
				</h1>
				<p class="text-xl text-secondary dark:text-gray-400 mb-10 leading-relaxed max-w-2xl">
					<?php esc_html_e( 'Specialized in modern web technologies, performance optimization, and developer experience. Crafting enterprise-grade applications with focus on maintainability.', 'devportfolio' ); ?>
				</p>
				<div class="flex flex-wrap gap-4">
					<a href="#portfolio" class="px-8 py-4 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl transition-all shadow-lg shadow-primary/20">
						<?php esc_html_e( 'View Work', 'devportfolio' ); ?>
					</a>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="px-8 py-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-primary font-bold rounded-xl transition-all">
						<?php esc_html_e( 'Read Blog', 'devportfolio' ); ?>
					</a>
				</div>
			</div>
		</div>
		<!-- Decorative Background Element -->
		<div class="absolute top-0 right-0 -translate-y-1/4 translate-x-1/4 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl"></div>
	</section>

	<!-- Technical Stack Section -->
	<section class="py-24 bg-gray-50 dark:bg-gray-900/50">
		<div class="container mx-auto px-6">
			<div class="text-center mb-16">
				<h2 class="text-3xl md:text-4xl font-bold mb-4"><?php esc_html_e( 'Technical Expertise', 'devportfolio' ); ?></h2>
				<p class="text-secondary dark:text-gray-400 max-w-2xl mx-auto">
					<?php esc_html_e( 'My core competencies across the modern development stack.', 'devportfolio' ); ?>
				</p>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
				<?php
				$stacks = array(
					array(
						'title' => 'Frontend',
						'icon'  => 'desktop',
						'items' => array( 'React', 'Vue', 'Tailwind CSS', 'TypeScript' ),
					),
					array(
						'title' => 'Backend',
						'icon'  => 'server',
						'items' => array( 'Node.js', 'Python', 'Go', 'PHP / WP' ),
					),
					array(
						'title' => 'Infrastructure',
						'icon'  => 'cloud',
						'items' => array( 'AWS', 'Docker', 'Kubernetes', 'CI/CD' ),
					),
					array(
						'title' => 'Architecture',
						'icon'  => 'layer-group',
						'items' => array( 'Microservices', 'Event-Driven', 'Clean Code', 'TDD' ),
					),
				);

				foreach ( $stacks as $stack ) :
					?>
					<div class="p-8 bg-white dark:bg-dark border border-gray-100 dark:border-gray-800 rounded-2xl hover:border-primary transition-all group">
						<div class="w-12 h-12 bg-gray-50 dark:bg-gray-800 rounded-lg flex items-center justify-center mb-6 text-primary group-hover:bg-primary group-hover:text-white transition-all">
							<i class="fas fa-<?php echo esc_attr( $stack['icon'] ); ?> text-xl"></i>
						</div>
						<h3 class="text-xl font-bold mb-4"><?php echo esc_html( $stack['title'] ); ?></h3>
						<div class="flex flex-wrap gap-2">
							<?php foreach ( $stack['items'] as $item ) : ?>
								<span class="px-3 py-1 bg-gray-100 dark:bg-gray-800 text-xs font-medium rounded-full"><?php echo esc_html( $item ); ?></span>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Latest Portfolio Section -->
	<section id="portfolio" class="py-24">
		<div class="container mx-auto px-6">
			<div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
				<div>
					<h2 class="text-3xl md:text-4xl font-bold mb-4"><?php esc_html_e( 'Featured Projects', 'devportfolio' ); ?></h2>
					<p class="text-secondary dark:text-gray-400 max-w-xl">
						<?php esc_html_e( 'A selection of technical challenges and engineered solutions.', 'devportfolio' ); ?>
					</p>
				</div>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>" class="text-primary font-bold flex items-center gap-2 hover:underline">
					<?php esc_html_e( 'View all projects', 'devportfolio' ); ?>
					<svg class="w-5 h-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
				</a>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
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
						<article class="group relative bg-white dark:bg-dark border border-gray-100 dark:border-gray-800 rounded-2xl overflow-hidden hover:shadow-2xl transition-all">
							<div class="aspect-video overflow-hidden">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500' ) ); ?>
								<?php else : ?>
									<div class="w-full h-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
										<i class="fas fa-code text-4xl text-gray-300"></i>
									</div>
								<?php endif; ?>
							</div>
							<div class="p-8">
								<div class="flex flex-wrap gap-2 mb-4">
									<?php
									$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
									if ( $terms && ! is_wp_error( $terms ) ) {
										foreach ( $terms as $term ) {
											echo '<span class="text-[10px] uppercase tracking-wider font-bold text-primary">' . esc_html( $term->name ) . '</span>';
										}
									}
									?>
								</div>
								<h3 class="text-xl font-bold mb-4 group-hover:text-primary transition-colors">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<p class="text-secondary dark:text-gray-400 text-sm mb-6 line-clamp-2">
									<?php echo esc_html( get_the_excerpt() ); ?>
								</p>
								<div class="flex items-center justify-between">
									<a href="<?php the_permalink(); ?>" class="text-sm font-bold inline-flex items-center gap-2">
										<?php esc_html_e( 'Case Study', 'devportfolio' ); ?>
										<svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
									</a>
								</div>
							</div>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					echo '<p class="col-span-full text-center text-secondary">' . esc_html__( 'No projects found.', 'devportfolio' ) . '</p>';
				endif;
				?>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
