/**
 * Main Theme JavaScript
 */
document.addEventListener('DOMContentLoaded', () => {
    console.log('Vibecode Studio Core Initialized');

    // Preloader
    const preloader = document.getElementById('preloader');
    if (preloader) {
        setTimeout(() => {
            preloader.style.opacity = '0';
            setTimeout(() => { preloader.style.display = 'none'; }, 500);
        }, 1000);
    }

    // Sticky Header
    let lastScroll = 0;
    const header = document.getElementById('main-header');
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        if (currentScroll <= 0) {
            header.classList.remove('scroll-up');
            return;
        }
        if (currentScroll > lastScroll && !header.classList.contains('scroll-down')) {
            header.classList.remove('scroll-up');
            header.classList.add('scroll-down');
            header.style.transform = 'translateY(-100%)';
        } else if (currentScroll < lastScroll && header.classList.contains('scroll-down')) {
            header.classList.remove('scroll-down');
            header.classList.add('scroll-up');
            header.style.transform = 'translateY(0)';
        }
        lastScroll = currentScroll;
    });

    // Dark Mode Toggle
    const darkToggle = document.getElementById('dark-mode-toggle');
    if (darkToggle) {
        darkToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark-mode');
            const isDark = document.documentElement.classList.contains('dark-mode');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    }

    // Code Copy Functionality
    const codeBlocks = document.querySelectorAll('pre');
    codeBlocks.forEach(block => {
        const button = document.createElement('button');
        button.innerText = 'COPY';
        button.className = 'copy-button absolute top-2 right-2 text-[10px] bg-primary text-surface px-2 py-1 font-bold rounded-sm opacity-0 group-hover:opacity-100 transition-opacity';
        block.style.position = 'relative';
        block.classList.add('group');
        block.appendChild(button);

        button.addEventListener('click', () => {
            const code = block.querySelector('code').innerText;
            navigator.clipboard.writeText(code).then(() => {
                button.innerText = 'COPIED!';
                setTimeout(() => { button.innerText = 'COPY'; }, 2000);
            });
        });
    });
});

    // Floating Mode Toggle
    const floatingToggle = document.createElement('div');
    floatingToggle.innerHTML = '<button class="w-12 h-12 bg-primary text-surface rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-transform"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.364 17.636l-.707.707M6.364 6.364l-.707-.707m12.728 12.728l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg></button>';
    floatingToggle.className = 'fixed bottom-8 right-8 z-[90]';
    document.body.appendChild(floatingToggle);
    floatingToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark-mode');
    });

    // AJAX Contact Form
    const contactForm = document.getElementById('portfolio-contact-form');
    const statusDiv = document.getElementById('contact-status');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(contactForm);
            formData.append('action', 'submit_contact_form');
            formData.append('security', devportfolio_ajax.nonce);

            statusDiv.classList.remove('hidden', 'bg-red-500', 'bg-green-500');
            statusDiv.innerText = 'SENDING...';
            statusDiv.classList.add('block', 'bg-primary', 'text-surface');

            fetch(devportfolio_ajax.url, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                statusDiv.innerText = data.data.message;
                if (data.success) {
                    statusDiv.classList.replace('bg-primary', 'bg-green-500');
                    statusDiv.classList.replace('text-surface', 'text-white');
                    contactForm.reset();
                } else {
                    statusDiv.classList.replace('bg-primary', 'bg-red-500');
                    statusDiv.classList.replace('text-surface', 'text-white');
                }
            })
            .catch(() => {
                statusDiv.innerText = 'ERROR SENDING MESSAGE.';
                statusDiv.classList.add('bg-red-500', 'text-white');
            });
        });
    }

    // Scroll Reveal
    const observerOptions = { threshold: 0.1 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);

    document.querySelectorAll('section, .card, article').forEach(el => {
        el.classList.add('scroll-reveal');
        observer.observe(el);
    });
