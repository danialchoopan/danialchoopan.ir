# DevPortfolio Pro 🚀

[![WordPress](https://img.shields.io/badge/WordPress-v6.0+-21759b.svg?logo=wordpress&logoColor=white)](https://wordpress.org)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v3.0+-38B2AC.svg?logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-v7.4+-777bb4.svg?logo=php&logoColor=white)](https://php.net)
[![License: GPL-2.0](https://img.shields.io/badge/License-GPL--2.0-blue.svg)](https://opensource.org/licenses/GPL-2.0)

A highly professional, enterprise-grade, custom WordPress theme built for Senior Software Engineers. Designed to showcase high-end coding skills, clean architecture, and technical projects with a minimalist, high-tech aesthetic.

## ✨ Key Features

- **Modern Tech Stack:** Built with Tailwind CSS (Utility-first) and modern PHP standards.
- **Developer-Centric Design:** Dark mode preferred, high typographic hierarchy, and premium code block styling.
- **Portfolio Custom Post Type:** Dedicated project showcase with category filtering, technology badges, and detailed case study layouts.
- **Technical Blog:** Optimized for deep-dive technical reading with reading time estimation and scannable layouts.
- **i18n & RTL Support:** Fully internationalized and optimized for Persian (RTL) and English (LTR) with the 'Vazirmatn' font.
- **Performance Focused:** Minimalist architecture, lazy loading support, and clean code.

## 📸 Screenshots

| Home Desktop | Portfolio Grid |
| :---: | :---: |
| ![Home Desktop](screenshots/home-desktop.png) | ![Portfolio Grid](screenshots/portfolio-grid.png) |

| RTL View (Persian) | Blog Single |
| :---: | :---: |
| ![RTL View](screenshots/rtl-view.png) | ![Blog Single](screenshots/blog-single.png) |

## 🛠️ Installation

1. **Clone the repository:**
   ```bash
   cd wp-content/themes
   git clone https://github.com/danialchoopan/devportfolio-pro.git
   ```

2. **Activate the theme:**
   Log in to your WordPress dashboard, navigate to **Appearance > Themes**, and activate **DevPortfolio Pro**.

3. **Configure Navigation:**
   Go to **Appearance > Menus** and create your menus. Assign them to the **Primary Menu** and **Footer Menu** locations.

4. **Add Content:**
   - Create your technical blog posts under **Posts**.
   - Showcase your projects using the **Portfolios** menu item. Use custom fields like `tech_stack`, `github_url`, `live_url`, and `challenge` for enhanced project details.

## ⚙️ Development & Customization

This theme uses Tailwind CSS via CDN for rapid development. For production use, it is recommended to compile Tailwind locally:

1. Install dependencies: `npm install`
2. Compile styles: `npm run build`
3. The `functions.php` is configured to easily switch between CDN and compiled CSS.

## 📝 License

This project is licensed under the GNU General Public License v2 or later.

---
Built with ❤️ by [Danial Choopan](https://danialchoopan.ir)
