// ============================================================
// mBuild Tech – app.js  (Complete updated & fixed version)
// ============================================================

document.addEventListener('DOMContentLoaded', function () {

    // ----- Scroll fade-in -----
    const faders = document.querySelectorAll('.fade-in');
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); fadeObserver.unobserve(e.target); }
        });
    }, { threshold: 0.12 });
    faders.forEach(el => fadeObserver.observe(el));


    // ----- Stat Counter Animation -----
    const statEls = document.querySelectorAll('.stat-number');
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (!e.isIntersecting) return;
            const el = e.target;
            const raw = el.dataset.value;
            const suffix = el.dataset.suffix || '';
            const target = parseFloat(raw);
            const isFloat = raw.includes('.');
            let start = null;
            const duration = 1800;

            const step = (ts) => {
                if (!start) start = ts;
                const progress = Math.min((ts - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
                const current = eased * target;
                el.textContent = (isFloat ? current.toFixed(1) : Math.floor(current)) + suffix;
                if (progress < 1) requestAnimationFrame(step);
                else el.textContent = raw + suffix;
            };
            requestAnimationFrame(step);
            statObserver.unobserve(el);
        });
    }, { threshold: 0.5 });
    statEls.forEach(el => statObserver.observe(el));


    // ----- Homepage Projects Tab Filter -----
    const projectTabs = document.querySelectorAll('.project-tab');
    const projectCards = document.querySelectorAll('#projects-grid .project-card');

    projectTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Update tab styles
            projectTabs.forEach(t => {
                t.classList.remove('bg-brand', 'text-white', 'shadow-sm');
                t.classList.add('text-muted', 'border', 'border-gray-200');
            });
            tab.classList.add('bg-brand', 'text-white', 'shadow-sm');
            tab.classList.remove('text-muted', 'border', 'border-gray-200');

            const filter = tab.dataset.filter;
            projectCards.forEach(card => {
                const match = filter === 'all' || card.dataset.status === filter;
                card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                if (match) {
                    card.style.display = '';
                    setTimeout(() => { card.style.opacity = '1'; card.style.transform = 'translateY(0)'; }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(10px)';
                    setTimeout(() => { card.style.display = 'none'; }, 300);
                }
            });
        });
    });


    // ----- Testimonial Carousel -----
    const track = document.getElementById('testimonial-track');
    const dots = document.querySelectorAll('.dot');
    let slides = document.querySelectorAll('.testimonial-slide');
    let current = 0;
    const totalOriginalSlides = slides.length;

    if (track && totalOriginalSlides > 0) {
        const isMobile = window.innerWidth < 768;
        const clonesCount = isMobile ? 1 : 3; 

        for (let i = 0; i < clonesCount; i++) {
            const cloneFirst = slides[i].cloneNode(true);
            track.appendChild(cloneFirst);
        }

        for (let i = 0; i < clonesCount; i++) {
            const cloneLast = slides[totalOriginalSlides - 1 - i].cloneNode(true);
            track.insertBefore(cloneLast, track.firstChild);
        }

        slides = document.querySelectorAll('.testimonial-slide');
        
        current = clonesCount;
        updateSlider(false);

        function updateSlider(animate = true) {
            const isMobile = window.innerWidth < 768;
            const slideWidth = isMobile ? 100 : 33.333;
            const offset = current * slideWidth;

            if (animate) {
                track.style.transition = "transform 0.5s ease-in-out"; // FIXED: 500s থেকে বদলে 0.5s করা হয়েছে
            } else {
                track.style.transition = "none"; 
            }

            track.style.transform = `translateX(-${offset}%)`;

            let dotIndex = (current - clonesCount) % totalOriginalSlides;
            if (dotIndex < 0) dotIndex += totalOriginalSlides;
            
            dots.forEach((d, i) => d.classList.toggle('active', i === dotIndex));
        }

        function goTo(n) {
            current = n;
            updateSlider(true);

            track.addEventListener('transitionend', function loopEnd() {
                const isMobile = window.innerWidth < 768;
                const clonesCount = isMobile ? 1 : 3;

                if (current >= totalOriginalSlides + clonesCount) {
                    track.style.transition = "none";
                    current = clonesCount;
                    track.style.transform = `translateX(-${current * (isMobile ? 100 : 33.333)}%)`;
                }
                if (current < clonesCount) {
                    track.style.transition = "none";
                    current = totalOriginalSlides + clonesCount - 1; 
                    track.style.transform = `translateX(-${current * (isMobile ? 100 : 33.333)}%)`;
                }
                track.removeEventListener('transitionend', loopEnd);
            });
        }

        document.getElementById('t-next')?.addEventListener('click', () => goTo(current + 1));
        document.getElementById('t-prev')?.addEventListener('click', () => goTo(current - 1));

        dots.forEach((d, i) => {
            d.addEventListener('click', () => {
                const isMobile = window.innerWidth < 768;
                const clonesCount = isMobile ? 1 : 3;
                goTo(i + clonesCount);
            });
        });

        window.addEventListener('resize', () => {
            const isMobile = window.innerWidth < 768;
            const newClonesCount = isMobile ? 1 : 3;
            current = newClonesCount;
            updateSlider(false);
        });

        // Touch swipe support
        let startX = 0;
        track.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
        track.addEventListener('touchend', e => {
            const diff = startX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) goTo(diff > 0 ? current + 1 : current - 1);
        });


        let autoplay = setInterval(() => goTo(current + 1), 5500);
        track.parentElement?.addEventListener('mouseenter', () => clearInterval(autoplay));
        track.parentElement?.addEventListener('mouseleave', () => { autoplay = setInterval(() => goTo(current + 1), 5500); });
    }

});


// ----- FAQ Accordion (global) -----
function toggleFaq(index) {
    const answer = document.getElementById('faq-' + index);
    const icon = answer?.previousElementSibling?.querySelector('.faq-icon');
    const isOpen = answer?.classList.contains('open');

    document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
    document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotated'));

    if (!isOpen && answer) {
        answer.classList.add('open');
        icon?.classList.add('rotated');
    }
}