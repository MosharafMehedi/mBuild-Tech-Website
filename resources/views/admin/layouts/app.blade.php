<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') – mBuild Tech</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand:       '#ab5e40',
                        'brand-dark':'#8a4a30',
                        'brand-light':'#f5ede8',
                        dark:        '#3f3b3a',
                        'dark-2':    '#2a2726',
                        'dark-3':    '#1e1c1b',
                        muted:       '#6b6563',
                        light:       '#f9f9f9',
                        sidebar:     '#1e1c1b',
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
        h1,h2,h3,h4,h5,h6,.font-heading { font-family: 'Montserrat', sans-serif; }

        /* Sidebar */
        #admin-sidebar { transition: transform 0.3s ease; }
        #sidebar-overlay { transition: opacity 0.3s ease; }

        /* Nav items */
        .nav-item { transition: all 0.2s ease; }
        .nav-item.active, .nav-item:hover { background: rgba(171,94,64,0.15); color: #ab5e40; }
        .nav-item.active { border-left: 3px solid #ab5e40; }
        .nav-item:not(.active) { border-left: 3px solid transparent; }

        /* Submenu */
        .submenu { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; }
        .submenu.open { max-height: 200px; }
        .submenu-arrow { transition: transform 0.3s ease; }
        .submenu-arrow.open { transform: rotate(90deg); }

        /* Card hover */
        .stat-card { transition: all 0.25s ease; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(0,0,0,0.08); }

        /* Table row hover */
        tbody tr { transition: background 0.15s ease; }
        tbody tr:hover { background: #fdf8f6; }

        /* Badge */
        .badge-ongoing   { background: #fef3c7; color: #92400e; }
        .badge-completed { background: #d1fae5; color: #065f46; }
        .badge-upcoming  { background: #dbeafe; color: #1e40af; }
        .badge-published { background: #d1fae5; color: #065f46; }
        .badge-draft     { background: #f3f4f6; color: #374151; }
        .badge-new       { background: #ede9fe; color: #5b21b6; }
        .badge-contacted { background: #fef3c7; color: #92400e; }
        .badge-closed    { background: #d1fae5; color: #065f46; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #ab5e40; border-radius: 10px; }

        /* Tooltip */
        [data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute; left: 110%; top: 50%; transform: translateY(-50%);
            background: #2a2726; color: white; font-size: 11px; padding: 4px 8px;
            border-radius: 6px; white-space: nowrap; z-index: 99; pointer-events: none;
        }
        [data-tooltip] { position: relative; }
    </style>

    @stack('styles')
</head>
<body class="bg-light text-dark font-body">

{{-- ===== SIDEBAR ===== --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 opacity-0 pointer-events-none lg:hidden" onclick="closeSidebar()"></div>

<aside id="admin-sidebar" class="fixed left-0 top-0 bottom-0 w-64 bg-sidebar z-40 flex flex-col -translate-x-full lg:translate-x-0 overflow-y-auto">

    {{-- Logo --}}
    <div class="px-5 py-5 border-b border-white/10 shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
            <div class="w-9 h-9 bg-brand rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M3 3h4v18H3V3zm7 0h4v18h-4V3zm7 6h4v12h-4V9z"/></svg>
            </div>
            <div>
                <p class="font-heading font-black text-white text-sm leading-none"><span class="text-brand">m</span>Build Tech</p>
                <p class="text-white/40 text-xs mt-0.5">Admin Panel</p>
            </div>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'active text-brand' : '' }}">
            <svg class="w-4.5 h-4.5 w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>

        <div class="pt-3 pb-1 px-3">
            <p class="text-white/25 text-xs uppercase tracking-widest font-heading font-semibold">Content</p>
        </div>

        {{-- Projects --}}
        <div>
            <button onclick="toggleSubmenu('projects-sub')" class="nav-item w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.projects*') ? 'active text-brand' : '' }}">
                <span class="flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>
                    Projects
                </span>
                <svg class="submenu-arrow w-4 h-4 {{ request()->routeIs('admin.projects*') ? 'open' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
            <div class="submenu pl-8 space-y-1 {{ request()->routeIs('admin.projects*') ? 'open' : '' }}" id="projects-sub">
                <a href="{{ route('admin.projects.index') }}" class="block text-white/50 hover:text-brand text-sm py-1.5 px-2 rounded-lg hover:bg-brand/10 transition-colors {{ request()->routeIs('admin.projects.index') ? 'text-brand' : '' }}">All Projects</a>
            </div>
        </div>

        {{-- Blog --}}
        <div>
            <button onclick="toggleSubmenu('blog-sub')" class="nav-item w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.blog*') ? 'active text-brand' : '' }}">
                <span class="flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Blog Posts
                </span>
                <svg class="submenu-arrow w-4 h-4 {{ request()->routeIs('admin.blogs*') ? 'open' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
            <div class="submenu pl-8 space-y-1 {{ request()->routeIs('admin.blogs*') ? 'open' : '' }}" id="blog-sub">
                <a href="{{ route('admin.blogs.index') }}" class="block text-white/50 hover:text-brand text-sm py-1.5 px-2 rounded-lg hover:bg-brand/10 transition-colors">All Posts</a>
            </div>
        </div>

        {{-- Leads --}}
        {{-- <a href="{{ route('admin.leads.index') }}" class="nav-item flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.leads*') ? 'active text-brand' : '' }}">
            <span class="flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                Leads / Inquiries
            </span>
            <span class="bg-brand text-white text-xs font-bold px-2 py-0.5 rounded-full">12</span>
        </a> --}}

        {{-- FAQs --}}
        <a href="{{ route('admin.faqs.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.faqs*') ? 'active text-brand' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            FAQs
        </a>
        <a href="{{ route('admin.metrics.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.metrics*') ? 'active text-brand' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 ２v14a２ ２ ０ ０１－２ ２h－２a２ ２ ０ ０１－２－２z"/></svg>
            Metrics
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.contacts*') ? 'active text-brand' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Contacts
        </a>

         {{-- Testimonials --}}
        <a href="{{ route('admin.testimonials.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.testimonials*') ? 'active text-brand' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            Testimonials
        </a>

        {{-- Settings --}}
        {{-- <a href="{{ route('admin.settings') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.settings') ? 'active text-brand' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Site Settings
        </a> --}}

        {{-- View Website --}}
        {{-- <a href="{{ route('home') }}" target="_blank" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 text-sm font-medium">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            View Website
        </a> --}}
    </nav>

    {{-- Logout --}}
    <div class="px-3 py-4 border-t border-white/10 shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/50 hover:text-red-400 hover:bg-red-500/10 text-sm font-medium transition-all">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Logout
            </button>
        </form>
    </div>
</aside>


{{-- ===== MAIN CONTENT AREA ===== --}}
<div class="lg:pl-64 min-h-screen flex flex-col">

    {{-- Topbar --}}
    <header class="sticky top-0 z-20 bg-white border-b border-gray-200 shadow-sm">
        <div class="flex items-center justify-between px-4 sm:px-6 h-14">

            <div class="flex items-center gap-4">
                {{-- Hamburger (mobile) --}}
                <button onclick="openSidebar()" class="lg:hidden text-muted hover:text-dark p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                {{-- Page title / breadcrumb --}}
                <div>
                    <h1 class="font-heading font-bold text-dark text-base md:text-lg">@yield('page-title', 'Dashboard')</h1>
                    @hasSection('breadcrumb')
                    <p class="text-muted text-xs hidden sm:block">@yield('breadcrumb')</p>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3">

                {{-- Notifications --}}
                <button class="relative p-2 text-muted hover:text-dark rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-brand rounded-full"></span>
                </button>

                {{-- User dropdown --}}
                <div class="relative" id="user-dropdown-wrap">
                    <button onclick="toggleUserMenu()" class="flex items-center gap-2 p-1.5 rounded-xl hover:bg-gray-100 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-brand/20 flex items-center justify-center">
                            <span class="font-heading font-black text-brand text-sm">A</span>
                        </div>
                        <svg class="w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="user-dropdown" class="hidden absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-dark text-sm font-semibold">Admin User</p>
                            <p class="text-muted text-xs">admin@mbuildtech.com</p>
                        </div>
                        {{-- <a href="{{ route('admin.settings') }}" class="block px-4 py-2.5 text-sm text-dark hover:text-brand hover:bg-brand-light transition-colors">Profile Settings</a> --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="mx-4 sm:mx-6 mt-4 bg-green-50 border border-green-200 text-green-800 text-sm rounded-xl px-4 py-3 flex items-center gap-2" id="flash-success">
        <svg class="w-4 h-4 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
        <button onclick="this.parentElement.remove()" class="ml-auto text-green-600 hover:text-green-800">×</button>
    </div>
    @endif
    @if(session('error'))
    <div class="mx-4 sm:mx-6 mt-4 bg-red-50 border border-red-200 text-red-800 text-sm rounded-xl px-4 py-3 flex items-center gap-2">
        <svg class="w-4 h-4 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('error') }}
        <button onclick="this.parentElement.remove()" class="ml-auto text-red-600 hover:text-red-800">×</button>
    </div>
    @endif

    {{-- Page Content --}}
    <main class="flex-1 p-4 sm:p-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="px-6 py-3 border-t border-gray-200 bg-white">
        <p class="text-muted text-xs text-center">© {{ date('Y') }} mBuild Tech Admin Panel · Developed by <span class="text-brand font-semibold">Mysoft Heaven (BD) Ltd.</span></p>
    </footer>
</div>

<script>
function openSidebar() {
    document.getElementById('admin-sidebar').classList.remove('-translate-x-full');
    const ov = document.getElementById('sidebar-overlay');
    ov.classList.remove('opacity-0','pointer-events-none');
    ov.classList.add('opacity-100');
}
function closeSidebar() {
    document.getElementById('admin-sidebar').classList.add('-translate-x-full');
    const ov = document.getElementById('sidebar-overlay');
    ov.classList.add('opacity-0','pointer-events-none');
    ov.classList.remove('opacity-100');
}
function toggleSubmenu(id) {
    const el = document.getElementById(id);
    const btn = el.previousElementSibling;
    const arrow = btn.querySelector('.submenu-arrow');
    el.classList.toggle('open');
    arrow.classList.toggle('open');
}
function toggleUserMenu() {
    document.getElementById('user-dropdown').classList.toggle('hidden');
}
document.addEventListener('click', function(e) {
    const wrap = document.getElementById('user-dropdown-wrap');
    if (wrap && !wrap.contains(e.target)) {
        document.getElementById('user-dropdown').classList.add('hidden');
    }
});
setTimeout(() => { const f = document.getElementById('flash-success'); if(f) f.remove(); }, 4000);
</script>

@stack('scripts')
</body>
</html>