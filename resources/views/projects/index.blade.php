@extends('layouts.app')
@section('title', 'Projects – mBuild Tech')
@section('meta_desc', 'Browse mBuild Tech\'s portfolio of completed, ongoing and upcoming residential and commercial projects across Bangladesh.')

@section('content')

{{-- Page Hero --}}
<section class="relative bg-dark-2 pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1600&q=80" class="w-full h-full object-cover"/>
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-dark-2/95 to-dark-2/60"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-3">Our Portfolio</p>
        <h1 class="font-heading font-black text-4xl md:text-5xl text-white mb-4">All Projects</h1>
        <nav class="flex items-center gap-2 text-sm text-white/50">
            <a href="{{ route('home') }}" class="hover:text-brand transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">Projects</span>
        </nav>
    </div>
</section>


{{-- Filter Archive Header --}}
<section class="bg-white border-b border-gray-100 top-16 md:top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-wrap items-center gap-3">
            <span class="text-muted text-sm font-heading font-semibold mr-2">Filter by:</span>

            {{-- Status filter --}}
            <div class="flex gap-2">
                @foreach(['All','Ongoing','Completed','Upcoming'] as $s)
                <button class="status-filter px-3.5 py-1.5 rounded-lg text-xs font-heading font-semibold transition-all
                    {{ $s === 'All' ? 'bg-brand text-white' : 'border border-gray-200 text-muted hover:border-brand hover:text-dark' }}"
                    data-status="{{ strtolower($s) }}">{{ $s }}</button>
                @endforeach
            </div>

            <div class="w-px h-5 bg-gray-200 mx-1"></div>

            {{-- Type (Classification) filter --}}
            <select id="type-filter" class="border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-dark focus:outline-none focus:border-brand bg-white font-heading font-semibold capitalize">
                <option value="">All Types</option>
                {{-- ডাটাবেজে থাকা ইউনিক classification গুলো ডাইনামিকালি ড্রপডাউনে আসবে --}}
                @foreach($allProjects->pluck('classification')->unique() as $type)
                    <option value="{{ strtolower($type) }}">{{ $type }}</option>
                @endforeach
            </select>

            {{-- Location filter --}}
            <select id="location-filter" class="border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-dark focus:outline-none focus:border-brand bg-white font-heading font-semibold capitalize">
                <option value="">All Locations</option>
                {{-- ডাটাবেজে থাকা ইউনিক location গুলো ডাইনামিকালি ড্রপডাউনে আসবে --}}
                @foreach($allProjects->pluck('location')->unique() as $loc)
                    <option value="{{ strtolower($loc) }}">{{ $loc }}</option>
                @endforeach
            </select>

            <div class="ml-auto text-xs text-muted font-medium" id="result-count">Showing all projects</div>
        </div>
    </div>
</section>


{{-- Projects Grid --}}
<section class="py-14 bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="all-projects" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($allProjects as $p)
            <div class="project-card-filter group rounded-2xl overflow-hidden bg-white border border-gray-100 hover:shadow-xl transition-all duration-300 relative"
                 data-status="{{ strtolower($p->status) }}"
                 data-type="{{ strtolower($p->classification) }}"
                 data-location="{{ strtolower($p->location) }}">

                <div class="relative overflow-hidden h-52">
                    @if($p->cover_image)
                        <img src="{{ asset('storage/' . $p->cover_image) }}" alt="{{ $p->name }}" class="project-img w-full h-full object-cover"/>
                    @else
                        <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=600&q=80" alt="{{ $p->name }}" class="project-img w-full h-full object-cover"/>
                    @endif
                    
                    <span class="absolute top-3 left-3 bg-brand text-white text-xs font-heading font-semibold px-3 py-1 rounded-full capitalize">{{ $p->status }}</span>
                    <span class="absolute top-3 right-3 bg-dark-2/80 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded-full capitalize">{{ $p->classification }}</span>

                    {{-- Hover overlay with quick specs --}}
                    <div class="absolute inset-0 bg-dark-2/90 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-3 px-6">
                        <div class="grid grid-cols-2 gap-3 w-full">
                            <div class="text-center">
                                <div class="font-heading font-black text-brand text-xl">{{ $p->floors ?? 'N/A' }}</div>
                                <div class="text-white/70 text-xs">Floors</div>
                            </div>
                            <div class="text-center">
                                <div class="font-heading font-black text-brand text-xl capitalize">{{ $p->status }}</div>
                                <div class="text-white/70 text-xs">Status</div>
                            </div>
                        </div>
                        <a href="{{ route('projects.show', $p->slug) }}" class="bg-brand hover:bg-brand-dark text-white font-heading font-semibold text-xs px-5 py-2 rounded-lg transition-colors">
                            View Full Details →
                        </a>
                    </div>
                </div>

                <div class="p-5">
                    <h3 class="font-heading font-bold text-dark text-base leading-snug mb-1.5 truncate" title="{{ $p->name }}">{{ $p->name }}</h3>
                    <div class="flex items-center gap-1.5 text-muted text-xs truncate">
                        <svg class="w-3.5 h-3.5 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $p->location }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- No results message --}}
        <div id="no-results" class="hidden text-center py-20">
            <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="font-heading font-bold text-dark text-lg mb-2">No projects found</p>
            <p class="text-muted text-sm">Try adjusting your filter criteria.</p>
        </div>
    </div>
</section>

@push('scripts')
<script>
// Projects filter logic
const cards = document.querySelectorAll('.project-card-filter');
const statusBtns = document.querySelectorAll('.status-filter');
const typeSelect = document.getElementById('type-filter');
const locSelect = document.getElementById('location-filter');
const countEl = document.getElementById('result-count');
const noResults = document.getElementById('no-results');

const urlParams = new URLSearchParams(window.location.search);
let activeStatus = urlParams.get('status') ? urlParams.get('status').toLowerCase() : 'all';

function applyFilters() {
    const type = typeSelect.value.toLowerCase();
    const loc = locSelect.value.toLowerCase();
    let visible = 0;

    cards.forEach(card => {
        const matchStatus = activeStatus === 'all' || card.dataset.status === activeStatus;
        const matchType = !type || card.dataset.type === type;
        const matchLoc = !loc || card.dataset.location === loc;
        const show = matchStatus && matchType && matchLoc;
        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    countEl.textContent = `Showing ${visible} project${visible !== 1 ? 's' : ''}`;
    noResults.classList.toggle('hidden', visible > 0);
}

function updateButtonUI() {
    statusBtns.forEach(b => {
        if (b.dataset.status === activeStatus) {
            b.classList.add('bg-brand', 'text-white');
            b.classList.remove('border', 'border-gray-200', 'text-muted');
        } else {
            b.classList.remove('bg-brand', 'text-white');
            b.classList.add('border', 'border-gray-200', 'text-muted');
        }
    });
}

// Button Click Event
statusBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        activeStatus = btn.dataset.status;
        updateButtonUI();
        applyFilters();
        
        const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + (activeStatus !== 'all' ? `?status=${activeStatus}` : '');
        window.history.pushState({path:newUrl}, '', newUrl);
    });
});

typeSelect.addEventListener('change', applyFilters);
locSelect.addEventListener('change', applyFilters);

updateButtonUI();
applyFilters();
</script>
@endpush

@endsection