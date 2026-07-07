@extends('layouts.app')
@section('title', $project->name . ' – mBuild Tech')
@section('meta_desc', $project->meta_description ?? $project->description)

@section('content')

{{-- Project Hero --}}
<section class="relative h-[60vh] min-h-[420px] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        @if($project->cover_image)
            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->name }}" class="w-full h-full object-cover"/>
        @else
            <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1600&q=80" alt="{{ $project->name }}" class="w-full h-full object-cover"/>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-dark-2/95 via-dark-2/40 to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 w-full">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="bg-brand text-white text-xs font-heading font-semibold px-3 py-1 rounded-full capitalize">{{ $project->status }}</span>
                    <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-medium px-3 py-1 rounded-full capitalize">{{ $project->classification }}</span>
                </div>
                <h1 class="font-heading font-black text-4xl md:text-5xl text-white mb-2">{{ $project->name }}</h1>
                <div class="flex items-center gap-2 text-white/70 text-sm">
                    <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    {{ $project->address ?? $project->location }}
                </div>
            </div>
            <a href="#lead-form" class="bg-brand hover:bg-brand-dark text-white font-heading font-semibold px-6 py-3 rounded-lg transition-colors text-sm">
                Book a Site Visit
            </a>
        </div>
    </div>
</section>


{{-- Breadcrumb --}}
<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <nav class="flex items-center gap-2 text-xs text-muted">
            <a href="{{ route('home') }}" class="hover:text-brand">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('projects.index') }}" class="hover:text-brand">Projects</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-dark font-medium">{{ $project->name }}</span>
        </nav>
    </div>
</div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-10">
            
            {{-- Project Description / Body --}}
            <div class="fade-in prose max-w-none text-muted text-sm leading-relaxed">
                <h2 class="font-heading font-bold text-dark text-xl mb-4">About the Project</h2>
                <p class="mb-4">{{ $project->description }}</p>
                @if($project->body)
                    {!! $project->body !!}
                @endif
            </div>

            {{-- Image Gallery --}}
            @php 
                $galleryImages = is_string($project->gallery) ? json_decode($project->gallery, true) : $project->gallery;
            @endphp
            @if(!empty($galleryImages))
            <div class="fade-in">
                <h2 class="font-heading font-bold text-dark text-xl mb-5">Project Gallery</h2>
                <div class="grid grid-cols-3 gap-3">
                    @foreach($galleryImages as $index => $img)
                        <div class="{{ $index === 0 ? 'col-span-3 h-64' : 'h-32' }} rounded-xl overflow-hidden">
                            <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"/>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Specifications Grid --}}
            <div class="fade-in">
                <h2 class="font-heading font-bold text-dark text-xl mb-5">Specifications</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php 
                        $specs = [
                            ['label'=>'Plot Size', 'val'=> $project->plot_size ?? 'N/A', 'icon'=>'M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4'],
                            ['label'=>'Number of Floors', 'val'=> $project->floors ? $project->floors . ' Stories' : 'N/A', 'icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5'],
                            ['label'=>'Apartment Sizes', 'val'=> $project->size_range ?? 'N/A', 'icon'=>'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm0 8a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zm8 0a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-6a1 1 0 01-1-1v-6z'],
                            ['label'=>'Total Units', 'val'=> $project->units ? $project->units . ' Units' : 'N/A', 'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                            ['label'=>'Expected Handover', 'val'=> $project->handover_date ? \Carbon\Carbon::parse($project->handover_date)->format('M Y') : 'N/A', 'icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                            ['label'=>'Land Use', 'val'=> $project->classification, 'icon'=>'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4'],
                            ['label'=>'RAJUK Approval', 'val'=> $project->rajuk_no ?? 'N/A', 'icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                        ]; 
                    @endphp
                    @foreach($specs as $sp)
                    <div class="bg-light rounded-xl p-4 border border-gray-100">
                        <div class="w-8 h-8 bg-brand/10 rounded-lg flex items-center justify-center mb-2">
                            <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sp['icon'] }}"/></svg>
                        </div>
                        <div class="font-heading font-black text-dark text-sm capitalize">{{ $sp['val'] }}</div>
                        <div class="text-muted text-xs mt-0.5">{{ $sp['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Features & Amenities --}}
            @php 
                $amenities = is_string($project->amenities) ? json_decode($project->amenities, true) : $project->amenities;
            @endphp
            @if(!empty($amenities))
            <div class="fade-in">
                <h2 class="font-heading font-bold text-dark text-xl mb-5">Features & Amenities</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($amenities as $amenity)
                    <div class="flex items-center gap-3 bg-light rounded-xl px-4 py-3 border border-gray-100">
                        <div class="w-6 h-6 bg-brand/10 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-dark text-sm font-medium">{{ $amenity }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Construction Progress --}}
            <div class="fade-in">
                <h2 class="font-heading font-bold text-dark text-xl mb-5">Construction Progress</h2>
                <div class="bg-light rounded-2xl p-6 border border-gray-100 space-y-5">
                    @php 
                        $progressStages = [
                            ['stage' => 'Foundation & Piling Work', 'pct' => $project->progress_foundation ?? 0],
                            ['stage' => 'R.C.C Casting & Structural Frame', 'pct' => $project->progress_casting ?? 0],
                            ['stage' => 'Brickwork & Finishing Work', 'pct' => $project->progress_finishing ?? 0],
                        ]; 
                    @endphp
                    @foreach($progressStages as $pr)
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-sm font-medium text-dark flex items-center gap-2">
                                @if($pr['pct'] == 100)
                                <svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5l-4.5-4.5 1.41-1.41L10 13.67l7.09-7.09 1.41 1.41L10 16.5z"/></svg>
                                @endif
                                {{ $pr['stage'] }}
                            </span>
                            <span class="text-sm font-heading font-bold {{ $pr['pct'] == 100 ? 'text-green-600' : 'text-brand' }}">{{ $pr['pct'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                            <div class="h-2.5 rounded-full transition-all duration-1000 progress-bar {{ $pr['pct'] == 100 ? 'bg-green-500' : 'bg-brand' }}"
                                 style="width: {{ $pr['pct'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Location Map --}}
            <div class="fade-in">
                <h2 class="font-heading font-bold text-dark text-xl mb-5">Location Map</h2>
                <div class="rounded-2xl overflow-hidden border border-gray-200 shadow-sm">
                    {{-- Google Map Embed with Dynamic Location Name --}}
                    <iframe
                        src="https://maps.google.com/maps?q={{ urlencode($project->address ?? $project->location . ', Dhaka, Bangladesh') }}&t=&z=15&ie=UTF8&iwloc=&output=embed"
                        width="100%"
                        height="350"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="{{ $project->name }} Location">
                    </footer>
                    </iframe>
                </div>
            </div>
        </div>


        {{-- Sidebar --}}
        <div class="space-y-6">

            {{-- Quick info card --}}
            <div class="md:mt-12 bg-dark-2 rounded-2xl p-6 top-28 space-y-4 fade-in">
                <h3 class="font-heading font-bold text-white text-lg">Project At a Glance</h3>
                <div class="space-y-3 border-t border-white/10 pt-4">
                    @php
                        $sidebarSpecs = [
                            ['Developer','mBuild Tech Ltd.'],
                            ['Project Type', $project->classification],
                            ['Total Floors', $project->floors ?? 'N/A'],
                            ['Price Range', $project->price_range ?? 'Contact for Price'],
                            ['Status', $project->status],
                            ['Handover', $project->handover_date ? \Carbon\Carbon::parse($project->handover_date)->format('F Y') : 'N/A'],
                        ];
                    @endphp
                    @foreach($sidebarSpecs as [$k,$v])
                    <div class="flex justify-between items-start gap-3">
                        <span class="text-white/50 text-xs">{{ $k }}</span>
                        <span class="text-white text-xs font-semibold text-right capitalize">{{ $v }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="flex gap-3 pt-2">
                    <a href="#lead-form" class="flex-1 bg-brand hover:bg-brand-dark text-white font-heading font-semibold text-sm py-3 rounded-xl text-center transition-colors">Book Site Visit</a>
                    <a href="#" class="flex-1 border border-white/20 hover:border-brand text-white font-heading font-semibold text-sm py-3 rounded-xl text-center transition-colors">Download Brochure</a>
                </div>
            </div>

            {{-- Lead Form --}}
            <div id="lead-form" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 fade-in">
                <h3 class="font-heading font-bold text-dark text-lg mb-5">Book a Site Visit</h3>
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="inquiry_type" value="Book a Property">
                    <input type="hidden" name="project" value="{{ $project->name }}">
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Full Name</label>
                        <input type="text" name="name" required placeholder="Your name" class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Phone Number</label>
                        <input type="tel" name="phone" required placeholder="+880 17XX-XXXXXX" class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Email</label>
                        <input type="email" name="email" placeholder="you@example.com" class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Preferred Visit Date</label>
                        <input type="date" name="visit_date" class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Message (Optional)</label>
                        <textarea name="message" rows="3" placeholder="Any specific questions?" class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-brand hover:bg-brand-dark text-white font-heading font-bold py-3.5 rounded-xl transition-colors text-sm">
                        Submit Booking Request
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection