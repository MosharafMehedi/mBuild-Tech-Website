@extends('layouts.app')

@section('title', 'mBuild Tech – Engineering Trust, Building Legacies')

@section('content')

{{-- ===== 1. HERO BANNER ===== --}}
<section class="relative min-h-screen flex items-center overflow-visible">
    {{-- Background video / fallback image --}}
    <div class="absolute inset-0 z-0">
        <video autoplay muted loop playsinline class="w-full h-full object-cover hidden md:block" poster="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1600&q=80">
            Replace with actual video: <source src="{{ asset('videos/test.mp4') }}" type="video/mp4">
        </video>
        {{-- Fallback image (also shows on mobile) --}}
        <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1600&q=80" alt="mBuild Tech construction site" class="w-full h-full object-cover md:hidden absolute inset-0"/>
        {{-- dark overlay fallback for when video loads --}}
        <div class="absolute inset-0 bg-dark-2/70 md:hidden"></div>
        <div class="hero-overlay absolute inset-0 hidden md:block"></div>
    </div>

    <div class="relative z-10 w-full pl-4 md:pl-12 lg:pl-20 pt-24 pb-48 md:pb-56">
        <div class="max-w-3xl">
            <h1 class="md:pt-8 font-heading font-black text-[32px] md:text-6xl lg:text-7xl text-white leading-[1.15] md:leading-[1.08] mb-5 anim-2">
                Engineering Trust,<br class="md:hidden">
                <span class="text-brand whitespace-nowrap">Building Legacies.</span>
            </h1>
            
            <p class="text-white/75 text-base md:text-lg leading-relaxed mb-8 max-w-[350px] sm:max-w-md md:max-w-xl anim-3">
                mBuild Tech delivers world-class structural engineering, commercial hubs, and premium residential spaces across Bangladesh.
            </p>
            
            <div class="flex flex-nowrap items-center gap-2 sm:gap-4 anim-4">
                <a href="{{ route('projects.index') }}" class="bg-brand hover:bg-brand-dark text-white font-heading font-semibold px-4 py-3 md:px-7 md:py-3.5 rounded-lg transition-all hover:scale-105 text-xs sm:text-sm md:text-base whitespace-nowrap">
                    Explore Our Projects
                </a>
                <a href="#video" class="flex items-center gap-1.5 bg-white/15 hover:bg-white/25 backdrop-blur-sm text-white font-heading font-semibold px-4 py-3 md:px-7 md:py-3.5 rounded-lg border border-white/25 transition-all text-xs sm:text-sm md:text-base whitespace-nowrap">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    Corporate Video
                </a>
            </div>
        </div>
    </div>

    {{-- ===== 2. SMART SEARCH (overlapping Hero bottom) ===== --}}
    <div class="absolute bottom-0 left-0 right-0 z-10 translate-y-1/2 px-4 sm:px-6">
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-2xl p-4 md:p-5">
        <p class="font-heading font-bold text-dark text-xs uppercase tracking-widest mb-3 text-center">Find a Property / Project</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
            <div>
                <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Project Status</label>
                <select id="search-status" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 bg-white">
                    <option value="">All Status</option>
                    <option value="completed">Completed</option>
                    <option value="ongoing" selected>Ongoing</option>
                    <option value="upcoming">Upcoming</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Project Type</label>
                <select id="search-type" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 bg-white">
                    <option value="">All Types</option>
                    <option value="commercial">Commercial</option>
                    <option value="industrial">Industrial</option>
                    <option value="residential" selected>Residential</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Location / Area</label>
                <select id="search-location" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 bg-white">
                    <option value="">All Areas</option>
                    <option value="uttara">Uttara</option>
                    <option value="mirpur">Mirpur</option>
                    <option value="bashundhara">Bashundhara</option>
                    <option value="mohammadpur">Mohammadpur</option>
                    <option value="dhanmondi">Dhanmondi</option>
                </select>
            </div>
            <div class="flex items-end">
                <button id="search-btn" type="button" class="w-full bg-brand hover:bg-brand-dark text-white font-heading font-semibold px-4 py-2.5 rounded-lg transition-colors text-sm">
                    Search Properties/Projects
                </button>
            </div>
        </div>
    </div>
</div>
</section>


{{-- ===== 3. AT A GLANCE – COUNTER STATS ===== --}}
<section class="bg-light pt-36 md:pt-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 fade-in mt-12 md:mt-0">
            <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-2">Enterprise Value Proposition</p>
            <h2 class="font-heading font-black text-3xl md:text-4xl text-dark">At a Glance</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5 fade-in">
            @php
            $stats = [
                ['value'=>'15',  'suffix'=>'+', 'label'=>'Years of Excellence',                    'icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['value'=>'4.2', 'suffix'=>'M+','label'=>'Sq. Ft. Delivered',                     'icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5'],
                ['value'=>'21',  'suffix'=>'+', 'label'=>'Active Construction Sites',              'icon'=>'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7'],
                ['value'=>'100', 'suffix'=>'%', 'label'=>'Structural Integrity & RAJUK Compliance','icon'=>'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
            ];
            @endphp
            @foreach($stats as $s)
            <div class="bg-white rounded-2xl p-6 text-center border border-gray-100 hover:border-brand/30 hover:shadow-lg transition-all">
                <div class="w-12 h-12 bg-brand/10 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"/>
                    </svg>
                </div>
                <div class="font-heading font-black text-3xl md:text-4xl text-brand mb-1">
                    <span class="stat-number" data-value="{{ $s['value'] }}" data-suffix="{{ $s['suffix'] }}">{{ $s['value'] }}{{ $s['suffix'] }}</span>
                </div>
                <p class="text-muted text-sm font-medium leading-snug">{{ $s['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ===== 4. PROJECTS GRID – INTERACTIVE TABS ===== --}}
<section id="projects" class="py-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10">
            <div class="fade-in">
                <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-2">Our Portfolio</p>
                <h2 class="font-heading font-black text-3xl md:text-4xl text-dark">Explore Projects</h2>
            </div>
            <div class="flex gap-2 mt-5 md:mt-0 fade-in">
                @foreach(['Completed','Ongoing','Upcoming'] as $tab)
                <button class="project-tab px-4 py-2 rounded-lg text-sm font-heading font-semibold transition-all
                    {{ $tab === 'Ongoing' ? 'bg-brand text-white shadow-sm' : 'text-muted border border-gray-200 hover:border-brand hover:text-dark' }}"
                    data-filter="{{ strtolower($tab) }}">{{ $tab }}</button>
                @endforeach
            </div>
        </div>

        <div id="projects-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 fade-in">
            @php
            $projects = [
                ['slug'=>'mbuild-tower-dhanmondi',  'name'=>'mBuild Tower Dhanmondi',  'type'=>'Residential', 'location'=>'Dhanmondi, Dhaka',  'status'=>'ongoing',   'img'=>'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=600&q=80'],
                ['slug'=>'terracotta-commercial-hub','name'=>'Terracotta Commercial Hub','type'=>'Commercial', 'location'=>'Gulshan, Dhaka',    'status'=>'ongoing',   'img'=>'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=600&q=80'],
                ['slug'=>'skyline-apartments-uttara','name'=>'Skyline Apartments Uttara','type'=>'Residential','location'=>'Uttara, Dhaka',     'status'=>'ongoing',   'img'=>'https://images.unsplash.com/photo-1567496898669-ee935f5f647a?w=600&q=80'],
                ['slug'=>'bashundhara-heights',      'name'=>'Bashundhara Heights',      'type'=>'Residential','location'=>'Bashundhara, Dhaka','status'=>'completed', 'img'=>'https://images.unsplash.com/photo-1560185007-cde436f6a4d0?w=600&q=80'],
                ['slug'=>'mirpur-tech-park',         'name'=>'Mirpur Tech Park',          'type'=>'Commercial', 'location'=>'Mirpur, Dhaka',    'status'=>'upcoming',  'img'=>'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=600&q=80'],
                ['slug'=>'mohammadpur-residency',    'name'=>'Mohammadpur Residency',     'type'=>'Residential','location'=>'Mohammadpur, Dhaka','status'=>'completed','img'=>'https://images.unsplash.com/photo-1487958449943-2429e8be8625?w=600&q=80'],
            ];
            @endphp

            @foreach($projects as $p)
            <div class="project-card group rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300" 
                 data-status="{{ strtolower($p['status']) }}"
                 data-type="{{ strtolower($p['type']) }}"
                 data-location="{{ strtolower($p['location']) }}">
                <div class="relative overflow-hidden h-52">
                    <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" class="project-img w-full h-full object-cover"/>
                    <span class="absolute top-3 left-3 bg-brand text-white text-xs font-heading font-semibold px-3 py-1 rounded-full capitalize">{{ $p['status'] }}</span>
                    <span class="absolute top-3 right-3 bg-dark-2/80 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded-full">{{ $p['type'] }}</span>
                </div>
                <div class="p-5">
                    <h3 class="font-heading font-bold text-dark text-base md:text-lg mb-1.5 leading-snug">{{ $p['name'] }}</h3>
                    <div class="flex items-center gap-1.5 text-muted text-sm mb-4">
                        <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $p['location'] }}
                    </div>
                    <a href="{{ route('projects.show', $p['slug']) }}" class="inline-flex items-center gap-1.5 text-brand hover:text-brand-dark font-heading font-semibold text-sm group/link">
                        View Details
                        <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
            @endforeach

            <div id="no-project-msg" class="hidden col-span-1 sm:col-span-2 lg:col-span-3 text-center py-12 px-4 bg-gray-50 rounded-2xl border border-dashed border-gray-200 mt-4">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h4 class="font-heading font-bold text-dark text-lg mb-1">No Projects Found</h4>
                <p class="text-muted text-sm max-w-sm mx-auto">We couldn't find any projects matching your selected criteria. Please try adjusting your filters.</p>
            </div>

        </div>

        <div class="text-center mt-10 fade-in">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 border-2 border-brand text-brand hover:bg-brand hover:text-white font-heading font-semibold px-8 py-3 rounded-lg transition-all">
                View All Projects
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>


{{-- ===== 5. CORE COMPETENCIES / SERVICES ===== --}}
<section class="bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 fade-in">
            <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-2">Our Expertise</p>
            <h2 class="font-heading font-black text-3xl md:text-4xl text-dark">Core Competencies / Services</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 fade-in">
            @php
            $services = [
                ['title'=>'Architectural & Engineering Design',       'desc'=>'Innovative proposals that blend aesthetics, functionality, and sustainability for every scale of project.',         'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['title'=>'Civil Construction & Infrastructure',      'desc'=>'Full-scale civil construction combining quality materials, certified engineers, and industry-best practices.',         'icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5'],
                ['title'=>'Real Estate Development',                  'desc'=>'End-to-end development — from land acquisition to handover — for residential and commercial properties.',            'icon'=>'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z'],
                ['title'=>'Project Management & Turnkey Solutions',   'desc'=>'Seamless coordination from design brief to ribbon-cutting, ensuring on-time and on-budget delivery every time.',     'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 8h.01M9 16h.01'],
            ];
            @endphp
            @foreach($services as $s)
            <div class="service-card bg-white rounded-2xl p-7 border border-gray-100 cursor-default">
                <div class="w-14 h-14 bg-brand/10 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $s['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-dark text-base md:text-lg mb-3 leading-snug">{{ $s['title'] }}</h3>
                <p class="text-muted text-sm leading-relaxed">{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ===== 6. FEATURED PROJECT SHOWCASE – 50:50 ===== --}}
<section class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 fade-in">
            <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-2">Spotlight</p>
            <h2 class="font-heading font-black text-3xl md:text-4xl text-dark">Featured Project Showcase</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center fade-in">
            {{-- Image gallery --}}
            <div class="grid grid-cols-2 gap-4">
                <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800&q=80" alt="mBuild Tower" class="rounded-2xl w-full h-52 object-cover col-span-2"/>
                <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=400&q=80" alt="" class="rounded-2xl w-full h-36 object-cover"/>
                <img src="https://images.unsplash.com/photo-1560185007-cde436f6a4d0?w=400&q=80" alt="" class="rounded-2xl w-full h-36 object-cover"/>
            </div>

            {{-- Project details --}}
            <div class="lg:pl-6">
                <span class="inline-block bg-brand/10 text-brand text-xs font-heading font-bold uppercase tracking-wider px-3 py-1.5 rounded-full mb-4">Current Mega Project</span>
                <h3 class="font-heading font-black text-3xl text-dark mb-3">mBuild Tower Dhanmondi</h3>
                <p class="text-muted leading-relaxed mb-6">A 28-storey landmark in Dhanmondi featuring premium commercial and residential floors, rooftop amenities, and a design that redefines Dhaka's urban skyline.</p>

                {{-- Specs grid --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-7">
                    @php
                    $specs = [
                        ['label'=>'Plot Size',   'val'=>'18 Katha'],
                        ['label'=>'Floors',      'val'=>'28 Stories'],
                        ['label'=>'Units',       'val'=>'112 Apts'],
                        ['label'=>'Handover',    'val'=>'Dec 2026'],
                    ];
                    @endphp
                    @foreach($specs as $sp)
                    <div class="bg-light rounded-xl p-3.5 text-center">
                        <div class="font-heading font-black text-brand text-lg leading-tight">{{ $sp['val'] }}</div>
                        <div class="text-muted text-xs mt-1">{{ $sp['label'] }}</div>
                    </div>
                    @endforeach
                </div>

                {{-- Amenities --}}
                <ul class="grid grid-cols-2 gap-2 text-sm text-dark mb-7">
                    @foreach(['Passenger & Cargo Lifts','100KVA Backup Generator','Rooftop Community Hall','Swimming Pool','24/7 CCTV Security','Basement Car Parking'] as $a)
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ $a }}
                    </li>
                    @endforeach
                </ul>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('projects.show', 'mbuild-tower-dhanmondi') }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-heading font-semibold px-6 py-3 rounded-lg transition-colors text-sm">
                        View Full Details
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="#" class="inline-flex items-center gap-2 border-2 border-brand text-brand hover:bg-brand hover:text-white font-heading font-semibold px-6 py-3 rounded-lg transition-all text-sm">
                        Download Brochure
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ===== 7A. PARTNER LOGOS – INFINITE MARQUEE ===== --}}
<section class="py-14 bg-light border-y border-gray-200 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <p class="text-center text-muted font-heading font-semibold text-xs uppercase tracking-widest">Our Clients & Partners</p>
    </div>
    <div class="overflow-hidden">
        <div class="marquee-track flex items-center">
            @php
            $partners = [
                'bsrm.png',
                'bashundhara.png',
                'gph.png',
                'kazi.png',
                'kfc.png',
                'ekhanei.png',
                'rangs.png',
                'ific.png',
                'eastern-housing.png',
                'bengal.png'
            ];
            @endphp
            
            @foreach(array_merge($partners, $partners) as $logo)
            <div class="partner-logo mx-6 shrink-0 w-20 h-20 flex items-center justify-center bg-white border border-gray-100 rounded-lg p-3 shadow-sm">
                <img src="{{ asset('images/partners/' . $logo) }}" 
                     alt="Partner Logo" 
                     class="max-w-full max-h-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ===== 7B. CUSTOMER TESTIMONIALS CAROUSEL ===== --}}
<section class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 fade-in">
            <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-2">Social Proof</p>
            <h2 class="font-heading font-black text-3xl md:text-4xl text-dark">What Our Clients Say</h2>
        </div>

        <div class="relative w-full px-4 md:px-0 fade-in">
            
            <div class="overflow-hidden w-full">
                <div id="testimonial-track" class="flex flex-row flex-nowrap transition-transform duration-500 ease-in-out md:-mx-3">
                    @php
                    $testimonials = [
                        ['name'=>'Md. Rafiqul Islam',  'role'=>'CEO, RFL Group Bangladesh',          'text'=>'mBuild Tech transformed our commercial vision into reality. The structural quality and on-time delivery far exceeded our expectations.'],
                        ['name'=>'Tahmina Begum',      'role'=>'Property Owner, Gulshan',             'text'=>'From the first consultation to key handover, every team member was professional, transparent, and genuinely invested in our needs.'],
                        ['name'=>'Arif Hossain',       'role'=>'Director, Ananta Group',              'text'=>'The engineering expertise mBuild Tech brings to the table is unmatched in Bangladesh. I recommend them to anyone planning large-scale construction.'],
                    ];
                    @endphp

                    @foreach($testimonials as $t)
                    <div class="testimonial-slide w-full min-w-full md:min-w-[33.333333%] md:w-1/3 md:basis-1/3 shrink-0 px-3 box-border">
                        <div class="bg-light rounded-2xl p-8 h-full border border-gray-100 flex flex-col justify-between shadow-sm">
                            <div>
                                <div class="flex gap-1 mb-5">
                                    @for($i=0;$i<5;$i++)
                                    <svg class="w-5 h-5 text-brand" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    @endfor
                                </div>
                                <p class="text-dark/80 leading-relaxed mb-6 italic text-sm md:text-base">"{{ $t['text'] }}"</p>
                            </div>
                            <div class="flex items-center gap-3 mt-auto">
                                <div class="w-11 h-11 rounded-full bg-brand/20 flex items-center justify-center shrink-0">
                                    <span class="font-heading font-black text-brand">{{ substr($t['name'],0,1) }}</span>
                                </div>
                                <div>
                                    <div class="font-heading font-bold text-dark text-sm">{{ $t['name'] }}</div>
                                    <div class="text-muted text-xs mt-0.5">{{ $t['role'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <button id="t-prev" class="absolute left-0 top-1/2 -translate-y-1/2 md:-translate-x-5 w-10 h-10 bg-white border border-gray-200 rounded-full shadow-md flex items-center justify-center text-dark hover:text-brand hover:border-brand transition-colors hidden md:flex z-20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button id="t-next" class="absolute right-0 top-1/2 -translate-y-1/2 md:translate-x-5 w-10 h-10 bg-white border border-gray-200 rounded-full shadow-md flex items-center justify-center text-dark hover:text-brand hover:border-brand transition-colors hidden md:flex z-20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            <div class="flex justify-center gap-2 mt-8">
                @for($i=0;$i<count($testimonials);$i++)
                <button class="dot w-2.5 h-2.5 rounded-full bg-gray-300 transition-colors {{ $i===0?'active':'' }}" data-index="{{ $i }}"></button>
                @endfor
            </div>
        </div>
    </div>
</section>


{{-- ===== 8. BLOG & INSIGHTS ===== --}}
<section id="blog" class="bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 fade-in">
            <div>
                <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-2">Knowledge Hub</p>
                <h2 class="font-heading font-black text-3xl md:text-4xl text-dark">Blog & Insights</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="mt-4 md:mt-0 text-brand hover:text-brand-dark font-heading font-semibold text-sm inline-flex items-center gap-1">
                View All Posts <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 fade-in">
            @php
$posts = [
    [
        'title'   => 'Real Estate Investment Trends in Dhaka 2026', 
        'cat'     => 'Real Estate Tips', 
        'date'    => 'June 10, 2026', 
        'excerpt' => 'A comprehensive analysis of how Dhaka\'s property market is evolving amid new RAJUK regulations and surging demand in emerging zones.', // <--- Ekhane \' deya hoyeche
        'img'     => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=600&q=80'
    ],
    [
        'title'   => 'Sustainable Construction Practices by mBuild Tech', 
        'cat'     => 'Construction Insights', 
        'date'    => 'May 28, 2026', 
        'excerpt' => 'How green building methodologies are reshaping Bangladesh\'s construction industry and why sustainability is no longer optional.', // <--- Safe thakar jonno Bangladesh\'s o thik kora holo
        'img'     => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=600&q=80'
    ],
    [
        'title'   => 'Smart Home Integration in Modern Dhaka Apartments', 
        'cat'     => 'Company News', 
        'date'    => 'May 15, 2026', 
        'excerpt' => 'Exploring the rising adoption of IoT-powered smart home systems across mBuild Tech\'s premium residential portfolio.', // <--- Tech\'s o thik kora holo
        'img'     => 'https://images.unsplash.com/photo-1560185007-cde436f6a4d0?w=600&q=80'
    ],
];
@endphp
            @foreach($posts as $post)
            <article class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all group">
                <div class="overflow-hidden h-44">
                    <img src="{{ $post['img'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-brand font-heading font-semibold text-xs uppercase tracking-wider">{{ $post['cat'] }}</span>
                        <span class="text-muted text-xs">{{ $post['date'] }}</span>
                    </div>
                    <h3 class="font-heading font-bold text-dark text-base leading-snug mb-3">{{ $post['title'] }}</h3>
                    <p class="text-muted text-sm leading-relaxed mb-4">{{ $post['excerpt'] }}</p>
                    <a href="#" class="inline-flex items-center gap-1.5 text-brand hover:text-brand-dark font-heading font-semibold text-sm group/link">
                        View Details <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>


{{-- ===== 9. FAQ ACCORDION ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 fade-in">
            <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-2">Frequently Asked Questions</p>
            <h2 class="font-heading font-black text-3xl md:text-4xl text-dark">FAQ</h2>
        </div>

        <div class="space-y-3 fade-in">
            @forelse($faqs as $faq)
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-light transition-colors" onclick="toggleFaq({{ $faq->id }})">
                    <span class="font-heading font-semibold text-dark text-sm md:text-base pr-4">{{ $faq->question }}</span>
                    <svg class="faq-icon w-5 h-5 text-brand shrink-0 transition-transform duration-200" id="icon-{{ $faq->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </button>
                <div class="faq-answer bg-gray-50/50" id="faq-{{ $faq->id }}">
                    <p class="px-6 pb-5 text-muted text-sm leading-relaxed border-t border-gray-100/50 pt-3">{{ $faq->answer }}</p>
                </div>
            </div>
            @empty
            <div class="text-center py-10 border border-dashed border-gray-200 rounded-xl">
                <p class="text-muted text-sm">No FAQs available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>


{{-- ===== 10. FINAL CTA – LEAD GENERATION ===== --}}
<section id="contact" class="py-20 bg-dark-2 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1600&q=80" alt="" class="w-full h-full object-cover"/>
    </div>
    <div class="absolute top-0 left-0 w-72 h-72 bg-brand/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-brand/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-4">Start Your Journey</p>
        <h2 class="font-heading font-black text-4xl md:text-5xl text-white mb-3 leading-tight">
            Ready to Discuss Your<br class="hidden md:block"> Next Project?
        </h2>
        <p class="text-white/60 text-lg mb-10 font-heading font-semibold">Let's Build Together.</p>

        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 max-w-2xl mx-auto text-left border border-white/15">
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-white/70 text-xs font-heading font-semibold uppercase tracking-wider mb-1.5">Your Name</label>
                        <input type="text" name="name" placeholder="Md. Karim" required class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white placeholder-white/40 text-sm focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/30"/>
                    </div>
                    <div>
                        <label class="block text-white/70 text-xs font-heading font-semibold uppercase tracking-wider mb-1.5">Email Address</label>
                        <input type="email" name="email" placeholder="you@example.com" required class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white placeholder-white/40 text-sm focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/30"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-white/70 text-xs font-heading font-semibold uppercase tracking-wider mb-1.5">Phone Number</label>
                        <input type="tel" name="phone" placeholder="+880 17XX-XXXXXX" class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white placeholder-white/40 text-sm focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/30"/>
                    </div>
                    <div>
                        <label class="block text-white/70 text-xs font-heading font-semibold uppercase tracking-wider mb-1.5">I am looking to</label>
                        <select name="inquiry_type" class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white/40 text-sm focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/30 bg-dark-2">
                            <option>Buy a Property</option>
                            <option>Construct a Building</option>
                            <option>General Inquiry</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-white/70 text-xs font-heading font-semibold uppercase tracking-wider mb-1.5">Message</label>
                    <textarea name="message" rows="4" placeholder="Tell us about your project or requirements..." required class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white placeholder-white/40 text-sm focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/30 resize-none"></textarea>
                </div>
                <button type="submit" class="w-full bg-brand hover:bg-brand-dark text-white font-heading font-bold py-4 rounded-xl transition-colors text-base tracking-wide">
                    Schedule a Consultation
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchBtn = document.getElementById('search-btn');
    const projectCards = document.querySelectorAll('.project-card');
    const tabs = document.querySelectorAll('.project-tab');
    const noProjectMessage = document.getElementById('no-project-msg');

    function checkVisibleCards() {
        let visibleCount = 0;
        projectCards.forEach(card => {
            if (card.style.display !== 'none') {
                visibleCount++;
            }
        });

        if (visibleCount === 0) {
            noProjectMessage.classList.remove('hidden');
        } else {
            noProjectMessage.classList.add('hidden');
        }
    }

    searchBtn.addEventListener('click', function () {
        const statusFilter = document.getElementById('search-status').value.toLowerCase();
        const typeFilter = document.getElementById('search-type').value.toLowerCase();
        const locationFilter = document.getElementById('search-location').value.toLowerCase();

        projectCards.forEach(card => {
            const cardStatus = card.getAttribute('data-status');
            const cardType = card.getAttribute('data-type');
            const cardLocation = card.getAttribute('data-location');

            const matchStatus = !statusFilter || cardStatus === statusFilter;
            const matchType = !typeFilter || cardType === typeFilter;
            const matchLocation = !locationFilter || cardLocation.includes(locationFilter);

            if (matchStatus && matchType && matchLocation) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });

        checkVisibleCards();
        document.getElementById('projects').scrollIntoView({ behavior: 'smooth' });
    });

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.className = "project-tab px-4 py-2 rounded-lg text-sm font-heading font-semibold transition-all text-muted border border-gray-200 hover:border-brand hover:text-dark");
            this.className = "project-tab px-4 py-2 rounded-lg text-sm font-heading font-semibold transition-all bg-brand text-white shadow-sm";

            const filterValue = this.getAttribute('data-filter');

            projectCards.forEach(card => {
                if (card.getAttribute('data-status') === filterValue) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            checkVisibleCards();
        });
    });

    checkVisibleCards();
});
</script>
@endpush
