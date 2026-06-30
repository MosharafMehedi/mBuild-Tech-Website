@extends('layouts.app')
@section('title', 'Real Estate Investment Trends in Dhaka 2026 – mBuild Tech Blog')

@section('content')

{{-- Hero --}}
<section class="relative bg-dark-2 pt-32 pb-20">
    <div class="absolute inset-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1600&q=80" class="w-full h-full object-cover"/>
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-dark-2/80 to-dark-2/95"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block bg-brand/20 text-brand font-heading font-semibold text-xs uppercase tracking-widest px-3 py-1.5 rounded-full mb-4">Real Estate Tips</span>
        <h1 class="font-heading font-black text-3xl md:text-4xl text-white mb-5 leading-tight">Real Estate Investment Trends in Dhaka 2026</h1>
        <div class="flex items-center justify-center gap-5 text-white/60 text-sm">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-brand/20 flex items-center justify-center">
                    <span class="text-brand font-black text-xs">m</span>
                </div>
                <span>mBuild Tech Team</span>
            </div>
            <span>·</span>
            <span>June 10, 2026</span>
            <span>·</span>
            <span>5 min read</span>
        </div>
    </div>
</section>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

        {{-- Article Content --}}
        <article class="lg:col-span-2 prose max-w-none">
            <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1200&q=80" alt="Dhaka real estate 2026" class="rounded-2xl w-full h-72 object-cover mb-8 not-prose"/>

            <div class="not-prose mb-8">
                <nav class="flex items-center gap-2 text-xs text-muted">
                    <a href="{{ route('home') }}" class="hover:text-brand">Home</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <a href="{{ route('blog.index') }}" class="hover:text-brand">Blog</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-dark">Real Estate Investment Trends...</span>
                </nav>
            </div>

            <h2 class="font-heading font-black text-2xl text-dark mt-8 mb-4">Overview: Dhaka's Property Market in 2026</h2>
            <p class="text-muted leading-relaxed mb-5">Bangladesh's real estate sector has undergone a significant transformation over the past three years. Driven by rapid urbanisation, a growing middle class, and significant infrastructure investment, Dhaka's property market is at an inflection point that experienced investors cannot afford to ignore.</p>

            <h2 class="font-heading font-black text-2xl text-dark mt-8 mb-4">Key Trends Shaping the Market</h2>
            <p class="text-muted leading-relaxed mb-4">Several macro trends are converging to create unique opportunities in the Dhaka residential and commercial real estate segments:</p>

            <div class="not-prose space-y-4 mb-8">
                @foreach([
                    ['title'=>'1. Emerging Zones Rising', 'text'=>'Areas like Bashundhara, Purbachal, and Jhilmil are seeing 15–20% annual appreciation as infrastructure catches up with demand.'],
                    ['title'=>'2. RAJUK Digitisation', 'text'=>'The newly digitised RAJUK approval process has reduced bureaucratic delays by 60%, encouraging more legitimate developments.'],
                    ['title'=>'3. Green Building Premium', 'text'=>'Eco-certified buildings are commanding 8–12% price premiums as buyer awareness of sustainability increases.'],
                    ['title'=>'4. Commercial Demand Surge', 'text'=>'Dhaka\'s growing IT and financial sectors are driving unprecedented demand for Grade-A commercial office space.'],
                ] as $trend)
                <div class="bg-light rounded-xl p-5 border border-gray-100">
                    <h4 class="font-heading font-bold text-dark text-sm mb-1.5">{{ $trend['title'] }}</h4>
                    <p class="text-muted text-sm leading-relaxed">{{ $trend['text'] }}</p>
                </div>
                @endforeach
            </div>

            <h2 class="font-heading font-black text-2xl text-dark mt-8 mb-4">What This Means for Buyers</h2>
            <p class="text-muted leading-relaxed mb-5">For end-users purchasing their first home, the focus should remain on RAJUK-approved projects in well-connected areas with established infrastructure. For investors, the emerging zones offer compelling entry prices with strong 5–7 year return potential.</p>
            <p class="text-muted leading-relaxed mb-8">mBuild Tech's current portfolio strategically spans both segments — premium residential towers in established neighbourhoods and commercial developments in high-growth corridors.</p>

            {{-- Author Card --}}
            <div class="not-prose border-t border-gray-100 pt-8 mt-8">
                <div class="flex items-start gap-5 bg-light rounded-2xl p-6 border border-gray-100">
                    <div class="w-16 h-16 rounded-full bg-brand/20 flex items-center justify-center shrink-0">
                        <span class="font-heading font-black text-brand text-2xl">m</span>
                    </div>
                    <div>
                        <h4 class="font-heading font-bold text-dark">mBuild Tech Editorial Team</h4>
                        <p class="text-brand text-xs font-semibold mb-2">Construction & Real Estate Experts</p>
                        <p class="text-muted text-sm leading-relaxed">Our editorial team consists of licensed engineers, certified real estate professionals, and experienced project managers with a combined 50+ years of industry experience in Bangladesh.</p>
                    </div>
                </div>
            </div>

            {{-- Social Sharing --}}
            <div class="not-prose mt-8 pt-8 border-t border-gray-100">
                <p class="font-heading font-semibold text-dark text-sm mb-4">Share this article:</p>
                <div class="flex gap-3">
                    @foreach([
                        ['label'=>'Facebook',  'color'=>'bg-[#1877F2]', 'icon'=>'M24 12.07C24 5.41 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.5 0-1.96.93-1.96 1.89v2.26h3.32l-.53 3.5h-2.8V24C19.62 23.1 24 18.1 24 12.07z'],
                        ['label'=>'LinkedIn',  'color'=>'bg-[#0A66C2]', 'icon'=>'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z'],
                        ['label'=>'WhatsApp', 'color'=>'bg-[#25D366]', 'icon'=>'M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z'],
                    ] as $s)
                    <a href="#" class="{{ $s['color'] }} text-white px-4 py-2.5 rounded-lg text-xs font-heading font-semibold flex items-center gap-2 hover:opacity-90 transition-opacity">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $s['icon'] }}"/></svg>
                        {{ $s['label'] }}
                    </a>
                    @endforeach
                </div>
            </div>
        </article>

        {{-- Sidebar --}}
        <aside class="space-y-8">
            {{-- Related posts --}}
            <div class="bg-light rounded-2xl p-6 border border-gray-100">
                <h3 class="font-heading font-bold text-dark text-base mb-5">Related Articles</h3>
                <div class="space-y-4">
                    @foreach([
                        ['title'=>'Sustainable Construction Practices',      'date'=>'May 28, 2026', 'img'=>'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=200&q=80'],
                        ['title'=>'Smart Home Integration in Dhaka Apts',   'date'=>'May 15, 2026', 'img'=>'https://images.unsplash.com/photo-1560185007-cde436f6a4d0?w=200&q=80'],
                        ['title'=>'Earthquake-Resistant Design Explained',   'date'=>'Mar 25, 2026', 'img'=>'https://images.unsplash.com/photo-1565008576549-57569a49371d?w=200&q=80'],
                    ] as $rel)
                    <a href="#" class="flex gap-3 group">
                        <img src="{{ $rel['img'] }}" class="w-16 h-14 rounded-lg object-cover shrink-0"/>
                        <div>
                            <p class="font-heading font-semibold text-dark text-xs leading-snug group-hover:text-brand transition-colors">{{ $rel['title'] }}</p>
                            <p class="text-muted text-xs mt-1">{{ $rel['date'] }}</p>
                        </div>
                    </a>
                    @endforeach
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
