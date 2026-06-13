# DevPortfolio Danial 

[![WordPress](https://img.shields.io/badge/WordPress-v6.0+-21759b.svg?logo=wordpress&logoColor=white)](https://wordpress.org)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v3.0+-38B2AC.svg?logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License: GPL-2.0](https://img.shields.io/badge/License-GPL--2.0-blue.svg)](https://opensource.org/licenses/GPL-2.0)

**DevPortfolio Pro** is a highly professional, enterprise-grade custom WordPress theme architected for Senior Software Engineers. It features a minimalist, high-tech aesthetic with a focus on performance, accessibility, and technical depth.

## ✨ Core Features (New & Enhanced)

- **🚀 Local Asset Architecture:** Completely independent of external CDNs. Tailwind CSS and Vazirmatn fonts are bundled locally for maximum privacy and performance.
- **🛠️ Theme Options Panel:** A dedicated settings page in the Admin Dashboard for managing:
  - **Site Language:** Instant toggle between English (LTR) and Farsi (RTL).
  - **Contact Info:** Global management of email and phone numbers.
  - **Social Matrix:** Centralized links for GitHub and LinkedIn.
- **📩 Advanced Contact System:** Custom-built contact form handling that saves messages directly to a "Contact Messages" CPT and sends email notifications.
- **📐 Optimized Portfolio Grid:** Responsive grid layout (1, 3, or 4 columns) for project showcases.
- **📄 Custom Page Templates:** Professionally designed templates for **Contact Me** and **About Me** pages.
- **Accessibility Optimized:** Sharp text contrast in both dark and light modes for maximum readability.

## 💎 Visual Showcase

### 🏠 Home Desktop

![Home Desktop](screenshots/home-desktop.png)

*Featuring a high-impact hero section and technical competency grid.*


## 🛠️ Installation & Setup Guide

1. **Clone the repository:**
   ```bash
   cd wp-content/themes
   git clone https://github.com/danialchoopan/danialchoopan.ir.git
   ```

2. **Activate the theme:**
   Log in to your WordPress dashboard, navigate to **Appearance > Themes**, and activate **DevPortfolio Pro**.

3. **Configure Theme Options:**
   Go to **Theme Options** in the sidebar. Set your preferred site language, contact email, phone number, and social media links. These will be automatically displayed on the contact page.

4. **Setup Contact Me Page:**
   - Go to **Pages > Add New**.
   - Set the title to "Contact Me".
   - In the **Page Attributes** section on the right, select the **Contact Me** template.
   - Publish the page. It will now show your contact info and the functional form.

5. **Setup About Me Page:**
   - Go to **Pages > Add New**.
   - Set the title to "About Me".
   - Select the **About Me** template in **Page Attributes**.
   - Add your bio content in the editor. The template will automatically display your technical DNA cards on the side.

6. **Manage Messages:**
   All submissions from the contact form are stored in the **Messages** menu in your WordPress dashboard. You can view, manage, and reply to inquiries from there.

7. **Configure Navigation:**
   Create your menus under **Appearance > Menus** and assign them to the **Primary Menu** and **Footer Menu** locations.

## ⚙️ Technical Standards

- **Security:** Strict adherence to WordPress standards (escaping, sanitization, nonces).
- **Hooks:** Extensible architecture using standard WordPress hooks.
- **Performance:** Pre-compiled local CSS and locally hosted assets for sub-second load times.

## 📝 License

This project is licensed under the GNU General Public License v2 or later.

---
Built with ❤️ by [Danial Choopan](https://danialchoopan.ir)
