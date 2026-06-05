<?php
/**
 * The front page template file - Premium Edition
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main>
	<!-- Hero Section -->
	<section class="relative min-h-[90vh] flex items-center pt-20 overflow-hidden grid-pattern">
		<div class="absolute inset-0 bg-gradient-to-b from-transparent via-zinc-950/50 to-zinc-950"></div>

		<!-- Decorative blobs -->
		<div class="absolute top-1/4 right-0 w-[500px] h-[500px] bg-primary/20 blur-[120px] rounded-full pointer-events-none animate-pulse"></div>
		<div class="absolute bottom-1/4 left-0 w-[400px] h-[400px] bg-accent/10 blur-[100px] rounded-full pointer-events-none animate-pulse" style="animation-delay: 2s"></div>

		<div class="container mx-auto px-6 relative z-10">
			<div class="max-w-4xl">
				<div class="inline-flex items-center gap-3 px-3 py-1 mb-8 text-[10px] font-black tracking-[0.2em] text-accent uppercase bg-accent/10 border border-accent/20 rounded-full">
					<span class="relative flex h-2 w-2">
						<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
						<span class="relative inline-flex rounded-full h-2 w-2 bg-accent"></span>
					</span>
					<?php esc_html_e( 'System Architect // Senior Software Engineer', 'devportfolio' ); ?>
				</div>

				<h1 class="text-6xl md:text-8xl font-black mb-10 leading-[0.9] tracking-tighter text-white">
					<?php esc_html_e( 'Engineering', 'devportfolio' ); ?> <br>
					<span class="text-primary italic"><?php esc_html_e( 'Performance', 'devportfolio' ); ?></span> <br>
					<?php esc_html_e( 'at Scale.', 'devportfolio' ); ?>
				</h1>

				<p class="text-xl md:text-2xl text-zinc-400 mb-12 leading-relaxed max-w-2xl font-medium">
					<?php esc_html_e( 'Specializing in high-concurrency systems, distributed architectures, and mission-critical web applications.', 'devportfolio' ); ?>
				</p>

				<div class="flex flex-wrap gap-6">
					<a href="#portfolio" class="px-10 py-5 bg-primary hover:bg-primary-dark text-white font-black text-sm uppercase tracking-widest rounded-2xl transition-all shadow-[0_20px_50px_rgba(79,70,229,0.3)] hover:-translate-y-1">
						<?php esc_html_e( 'Explore Systems', 'devportfolio' ); ?>
					</a>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="px-10 py-5 bg-zinc-900 border border-zinc-800 hover:border-zinc-700 text-white font-black text-sm uppercase tracking-widest rounded-2xl transition-all hover:bg-zinc-800">
						<?php esc_html_e( 'Technical Blog', 'devportfolio' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Technical Expertise -->
	<section class="py-32 bg-zinc-950">
		<div class="container mx-auto px-6">
			<div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
				<div class="max-w-2xl">
					<h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight text-white"><?php esc_html_e( 'Technical DNA', 'devportfolio' ); ?></h2>
					<p class="text-lg text-zinc-500 font-medium leading-relaxed">
						<?php esc_html_e( 'A pragmatic approach to software engineering, balancing bleeding-edge innovation with production stability.', 'devportfolio' ); ?>
					</p>
				</div>
				<div class="hidden md:block">
					<div class="flex items-center gap-4 text-xs font-black uppercase tracking-[0.3em] text-zinc-600">
						<span>01 // CAPABILITIES</span>
						<div class="w-12 h-px bg-zinc-800"></div>
					</div>
				</div>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
				<?php
				$expertise = array(
					array(
						'title' => 'System Architecture',
						'desc'  => 'Designing event-driven microservices and distributed databases for high-availability workloads.',
						'icon'  => 'cubes',
						'color' => 'primary'
					),
					array(
						'title' => 'DevOps & SRE',
						'desc'  => 'Automating infrastructure as code with Terraform, Docker, and orchestrated CI/CD pipelines.',
						'icon'  => 'terminal',
						'color' => 'accent'
					),
					array(
						'title' => 'Modern Web',
						'desc'  => 'Building performant, accessible interfaces using React, Next.js, and TypeScript.',
						'icon'  => 'code',
						'color' => 'white'
					),
				);

				foreach ( $expertise as $item ) :
					?>
					<div class="group p-10 bg-zinc-900/50 border border-zinc-800/50 rounded-[32px] hover:border-primary/50 transition-all duration-500 hover:bg-zinc-900">
						<div class="w-16 h-16 bg-zinc-800 rounded-2xl flex items-center justify-center mb-8 text-<?php echo esc_attr($item['color']); ?> group-hover:scale-110 transition-transform duration-500">
							<i class="fas fa-<?php echo esc_attr( $item['icon'] ); ?> text-2xl"></i>
						</div>
						<h3 class="text-2xl font-black mb-4 text-white"><?php echo esc_html( $item['title'] ); ?></h3>
						<p class="text-zinc-500 font-medium leading-relaxed">
							<?php echo esc_html( $item['desc'] ); ?>
						</p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Featured Projects Grid -->
	<section id="portfolio" class="py-32 relative">
		<!-- Section background glow -->
		<div class="absolute top-1/2 left-0 w-full h-[500px] bg-primary/5 blur-[150px] -translate-y-1/2 rounded-full pointer-events-none"></div>

		<div class="container mx-auto px-6 relative z-10">
			<div class="flex flex-col md:flex-row justify-between items-center mb-20 gap-8">
				<h2 class="text-4xl md:text-5xl font-black tracking-tight text-white"><?php esc_html_e( 'Selected Deployments', 'devportfolio' ); ?></h2>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>" class="group flex items-center gap-4 px-6 py-3 bg-zinc-900 border border-zinc-800 rounded-full text-xs font-black uppercase tracking-widest hover:border-primary transition-all">
					<?php esc_html_e( 'View Full Repository', 'devportfolio' ); ?>
					<i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
				</a>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-10">
				<?php
				$portfolio_query = new WP_Query(
					array(
						'post_type'      => 'portfolio',
						'posts_per_page' => 2,
					)
				);

				if ( $portfolio_query->have_posts() ) :
					while ( $portfolio_query->have_posts() ) :
						$portfolio_query->the_post();
						?>
						<article class="group relative bg-zinc-900/50 border border-zinc-800 rounded-[40px] overflow-hidden hover:border-primary/30 transition-all duration-700">
							<div class="aspect-[16/10] overflow-hidden">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000' ) ); ?>
								<?php else : ?>
									<div class="w-full h-full bg-zinc-800 flex items-center justify-center">
										<i class="fas fa-terminal text-6xl text-zinc-700"></i>
									</div>
								<?php endif; ?>
							</div>
							<div class="p-10 md:p-14">
								<div class="flex items-center gap-3 mb-6">
									<div class="h-px w-8 bg-primary"></div>
									<span class="text-[10px] font-black uppercase tracking-widest text-primary">
										<?php
										$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
										if ( $terms ) echo esc_html( $terms[0]->name );
										?>
									</span>
								</div>
								<h3 class="text-3xl md:text-4xl font-black mb-6 text-white group-hover:text-primary transition-colors">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<p class="text-zinc-500 font-medium text-lg leading-relaxed mb-10 line-clamp-2">
									<?php echo esc_html( get_the_excerpt() ); ?>
								</p>
								<div class="flex flex-wrap gap-3 mb-10">
									<?php
									$tech_stack = get_post_meta( get_the_ID(), 'tech_stack', true );
									if ( $tech_stack ) {
										$techs = explode( ',', $tech_stack );
										foreach ( array_slice($techs, 0, 4) as $tech ) {
											echo '<span class="px-4 py-1.5 bg-zinc-800 text-[10px] font-black uppercase tracking-widest text-zinc-400 rounded-lg">' . esc_html( trim( $tech ) ) . '</span>';
										}
									}
									?>
								</div>
								<a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-4 text-xs font-black uppercase tracking-widest text-white group-hover:gap-6 transition-all">
									<?php esc_html_e( 'Analyze Case Study', 'devportfolio' ); ?>
									<i class="fas fa-arrow-right text-primary"></i>
								</a>
							</div>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
	</section>

	<!-- Call to Action -->
	<section class="py-32 grid-pattern">
		<div class="container mx-auto px-6 relative z-10">
			<div class="bg-gradient-to-br from-primary to-primary-dark rounded-[48px] p-12 md:p-24 text-center relative overflow-hidden shadow-[0_40px_100px_rgba(79,70,229,0.4)]">
				<div class="absolute inset-0 grid-pattern opacity-20"></div>
				<div class="relative z-10 max-w-3xl mx-auto">
					<h2 class="text-4xl md:text-6xl font-black mb-8 text-white tracking-tighter"><?php esc_html_e( 'Ready to build the next breakthrough?', 'devportfolio' ); ?></h2>
					<p class="text-xl text-primary-light font-medium mb-12">
						<?php esc_html_e( 'Currently available for strategic consulting and technical leadership roles.', 'devportfolio' ); ?>
					</p>
					<a href="mailto:<?php echo esc_attr( get_option( 'admin_email' ) ); ?>" class="inline-block px-12 py-6 bg-white text-primary font-black text-sm uppercase tracking-widest rounded-2xl transition-all hover:scale-105 hover:shadow-2xl">
						<?php esc_html_e( 'Initialize Connection', 'devportfolio' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
