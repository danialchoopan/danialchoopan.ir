<section class="py-32 bg-white dark:bg-zinc-950">
	<div class="container mx-auto px-6">
		<h2 class="text-3xl font-black text-zinc-900 dark:text-white uppercase tracking-[0.2em] mb-20 flex items-center gap-6">
			<span><?php esc_html_e( 'Recent Logs', 'devportfolio' ); ?></span>
			<div class="h-px flex-1 bg-zinc-100 dark:bg-zinc-900"></div>
		</h2>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-16">
			<?php
			$b_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 2 ) );
			if ( $b_query->have_posts() ) : while ( $b_query->have_posts() ) : $b_query->the_post(); ?>
				<article class="group">
					<div class="text-[9px] font-black text-primary uppercase tracking-widest mb-6 flex items-center gap-3">
						<span><?php echo get_the_date(); ?></span>
						<span class="w-1 h-1 bg-zinc-200 dark:bg-zinc-800 rounded-full"></span>
						<span><?php echo esc_html( devportfolio_reading_time( get_the_content() ) ); ?> <?php esc_html_e( 'min read', 'devportfolio' ); ?></span>
					</div>
					<h3 class="text-3xl font-black text-zinc-900 dark:text-white group-hover:text-primary transition-colors leading-tight mb-6">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<p class="text-zinc-600 dark:text-zinc-500 font-medium mb-8 line-clamp-2"><?php echo esc_html(get_the_excerpt()); ?></p>
					<a href="<?php the_permalink(); ?>" class="text-[10px] font-black uppercase tracking-widest text-zinc-900 dark:text-white flex items-center gap-3 group-hover:gap-5 transition-all">
						<?php esc_html_e( 'Read Log', 'devportfolio' ); ?>
						<svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
					</a>
				</article>
			<?php endwhile; wp_reset_postdata(); else : ?>
				<p class="text-zinc-500 uppercase font-black tracking-widest"><?php esc_html_e( 'No logs found.', 'devportfolio' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
