@extends('layouts.app')
@section('title', 'Contact Us – mBuild Tech')

@section('content')

    {{-- Hero --}}
    <section class="relative bg-dark-2 pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 opacity-15">
            <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1600&q=80"
                class="w-full h-full object-cover" />
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-dark-2/95 to-dark-2/70"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-3">Get in Touch</p>
            <h1 class="font-heading font-black text-4xl md:text-5xl text-white mb-4">Contact Us</h1>
            <nav class="flex items-center gap-2 text-sm text-white/50">
                <a href="{{ route('home') }}" class="hover:text-brand transition-colors">Home</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white/80">Contact Us</span>
            </nav>
        </div>
    </section>


    {{-- Contact Content --}}
    <section class="py-16 bg-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    class="bg-green-50 border border-green-200 text-green-800 rounded-xl px-5 py-4 mb-8 flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                {{-- Left Column: Office Info + Map --}}
                <div class="space-y-8 fade-in">

                    {{-- Office Cards --}}
                    <div>
                        <h2 class="font-heading font-black text-2xl text-dark mb-6">Our Offices</h2>
                        <div class="space-y-5">
                            @php $offices = [['type' => 'Corporate Head Office', 'addr' => 'House 12, Road 5, Dhanmondi, Dhaka-1205', 'hours' => 'Sun–Thu: 9:00 AM – 6:00 PM'], ['type' => 'Sales & Marketing Office', 'addr' => 'Level 8, Gulshan Trade Centre, Gulshan-1, Dhaka-1212', 'hours' => 'Sun–Fri: 10:00 AM – 7:00 PM'], ['type' => 'Site Office (Ongoing Projects)', 'addr' => 'mBuild Tower Site, Dhanmondi R/A, Dhaka', 'hours' => 'Daily: 8:00 AM – 5:00 PM']]; @endphp
                            @foreach ($offices as $office)
                                <div class="bg-white rounded-xl p-5 border border-gray-100 flex gap-4">
                                    <div class="w-10 h-10 bg-brand/10 rounded-xl flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-heading font-bold text-dark text-sm mb-1">{{ $office['type'] }}</h4>
                                        <p class="text-muted text-xs leading-relaxed">{{ $office['addr'] }}</p>
                                        <p class="text-brand text-xs mt-1 font-medium">{{ $office['hours'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Contact Details --}}
                    <div class="bg-white rounded-2xl p-6 border border-gray-100">
                        <h3 class="font-heading font-bold text-dark text-base mb-5">Direct Contacts</h3>
                        <div class="space-y-4">
                            @php $contacts = [
                                    [
                                        'label' => 'Hotline',
                                        'val' => '+880 1711-123456',
                                        'icon' =>
                                            'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
                                        'href' => 'tel:+8801711123456',
                                    ],
                                    [
                                        'label' => 'Sales Department',
                                        'val' => 'sales@mbuildtech.com.bd',
                                        'icon' =>
                                            'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                                        'href' => 'mailto:sales@mbuildtech.com.bd',
                                    ],
                                    [
                                        'label' => 'Career Department',
                                        'val' => 'careers@mbuildtech.com.bd',
                                        'icon' =>
                                            'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                                        'href' => 'mailto:careers@mbuildtech.com.bd',
                                    ],
                                    [
                                        'label' => 'General Inquiries',
                                        'val' => 'info@mbuildtech.com.bd',
                                        'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                                        'href' => 'mailto:info@mbuildtech.com.bd',
                                    ],
                            ]; @endphp
                            @foreach ($contacts as $c)
                                <a href="{{ $c['href'] }}" class="flex items-center gap-3 group">
                                    <div class="w-9 h-9 bg-brand/10 rounded-lg flex items-center justify-center shrink-0">
                                        <svg class="w-4.5 h-4.5 text-brand w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ $c['icon'] }}" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-muted text-xs">{{ $c['label'] }}</p>
                                        <p class="text-dark text-sm font-semibold group-hover:text-brand transition-colors">
                                            {{ $c['val'] }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Google Map --}}
                    <div>
                        <h3 class="font-heading font-bold text-dark text-base mb-4">Find Us on the Map</h3>
                        <div class="rounded-2xl overflow-hidden border border-gray-200 shadow-sm">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.2767924835!2d90.37368931536282!3d23.74579698459259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b33cffc3fb%3A0x4a826f475fd312af!2sDhanmondi%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1625000000000!5m2!1sen!2sbd"
                                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" title="mBuild Tech Office Location">
                            </iframe>
                        </div>
                    </div>
                </div>

                {{-- Right Column: CRM Form --}}
                <div class="fade-in">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h2 class="font-heading font-black text-2xl text-dark mb-2">Send Us a Message</h2>
                        <p class="text-muted text-sm mb-7">Our team will get back to you within 24 working hours.</p>

                        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label
                                        class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Full
                                        Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" required placeholder="Md. Karim"
                                        value="{{ old('name') }}"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 @error('name') border-red-400 @enderror" />
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Email
                                        Address <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" required placeholder="you@example.com"
                                        value="{{ old('email') }}"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 @error('email') border-red-400 @enderror" />
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Phone
                                    Number</label>
                                <input type="tel" name="phone" placeholder="+880 17XX-XXXXXX"
                                    value="{{ old('phone') }}"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20" />
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">I
                                    am looking to <span class="text-red-500">*</span></label>
                                <select name="inquiry_type" required
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 bg-white">
                                    <option value="" disabled selected>Select your inquiry type</option>
                                    <option value="Buy a Property"
                                        {{ old('inquiry_type') === 'Buy a Property' ? 'selected' : '' }}>Buy a Property
                                    </option>
                                    <option value="Construct a Building"
                                        {{ old('inquiry_type') === 'Construct a Building' ? 'selected' : '' }}>Construct a
                                        Building</option>
                                    <option value="General Inquiry"
                                        {{ old('inquiry_type') === 'General Inquiry' ? 'selected' : '' }}>General Inquiry
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Message
                                    <span class="text-red-500">*</span></label>
                                <textarea name="message" required rows="5"
                                    placeholder="Tell us about your project, preferred location, budget range, or any other requirements..."
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 resize-none @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full bg-brand hover:bg-brand-dark text-white font-heading font-bold py-4 rounded-xl transition-colors text-base tracking-wide flex items-center justify-center gap-2">
                                Send Message
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </button>

                            <p class="text-muted text-xs text-center">We respect your privacy. Your information is never
                                shared with third parties.</p>
                        </form>
                    </div>

                    {{-- Quick contact strips --}}
                    <div class="grid grid-cols-3 gap-3 mt-5">
                        @foreach ([
                            ['label' => 'Call Us', 'val' => '+880 1711-123456', 'href' => 'tel:+8801711123456', 'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],

                            ['label' => 'WhatsApp', 'val' => 'Chat Now', 'href' => 'https://wa.me/8801711123456', 'icon' => 'M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z M16.5 14c-.2-.1-1.2-.6-1.4-.7-.2-.1-.3-.1-.4.1-.2.3-.6.7-.8.9-.1.1-.3.1-.5 0a7 7 0 01-2.7-1.7 7.6 7.6 0 01-1.9-2.3c-.1-.3 0-.4.1-.5l.3-.4c.1-.1.2-.2.2-.3s.1-.2 0-.4c-.1-.2-.4-1-.6-1.4-.2-.4-.3-.3-.4-.3h-.4c-.2 0-.4.1-.6.3a3.3 3.3 0 00-1 2.4 5.7 5.7 0 001.2 3A13 13 0 0011 16.2c.4.2.8.3 1.1.3.5 0 1.5-.6 1.7-1.2.3-.7.3-1.2.2-1.3z'],

                            ['label' => 'Email', 'val' => 'Sales Team', 'href' => 'mailto:sales@mbuildtech.com.bd', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ] as $qc)
                            <a href="{{ $qc['href'] }}"
                                class="bg-white rounded-xl p-4 text-center border border-gray-100 hover:border-brand hover:shadow-sm transition-all">
                                <div class="w-9 h-9 bg-brand/10 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $qc['icon'] }}" />
                                    </svg>
                                </div>
                                <p class="font-heading font-bold text-dark text-xs">{{ $qc['label'] }}</p>
                                <p class="text-muted text-xs mt-0.5">{{ $qc['val'] }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
