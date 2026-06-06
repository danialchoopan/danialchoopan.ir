<?php
/**
 * Technical Blog Archive - Premium Edition
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main class="py-32 grid-pattern">
	<div class="container mx-auto px-6 relative z-10">
		<header class="max-w-3xl mb-24">
			<div class="flex items-center gap-4 text-xs font-black uppercase tracking-[0.3em] text-primary mb-6">
				<span>02 // KNOWLEDGE BASE</span>
				<div class="w-12 h-px bg-primary/30"></div>
			</div>
			<h1 class="text-5xl md:text-7xl font-black mb-8 tracking-tighter text-white">
				<?php
				if ( is_archive() ) {
					the_archive_title();
				} else {
					esc_html_e( 'Technical Logs', 'devportfolio' );
				}
				?>
			</h1>
			<p class="text-xl text-zinc-500 font-medium leading-relaxed">
				<?php
				if ( is_archive() ) {
					the_archive_description();
				} else {
					esc_html_e( 'Architectural deep dives, engineering patterns, and technical retrospectives.', 'devportfolio' );
				}
				?>
			</p>
		</header>

		<div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
			<div class="lg:col-span-8 space-y-24">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'group' ); ?>>
							<div class="flex flex-col gap-10">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="w-full h-[400px] overflow-hidden rounded-[40px] border border-zinc-800">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000' ) ); ?>
										</a>
									</div>
								<?php endif; ?>

								<div class="max-w-3xl">
									<div class="flex flex-wrap items-center gap-6 text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-8">
										<span class="flex items-center gap-2">
											<i class="far fa-calendar text-primary"></i>
											<?php echo get_the_date(); ?>
										</span>
										<span class="w-1 h-1 bg-zinc-800 rounded-full"></span>
										<span class="flex items-center gap-2">
											<i class="far fa-clock text-accent"></i>
											<?php echo esc_html( devportfolio_reading_time( get_the_content() ) ); ?> <?php esc_html_e( 'min read', 'devportfolio' ); ?>
										</span>
										<?php
										$categories = get_the_category();
										if ( $categories ) : ?>
											<span class="w-1 h-1 bg-zinc-800 rounded-full"></span>
											<span class="text-white bg-zinc-800 px-3 py-1 rounded-lg"><?php echo esc_html( $categories[0]->name ); ?></span>
										<?php endif; ?>
									</div>

									<h2 class="text-3xl md:text-4xl font-black mb-6 text-white group-hover:text-primary transition-colors tracking-tight">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>

									<p class="text-lg text-zinc-500 font-medium leading-relaxed mb-8 line-clamp-3">
										<?php echo esc_html( get_the_excerpt() ); ?>
									</p>

									<a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-4 text-xs font-black uppercase tracking-widest text-white group-hover:gap-6 transition-all">
										<?php esc_html_e( 'Decipher Article', 'devportfolio' ); ?>
										<i class="fas fa-arrow-right text-primary"></i>
									</a>
								</div>
							</div>
						</article>
						<?php
					endwhile;

					the_posts_navigation(
						array(
							'prev_text' => '<i class="fas fa-arrow-left mr-2 text-primary"></i> ' . esc_html__( 'Previous Logs', 'devportfolio' ),
							'next_text' => esc_html__( 'Next Logs', 'devportfolio' ) . ' <i class="fas fa-arrow-right ml-2 text-primary"></i>',
							'class'     => 'flex justify-between items-center pt-16 border-t border-zinc-900 font-black text-xs uppercase tracking-widest text-white',
						)
					);

				else :
					echo '<p class="text-zinc-500">' . esc_html__( 'No logs recorded yet.', 'devportfolio' ) . '</p>';
				endif;
				?>
			</div>

			<aside class="lg:col-span-4 space-y-16">
				<!-- Search -->
				<div class="p-10 bg-zinc-900/50 border border-zinc-800 rounded-[32px]">
					<h3 class="text-lg font-black mb-8 text-white uppercase tracking-widest"><?php esc_html_e( 'Query Database', 'devportfolio' ); ?></h3>
					<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative">
						<input type="search" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_attr_e( 'Search content...', 'devportfolio' ); ?>" class="w-full bg-zinc-950 border border-zinc-800 focus:border-primary rounded-2xl py-4 px-6 text-sm font-medium outline-none transition-all">
						<button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-500 hover:text-white">
							<i class="fas fa-search"></i>
						</button>
					</form>
				</div>

				<!-- Categories -->
				<div class="p-10 bg-zinc-900/50 border border-zinc-800 rounded-[32px]">
					<h3 class="text-lg font-black mb-8 text-white uppercase tracking-widest"><?php esc_html_e( 'Classifications', 'devportfolio' ); ?></h3>
					<div class="space-y-4">
						<?php
						$categories = get_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'number' => 8 ) );
						foreach ( $categories as $category ) :
							?>
							<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="flex justify-between items-center group p-2 hover:translate-x-1 transition-all">
								<span class="text-zinc-400 font-bold group-hover:text-white"><?php echo esc_html( $category->name ); ?></span>
								<span class="text-[10px] font-black px-2 py-1 bg-zinc-800 text-zinc-500 rounded-md group-hover:bg-primary group-hover:text-white"><?php echo esc_html( $category->count ); ?></span>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</aside>
		</div>
	</div>
</main>

<?php get_footer(); ?>
