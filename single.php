<?php
/**
 * Single Technical Post - Premium Edition
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-32 grid-pattern relative">
	<div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-5xl h-screen bg-primary/5 blur-[120px] pointer-events-none"></div>

	<div class="container mx-auto px-6 relative z-10">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto' ); ?>>
				<header class="mb-20 text-center">
					<div class="flex flex-wrap items-center justify-center gap-6 text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-10">
						<span><?php echo get_the_date(); ?></span>
						<span class="w-1.5 h-1.5 bg-zinc-800 rounded-full"></span>
						<span><?php echo esc_html( devportfolio_reading_time( get_the_content() ) ); ?> <?php esc_html_e( 'min read', 'devportfolio' ); ?></span>
					</div>

					<h1 class="text-5xl md:text-7xl font-black mb-12 tracking-tighter text-white leading-[0.95]">
						<?php the_title(); ?>
					</h1>

					<div class="flex items-center justify-center gap-4">
						<div class="w-12 h-12 rounded-full border border-zinc-800 p-1">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'rounded-full' ) ); ?>
						</div>
						<div class="text-left">
							<span class="block text-white font-black text-xs uppercase tracking-widest"><?php the_author(); ?></span>
							<span class="text-zinc-500 text-[10px] font-bold uppercase tracking-widest"><?php esc_html_e( 'Lead Engineer', 'devportfolio' ); ?></span>
						</div>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mb-24 rounded-[48px] overflow-hidden border border-zinc-800 shadow-2xl">
						<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="prose prose-zinc prose-invert max-w-none
							prose-headings:font-black prose-headings:tracking-tighter prose-headings:text-white
							prose-p:text-zinc-400 prose-p:text-lg prose-p:leading-relaxed prose-p:font-medium
							prose-a:text-primary prose-a:no-underline hover:prose-a:text-primary-light
							prose-pre:bg-zinc-900 prose-pre:rounded-[32px] prose-pre:border prose-pre:border-zinc-800 prose-pre:p-10
							prose-code:text-primary prose-code:before:content-none prose-code:after:content-none
							prose-strong:text-white prose-blockquote:border-primary prose-blockquote:bg-zinc-900/50 prose-blockquote:p-8 prose-blockquote:rounded-2xl">
					<?php the_content(); ?>
				</div>

				<footer class="mt-32 pt-16 border-t border-zinc-900">
					<div class="flex flex-wrap items-center justify-between gap-10">
						<div class="flex flex-wrap gap-3">
							<?php
							$tags = get_the_tags();
							if ( $tags ) {
								foreach ( $tags as $tag ) {
									echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="px-6 py-2 bg-zinc-900 border border-zinc-800 hover:border-primary text-zinc-500 hover:text-white transition-all text-[10px] font-black uppercase tracking-widest rounded-xl">#' . esc_html( $tag->name ) . '</a>';
								}
							}
							?>
						</div>
						<div class="flex items-center gap-6">
							<span class="text-[10px] font-black uppercase tracking-widest text-zinc-600"><?php esc_html_e( 'Broadcast', 'devportfolio' ); ?></span>
							<div class="flex gap-4">
								<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-xl bg-zinc-900 border border-zinc-800 hover:text-primary transition-all transition-all duration-300">
									<i class="fab fa-twitter text-lg"></i>
								</a>
								<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-xl bg-zinc-900 border border-zinc-800 hover:text-primary transition-all transition-all duration-300">
									<i class="fab fa-linkedin-in text-lg"></i>
								</a>
							</div>
						</div>
					</div>

					<!-- Author Bio -->
					<div class="mt-32 p-12 md:p-16 bg-zinc-900/30 border border-zinc-800 rounded-[48px] flex flex-col md:flex-row gap-12 items-center text-center md:text-left relative overflow-hidden">
						<div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 blur-3xl rounded-full"></div>
						<div class="flex-shrink-0 relative z-10">
							<div class="w-32 h-32 rounded-[32px] border-2 border-primary/20 p-2">
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 128, '', '', array( 'class' => 'rounded-[24px]' ) ); ?>
							</div>
						</div>
						<div class="relative z-10">
							<h3 class="text-3xl font-black mb-4 text-white tracking-tight"><?php the_author(); ?></h3>
							<p class="text-lg text-zinc-500 font-medium leading-relaxed mb-8 max-w-xl">
								<?php the_author_meta( 'description' ); ?>
							</p>
							<div class="flex justify-center md:justify-start gap-6">
								<?php
								$social_links = devportfolio_get_social_links();
								foreach ( $social_links as $platform => $url ) :
									?>
									<a href="<?php echo esc_url( $url ); ?>" target="_blank" class="text-zinc-600 hover:text-primary transition-all">
										<i class="fab fa-<?php echo esc_attr( $platform ); ?> text-2xl"></i>
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</footer>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<style>
pre {
	position: relative;
	overflow: hidden;
}
pre::before {
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 4px;
	background: linear-gradient(to right, #6366f1, #10b981);
	opacity: 0.5;
}
code {
	font-family: 'Fira Code', 'JetBrains Mono', monospace;
	font-size: 0.95em !important;
	line-height: 1.7 !important;
}
</style>

<?php get_footer(); ?>
