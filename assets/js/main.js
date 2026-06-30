/**
 * Main Theme JavaScript — Danial Portfolio v3.0
 *
 * Features:
 *   - Dark/Light mode toggle with icon swap + localStorage
 *   - Preloader with typing animation
 *   - Sticky header with hide/show on scroll
 *   - Terminal line-by-line reveal animation
 *   - Floating particles background
 *   - Counter animation for stats
 *   - Scroll reveal with stagger
 *   - Code copy on all <pre> blocks
 *   - AJAX contact form
 *   - Mobile menu open/close
 */
document.addEventListener('DOMContentLoaded', () => {

    const themeSettings = {
        preloader: document.body.classList.contains('preloader-enabled'),
        scrollReveal: document.body.classList.contains('scroll-reveal-enabled')
    };

    // Settings from PHP Customizer
    const S = window.danialSettings || {};

    // ══════════════════════════════════════════════════════════════════
    // DARK / LIGHT MODE TOGGLE
    // ══════════════════════════════════════════════════════════════════
    const darkToggle = document.getElementById('dark-mode-toggle');
    const moonIcon = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>`;
    const sunIcon = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>`;

    function updateToggleIcon() {
        if (!darkToggle) return;
        const isLight = document.documentElement.classList.contains('light-mode');
        darkToggle.innerHTML = isLight ? moonIcon : sunIcon;
    }

    // Restore saved theme
    if (localStorage.getItem('theme') === 'light') {
        document.documentElement.classList.add('light-mode');
    }
    updateToggleIcon();

    if (darkToggle) {
        darkToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('light-mode');
            const isLight = document.documentElement.classList.contains('light-mode');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
            updateToggleIcon();
            // Smooth transition flash
            document.body.style.transition = 'background-color 0.3s, color 0.3s';
        });
    }

    // ══════════════════════════════════════════════════════════════════
    // PRELOADER
    // ══════════════════════════════════════════════════════════════════
    const preloader = document.getElementById('preloader');
    if (preloader && themeSettings.preloader) {
        setTimeout(() => {
            preloader.style.opacity = '0';
            setTimeout(() => { preloader.style.display = 'none'; }, 500);
        }, S.preloader_duration || 1800);
    } else if (preloader) {
        preloader.style.display = 'none';
    }

    // ══════════════════════════════════════════════════════════════════
    // TERMINAL LINE-BY-LINE REVEAL
    // ══════════════════════════════════════════════════════════════════
    const terminalLines = document.querySelectorAll('.terminal-line');
    if (terminalLines.length) {
        let delay = 800; // start after preloader
        terminalLines.forEach((line, i) => {
            line.style.opacity = '0';
            line.style.transform = 'translateX(-10px)';
            line.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            setTimeout(() => {
                line.style.opacity = '1';
                line.style.transform = 'translateX(0)';
            }, delay + (i * (S.terminal_speed || 180)));
        });
    }

    // ══════════════════════════════════════════════════════════════════
    // FLOATING PARTICLES (hero background)
    // ══════════════════════════════════════════════════════════════════
    const heroSection = document.querySelector('.hero-particles');
    if (heroSection && S.show_particles !== false) {
        const count = S.particles_count || 20;
        for (let i = 0; i < count; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 6 + 's';
            particle.style.animationDuration = (4 + Math.random() * 6) + 's';
            particle.style.width = particle.style.height = (2 + Math.random() * 4) + 'px';
            heroSection.appendChild(particle);
        }
    }

    // ══════════════════════════════════════════════════════════════════
    // COUNTER ANIMATION (stats section)
    // ══════════════════════════════════════════════════════════════════
    const counters = document.querySelectorAll('[data-count]');
    if (counters.length) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = el.getAttribute('data-count');
                    const prefix = el.getAttribute('data-prefix') || '';
                    const suffix = el.getAttribute('data-suffix') || '';
                    const numTarget = parseInt(target.replace(/[^0-9]/g, ''), 10);
                    if (isNaN(numTarget)) return;
                    let current = 0;
                    const step = Math.max(1, Math.floor(numTarget / 60));
                    const timer = setInterval(() => {
                        current += step;
                        if (current >= numTarget) {
                            current = numTarget;
                            clearInterval(timer);
                        }
                        el.textContent = prefix + current.toLocaleString() + suffix;
                    }, S.counter_speed || 25);
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(c => counterObserver.observe(c));
    }

    // ══════════════════════════════════════════════════════════════════
    // PROGRESS BAR ANIMATION
    // ══════════════════════════════════════════════════════════════════
    const progressBars = document.querySelectorAll('.animate-progress');
    if (progressBars.length) {
        const barObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('progress-active');
                    barObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        progressBars.forEach(bar => barObserver.observe(bar));
    }

    // ══════════════════════════════════════════════════════════════════
    // STICKY HEADER
    // ══════════════════════════════════════════════════════════════════
    let lastScroll = 0;
    const header = document.getElementById('main-header');
    if (header) {
        header.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll <= 0) {
                header.style.transform = 'translateY(0)';
                header.style.opacity = '1';
                lastScroll = currentScroll;
                return;
            }
            if (currentScroll > lastScroll) {
                header.style.transform = 'translateY(-100%)';
                header.style.opacity = '0';
            } else {
                header.style.transform = 'translateY(0)';
                header.style.opacity = '1';
            }
            lastScroll = currentScroll;
        });
    }

    // ══════════════════════════════════════════════════════════════════
    // MOBILE MENU
    // ══════════════════════════════════════════════════════════════════
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileClose = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', () => {
            mobileMenu.classList.remove('translate-x-full');
            mobileMenu.classList.add('translate-x-0');
        });
    }
    if (mobileClose && mobileMenu) {
        mobileClose.addEventListener('click', () => {
            mobileMenu.classList.remove('translate-x-0');
            mobileMenu.classList.add('translate-x-full');
        });
    }

    // ══════════════════════════════════════════════════════════════════
    // CODE COPY
    // ══════════════════════════════════════════════════════════════════
    document.querySelectorAll('pre').forEach(block => {
        const button = document.createElement('button');
        button.innerText = 'COPY';
        button.className = 'copy-button';
        button.style.cssText = 'position:absolute;top:8px;right:8px;font-size:10px;background:#FFD700;color:#131313;padding:2px 8px;font-weight:700;border-radius:2px;opacity:0;transition:opacity 0.2s;cursor:pointer;border:none;';
        block.style.position = 'relative';
        block.classList.add('group');
        block.appendChild(button);
        block.addEventListener('mouseenter', () => { button.style.opacity = '1'; });
        block.addEventListener('mouseleave', () => { button.style.opacity = '0'; });
        button.addEventListener('click', () => {
            const code = block.querySelector('code') ? block.querySelector('code').innerText : block.innerText;
            navigator.clipboard.writeText(code).then(() => {
                button.innerText = 'COPIED!';
                setTimeout(() => { button.innerText = 'COPY'; }, 2000);
            });
        });
    });

    // ══════════════════════════════════════════════════════════════════
    // AJAX CONTACT FORM
    // ══════════════════════════════════════════════════════════════════
    const contactForm = document.getElementById('portfolio-contact-form');
    const statusDiv = document.getElementById('contact-status');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(contactForm);
            formData.append('action', 'submit_contact_form');
            formData.append('security', S.nonce);

            statusDiv.style.display = 'block';
            statusDiv.style.padding = '12px 16px';
            statusDiv.style.fontSize = '12px';
            statusDiv.style.fontWeight = '700';
            statusDiv.style.textTransform = 'uppercase';
            statusDiv.style.letterSpacing = '0.05em';
            statusDiv.style.marginBottom = '16px';
            statusDiv.style.color = '#131313';
            statusDiv.style.backgroundColor = '#FFD700';
            statusDiv.innerText = S.contact_sending || 'SENDING...';

            fetch(S.ajax_url, { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                statusDiv.innerText = data.data.message;
                if (data.success) {
                    statusDiv.style.backgroundColor = '#22c55e';
                    statusDiv.style.color = '#ffffff';
                    contactForm.reset();
                } else {
                    statusDiv.style.backgroundColor = '#ef4444';
                    statusDiv.style.color = '#ffffff';
                }
            })
            .catch(() => {
                statusDiv.innerText = 'ERROR SENDING MESSAGE.';
                statusDiv.style.backgroundColor = '#ef4444';
                statusDiv.style.color = '#ffffff';
            });
        });
    }

    // ══════════════════════════════════════════════════════════════════
    // SCROLL REVEAL (staggered)
    // ══════════════════════════════════════════════════════════════════
    if (themeSettings.scrollReveal) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('active');
                    }, i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });

        document.querySelectorAll('section, .card, article, .reveal-item').forEach(el => {
            el.classList.add('scroll-reveal');
            observer.observe(el);
        });
    }

    // ══════════════════════════════════════════════════════════════════
    // TYPING EFFECT for elements with [data-type] attribute
    // ══════════════════════════════════════════════════════════════════
    document.querySelectorAll('[data-type]').forEach(el => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    typeText(el);
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        observer.observe(el);
    });

    function typeText(el) {
        const text = el.getAttribute('data-type');
        const speed = parseInt(el.getAttribute('data-type-speed') || '50', 10);
        el.textContent = '';
        let i = 0;
        const timer = setInterval(() => {
            el.textContent += text[i];
            i++;
            if (i >= text.length) clearInterval(timer);
        }, speed);
    }
});
