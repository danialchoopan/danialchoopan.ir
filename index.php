<?php
/**
 * The main template file
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-24">
	<div class="container mx-auto px-6">
		<header class="mb-16">
			<h1 class="text-4xl md:text-5xl font-bold mb-4">
				<?php
				if ( is_archive() ) {
					the_archive_title();
				} elseif ( is_search() ) {
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'devportfolio' ), '<span>' . get_search_query() . '</span>' );
				} else {
					esc_html_e( 'Technical Blog', 'devportfolio' );
				}
				?>
			</h1>
			<p class="text-xl text-secondary dark:text-gray-400">
				<?php
				if ( is_archive() ) {
					the_archive_description();
				} else {
					esc_html_e( 'Deep dives into software engineering, architecture, and modern web development.', 'devportfolio' );
				}
				?>
			</p>
		</header>

		<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
			<div class="lg:col-span-2 space-y-12">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'group' ); ?>>
							<div class="flex flex-col md:flex-row gap-8">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="w-full md:w-64 h-48 flex-shrink-0 overflow-hidden rounded-2xl">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500' ) ); ?>
										</a>
									</div>
								<?php endif; ?>

								<div class="flex-1">
									<div class="flex items-center gap-4 text-xs font-bold text-primary uppercase tracking-widest mb-3">
										<span><?php echo get_the_date(); ?></span>
										<span class="w-1 h-1 bg-gray-300 rounded-full"></span>
										<span><?php echo esc_html( devportfolio_reading_time( get_the_content() ) ); ?> <?php esc_html_e( 'min read', 'devportfolio' ); ?></span>
									</div>
									<h2 class="text-2xl md:text-3xl font-bold mb-4 group-hover:text-primary transition-colors">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
									<p class="text-secondary dark:text-gray-400 mb-6 line-clamp-3">
										<?php echo esc_html( get_the_excerpt() ); ?>
									</p>
									<div class="flex flex-wrap gap-2">
										<?php
										$categories = get_the_category();
										if ( $categories ) {
											foreach ( $categories as $category ) {
												echo '<span class="px-3 py-1 bg-gray-100 dark:bg-gray-800 text-[10px] font-bold rounded-full">' . esc_html( $category->name ) . '</span>';
											}
										}
										?>
									</div>
								</div>
							</div>
						</article>
						<?php
					endwhile;

					the_posts_navigation(
						array(
							'prev_text' => esc_html__( 'Older Posts', 'devportfolio' ),
							'next_text' => esc_html__( 'Newer Posts', 'devportfolio' ),
							'class'     => 'flex justify-between items-center pt-12 border-t border-gray-100 dark:border-gray-800 font-bold',
						)
					);

				else :
					echo '<p>' . esc_html__( 'No posts found.', 'devportfolio' ) . '</p>';
				endif;
				?>
			</div>

			<aside class="lg:col-span-1 space-y-12">
				<div class="p-8 bg-gray-50 dark:bg-gray-900 rounded-2xl">
					<h3 class="text-lg font-bold mb-6"><?php esc_html_e( 'Popular Categories', 'devportfolio' ); ?></h3>
					<ul class="space-y-4">
						<?php
						$categories = get_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'number' => 5 ) );
						foreach ( $categories as $category ) :
							?>
							<li>
								<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="flex justify-between items-center group">
									<span class="group-hover:text-primary transition-colors"><?php echo esc_html( $category->name ); ?></span>
									<span class="text-xs font-bold px-2 py-1 bg-gray-200 dark:bg-gray-800 rounded-lg"><?php echo esc_html( $category->count ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<div class="p-8 border border-gray-100 dark:border-gray-800 rounded-2xl">
					<h3 class="text-lg font-bold mb-6"><?php esc_html_e( 'Subscribe', 'devportfolio' ); ?></h3>
					<p class="text-sm text-secondary dark:text-gray-400 mb-6">
						<?php esc_html_e( 'Get the latest technical deep dives directly in your inbox.', 'devportfolio' ); ?>
					</p>
					<form class="space-y-4">
						<input type="email" placeholder="email@example.com" class="w-full px-4 py-3 bg-gray-100 dark:bg-gray-800 border-transparent focus:border-primary focus:bg-white dark:focus:bg-dark focus:ring-0 rounded-xl transition-all outline-none text-sm">
						<button type="submit" class="w-full py-3 bg-dark dark:bg-white text-white dark:text-dark font-bold rounded-xl hover:bg-primary dark:hover:bg-primary dark:hover:text-white transition-all">
							<?php esc_html_e( 'Subscribe', 'devportfolio' ); ?>
						</button>
					</form>
				</div>
			</aside>
		</div>
	</div>
</main>

<?php get_footer(); ?>
