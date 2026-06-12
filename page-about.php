<?php
/**
 * Template Name: About Me
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-32 grid-pattern relative">
	<div class="container mx-auto px-6 relative z-10">
		<div class="max-w-5xl mx-auto">
			<header class="mb-32">
				<h1 class="text-6xl md:text-8xl font-black mb-10 tracking-tighter text-zinc-900 dark:text-white uppercase"><?php esc_html_e( 'About', 'devportfolio' ); ?></h1>
				<p class="text-xl text-zinc-600 dark:text-zinc-500 font-medium leading-relaxed max-w-2xl"><?php esc_html_e( 'Engineering digital resilience and high-performance systems.', 'devportfolio' ); ?></p>
			</header>

			<div class="grid grid-cols-1 lg:grid-cols-12 gap-24">
				<div class="lg:col-span-7 prose prose-zinc dark:prose-invert max-w-none prose-p:text-xl prose-p:leading-relaxed prose-headings:font-black prose-headings:tracking-tighter">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
				</div>

				<aside class="lg:col-span-5 space-y-12">
					<div class="p-12 bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 rounded-[40px]">
						<h3 class="text-2xl font-black mb-10 text-zinc-900 dark:text-white tracking-tighter uppercase"><?php esc_html_e( 'Technical DNA', 'devportfolio' ); ?></h3>

						<div class="space-y-12">
							<div>
								<h4 class="text-[9px] font-black uppercase tracking-[0.3em] text-zinc-400 dark:text-zinc-600 mb-6"><?php esc_html_e( 'Core Stack', 'devportfolio' ); ?></h4>
								<div class="flex flex-wrap gap-3">
									<?php
									$core_techs = ['PHP', 'Go', 'Node.js', 'Python', 'AWS', 'Docker', 'Kubernetes', 'PostgreSQL'];
									foreach($core_techs as $tech): ?>
										<span class="px-5 py-2 bg-zinc-100 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-black uppercase tracking-widest text-zinc-500 rounded-xl"><?php echo esc_html($tech); ?></span>
									<?php endforeach; ?>
								</div>
							</div>

							<div>
								<h4 class="text-[9px] font-black uppercase tracking-[0.3em] text-zinc-400 dark:text-zinc-600 mb-6"><?php esc_html_e( 'Specializations', 'devportfolio' ); ?></h4>
								<ul class="space-y-4">
									<?php
									$specs = [
										'Distributed Systems Architecture',
										'High-Availability Infrastructure',
										'Cloud Native Engineering',
										'Performance Optimization'
									];
									foreach($specs as $spec): ?>
										<li class="flex items-center gap-4 text-sm font-bold text-zinc-700 dark:text-zinc-300">
											<span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
											<?php echo esc_html($spec); ?>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
