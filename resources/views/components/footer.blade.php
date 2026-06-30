{{-- Footer per instruction document --}}
<footer class="bg-dark-2 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Column 1: Brand --}}
            <div>
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-5">
                <img class="w-8 h-8 object-contain" src="{{ asset('images/favicon.png') }}" alt="Brand Logo">
                    <span class="font-heading font-black text-xl"><span class="text-brand">m</span>Build Tech</span>
                </a>
                <p class="text-white/55 text-sm leading-relaxed mb-6">A premium construction and real estate engineering company delivering world-class structures across Bangladesh.</p>
                <div class="flex gap-3">
                    <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-brand flex items-center justify-center transition-colors" aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.5 0-1.96.93-1.96 1.89v2.26h3.32l-.53 3.5h-2.8V24C19.62 23.1 24 18.1 24 12.07z"/></svg>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-brand flex items-center justify-center transition-colors" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-brand flex items-center justify-center transition-colors" aria-label="LinkedIn">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-brand flex items-center justify-center transition-colors" aria-label="YouTube">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Column 2: Quick Links --}}
            <div>
                <h4 class="font-heading font-bold text-sm mb-5 text-white uppercase tracking-wider">Quick Links</h4>
                <ul class="space-y-3">
                    @foreach([
                        ['About Us',            route('about')],
                        ['Ongoing Projects',    route('projects.index').'?status=ongoing'],
                        ['Completed Projects',  route('projects.index').'?status=completed'],
                        ['Career',              '#'],
                        ['Privacy Policy',      '#'],
                    ] as [$label, $href])
                    <li><a href="{{ $href }}" class="text-white/55 hover:text-brand text-sm transition-colors">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Column 3: Locations We Build --}}
            <div>
                <h4 class="font-heading font-bold text-sm mb-5 text-white uppercase tracking-wider">Locations We Build</h4>
                <ul class="space-y-3">
                    @foreach(['Uttara','Dhanmondi','Gulshan','Mirpur','Bashundhara','Mohammadpur'] as $loc)
                    <li>
                        <a href="{{ route('projects.index') }}?location={{ strtolower($loc) }}" class="flex items-center gap-2 text-white/55 hover:text-brand text-sm transition-colors">
                            <svg class="w-3.5 h-3.5 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $loc }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Column 4: Newsletter + Contact --}}
            <div>
                <h4 class="font-heading font-bold text-sm mb-5 text-white uppercase tracking-wider">Stay Updated</h4>
                <p class="text-white/55 text-sm mb-4 leading-relaxed">Subscribe for upcoming project launches and real estate insights.</p>
                <form class="flex gap-2 mb-7" onsubmit="return false;">
                    <input type="email" placeholder="Your email address" class="flex-1 bg-white/10 border border-white/20 rounded-lg px-3 py-2.5 text-white placeholder-white/40 text-sm focus:outline-none focus:border-brand"/>
                    <button class="bg-brand hover:bg-brand-dark text-white font-heading font-semibold text-sm px-4 py-2.5 rounded-lg transition-colors shrink-0">Subscribe</button>
                </form>
                <div class="space-y-3">
                    <a href="tel:+8801711123456" class="flex items-center gap-2.5 text-white/55 hover:text-brand text-sm transition-colors">
                        <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        +880 1711-123456
                    </a>
                    <a href="mailto:info@mbuildtech.com.bd" class="flex items-center gap-2.5 text-white/55 hover:text-brand text-sm transition-colors">
                        <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        info@mbuildtech.com.bd
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-white/35 text-xs">© {{ date('Y') }} mBuild Tech. All Rights Reserved. Developed by <span class="text-white/50">Mysoft Heaven (BD) Ltd.</span></p>
            <div class="flex gap-5">
                <a href="#" class="text-white/35 hover:text-brand text-xs transition-colors">Privacy Policy</a>
                <a href="#" class="text-white/35 hover:text-brand text-xs transition-colors">Terms of Service</a>
                <a href="#" class="text-white/35 hover:text-brand text-xs transition-colors">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
