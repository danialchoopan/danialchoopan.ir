# Vibecode Studio - Premium Developer Portfolio Theme

A professional, high-performance WordPress theme for Senior Software Engineers. Built with an MVC architecture (OOP PHP) and a Cyber-Brutalist aesthetic.

## Features
- **MVC Architecture**: OOP structure in `src/` directory.
- **Native Multi-language**: FA, EN, DE, AR support without extra plugins.
- **Advanced Customizer**: Typography, colors, spacing, and feature toggles.
- **GitHub Integration**: Display repos with star/fork counts and caching.
- **Developer Rank**: Automatic scoring based on project history.
- **AJAX Contact System**: Fast, non-reloading message submission.
- **Dark/Light Mode**: User preference stored in `localStorage`.
- **Responsive Design**: Tailored for mobile, tablet, and desktop.
- **SEO Ready**: JSON-LD and Open Graph built-in.

## Installation
1. Upload to `wp-content/themes/`.
2. Activate theme.
3. Configure GitHub Token in `DevPortfolio` Admin Menu.
4. Customize via `Appearance > Customize`.

## Development
Compile CSS:
`npx tailwindcss -i ./assets/css/input.css -o ./assets/css/main.css --minify`
