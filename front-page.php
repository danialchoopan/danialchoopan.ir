<?php
/**
 * The front page template file
 */

get_header();

$order = get_theme_mod('homepage_order', 'hero,tech,stats,portfolio,blog');
$sections = explode(',', $order);

foreach ($sections as $section) {
    $section = trim($section);
    switch ($section) {
        case 'hero':
            get_template_part('template-parts/home-hero');
            break;
        case 'tech':
            get_template_part('template-parts/home-tech');
            break;
        case 'stats':
            get_template_part('template-parts/home-stats');
            break;
        case 'portfolio':
            get_template_part('template-parts/home-portfolio');
            break;
        case 'blog':
            get_template_part('template-parts/home-blog');
            break;
    }
}

get_footer();
