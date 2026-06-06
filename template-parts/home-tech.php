<section class="py-32 bg-white dark:bg-zinc-950">
	<div class="container mx-auto px-6">
		<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
			<?php for ( $i = 1; $i <= 3; $i++ ) :
				$title = get_theme_mod("tech_card_title_$i", "Card $i");
				$tags  = get_theme_mod("tech_card_tags_$i", "PHP, Go, Node.js");
				$img   = get_theme_mod("tech_card_img_$i");
			?>
				<div class="relative p-10 bg-zinc-50 dark:bg-zinc-900/50 border border-zinc-100 dark:border-zinc-800 rounded-[32px] overflow-hidden group">
					<?php if($img): ?>
					<div class="absolute inset-0 z-0 bg-cover bg-center opacity-10 group-hover:opacity-20 transition-opacity" style="background-image: url('<?php echo esc_url($img); ?>');"></div>
					<?php endif; ?>
					<div class="relative z-10">
						<h3 class="text-xl font-black mb-6 text-zinc-900 dark:text-white uppercase tracking-widest"><?php echo esc_html($title); ?></h3>
						<div class="flex flex-wrap gap-2">
							<?php foreach ( explode(',', $tags) as $tag ) : ?>
								<span class="px-4 py-2 bg-white dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 text-[10px] font-black uppercase tracking-widest rounded-lg"><?php echo esc_html(trim($tag)); ?></span>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</section>
