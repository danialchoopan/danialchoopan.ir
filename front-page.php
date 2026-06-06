<?php
/**
 * The front page template file - High Performance Edition
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main>
	<!-- Hero Section -->
	<section class="relative min-h-[85vh] flex items-center pt-20 overflow-hidden grid-pattern">
		<div class="absolute inset-0 bg-gradient-to-b from-transparent via-zinc-950/20 to-zinc-950"></div>

		<div class="container mx-auto px-6 relative z-10">
			<div class="max-w-4xl">
				<div class="inline-flex items-center gap-3 px-3 py-1 mb-8 text-[9px] font-black tracking-[0.3em] text-accent uppercase bg-accent/10 border border-accent/20 rounded-full">
					<span class="w-1.5 h-1.5 bg-accent rounded-full animate-pulse"></span>
					<?php esc_html_e( 'System Architecture // Lead Engineering', 'devportfolio' ); ?>
				</div>

				<h1 class="text-6xl md:text-8xl font-black mb-10 leading-[0.85] tracking-tighter text-white">
					<?php esc_html_e( 'Building', 'devportfolio' ); ?> <br>
					<span class="text-primary italic"><?php esc_html_e( 'Resilience', 'devportfolio' ); ?></span> <br>
					<?php esc_html_e( 'through Code.', 'devportfolio' ); ?>
				</h1>

				<p class="text-lg md:text-xl text-zinc-500 mb-12 leading-relaxed max-w-2xl font-medium">
					<?php esc_html_e( 'Focused on distributed systems, high-availability architecture, and engineering excellence.', 'devportfolio' ); ?>
				</p>

				<div class="flex flex-wrap gap-6">
					<a href="#portfolio" class="px-10 py-5 bg-primary hover:bg-primary-dark text-white font-black text-[11px] uppercase tracking-[0.2em] rounded-xl transition-all shadow-[0_20px_50px_rgba(79,70,229,0.2)] hover:-translate-y-1">
						<?php esc_html_e( 'Analyze Systems', 'devportfolio' ); ?>
					</a>
					<div class="flex items-center gap-4 px-2">
						<?php
						$social_links = devportfolio_get_social_links();
						foreach ( $social_links as $platform => $url ) :
							?>
							<a href="<?php echo esc_url( $url ); ?>" target="_blank" class="w-10 h-10 flex items-center justify-center text-zinc-600 hover:text-white transition-colors">
								<div class="w-6 h-6"><?php echo devportfolio_get_svg( $platform ); ?></div>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Technical DNA -->
	<section class="py-32 bg-zinc-950">
		<div class="container mx-auto px-6">
			<div class="grid grid-cols-1 md:grid-cols-3 gap-12">
				<?php
				$dna = array(
					array( 'title' => 'Scalability', 'icon' => 'cubes', 'desc' => 'Distributed system design for multi-regional workloads.' ),
					array( 'title' => 'Optimization', 'icon' => 'terminal', 'desc' => 'Refining core logic for sub-millisecond response times.' ),
					array( 'title' => 'Security', 'icon' => 'code', 'desc' => 'Hardening infrastructure through automated compliance.' ),
				);

				foreach ( $dna as $item ) : ?>
					<div class="group">
						<div class="w-12 h-12 text-primary mb-8 group-hover:scale-110 transition-transform">
							<?php echo devportfolio_get_svg( $item['icon'] ); ?>
						</div>
						<h3 class="text-xl font-black mb-4 text-white tracking-tight uppercase tracking-widest"><?php echo esc_html( $item['title'] ); ?></h3>
						<p class="text-zinc-500 text-sm leading-relaxed font-medium"><?php echo esc_html( $item['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Latest Work -->
	<section id="portfolio" class="py-32 bg-zinc-900/20">
		<div class="container mx-auto px-6">
			<div class="flex justify-between items-center mb-20">
				<h2 class="text-3xl font-black tracking-tight text-white uppercase tracking-widest"><?php esc_html_e( 'Recent Deployments', 'devportfolio' ); ?></h2>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>" class="text-[10px] font-black uppercase tracking-[0.2em] text-primary hover:translate-x-2 transition-transform inline-flex items-center gap-2">
					<?php esc_html_e( 'Full Repository', 'devportfolio' ); ?>
					<div class="w-4 h-4"><?php echo devportfolio_get_svg('arrow-right'); ?></div>
				</a>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
				<?php
				$p_query = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 3 ) );
				if ( $p_query->have_posts() ) :
					while ( $p_query->have_posts() ) : $p_query->the_post(); ?>
						<article class="group bg-zinc-900/50 border border-zinc-800 p-10 rounded-[32px] hover:border-primary/30 transition-all duration-500">
							<div class="flex items-center justify-between mb-8">
								<div class="w-8 h-8 text-primary/40"><?php echo devportfolio_get_svg('terminal'); ?></div>
								<span class="text-[9px] font-black uppercase tracking-widest text-zinc-600">
									<?php $t = get_the_terms(get_the_ID(), 'portfolio_category'); if($t) echo esc_html($t[0]->name); ?>
								</span>
							</div>
							<h3 class="text-2xl font-black mb-4 text-white group-hover:text-primary transition-colors tracking-tight">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<p class="text-zinc-500 text-sm font-medium mb-10 line-clamp-2"><?php echo esc_html(get_the_excerpt()); ?></p>
							<div class="flex items-center justify-between pt-6 border-t border-zinc-800">
								<a href="<?php the_permalink(); ?>" class="text-[10px] font-black uppercase tracking-widest text-zinc-400 group-hover:text-white transition-all flex items-center gap-2">
									<?php esc_html_e( 'Analysis', 'devportfolio' ); ?>
									<div class="w-3 h-3"><?php echo devportfolio_get_svg('arrow-right'); ?></div>
								</a>
							</div>
						</article>
					<?php endwhile; wp_reset_postdata(); endif; ?>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
