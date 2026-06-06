<?php
/**
 * The front page template file
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main>
	<?php
	$hero_title = get_theme_mod('hero_title', 'Building Resilience through Code.');
	$hero_bio   = get_theme_mod('hero_bio', 'Focused on high-performance distributed systems and engineering excellence.');
	$hero_img   = get_theme_mod('hero_image');
	?>
	<!-- Hero Section -->
	<section class="relative min-h-[80vh] flex items-center pt-20 overflow-hidden grid-pattern">
		<div class="absolute inset-0 bg-gradient-to-b from-transparent via-zinc-200/20 to-white dark:via-zinc-950/20 dark:to-zinc-950"></div>

		<div class="container mx-auto px-6 relative z-10">
			<div class="flex flex-col lg:flex-row items-center gap-16">
				<div class="max-w-3xl flex-1 text-center lg:text-left rtl:lg:text-right">
					<div class="inline-flex items-center gap-3 px-3 py-1 mb-8 text-[9px] font-black tracking-[0.3em] text-accent uppercase bg-accent/10 border border-accent/20 rounded-full">
						<span class="w-1.5 h-1.5 bg-accent rounded-full animate-pulse"></span>
						<?php esc_html_e( 'Lead Engineer // System Architect', 'devportfolio' ); ?>
					</div>

					<h1 class="text-6xl md:text-8xl font-black mb-10 leading-[0.85] tracking-tighter text-zinc-900 dark:text-white">
						<?php echo esc_html($hero_title); ?>
					</h1>

					<p class="text-lg md:text-xl text-zinc-600 dark:text-zinc-500 mb-12 leading-relaxed max-w-2xl font-medium mx-auto lg:mx-0">
						<?php echo esc_html($hero_bio); ?>
					</p>

					<div class="flex flex-wrap justify-center lg:justify-start gap-6">
						<a href="#portfolio" class="px-10 py-5 bg-primary hover:bg-primary-dark text-white font-black text-[11px] uppercase tracking-[0.2em] rounded-xl transition-all shadow-[0_20px_50px_rgba(79,70,229,0.2)] hover:-translate-y-1">
							<?php esc_html_e( 'Analyze Work', 'devportfolio' ); ?>
						</a>
						<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="px-10 py-5 bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-zinc-900 dark:text-white font-black text-[11px] uppercase tracking-[0.2em] rounded-xl transition-all hover:bg-zinc-200 dark:hover:bg-zinc-800">
							<?php esc_html_e( 'Technical Blog', 'devportfolio' ); ?>
						</a>
					</div>
				</div>

				<?php if($hero_img): ?>
				<div class="flex-shrink-0 w-64 h-64 md:w-80 md:h-80 rounded-[48px] overflow-hidden border-4 border-white dark:border-zinc-800 shadow-2xl rotate-3 hover:rotate-0 transition-transform duration-500">
					<img src="<?php echo esc_url($hero_img); ?>" alt="Hero Profile" class="w-full h-full object-cover">
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- Technical DNA -->
	<section class="py-32 bg-white dark:bg-zinc-950">
		<div class="container mx-auto px-6">
			<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
				<?php
				$stacks = array(
					array( 'title' => 'Core Systems', 'items' => array( 'Node.js', 'Go', 'Python' ) ),
					array( 'title' => 'Infrastructure', 'items' => array( 'AWS', 'K8s', 'Terraform' ) ),
					array( 'title' => 'Web Engine', 'items' => array( 'React', 'Next.js', 'Tailwind' ) ),
				);
				foreach ( $stacks as $stack ) : ?>
					<div class="p-10 bg-zinc-50 dark:bg-zinc-900/50 border border-zinc-100 dark:border-zinc-800 rounded-[32px]">
						<h3 class="text-xl font-black mb-6 text-zinc-900 dark:text-white uppercase tracking-widest"><?php echo esc_html( $stack['title'] ); ?></h3>
						<div class="flex flex-wrap gap-2">
							<?php foreach ( $stack['items'] as $item ) : ?>
								<span class="px-4 py-2 bg-white dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 text-[10px] font-black uppercase tracking-widest rounded-lg"><?php echo esc_html( $item ); ?></span>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Portfolio Section -->
	<?php $cols = get_theme_mod('portfolio_cols', 3); ?>
	<section id="portfolio" class="py-32 bg-zinc-50 dark:bg-zinc-900/20">
		<div class="container mx-auto px-6">
			<h2 class="text-3xl font-black tracking-tight text-zinc-900 dark:text-white uppercase tracking-widest mb-20"><?php esc_html_e( 'Selected Work', 'devportfolio' ); ?></h2>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-<?php echo esc_attr($cols); ?> gap-10">
				<?php
				$p_query = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 3 ) );
				if ( $p_query->have_posts() ) : while ( $p_query->have_posts() ) : $p_query->the_post(); ?>
					<article class="group bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 rounded-[32px] overflow-hidden hover:border-primary/30 transition-all">
						<div class="p-10">
							<span class="text-[9px] font-black uppercase tracking-widest text-primary mb-4 block">
								<?php $t = get_the_terms(get_the_ID(), 'portfolio_category'); if($t) echo esc_html($t[0]->name); ?>
							</span>
							<h3 class="text-2xl font-black mb-4 text-zinc-900 dark:text-white group-hover:text-primary transition-colors tracking-tight">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<p class="text-zinc-600 dark:text-zinc-500 text-sm font-medium mb-10 line-clamp-2"><?php echo esc_html(get_the_excerpt()); ?></p>
							<div class="pt-6 border-t border-zinc-100 dark:border-zinc-800">
								<a href="<?php the_permalink(); ?>" class="text-[10px] font-black uppercase tracking-widest text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white transition-all"><?php esc_html_e( 'Analyze Case', 'devportfolio' ); ?></a>
							</div>
						</div>
					</article>
				<?php endwhile; wp_reset_postdata(); endif; ?>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
