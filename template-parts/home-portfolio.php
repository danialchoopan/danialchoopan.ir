<section class="py-32 bg-zinc-50 dark:bg-zinc-900/20">
	<div class="container mx-auto px-6">
		<div class="flex items-end justify-between mb-20">
			<h2 class="text-3xl font-black text-zinc-900 dark:text-white uppercase tracking-[0.2em]"><?php esc_html_e( 'Selected Systems', 'devportfolio' ); ?></h2>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>" class="text-[10px] font-black uppercase tracking-widest text-zinc-500 hover:text-primary transition-colors mb-2">
				<?php esc_html_e( 'View All Systems //', 'devportfolio' ); ?>
			</a>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-10">
			<?php
			$p_query = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 3 ) );
			if ( $p_query->have_posts() ) : while ( $p_query->have_posts() ) : $p_query->the_post(); ?>
				<article class="group bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 rounded-[32px] overflow-hidden hover:border-primary/30 transition-all duration-500">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="h-48 overflow-hidden">
							<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-700' ) ); ?>
						</div>
					<?php endif; ?>
					<div class="p-10">
						<div class="flex items-center justify-between mb-8">
							<span class="text-[9px] font-black uppercase tracking-widest text-primary bg-primary/10 px-3 py-1 rounded-full">
								<?php $t = get_the_terms(get_the_ID(), 'portfolio_category'); if($t) echo esc_html($t[0]->name); ?>
							</span>
						</div>

						<h3 class="text-2xl font-black mb-4 text-zinc-900 dark:text-white group-hover:text-primary transition-colors leading-tight">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<p class="text-zinc-600 dark:text-zinc-500 text-sm font-medium mb-10 line-clamp-2"><?php echo esc_html(get_the_excerpt()); ?></p>

						<div class="flex items-center justify-between pt-8 border-t border-zinc-100 dark:border-zinc-800/50">
							<a href="<?php the_permalink(); ?>" class="text-[10px] font-black uppercase tracking-widest text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white transition-colors">
								<?php esc_html_e( 'Analyze Case', 'devportfolio' ); ?>
							</a>
							<svg class="w-4 h-4 text-zinc-300 dark:text-zinc-700 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
						</div>
					</div>
				</article>
			<?php endwhile; wp_reset_postdata(); else : ?>
				<p class="text-zinc-500 uppercase font-black tracking-widest"><?php esc_html_e( 'No systems currently indexed.', 'devportfolio' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
