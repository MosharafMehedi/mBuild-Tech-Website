@extends('layouts.app')
@section('title', 'Blog & Insights – mBuild Tech')

@section('content')

{{-- Hero --}}
<section class="relative bg-dark-2 pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 opacity-15">
        <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1600&q=80" class="w-full h-full object-cover" alt="Hero Background"/>
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
        <form action="{{ route('blog.index') }}" method="GET" id="filter-form" class="flex flex-wrap items-center gap-3">
            
            <input type="hidden" name="category" id="selected-category" value="{{ request('category', 'All') }}">

            {{-- Search Input --}}
            <div class="relative flex-1 min-w-[200px] max-w-xs">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" id="blog-search" value="{{ request('search') }}" placeholder="Search articles..." class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand text-dark"/>
            </div>

            {{-- Dynamic Category Filters --}}
            <div class="flex gap-2 flex-wrap">
                @foreach($categories as $cat)
                <button type="button" class="cat-filter px-3.5 py-1.5 rounded-lg text-xs font-heading font-semibold transition-all
                    {{ request('category', 'All') === $cat ? 'bg-brand text-white' : 'border border-gray-200 text-muted hover:border-brand hover:text-dark' }}"
                    data-cat="{{ $cat }}">
                    {{ $cat }}
                </button>
                @endforeach
            </div>
        </form>
    </div>
</section>

{{-- Posts Grid --}}
<section class="py-14 bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="blog-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($blogs as $blog)
            <article class="blog-card bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all group flex flex-col justify-between h-full">
                <div>
                    <div class="overflow-hidden h-48">
                        @if($blog->featured_image)
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                        @else
                            <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=600&q=80" alt="Default Image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="bg-brand/10 text-brand font-heading font-semibold text-xs px-2.5 py-1 rounded-full">{{ $blog->category }}</span>
                            <span class="text-muted text-xs">{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
                        </div>
                        <h3 class="font-heading font-bold text-dark text-base leading-snug mb-3 line-clamp-2" title="{{ $blog->title }}">{{ $blog->title }}</h3>
                        <p class="text-muted text-sm leading-relaxed mb-4 line-clamp-3">{{ $blog->excerpt }}</p>
                    </div>
                </div>

                <div class="p-6 pt-0">
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-brand/20 flex items-center justify-center">
                                <span class="text-brand font-black text-xs">{{ substr($blog->author, 0, 1) }}</span>
                            </div>
                            <span class="text-muted text-xs font-medium">{{ $blog->author }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-muted text-xs">
                                {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : $blog->created_at->format('M d, Y') }}
                            </span>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="text-brand hover:text-brand-dark transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-16">
                <p class="font-heading font-bold text-dark text-lg mb-2">No articles found</p>
                <p class="text-muted text-sm">Try a different search or category.</p>
            </div>
            @endforelse
        </div>

        {{-- Laravel Pagination Links --}}
        <div class="mt-12">
            {{ $blogs->appends(request()->query())->links() }}
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filter-form');
    const searchInput = document.getElementById('blog-search');
    const catBtns = document.querySelectorAll('.cat-filter');
    const selectedCatInput = document.getElementById('selected-category');

    catBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            selectedCatInput.value = btn.dataset.cat;
            form.submit();
        });
    });

    let delayTimer;
    searchInput.addEventListener('input', () => {
        clearTimeout(delayTimer);
        delayTimer = setTimeout(() => {
            form.submit();
        }, 600);
    });
});
</script>
@endpush

@endsection