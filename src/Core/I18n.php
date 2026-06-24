<?php
namespace DevPortfolio\Core;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Handles Multi-language support and RTL/LTR logic.
 */
class I18n {
	private static $instance = null;
    private array $supported_langs = [
        'fa' => 'fa_IR',
        'en' => 'en_US',
        'de' => 'de_DE',
        'ar' => 'ar_SA'
    ];

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_filter( 'locale', [ $this, 'handle_locale' ] );
		add_filter( 'body_class', [ $this, 'add_body_classes' ] );
	}

	public function handle_locale( $locale ) {
        if ( isset( $_GET['lang'] ) && array_key_exists( $_GET['lang'], $this->supported_langs ) ) {
            return $this->supported_langs[ $_GET['lang'] ];
        }

        $options = get_option( 'devportfolio_settings' );
        $default_lang = $options['site_language'] ?? 'fa';

        return $this->supported_langs[ $default_lang ] ?? $locale;
	}

	public function add_body_classes( $classes ) {
        $locale = get_locale();
        if ( in_array( $locale, [ 'fa_IR', 'ar_SA' ] ) ) {
            $classes[] = 'rtl';
        } else {
            $classes[] = 'ltr';
        }

        $classes[] = 'bg-surface text-white selection:bg-primary selection:text-surface font-vazir';
		return $classes;
	}

    public static function render_language_switcher() {
        $current_lang = isset($_GET['lang']) ? $_GET['lang'] : 'fa';
        ?>
        <div class="relative group">
            <button class="text-[10px] font-black uppercase tracking-widest text-zinc-400 hover:text-white transition-colors">
                <?php echo esc_html( strtoupper( $current_lang ) ); ?>
            </button>
            <div class="absolute right-0 mt-2 w-24 bg-surface-high border border-border shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                <a href="?lang=fa" class="block px-4 py-2 text-[10px] hover:bg-primary hover:text-surface transition-colors">FA</a>
                <a href="?lang=en" class="block px-4 py-2 text-[10px] hover:bg-primary hover:text-surface transition-colors">EN</a>
                <a href="?lang=de" class="block px-4 py-2 text-[10px] hover:bg-primary hover:text-surface transition-colors">DE</a>
                <a href="?lang=ar" class="block px-4 py-2 text-[10px] hover:bg-primary hover:text-surface transition-colors">AR</a>
            </div>
        </div>
        <?php
    }
}
