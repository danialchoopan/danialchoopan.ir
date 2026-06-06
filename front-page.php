<?php
/**
 * The dynamic front page template file
 *
 * @package DevPortfolio
 */

get_header(); ?>

<main>
	<?php
	$order_raw = get_theme_mod('homepage_order', 'hero,tech,portfolio,blog');
	$sections  = explode(',', $order_raw);

	foreach ($sections as $section) {
		$section = trim($section);
		switch ($section) {
			case 'hero':
				get_template_part('template-parts/home', 'hero');
				break;
			case 'tech':
				get_template_part('template-parts/home', 'tech');
				break;
			case 'portfolio':
				get_template_part('template-parts/home', 'portfolio');
				break;
			case 'blog':
				get_template_part('template-parts/home', 'blog');
				break;
		}
	}
	?>
</main>

<?php get_footer(); ?>
