{{-- Navbar: Solid White → Light Gray on scroll --}}
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center shrink-0">
                <img class="h-16 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="mBuild Tech Logo">
            </a>

            {{-- Desktop nav --}}
            <div class="hidden md:flex items-center gap-7">
                <a href="{{ route('home') }}"
                    class="text-gray-800 hover:text-brand font-bold text-md transition-colors">Home</a>

                {{-- About Us dropdown --}}
                <div class="relative group">
                    <button
                        class="flex items-center gap-1 text-gray-800 hover:text-brand font-bold text-md transition-colors py-2">
                        About Us
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-0 mt-1 w-52 bg-white rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible py-2 border border-gray-100">
                        <a href="{{ route('about') }}"
                            class="block px-5 py-2.5 text-sm text-gray-700 hover:text-brand hover:bg-gray-50 font-semibold transition-colors">Company Profile</a>
                        <a href="{{ route('about') }}#leadership"
                            class="block px-5 py-2.5 text-sm text-gray-700 hover:text-brand hover:bg-gray-50 font-semibold transition-colors">Board of Directors</a>
                        <a href="{{ route('about') }}#quality"
                            class="block px-5 py-2.5 text-sm text-gray-700 hover:text-brand hover:bg-gray-50 font-semibold transition-colors">Quality Policy</a>
                    </div>
                </div>

                {{-- Projects dropdown --}}
                <div class="relative group">
                    <button
                        class="flex items-center gap-1 text-gray-800 hover:text-brand font-bold text-md transition-colors py-2">
                        Projects
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-0 mt-1 w-48 bg-white rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible py-2 border border-gray-100">
                        <a href="{{ route('projects.index') }}?status=ongoing"
                            class="block px-5 py-2.5 text-sm text-gray-700 hover:text-brand hover:bg-gray-50 font-semibold transition-colors">Ongoing</a>
                        <a href="{{ route('projects.index') }}?status=completed"
                            class="block px-5 py-2.5 text-sm text-gray-700 hover:text-brand hover:bg-gray-50 font-semibold transition-colors">Completed</a>
                        <a href="{{ route('projects.index') }}?status=upcoming"
                            class="block px-5 py-2.5 text-sm text-gray-700 hover:text-brand hover:bg-gray-50 font-semibold transition-colors">Upcoming</a>
                    </div>
                </div>

                <a href="{{ route('blog.index') }}"
                    class="text-gray-800 hover:text-brand font-bold text-md transition-colors">Blog</a>
                <a href="{{ route('contact') }}"
                    class="text-gray-800 hover:text-brand font-bold text-md
                     transition-colors">Contact Us</a>
            </div>

            {{-- CTA --}}
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('contact') }}"
                    class="bg-brand hover:bg-brand-dark text-white font-heading font-bold text-sm px-5 py-2.5 rounded-lg transition-colors">
                    Request a Quote
                </a>
            </div>

            {{-- Hamburger Button --}}
            <button id="menu-btn" class="md:hidden text-gray-800 p-2 focus:outline-none" onclick="toggleMenu()">
                <svg id="icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-100 shadow-lg" style="max-height: 0; overflow: hidden; transition: max-height 0.4s ease;">
        <div class="px-4 py-4 space-y-1">
            <a href="{{ route('home') }}"
                class="block text-gray-800 hover:text-brand font-bold py-2.5 px-3 rounded-lg hover:bg-gray-50 transition-colors text-sm">Home</a>
            <a href="{{ route('about') }}"
                class="block text-gray-800 hover:text-brand font-bold py-2.5 px-3 rounded-lg hover:bg-gray-50 transition-colors text-sm">About Us</a>
            <a href="{{ route('projects.index') }}"
                class="block text-gray-800 hover:text-brand font-bold py-2.5 px-3 rounded-lg hover:bg-gray-50 transition-colors text-sm">Projects</a>
            <a href="{{ route('blog.index') }}"
                class="block text-gray-800 hover:text-brand font-bold py-2.5 px-3 rounded-lg hover:bg-gray-50 transition-colors text-sm">Blog</a>
            <a href="{{ route('contact') }}"
                class="block text-gray-800 hover:text-brand font-bold py-2.5 px-3 rounded-lg hover:bg-gray-50 transition-colors text-sm">Contact Us</a>
            <a href="{{ route('contact') }}"
                class="block bg-brand text-white font-heading font-bold px-3 py-3 rounded-lg text-center mt-3 text-sm shadow-md">Request a Quote</a>
        </div>
    </div>
</nav>

<script>
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        const openIcon = document.getElementById('icon-open');
        const closeIcon = document.getElementById('icon-close');
        
        if (menu.style.maxHeight === '0px' || menu.style.maxHeight === '') {
            menu.style.maxHeight = '400px';
            openIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
        } else {
            menu.style.maxHeight = '0px';
            openIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    }

    // Scroll effect for background color change
    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 60) {
            navbar.classList.remove('bg-white');
            navbar.classList.add('bg-gray-100');
        } else {
            navbar.classList.remove('bg-gray-100');
            navbar.classList.add('bg-white');
        }
    });
</script>