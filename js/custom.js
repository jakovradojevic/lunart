/**
 * Custom JavaScript for Lunart Theme
 */

document.addEventListener('DOMContentLoaded', function() {
    
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const headerHeight = document.querySelector('.navigation').offsetHeight;
                const targetPosition = target.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('gentle-fade-in');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const animateElements = document.querySelectorAll('.service-card, .gallery-item, .hero-feature');
    animateElements.forEach(el => {
        observer.observe(el);
    });
    
    // Parallax/background scroll effect for hero section (non-intrusive)
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        // Ensure any previous transform is cleared to avoid layout gaps
        heroSection.style.transform = '';
        const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)');
        const onScrollHero = () => {
            if (prefersReduced && prefersReduced.matches) return;
            const scrolled = window.pageYOffset || document.documentElement.scrollTop || 0;
            // Move background only to prevent layout shift (no translate on the container)
            heroSection.style.backgroundPosition = `center ${Math.round(scrolled * 0.2)}px`;
        };
        window.addEventListener('scroll', onScrollHero, { passive: true });
    }
    
    // Gallery image hover effects
    const galleryImages = document.querySelectorAll('.gallery-image');
    galleryImages.forEach(image => {
        image.addEventListener('mouseenter', function() {
            this.querySelector('.gallery-image-overlay').style.opacity = '1';
        });
        
        image.addEventListener('mouseleave', function() {
            this.querySelector('.gallery-image-overlay').style.opacity = '0';
        });
    });
    
    // Form validation for contact forms
    const contactForms = document.querySelectorAll('form[class*="contact"]');
    contactForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                } else {
                    field.classList.remove('error');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Molimo popunite sva obavezna polja.');
            }
        });
    });
    
    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        const lazyImages = document.querySelectorAll('img[data-src]');
        lazyImages.forEach(img => imageObserver.observe(img));
    }
    
    // Back to top button
    const backToTopButton = document.createElement('button');
    backToTopButton.innerHTML = `
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18,15 12,9 6,15"></polyline>
        </svg>
    `;
    backToTopButton.className = 'back-to-top';
    backToTopButton.setAttribute('aria-label', 'Nazad na vrh');
    document.body.appendChild(backToTopButton);
    
    // Show/hide back to top button
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    });
    
    // Back to top functionality
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Add loading states to buttons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.classList.contains('btn-primary') || this.classList.contains('btn-outline')) {
                this.classList.add('loading');
                setTimeout(() => {
                    this.classList.remove('loading');
                }, 2000);
            }
        });
    });
    
    // Cookie consent banner
    if (!localStorage.getItem('cookieConsent')) {
        const cookieBanner = document.createElement('div');
        cookieBanner.className = 'cookie-banner';
        cookieBanner.innerHTML = `
            <div class="cookie-content">
                <p>Ova web stranica koristi kolačiće za poboljšanje korisničkog iskustva. Nastavkom korišćenja stranice pristajete na korišćenje kolačića.</p>
                <div class="cookie-buttons">
                    <button class="btn btn-primary accept-cookies">Prihvatam</button>
                    <button class="btn btn-outline decline-cookies border-primary text-primary">Odbijam</button>
                </div>
            </div>
        `;
        document.body.appendChild(cookieBanner);
        
        // Cookie consent functionality
        const acceptButton = cookieBanner.querySelector('.accept-cookies');
        const declineButton = cookieBanner.querySelector('.decline-cookies');
        
        acceptButton.addEventListener('click', function() {
            localStorage.setItem('cookieConsent', 'accepted');
            cookieBanner.remove();
        });
        
        declineButton.addEventListener('click', function() {
            localStorage.setItem('cookieConsent', 'declined');
            cookieBanner.remove();
        });
    }
    
    // Search functionality
    const searchToggle = document.querySelector('.search-toggle');
    const searchForm = document.querySelector('.search-form');
    
    if (searchToggle && searchForm) {
        searchToggle.addEventListener('click', function() {
            searchForm.classList.toggle('active');
            if (searchForm.classList.contains('active')) {
                searchForm.querySelector('input[type="search"]').focus();
            }
        });
        
        // Close search on outside click
        document.addEventListener('click', function(e) {
            if (!searchForm.contains(e.target) && !searchToggle.contains(e.target)) {
                searchForm.classList.remove('active');
            }
        });
    }
    
    // Newsletter subscription
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            // Simulate subscription
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.textContent = 'Pretplaćujem...';
            submitButton.disabled = true;
            
            setTimeout(() => {
                submitButton.textContent = 'Uspešno pretplaćen!';
                submitButton.classList.add('success');
                this.reset();
                
                setTimeout(() => {
                    submitButton.textContent = originalText;
                    submitButton.disabled = false;
                    submitButton.classList.remove('success');
                }, 3000);
            }, 2000);
        });
    }
    
    // Testimonials carousel
    const testimonials = document.querySelectorAll('.testimonial');
    if (testimonials.length > 1) {
        let currentTestimonial = 0;
        
        function showTestimonial(index) {
            testimonials.forEach((testimonial, i) => {
                testimonial.style.display = i === index ? 'block' : 'none';
            });
        }
        
        function nextTestimonial() {
            currentTestimonial = (currentTestimonial + 1) % testimonials.length;
            showTestimonial(currentTestimonial);
        }
        
        // Auto-rotate testimonials
        setInterval(nextTestimonial, 5000);
        
        // Show first testimonial
        showTestimonial(0);
    }
    
    // Add CSS for dynamic elements
    const style = document.createElement('style');
    style.textContent = `
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            background: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(241, 14, 85, 0.3);
        }
        
        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #1f2937;
            color: #ffffff;
            padding: 1rem;
            z-index: 9999;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }
        
        .cookie-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        
        .cookie-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        /* Cookie banner responsiveness and decline button styling */
        .cookie-banner .decline-cookies {
            border-color: var(--primary);
            color: var(--primary);
            background: transparent;
        }
        .cookie-banner .decline-cookies:hover,
        .cookie-banner .decline-cookies:focus {
            background: rgba(241, 14, 85, 0.08); /* fallback hover tint */
        }
        @media (max-width: 640px) {
            .cookie-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
            .cookie-buttons {
                width: 100%;
            }
            .cookie-buttons .btn {
                flex: 1;
                width: 100%;
            }
        }
        
        .btn.loading {
            position: relative;
            color: transparent;
        }
        
        .btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .btn.success {
            background: #10b981;
            border-color: #10b981;
        }
        
        .search-form {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            padding: 1rem;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        
        .search-form.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .search-form input[type="search"] {
            width: 250px;
            padding: 0.5rem;
            border: 1px solid var(--border);
            border-radius: var(--radius);
        }
        
        .testimonial {
            text-align: center;
            padding: 2rem;
        }
        
        .testimonial blockquote {
            font-style: italic;
            font-size: 1.125rem;
            margin-bottom: 1rem;
        }
        
        .testimonial cite {
            font-weight: 600;
            color: var(--primary);
        }
    `;
    document.head.appendChild(style);
});
