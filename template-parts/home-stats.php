<?php
/**
 * Stats Section — Animated counters with scroll reveal.
 *
 * @package DanialPortfolio
 */

$stats = [
    [
        'number' => get_theme_mod( 'stat_1_number', '+120' ),
        'label'  => get_theme_mod( 'stat_1_label', 'پروژه‌های موفق' ),
    ],
    [
        'number' => get_theme_mod( 'stat_2_number', '45k' ),
        'label'  => get_theme_mod( 'stat_2_label', 'خط کد پاک' ),
    ],
    [
        'number' => get_theme_mod( 'stat_3_number', '+15' ),
        'label'  => get_theme_mod( 'stat_3_label', 'تکنولوژی مورد استفاده' ),
    ],
    [
        'number' => get_theme_mod( 'stat_4_number', '99%' ),
        'label'  => get_theme_mod( 'stat_4_label', 'رضایت مشتریان' ),
    ],
];
?>

<section class="py-24 bg-surface border-y border-border">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-0">
            <?php foreach ( $stats as $i => $stat ) :
                // Parse prefix, number, suffix from values like "+120" or "45k" or "99%"
                $raw = $stat['number'];
                preg_match( '/^([^0-9]*)([0-9]+)(.*)$/', $raw, $m );
                $prefix = $m[1] ?? '';
                $num    = $m[2] ?? $raw;
                $suffix = $m[3] ?? '';
            ?>
            <div class="text-center px-8 <?php echo $i < 3 ? 'lg:border-r border-border rtl:lg:border-r-0 rtl:lg:border-l' : ''; ?>">
                <div class="text-6xl md:text-7xl font-black text-white mb-2 tracking-tighter italic"
                     data-count="<?php echo esc_attr( $num ); ?>"
                     data-prefix="<?php echo esc_attr( $prefix ); ?>"
                     data-suffix="<?php echo esc_attr( $suffix ); ?>"><?php echo esc_html( $raw ); ?></div>
                <div class="text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500"><?php echo esc_html( $stat['label'] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
