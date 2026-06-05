<?php
/**
 * The template for displaying all single posts
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-24">
	<div class="container mx-auto px-6">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto' ); ?>>
				<header class="mb-12 text-center">
					<div class="flex items-center justify-center gap-4 text-sm font-bold text-primary uppercase tracking-widest mb-6">
						<span><?php echo get_the_date(); ?></span>
						<span class="w-1.5 h-1.5 bg-gray-300 rounded-full"></span>
						<span><?php echo esc_html( devportfolio_reading_time( get_the_content() ) ); ?> <?php esc_html_e( 'min read', 'devportfolio' ); ?></span>
					</div>
					<h1 class="text-4xl md:text-6xl font-bold mb-8 leading-tight">
						<?php the_title(); ?>
					</h1>
					<div class="flex items-center justify-center gap-3">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 40, '', '', array( 'class' => 'rounded-full' ) ); ?>
						<span class="font-bold"><?php the_author(); ?></span>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mb-16 rounded-3xl overflow-hidden shadow-2xl shadow-primary/5">
						<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="prose prose-lg md:prose-xl dark:prose-invert max-w-none prose-headings:font-bold prose-a:text-primary prose-pre:bg-gray-900 prose-pre:rounded-2xl prose-pre:border prose-pre:border-gray-800 prose-code:text-primary dark:prose-code:text-primary-light">
					<?php the_content(); ?>
				</div>

				<footer class="mt-16 pt-12 border-t border-gray-100 dark:border-gray-800">
					<div class="flex flex-wrap items-center justify-between gap-8">
						<div class="flex flex-wrap gap-2">
							<?php
							$tags = get_the_tags();
							if ( $tags ) {
								foreach ( $tags as $tag ) {
									echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-primary hover:text-white transition-all text-sm font-medium rounded-xl">#' . esc_html( $tag->name ) . '</a>';
								}
							}
							?>
						</div>
						<div class="flex items-center gap-4">
							<span class="text-sm font-bold opacity-60"><?php esc_html_e( 'Share:', 'devportfolio' ); ?></span>
							<div class="flex gap-2">
								<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-[#1DA1F2] hover:text-white transition-all"><i class="fab fa-twitter"></i></a>
								<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-[#0077b5] hover:text-white transition-all"><i class="fab fa-linkedin-in"></i></a>
							</div>
						</div>
					</div>

					<!-- Author Bio -->
					<div class="mt-16 p-8 md:p-12 bg-gray-50 dark:bg-gray-900 rounded-3xl flex flex-col md:flex-row gap-8 items-center text-center md:text-start">
						<div class="flex-shrink-0">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 120, '', '', array( 'class' => 'rounded-2xl' ) ); ?>
						</div>
						<div>
							<h3 class="text-2xl font-bold mb-2"><?php the_author(); ?></h3>
							<p class="text-secondary dark:text-gray-400 mb-6">
								<?php the_author_meta( 'description' ); ?>
							</p>
							<div class="flex justify-center md:justify-start gap-4">
								<?php
								$social_links = devportfolio_get_social_links();
								foreach ( $social_links as $platform => $url ) :
									?>
									<a href="<?php echo esc_url( $url ); ?>" target="_blank" class="text-secondary hover:text-primary transition-colors"><i class="fab fa-<?php echo esc_attr( $platform ); ?> text-xl"></i></a>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</footer>
			</article>

			<?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>
	</div>
</main>

<style>
/* Prism-like styling for code blocks if using a syntax highlighter,
   otherwise styling the default prose output */
pre {
	position: relative;
	padding: 2rem !important;
	overflow-x: auto;
	box-shadow: inset 0 0 40px rgba(0,0,0,0.3);
}
pre::before {
	content: ' ';
	position: absolute;
	top: 1rem;
	left: 1rem;
	width: 12px;
	height: 12px;
	background: #ff5f56;
	border-radius: 50%;
	box-shadow: 20px 0 0 #ffbd2e, 40px 0 0 #27c93f;
}
code {
	font-family: 'Fira Code', 'Courier New', Courier, monospace;
	font-size: 0.9em;
}
</style>

<?php get_footer(); ?>
