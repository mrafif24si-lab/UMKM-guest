<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets-guest/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script src="{{ asset('assets-guest/js/main.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        AOS.init({
            duration: 1200,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });

        // Advanced Loading System
        const loadingSystem = document.getElementById('loadingSystem');
        const loadingBar = document.querySelector('.loading-bar');
        let loadProgress = 0;

        const loadingInterval = setInterval(() => {
            if (loadProgress >= 100) {
                clearInterval(loadingInterval);
                setTimeout(() => {
                    loadingSystem.style.opacity = '0';
                    loadingSystem.style.transform = 'scale(1.1)';
                    setTimeout(() => {
                        loadingSystem.style.display = 'none';
                    }, 800);
                }, 500);
            } else {
                loadProgress += 2;
                loadingBar.style.width = loadProgress + '%';
            }
        }, 40);

        // Create advanced particles
        createAdvancedParticles();

        // Create cursor follower
        createCursorFollower();

        // Spinner fade out
        setTimeout(() => {
            const spinner = document.getElementById('spinner');
            if (spinner) {
                spinner.style.opacity = '0';
                spinner.style.visibility = 'hidden';
                setTimeout(() => spinner.remove(), 800);
            }
        }, 2000);

        // Back to top button
        const backToTop = document.querySelector('.back-to-top');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 400) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Enhanced navbar scroll effect
        const navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Advanced parallax effect
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.hero-header, .page-header');
            parallaxElements.forEach(element => {
                if (element) {
                    const speed = scrolled * 0.4;
                    element.style.backgroundPosition = `center ${speed}px`;
                }
            });
        });

        // Create advanced floating elements in hero
        createAdvancedFloatingElements();

        // Advanced hover effects for cards
        document.querySelectorAll('.featurs-item, .fruite-item').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.zIndex = '20';
                this.classList.add('hover-lift');
            });

            card.addEventListener('mouseleave', function() {
                this.style.zIndex = '1';
                this.classList.remove('hover-lift');
            });
        });

        // Advanced ripple effect to buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height) * 2;
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple-effect');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 1000);
            });
        });

        // Text animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.featurs-item, .fruite-item, .section-title').forEach(el => {
            observer.observe(el);
        });
    });

    function createAdvancedParticles() {
        const particleSystem = document.getElementById('particleSystem');
        const particleCount = 50;
        if(particleSystem){
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                const size = Math.random() * 20 + 5;
                const posX = Math.random() * 100;
                const delay = Math.random() * 20;
                const duration = Math.random() * 15 + 20;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}%`;
                particle.style.animationDelay = `${delay}s`;
                particle.style.animationDuration = `${duration}s`;
                particle.style.opacity = Math.random() * 0.3 + 0.1;
                particleSystem.appendChild(particle);
            }
        }
    }

    function createCursorFollower() {
        const cursor = document.getElementById('cursorFollower');
        if(!cursor) return;
        let mouseX = 0, mouseY = 0;
        let cursorX = 0, cursorY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        function animateCursor() {
            cursorX += (mouseX - cursorX) * 0.1;
            cursorY += (mouseY - cursorY) * 0.1;

            cursor.style.left = cursorX + 'px';
            cursor.style.top = cursorY + 'px';

            requestAnimationFrame(animateCursor);
        }

        animateCursor();
    }

    function createAdvancedFloatingElements() {
        const hero = document.querySelector('.hero-header');
        if (!hero) return;

        const floatingSystem = document.createElement('div');
        floatingSystem.classList.add('floating-system');

        for (let i = 0; i < 12; i++) {
            const element = document.createElement('div');
            element.classList.add('floating-element');
            const size = Math.random() * 80 + 30;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const delay = Math.random() * 15;
            const duration = Math.random() * 15 + 20;
            element.style.width = `${size}px`;
            element.style.height = `${size}px`;
            element.style.left = `${posX}%`;
            element.style.top = `${posY}%`;
            element.style.animationDelay = `${delay}s`;
            element.style.animationDuration = `${duration}s`;
            element.style.opacity = Math.random() * 0.2 + 0.1;
            floatingSystem.appendChild(element);
        }

        hero.appendChild(floatingSystem);
    }

    // Advanced ripple effect style
    const advancedStyle = document.createElement('style');
    advancedStyle.textContent = `
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, transparent 70%);
            transform: scale(0);
            animation: advancedRipple 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            pointer-events: none;
        }

        @keyframes advancedRipple {
            0% { transform: scale(0); opacity: 1; }
            50% { transform: scale(1); opacity: 0.5; }
            100% { transform: scale(2); opacity: 0; }
        }

        ::selection {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            text-shadow: none;
        }

        .btn:focus,
        .form-control:focus,
        .nav-link:focus {
            box-shadow: 0 0 0 3px rgba(246, 179, 92, 0.3) !important;
            border-color: var(--primary) !important;
        }

        @media print {
            .navbar, .footer, .whatsapp-float, .back-to-top { display: none !important; }
        }
    `;
    document.head.appendChild(advancedStyle);
</script>