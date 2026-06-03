# Backend Developer Portfolio - Landing Page

A professional, static landing page designed for backend developers to showcase their skills, projects, blog posts, and testimonials from colleagues.

## Features

- **Responsive Design**: Fully responsive layout that works on all devices
- **Dark/Light Theme Toggle**: Users can switch between dark and light modes with persistent preference
- **Professional Sections**:
  - Hero/About section with profile image
  - Technical Skills showcase
  - Featured Projects portfolio
  - Blog posts section
  - Testimonials from colleagues
  - Contact form
- **No Emojis**: Uses professional SVG icons instead of emojis
- **Blue & Black Theme**: Default color scheme with easy customization
- **Smooth Scrolling**: Navigation links scroll smoothly to sections
- **Static Assets**: All CSS, icons, and images are downloaded locally

## Tech Stack

- HTML5
- Tailwind CSS (via CDN for simplicity)
- Vanilla JavaScript
- SVG Icons (Font Awesome)
- Unsplash Images

## Project Structure

```
/workspace
├── index.html          # Main landing page
├── tailwind.js         # Tailwind CSS CDN script
├── assets/
│   ├── icons/          # SVG icons
│   │   ├── github.svg
│   │   ├── linkedin.svg
│   │   ├── twitter.svg
│   │   ├── code.svg
│   │   ├── envelope.svg
│   │   ├── briefcase.svg
│   │   ├── user.svg
│   │   ├── blog.svg
│   │   ├── comments.svg
│   │   ├── server.svg
│   │   ├── moon.svg
│   │   └── sun.svg
│   └── images/         # Image assets
│       ├── profile.jpg
│       ├── project1.jpg
│       ├── project2.jpg
│       └── project3.jpg
└── README.md           # This file
```

## Getting Started

### Option 1: Open Directly in Browser

Simply open `index.html` in your web browser:

```bash
# On macOS
open index.html

# On Windows
start index.html

# On Linux
xdg-open index.html
```

### Option 2: Use a Local Server

For the best experience, serve the files using a local web server:

```bash
# Using Python 3
python3 -m http.server 8000

# Then visit http://localhost:8000
```

Or with Node.js:

```bash
npx serve .
```

## Customization

### Personal Information

Edit `index.html` to customize:

1. **Name and Title**: Update "John Doe" and "Backend Developer" in the hero section
2. **Bio**: Modify the about text in the hero section
3. **Skills**: Update the technical skills in the Skills section
4. **Projects**: Replace project titles, descriptions, and technologies
5. **Blog Posts**: Update blog post titles, dates, and excerpts
6. **Testimonials**: Change colleague names, positions, and quotes
7. **Contact Info**: Update email address and social media links

### Theme Colors

The default theme uses blue (`blue-600`) as the primary color. To change it:

1. Search for `blue-600` in `index.html`
2. Replace with your preferred Tailwind color (e.g., `green-600`, `purple-600`, `red-600`)
3. Also update `blue-400` for dark mode variations

### Images

Replace images in `assets/images/`:

- `profile.jpg`: Your profile photo (recommended: 400x400px)
- `project1.jpg`, `project2.jpg`, `project3.jpg`: Project screenshots (recommended: 600x400px)

### Icons

Icons are downloaded from Font Awesome. To use different icons:

1. Download SVG icons from [Font Awesome](https://fontawesome.com/icons)
2. Save them in `assets/icons/`
3. Update the `src` attributes in `index.html`

## Dark Mode

The site supports both dark and light modes:

- **Automatic**: Respects system preference
- **Manual Toggle**: Click the sun/moon icon in the navigation
- **Persistent**: Preference is saved in localStorage

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

This project is open source and available under the MIT License.

## Contributing

Feel free to fork this project and customize it for your own portfolio!

---

**Created with ❤️ for Backend Developers**
