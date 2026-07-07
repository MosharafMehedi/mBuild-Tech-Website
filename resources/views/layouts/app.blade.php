<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'mBuild Tech – Engineering Trust, Building Legacies')</title>
    <meta name="description" content="@yield('meta_desc', 'mBuild Tech delivers world-class structural engineering, commercial hubs, and premium residential spaces across Bangladesh.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('images/fav.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand:       '#ab5e40',
                        'brand-dark':'#8a4a30',
                        dark:        '#3f3b3a',
                        'dark-2':    '#2a2726',
                        muted:       '#6b6563',
                        light:       '#f9f9f9',
                    },
                    fontFamily: {
                        heading: ['Montserrat', 'sans-serif'],
                        body:    ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Inter', sans-serif; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Montserrat', sans-serif; }

        html { scroll-behavior: smooth; }

        /* Hero video overlay */
        .hero-overlay { background: linear-gradient(to right, rgba(42,39,38,0.88) 50%, rgba(42,39,38,0.35) 100%); }

        /* Navbar */
        .nav-scrolled { background: rgba(42,39,38,0.97) !important; box-shadow: 0 2px 24px rgba(0,0,0,0.35); }
        #navbar { transition: background 0.35s ease, box-shadow 0.35s ease; }

        /* Mobile menu */
        #mobile-menu { max-height: 0; overflow: hidden; transition: max-height 0.4s ease; }
        #mobile-menu.open { max-height: 600px; }

        /* Fade-in on scroll */
        .fade-in { opacity: 0; transform: translateY(28px); transition: opacity 0.65s ease, transform 0.65s ease; }
        .fade-in.visible { opacity: 1; transform: translateY(0); }

        /* Project card */
        .project-card:hover .project-img { transform: scale(1.07); }
        .project-img { transition: transform 0.5s ease; }

        /* Service card */
        .service-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .service-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(171,94,64,0.14); }

        /* Partner logos */
        .partner-logo { filter: grayscale(100%) opacity(0.45); transition: filter 0.35s; }
        .partner-logo:hover { filter: grayscale(0%) opacity(1); }

        /* FAQ */
        .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s ease; }
        .faq-answer.open { max-height: 350px; }
        .faq-icon { transition: transform 0.3s ease; }
        .faq-icon.rotated { transform: rotate(45deg); }

        /* Testimonial dot */
        .dot.active { background: #ab5e40; }

        /* Infinite partner marquee */
        @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        .marquee-track { display: flex; animation: marquee 22s linear infinite; width: max-content; }
        .marquee-track:hover { animation-play-state: paused; }

        /* Hero text animation */
        @keyframes fadeInUp { from { opacity:0; transform:translateY(24px); } to { opacity:1; transform:translateY(0); } }
        .anim-1 { animation: fadeInUp 0.7s ease 0.1s both; }
        .anim-2 { animation: fadeInUp 0.7s ease 0.3s both; }
        .anim-3 { animation: fadeInUp 0.7s ease 0.5s both; }
        .anim-4 { animation: fadeInUp 0.7s ease 0.7s both; }

        /* Dropdown */
        .dropdown-menu { transition: opacity 0.2s ease, visibility 0.2s ease; }
    </style>

    @stack('styles')
</head>
<body class="bg-white text-dark">

    @include('components.navbar')

    @yield('content')

    @include('components.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    {{-- @vite('resources/js/app.js') --}}
    @stack('scripts')
</body>
</html>
