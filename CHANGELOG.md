# Changelog

## [3.1.0] - 2025-06-30

### Added
- **Dark/Light toggle icon swap** — Moon icon in dark mode, sun icon in light mode
- **Terminal line-by-line reveal** — Code appears one line at a time on page load
- **Blinking cursor** — Animated `█` in terminal block
- **Floating particles** — 20 animated particles in hero background
- **Counter animation** — Stats count up from 0 on scroll
- **Typing effect** — Status text types character by character (`data-type` attribute)
- **Progress bar animation** — Bars fill on scroll intersection
- **Scroll reveal variants** — `from-left`, `from-right`, `scale-in` options
- **Staggered reveal** — Sections animate in sequence, not all at once
- **Card lift hover** — Cards rise with shadow on hover
- **Glow hover** — Subtle glow border effect
- **Neon border** — Permanent neon glow class
- **Gradient text** — Primary-to-secondary gradient class
- **Code shimmer** — Light sweep animation across code blocks
- **Float animation** — Gentle up/down bobbing
- **Pulse ring** — Expanding border ring effect
- **Matrix rain** — Binary code CSS background
- **Hero title entrance** — Slides up on page load
- **Status badge pulse** — Glowing dot animation
- **Light mode animation overrides** — Particles and effects adapt to light theme
- **15 Customizer sections** — Blog, Header, Footer, Portfolio sections added
- **Blog customization** — Subtitle, title, posts per page
- **Header customization** — CTA button text/URL/toggle, language switcher toggle
- **Footer customization** — Description, nav toggle, back-to-top text
- **Portfolio customization** — Subtitle, title, item count, view-all text/URL
- **Typography controls** — H1 size, H2 size, line height
- **Offline everything** — Vazirmatn fonts, CSS, JS, Prism.js all local
- **README.md** — Comprehensive documentation with animation class reference

### Changed
- Removed Google Fonts CDN — Vazirmatn loads from local `.woff2` files
- Removed Tailwind CDN — Replaced with comprehensive offline CSS
- Removed Prism.js CDN — Bundled locally
- Languages reduced to Farsi + English only
- Hero terminal now on LEFT, text on RIGHT
- Terminal lines use `terminal-line` class for animation
- Stats use `data-count` attribute for counter animation

### Fixed
- Dark mode toggle now shows correct icon (sun/moon)
- Light mode properly applies all Customizer colors
- Terminal lines don't flash before animation starts
- Counter values display correctly with prefixes/suffixes

## [3.0.0] - 2025-06-30

### Fixed
- CSS loading (replaced @tailwind directives with Tailwind CDN)
- Dark mode inversion
- Dark mode localStorage restore
- Font loading
- Header scroll transition
- Mobile menu toggle
- Contact form admin display
- XSS vulnerabilities (13 bugs fixed)

### Added
- Admin Dashboard with stats
- Testimonials CPT + section
- CTA section
- Custom 404 page
- Full Customizer control
- Code comments throughout
- Professional README

## [2.1.0] - 2024-06-23

### Added
- Initial release
- MVC architecture
- i18n support (FA, EN, DE, AR)
- AJAX contact form
- Developer rank system
- GitHub API integration
- Customizer typography/layout
- Scroll reveal animations
- Dark/Light mode
