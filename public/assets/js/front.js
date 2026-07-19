document.addEventListener('DOMContentLoaded', function () {
    // --- Navbar shrink on scroll ---
    const navbar = document.querySelector('.site-navbar');
    const backToTop = document.querySelector('.back-to-top');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 60) {
            navbar?.classList.add('shadow-sm');
        } else {
            navbar?.classList.remove('shadow-sm');
        }

        if (window.scrollY > 400) {
            backToTop?.classList.add('show');
        } else {
            backToTop?.classList.remove('show');
        }
    });

    backToTop?.addEventListener('click', function (e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // --- Smooth scroll for in-page anchor links (e.g. Hire Me -> #contact) ---
    // Handles links like "#contact" on the current page, and also links like
    // "/#contact" or "https://site/#contact" when we are already on that page,
    // offsetting for the sticky navbar so the target isn't hidden under it.
    function scrollToHash(hash) {
        if (!hash || hash === '#') return false;
        const target = document.querySelector(hash);
        if (!target) return false;
        const navH = navbar ? navbar.offsetHeight : 0;
        const top = target.getBoundingClientRect().top + window.pageYOffset - navH - 10;
        window.scrollTo({ top: top, behavior: 'smooth' });
        return true;
    }

    document.querySelectorAll('a[href*="#"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            const url = new URL(this.href, window.location.origin);
            const samePage = url.pathname === window.location.pathname;
            if (samePage && url.hash) {
                if (scrollToHash(url.hash)) {
                    e.preventDefault();
                    history.replaceState(null, '', url.hash);
                }
            }
        });
    });

    // If the page loaded with a hash (arriving from another page), scroll to it
    // once the layout has settled.
    if (window.location.hash) {
        setTimeout(function () { scrollToHash(window.location.hash); }, 300);
    }

    // --- Animate skill progress bars when visible ---
    const skillBars = document.querySelectorAll('.skill-progress-bar');
    if (skillBars.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const bar = entry.target;
                    bar.style.width = bar.dataset.percentage + '%';
                    observer.unobserve(bar);
                }
            });
        }, { threshold: 0.3 });

        skillBars.forEach((bar) => observer.observe(bar));
    }

    // --- Fade-in on scroll for elements with .reveal-on-scroll ---
    const reveals = document.querySelectorAll('.reveal-on-scroll');
    if (reveals.length) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        reveals.forEach((el) => revealObserver.observe(el));
    }

    // --- Portfolio category filter (front-end visual filter on already-loaded items) ---
    const filterPills = document.querySelectorAll('[data-filter-pill]');
    const filterItems = document.querySelectorAll('[data-filter-item]');

    filterPills.forEach((pill) => {
        pill.addEventListener('click', function (e) {
            e.preventDefault();
            filterPills.forEach((p) => p.classList.remove('active'));
            this.classList.add('active');

            const target = this.dataset.filterPill;

            filterItems.forEach((item) => {
                if (target === 'all' || item.dataset.filterItem === target) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // --- AJAX Contact Form ---
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Sending...';

            const formData = new FormData(contactForm);

            fetch(contactForm.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData,
            })
                .then((response) => response.json().then((data) => ({ status: response.status, body: data })))
                .then(({ status, body }) => {
                    if (status === 200 && body.success) {
                        if (window.Swal) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Message Sent!',
                                text: body.message,
                                confirmButtonColor: '#2563EB',
                            });
                        } else {
                            alert(body.message);
                        }
                        contactForm.reset();
                    } else if (status === 422) {
                        const errors = Object.values(body.errors || {}).flat().join('\n');
                        if (window.Swal) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Please check your input',
                                text: errors,
                                confirmButtonColor: '#2563EB',
                            });
                        } else {
                            alert(errors);
                        }
                    } else {
                        throw new Error('Unexpected response');
                    }
                })
                .catch(() => {
                    if (window.Swal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong',
                            text: 'Please try again later.',
                            confirmButtonColor: '#2563EB',
                        });
                    } else {
                        alert('Something went wrong. Please try again later.');
                    }
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
        });
    }
});
