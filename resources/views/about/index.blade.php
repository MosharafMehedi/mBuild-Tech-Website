@extends('layouts.app')
@section('title', 'About Us – mBuild Tech')
@section('meta_desc', 'Learn about mBuild Tech – our mission, leadership, certifications and QHSE policy.')

@section('content')

{{-- Page Hero --}}
<section class="relative bg-dark-2 pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1600&q=80" class="w-full h-full object-cover"/>
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-dark-2/95 to-dark-2/60"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-3">Who We Are</p>
        <h1 class="font-heading font-black text-4xl md:text-5xl text-white mb-4">About mBuild Tech</h1>
        <nav class="flex items-center gap-2 text-sm text-white/50">
            <a href="{{ route('home') }}" class="hover:text-brand transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">About Us</span>
        </nav>
    </div>
</section>


{{-- ===== SECTION 1: Company Overview & Mission/Vision ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center fade-in">
            <div>
                <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-3">Our Story</p>
                <h2 class="font-heading font-black text-3xl md:text-4xl text-dark mb-6 leading-tight">Building Bangladesh's Future, One Structure at a Time</h2>
                <p class="text-muted leading-relaxed mb-5">Founded over 15 years ago, mBuild Tech has grown from a boutique structural firm into one of Bangladesh's most trusted names in construction and real estate development. We have delivered over 4.2 million square feet of residential, commercial, and industrial space across Dhaka and beyond.</p>
                <p class="text-muted leading-relaxed mb-8">Our commitment to engineering excellence, transparent client relationships, and regulatory compliance has earned us the trust of thousands of families and hundreds of corporate partners nationwide.</p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    @php $pillars = [
                        ['title'=>'Our Vision',   'text'=>'To be the most trusted construction and real estate brand in South Asia by 2030.'],
                        ['title'=>'Our Mission',  'text'=>'To deliver structurally superior, aesthetically refined, and regulatory-compliant built environments.'],
                        ['title'=>'Our Values',   'text'=>'Integrity, Innovation, Safety, Sustainability, and Client-First Excellence.'],
                    ]; @endphp
                    @foreach($pillars as $p)
                    <div class="border-l-4 border-brand pl-4">
                        <h4 class="font-heading font-bold text-dark text-sm mb-1.5">{{ $p['title'] }}</h4>
                        <p class="text-muted text-xs leading-relaxed">{{ $p['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=800&q=80" alt="mBuild Tech office" class="rounded-2xl w-full h-[420px] object-cover shadow-xl"/>
                <div class="absolute -bottom-6 -left-6 bg-brand text-white rounded-2xl p-5 shadow-xl">
                    <div class="font-heading font-black text-3xl">15+</div>
                    <div class="text-white/80 text-sm mt-1">Years of Excellence</div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ===== SECTION 2: MD Leadership Message ===== --}}
<section class="py-20 bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 fade-in">
            <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-2">Leadership</p>
            <h2 class="font-heading font-black text-3xl md:text-4xl text-dark">Message from the Managing Director</h2>
        </div>
        <div class="max-w-4xl mx-auto fade-in">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="bg-dark-2 p-8 flex flex-col items-center justify-center text-center">
                        <div class="w-28 h-28 rounded-full bg-brand/20 flex items-center justify-center mb-4 overflow-hidden border-4 border-brand/30">
                            <svg class="w-16 h-16 text-brand/50" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                        </div>
                        <h3 class="font-heading font-black text-white text-lg">Engr. Mohammad Hasan</h3>
                        <p class="text-brand text-sm font-semibold mt-1">Managing Director</p>
                        <p class="text-white/50 text-xs mt-1">B.Sc. Civil Engg., BUET</p>
                        <div class="flex gap-2 mt-4">
                            <a href="#" class="w-8 h-8 bg-white/10 hover:bg-brand rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/></svg>
                            </a>
                        </div>
                    </div>
                    <div class="md:col-span-2 p-8 md:p-10 flex flex-col justify-center">
                        <svg class="w-10 h-10 text-brand/20 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                        <p class="text-dark/80 leading-relaxed text-base italic mb-5">"At mBuild Tech, we don't just build structures — we build trust, legacies, and the very fabric of Bangladesh's urban landscape. Every project we undertake carries the weight of our clients' dreams and our nation's future. Our engineers, architects, and project teams are united by one unwavering principle: excellence without compromise."</p>
                        <p class="text-muted text-sm leading-relaxed">"Over the past 15 years, we have delivered landmark residential towers, commercial hubs, and industrial facilities that stand as testaments to precision engineering and aesthetic vision. As Managing Director, I personally ensure that every structure bearing the mBuild Tech name meets the highest standards of structural integrity, regulatory compliance, and client satisfaction."</p>
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <p class="font-heading font-bold text-dark">Engr. Mohammad Hasan</p>
                            <p class="text-muted text-sm">Managing Director, mBuild Tech</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ===== SECTION 3: Board of Directors & Key Management ===== --}}
<section id="leadership" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 fade-in">
            <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-2">Leadership Team</p>
            <h2 class="font-heading font-black text-3xl md:text-4xl text-dark">Board of Directors & Key Management</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 fade-in">
            @php
            $team = [
                ['name'=>'Engr. Mohammad Hasan',   'role'=>'Managing Director',          'dept'=>'Leadership',   'edu'=>'B.Sc. Civil Engg., BUET'],
                ['name'=>'Arch. Nafisa Rahman',    'role'=>'Chief Architect',             'dept'=>'Design',       'edu'=>'M.Arch, BRAC University'],
                ['name'=>'Engr. Tanvir Ahmed',     'role'=>'Chief Engineer',              'dept'=>'Engineering',  'edu'=>'M.Sc. Structural Engg.'],
                ['name'=>'Ms. Rumana Akter',       'role'=>'Chief Financial Officer',     'dept'=>'Finance',      'edu'=>'MBA, IBA Dhaka'],
                ['name'=>'Mr. Kamal Hossain',      'role'=>'Director, Sales & Marketing', 'dept'=>'Sales',        'edu'=>'BBA, NSU'],
                ['name'=>'Engr. Shafiqul Islam',   'role'=>'Project Director',            'dept'=>'Operations',   'edu'=>'B.Sc. Civil Engg., CUET'],
                ['name'=>'Ms. Sharmin Sultana',    'role'=>'Head of Legal & Compliance',  'dept'=>'Legal',        'edu'=>'LLB, Dhaka University'],
                ['name'=>'Mr. Rezaul Karim',       'role'=>'Head of Procurement',         'dept'=>'Procurement',  'edu'=>'B.Sc. Engg., RUET'],
            ];
            @endphp
            @foreach($team as $member)
            <div class="bg-light rounded-2xl p-6 text-center border border-gray-100 hover:border-brand/30 hover:shadow-md transition-all group">
                <div class="w-20 h-20 rounded-full bg-brand/10 flex items-center justify-center mx-auto mb-4 group-hover:bg-brand/20 transition-colors">
                    <span class="font-heading font-black text-brand text-2xl">{{ substr($member['name'], strpos($member['name'], ' ')+1, 1) }}</span>
                </div>
                <h3 class="font-heading font-bold text-dark text-sm leading-snug">{{ $member['name'] }}</h3>
                <p class="text-brand font-semibold text-xs mt-1 mb-1">{{ $member['role'] }}</p>
                <p class="text-muted text-xs mb-3">{{ $member['edu'] }}</p>
                <a href="#" class="inline-flex items-center gap-1.5 text-xs text-muted hover:text-brand transition-colors font-medium">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/></svg>
                    LinkedIn
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ===== SECTION 4: Corporate Governance & Certifications ===== --}}
<section class="py-20 bg-dark-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 fade-in">
            <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-2">Trust & Compliance</p>
            <h2 class="font-heading font-black text-3xl md:text-4xl text-white">Corporate Governance & Certifications</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5 fade-in">
            @php $certs = [
                ['name'=>'RAJUK Approved',     'desc'=>'All Dhaka projects hold full RAJUK development permission.',       'icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ['name'=>'REHAB Member',       'desc'=>'Active member of Real Estate & Housing Association of Bangladesh.', 'icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5'],
                ['name'=>'ISO 9001 Aligned',   'desc'=>'Quality management processes aligned with ISO 9001 standards.',    'icon'=>'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
                ['name'=>'BUET Lab Certified', 'desc'=>'All construction materials tested and certified at BUET labs.',    'icon'=>'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
            ]; @endphp
            @foreach($certs as $c)
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/15 hover:border-brand/50 transition-all">
                <div class="w-14 h-14 bg-brand/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $c['icon'] }}"/>
                    </svg>
                </div>
                <h4 class="font-heading font-bold text-white text-sm mb-2">{{ $c['name'] }}</h4>
                <p class="text-white/50 text-xs leading-relaxed">{{ $c['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ===== SECTION 5: QHSE Policy ===== --}}
<section id="quality" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center fade-in">
            <div>
                <p class="text-brand font-heading font-semibold text-xs uppercase tracking-widest mb-3">Our Commitment</p>
                <h2 class="font-heading font-black text-3xl md:text-4xl text-dark mb-6 leading-tight">QHSE Policy<br><span class="text-brand">Quality · Health · Safety · Environment</span></h2>
                <p class="text-muted leading-relaxed mb-8">At mBuild Tech, QHSE is not a checklist — it is a culture. Every worker on our construction sites is trained, equipped, and empowered to uphold the highest standards of safety and quality.</p>

                <div class="space-y-5">
                    @php $qhse = [
                        ['title'=>'Quality Control',     'text'=>'Third-party material audits at every milestone. Only BUET-certified materials used. Structural drawings peer-reviewed by independent consultants.'],
                        ['title'=>'Health & Safety',     'text'=>'Mandatory PPE for all site personnel. Weekly toolbox talks. Incident reporting system. Zero-tolerance fatality policy across all sites.'],
                        ['title'=>'Environmental',       'text'=>'Responsible waste disposal, dust suppression systems, and noise control during construction. Green building features in all new designs.'],
                        ['title'=>'Regulatory Compliance','text'=>'Full RAJUK/CDA approval prior to ground-breaking. BNBC seismic standards enforced. REHAB code of conduct strictly followed.'],
                    ]; @endphp
                    @foreach($qhse as $item)
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-brand/10 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-dark text-sm mb-1">{{ $item['title'] }}</h4>
                            <p class="text-muted text-sm leading-relaxed">{{ $item['text'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&q=80" alt="Construction safety" class="rounded-2xl w-full h-44 object-cover"/>
                <img src="https://images.unsplash.com/photo-1565008576549-57569a49371d?w=400&q=80" alt="Quality check" class="rounded-2xl w-full h-44 object-cover mt-6"/>
                <img src="https://images.unsplash.com/photo-1518005020951-eccb494ad742?w=400&q=80" alt="Site inspection" class="rounded-2xl w-full h-44 object-cover -mt-6"/>
                <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=400&q=80" alt="Engineering" class="rounded-2xl w-full h-44 object-cover"/>
            </div>
        </div>
    </div>
</section>

@endsection
