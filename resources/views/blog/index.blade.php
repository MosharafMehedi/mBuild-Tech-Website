@extends('layouts.app')
@section('title', 'Blog & Insights – mBuild Tech')

@section('content')

{{-- Hero --}}
<section class="relative bg-dark-2 pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 opacity-15">
        <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1600&q=80" class="w-full h-full object-cover"/>
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-dark-2/95 to-dark-2/70"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-3">Knowledge Hub</p>
        <h1 class="font-heading font-black text-4xl md:text-5xl text-white mb-4">Blog & Insights</h1>
        <nav class="flex items-center gap-2 text-sm text-white/50">
            <a href="{{ route('home') }}" class="hover:text-brand transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">Blog</span>
        </nav>
    </div>
</section>


{{-- Search + Filter Bar --}}
<section class="bg-white border-b border-gray-100 top-16 md:top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-wrap items-center gap-3">
            {{-- Search --}}
            <div class="relative flex-1 min-w-[200px] max-w-xs">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="blog-search" placeholder="Search articles..." class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand text-dark"/>
            </div>
            {{-- Category filter --}}
            <div class="flex gap-2 flex-wrap">
                @foreach(['All','Construction Insights','Real Estate Tips','Company News'] as $cat)
                <button class="cat-filter px-3.5 py-1.5 rounded-lg text-xs font-heading font-semibold transition-all
                    {{ $cat === 'All' ? 'bg-brand text-white' : 'border border-gray-200 text-muted hover:border-brand hover:text-dark' }}"
                    data-cat="{{ $cat === 'All' ? 'all' : strtolower(str_replace(' ','_',$cat)) }}">{{ $cat }}</button>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- Posts Grid --}}
<section class="py-14 bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="blog-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
            $posts = [
                ['title'=>'Real Estate Investment Trends in Dhaka 2026',          'cat'=>'real_estate_tips',     'catLabel'=>'Real Estate Tips',     'date'=>'June 10, 2026',  'author'=>'mBuild Tech Team', 'excerpt'=>'A comprehensive analysis of how the Dhaka property market is evolving amid new RAJUK regulations and surging demand in emerging residential zones.', 'img'=>'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=600&q=80', 'read'=>'5 min'],
                ['title'=>'Sustainable Construction Practices by mBuild Tech',    'cat'=>'construction_insights', 'catLabel'=>'Construction Insights','date'=>'May 28, 2026',  'author'=>'Engr. Tanvir Ahmed', 'excerpt'=>'How green building methodologies and environmental responsibility are reshaping Bangladesh\'s construction landscape for a sustainable future.', 'img'=>'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=600&q=80', 'read'=>'7 min'],
                ['title'=>'Smart Home Integration in Modern Dhaka Apartments',    'cat'=>'company_news',         'catLabel'=>'Company News',         'date'=>'May 15, 2026',  'author'=>'mBuild Tech Team', 'excerpt'=>'Exploring the rising adoption of IoT-powered smart home systems in premium residential developments across Dhaka.', 'img'=>'https://images.unsplash.com/photo-1560185007-cde436f6a4d0?w=600&q=80', 'read'=>'4 min'],
                ['title'=>'How to Choose the Right Apartment in Dhaka: A 2026 Guide','cat'=>'real_estate_tips',  'catLabel'=>'Real Estate Tips',     'date'=>'April 30, 2026','author'=>'Ms. Rumana Akter',   'excerpt'=>'From location analysis to RAJUK compliance checks, here is a definitive guide for first-time apartment buyers in Dhaka.', 'img'=>'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&q=80', 'read'=>'9 min'],
                ['title'=>'mBuild Tech Wins REHAB Best Developer Award 2025',     'cat'=>'company_news',         'catLabel'=>'Company News',         'date'=>'April 10, 2026','author'=>'mBuild Tech Team', 'excerpt'=>'mBuild Tech has been honoured with the prestigious REHAB Best Developer Award 2025, recognising outstanding contribution to real estate development.', 'img'=>'https://images.unsplash.com/photo-1518005020951-eccb494ad742?w=600&q=80', 'read'=>'3 min'],
                ['title'=>'Earthquake-Resistant Design: Bangladesh Building Code Explained','cat'=>'construction_insights','catLabel'=>'Construction Insights','date'=>'March 25, 2026','author'=>'Engr. Shafiqul Islam','excerpt'=>'A technical deep-dive into BNBC seismic design standards and how mBuild Tech implements earthquake resistance in every structure.','img'=>'https://images.unsplash.com/photo-1565008576549-57569a49371d?w=600&q=80','read'=>'8 min'],
            ];
            @endphp

            @foreach($posts as $post)
            <article class="blog-card bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all group"
                     data-cat="{{ $post['cat'] }}"
                     data-title="{{ strtolower($post['title']) }}">
                <div class="overflow-hidden h-48">
                    <img src="{{ $post['img'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="bg-brand/10 text-brand font-heading font-semibold text-xs px-2.5 py-1 rounded-full">{{ $post['catLabel'] }}</span>
                        <span class="text-muted text-xs">{{ $post['read'] }} read</span>
                    </div>
                    <h3 class="font-heading font-bold text-dark text-base leading-snug mb-3">{{ $post['title'] }}</h3>
                    <p class="text-muted text-sm leading-relaxed mb-4 line-clamp-3">{{ $post['excerpt'] }}</p>
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-brand/20 flex items-center justify-center">
                                <span class="text-brand font-black text-xs">{{ substr($post['author'],0,1) }}</span>
                            </div>
                            <span class="text-muted text-xs font-medium">{{ $post['author'] }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-muted text-xs">{{ $post['date'] }}</span>
                            <a href="{{ route('blog.show', 'post-slug') }}" class="text-brand hover:text-brand-dark transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div id="no-blog-results" class="hidden text-center py-16">
            <p class="font-heading font-bold text-dark text-lg mb-2">No articles found</p>
            <p class="text-muted text-sm">Try a different search or category.</p>
        </div>
    </div>
</section>

@push('scripts')
<script>
const blogCards = document.querySelectorAll('.blog-card');
const catBtns = document.querySelectorAll('.cat-filter');
const searchInput = document.getElementById('blog-search');
const noBlogResults = document.getElementById('no-blog-results');
let activeCat = 'all';

function filterBlog() {
    const q = searchInput.value.toLowerCase();
    let visible = 0;
    blogCards.forEach(card => {
        const matchCat = activeCat === 'all' || card.dataset.cat === activeCat;
        const matchSearch = !q || card.dataset.title.includes(q);
        const show = matchCat && matchSearch;
        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });
    noBlogResults.classList.toggle('hidden', visible > 0);
}

catBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        catBtns.forEach(b => { b.classList.remove('bg-brand','text-white'); b.classList.add('border','border-gray-200','text-muted'); });
        btn.classList.add('bg-brand','text-white'); btn.classList.remove('border','border-gray-200','text-muted');
        activeCat = btn.dataset.cat;
        filterBlog();
    });
});
searchInput.addEventListener('input', filterBlog);
</script>
@endpush

@endsection
