</main>

<footer class="bg-surface border-t border-border py-20">
	<div class="container mx-auto px-6">
		<div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-20">
            <div class="md:col-span-2">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-3xl font-black tracking-tighter text-white mb-6 block">
                    <?php bloginfo( 'name' ); ?>
                </a>
                <p class="text-zinc-500 font-mono text-sm leading-relaxed max-w-sm">
                    Crafting digital excellence through high-performance code and brutalist design aesthetics.
                </p>
            </div>

            <div>
                <h4 class="text-[10px] font-black uppercase tracking-widest text-white mb-6">Navigation</h4>
                <div class="flex flex-col gap-4 text-xs font-bold text-zinc-500 uppercase tracking-widest">
                    <a href="#" class="hover:text-primary transition-colors">Portfolio</a>
                    <a href="#" class="hover:text-primary transition-colors">Technical Blog</a>
                    <a href="#" class="hover:text-primary transition-colors">Stack</a>
                    <a href="#" class="hover:text-primary transition-colors">Connect</a>
                </div>
            </div>

            <div>
                <h4 class="text-[10px] font-black uppercase tracking-widest text-white mb-6">Social</h4>
                <div class="flex flex-col gap-4 text-xs font-bold text-zinc-500 uppercase tracking-widest">
                    <a href="#" class="hover:text-primary transition-colors">GitHub</a>
                    <a href="#" class="hover:text-primary transition-colors">LinkedIn</a>
                    <a href="#" class="hover:text-primary transition-colors">Twitter</a>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center pt-12 border-t border-border/30 gap-8">
			<div class="text-[10px] font-bold uppercase tracking-widest text-zinc-600">
				© <?php echo date('Y'); ?> <?php bloginfo('name'); ?> // [BUILD_VERSION: 2.1.0]
			</div>

			<div class="flex items-center gap-8">
				<a href="#top" class="text-[10px] font-bold uppercase tracking-widest text-primary hover:underline">Back_to_top ↑</a>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
