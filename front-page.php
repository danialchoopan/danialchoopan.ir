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
            if (get_theme_mod('show_tech_section', true)) {
                get_template_part('template-parts/home-tech');
            }
            break;
        case 'stats':
            if (get_theme_mod('show_stats_section', true)) {
                get_template_part('template-parts/home-stats');
            }
            break;
        case 'portfolio':
            if (get_theme_mod('show_portfolio_section', true)) {
                get_template_part('template-parts/home-portfolio');
            }
            break;
        case 'blog':
            if (get_theme_mod('show_blog_section', true)) {
                get_template_part('template-parts/home-blog');
            }
            break;
    }
}

get_footer();
