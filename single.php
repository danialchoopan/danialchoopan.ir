<?php
/**
 * Single Technical Post - High Performance Edition
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-32 grid-pattern relative">
	<div class="container mx-auto px-6 relative z-10">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto' ); ?>>
				<header class="mb-24 text-center">
					<div class="flex flex-wrap items-center justify-center gap-6 text-[9px] font-black uppercase tracking-[0.3em] text-primary mb-12">
						<span><?php echo get_the_date(); ?></span>
						<span class="w-1.5 h-1.5 bg-zinc-800 rounded-full"></span>
						<span><?php echo esc_html( devportfolio_reading_time( get_the_content() ) ); ?> <?php esc_html_e( 'min read', 'devportfolio' ); ?></span>
					</div>

					<h1 class="text-5xl md:text-7xl font-black mb-12 tracking-tighter text-white leading-[0.95]">
						<?php the_title(); ?>
					</h1>

					<div class="flex items-center justify-center gap-4 text-xs font-black uppercase tracking-widest">
						<span class="text-zinc-500"><?php esc_html_e( 'System Engineer //', 'devportfolio' ); ?></span>
						<span class="text-white"><?php the_author(); ?></span>
					</div>
				</header>

				<div class="prose prose-zinc prose-invert max-w-none
							prose-headings:font-black prose-headings:tracking-tighter prose-headings:text-white
							prose-p:text-zinc-400 prose-p:text-lg prose-p:leading-relaxed
							prose-a:text-primary prose-a:no-underline
							prose-pre:bg-zinc-900 prose-pre:rounded-2xl prose-pre:border prose-pre:border-zinc-800 prose-pre:p-10
							prose-code:text-primary prose-code:before:content-none prose-code:after:content-none">
					<?php the_content(); ?>
				</div>

				<footer class="mt-32 pt-16 border-t border-zinc-900 flex justify-between items-center">
					<div class="flex gap-4">
						<?php
						$social_links = devportfolio_get_social_links();
						foreach ( $social_links as $platform => $url ) : ?>
							<a href="<?php echo esc_url( $url ); ?>" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-lg bg-zinc-900 border border-zinc-800 text-zinc-600 hover:text-white transition-all">
								<div class="w-5 h-5"><?php echo devportfolio_get_svg( $platform ); ?></div>
							</a>
						<?php endforeach; ?>
					</div>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="text-[9px] font-black uppercase tracking-[0.2em] text-zinc-500 hover:text-white transition-all">
						<?php esc_html_e( '// Back to Logs', 'devportfolio' ); ?>
					</a>
				</footer>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<style>
code {
	font-family: 'Fira Code', 'JetBrains Mono', monospace;
	font-size: 0.9em !important;
}
</style>

<?php get_footer(); ?>
