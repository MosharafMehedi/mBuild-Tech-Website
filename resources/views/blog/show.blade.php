@extends('layouts.app')
@section('title', $blog->meta_title ?? $blog->title . ' – mBuild Tech Blog')

@section('content')

{{-- Hero --}}
<section class="relative bg-dark-2 pt-32 pb-20">
    <div class="absolute inset-0 opacity-20">
        @if($blog->featured_image)
            <img src="{{ asset('storage/' . $blog->featured_image) }}" class="w-full h-full object-cover" alt="{{ $blog->title }}"/>
        @else
            <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1600&q=80" class="w-full h-full object-cover" alt="Default Background"/>
        @endif
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-dark-2/80 to-dark-2/95"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block bg-brand/20 text-brand font-heading font-semibold text-xs uppercase tracking-widest px-3 py-1.5 rounded-full mb-4">
            {{ $blog->category }}
        </span>
        <h1 class="font-heading font-black text-3xl md:text-4xl text-white mb-5 leading-tight">
            {{ $blog->title }}
        </h1>
        <div class="flex items-center justify-center gap-5 text-white/60 text-sm">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-brand/20 flex items-center justify-center">
                    <span class="text-brand font-black text-xs">m</span>
                </div>
                <span>{{ $blog->author }}</span>
            </div>
            <span>·</span>
            <span>
                {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : $blog->created_at->format('M d, Y') }}
            </span>
            <span>·</span>
            <span>{{ $blog->views }} views</span>
        </div>
    </div>
</section>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

        {{-- Article Content --}}
        <article class="lg:col-span-2 prose max-w-none">
            @if($blog->featured_image)
                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="rounded-2xl w-full h-72 object-cover mb-8 not-prose"/>
            @else
                <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1200&q=80" alt="Default Featured Image" class="rounded-2xl w-full h-72 object-cover mb-8 not-prose"/>
            @endif

            <div class="not-prose mb-8">
                <nav class="flex items-center gap-2 text-xs text-muted">
                    <a href="{{ route('home') }}" class="hover:text-brand">Home</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <a href="{{ route('blog.index') }}" class="hover:text-brand">Blog</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-dark line-clamp-1">{{ $blog->title }}</span>
                </nav>
            </div>

            @if($blog->excerpt)
                <div class="bg-light border-l-4 border-brand p-4 mb-6 italic text-muted rounded-r-xl">
                    {{ $blog->excerpt }}
                </div>
            @endif

            <div class="text-muted leading-relaxed space-y-4">
                {!! $blog->content !!}
            </div>

            {{-- Author Card --}}
            <div class="not-prose border-t border-gray-100 pt-8 mt-8">
                <div class="flex items-start gap-5 bg-light rounded-2xl p-6 border border-gray-100">
                    <div class="w-16 h-16 rounded-full bg-brand/20 flex items-center justify-center shrink-0">
                        <span class="font-heading font-black text-brand text-2xl">m</span>
                    </div>
                    <div>
                        <h4 class="font-heading font-bold text-dark">{{ $blog->author }}</h4>
                        <p class="text-brand text-xs font-semibold mb-2">Author</p>
                        <p class="text-muted text-sm leading-relaxed">mBuild Tech</p>
                    </div>
                </div>
            </div>

            {{-- Social Sharing --}}
            <div class="not-prose mt-8 pt-8 border-t border-gray-100">
                <p class="font-heading font-semibold text-dark text-sm mb-4">Share this article:</p>
                <div class="flex flex-wrap gap-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener noreferrer" class="bg-[#1877F2] text-white px-4 py-2.5 rounded-lg text-xs font-heading font-semibold flex items-center gap-2 hover:opacity-90 transition-opacity">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.5 0-1.96.93-1.96 1.89v2.26h3.32l-.53 3.5h-2.8V24C19.62 23.1 24 18.1 24 12.07z"/></svg>
                        Facebook
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener noreferrer" class="bg-[#0A66C2] text-white px-4 py-2.5 rounded-lg text-xs font-heading font-semibold flex items-center gap-2 hover:opacity-90 transition-opacity">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        LinkedIn
                    </a>
                </div>
            </div>
        </article>

        {{-- Sidebar --}}
        <aside class="space-y-8">
            <div class="bg-light rounded-2xl p-6 border border-gray-100">
                <h3 class="font-heading font-bold text-dark text-base mb-5">Related Articles</h3>
                <div class="space-y-4">
                    @forelse($relatedBlogs as $related)
                    <a href="{{ route('blog.show', $related->slug) }}" class="flex gap-3 group">
                        @if($related->featured_image)
                            <img src="{{ asset('storage/' . $related->featured_image) }}" class="w-16 h-14 rounded-lg object-cover shrink-0" alt="{{ $related->title }}"/>
                        @else
                            <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=200&q=80" class="w-16 h-14 rounded-lg object-cover shrink-0" alt="Default Image"/>
                        @endif
                        <div>
                            <p class="font-heading font-semibold text-dark text-xs leading-snug group-hover:text-brand transition-colors line-clamp-2">{{ $related->title }}</p>
                            <p class="text-muted text-xs mt-1">
                                {{ $related->published_at ? \Carbon\Carbon::parse($related->published_at)->format('M d, Y') : $related->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </a>
                    @empty
                    <p class="text-muted text-xs">No related articles found.</p>
                    @endforelse
                </div>
            </div>

            {{-- CTA --}}
            <div class="bg-brand rounded-2xl p-6 text-white">
                <h3 class="font-heading font-black text-lg mb-3">Ready to Invest?</h3>
                <p class="text-white/80 text-sm leading-relaxed mb-5">Talk to our sales team about current and upcoming projects in prime Dhaka locations.</p>
                <a href="{{ route('contact') }}" class="block w-full bg-white text-brand font-heading font-bold text-sm py-3 rounded-xl text-center hover:bg-light transition-colors">
                    Contact Sales Team
                </a>
            </div>
        </aside>
    </div>
</div>

@endsection