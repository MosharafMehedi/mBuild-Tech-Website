@extends('admin.layouts.app')
@section('title', isset($project) ? 'Edit Project' : 'Add New Project')
@section('page-title', isset($project) ? 'Edit Project' : 'Add New Project')
@section('breadcrumb', 'Admin / Projects / ' . (isset($project) ? 'Edit' : 'Create'))

@section('content')
@if($errors->any())
<div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
    <p class="font-semibold mb-1">Please fix the following errors:</p>
    <ul class="list-disc pl-5 space-y-1">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ isset($project) ? route('admin.projects.update', $project->id) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($project)) @method('PUT') @endif

    {{-- ফর্ম গ্রিড কন্টেইনার --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- Main Fields --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Basic Info --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-heading font-bold text-dark text-base mb-5">Basic Information</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Project Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $project->name ?? '') }}" required placeholder="e.g. mBuild Tower Dhanmondi"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 @error('name') border-red-400 @enderror"/>
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Classification <span class="text-red-500">*</span></label>
                            <select name="classification" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand bg-white">
                                @foreach(['residential' => 'Residential', 'commercial' => 'Commercial', 'industrial' => 'Industrial'] as $value => $label)
                                <option value="{{ $value }}" {{ old('classification', $project->classification ?? '') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Status <span class="text-red-500">*</span></label>
                            <select name="status" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand bg-white">
                                @foreach(['ongoing','completed','upcoming'] as $s)
                                <option value="{{ $s }}" {{ old('status', $project->status ?? '') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- ৩টি ফেজের প্রগ্রেস ট্র্যাকিং ফিল্ডস --}}
                    <div class="bg-gray-50/50 p-4 rounded-xl border border-gray-100">
                        <h4 class="text-xs font-heading font-bold text-dark uppercase tracking-wider mb-3">Construction Progress Stages (%)</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-[11px] font-heading font-semibold text-muted uppercase mb-1">Foundation</label>
                                <input type="number" name="progress_foundation" min="0" max="100" value="{{ old('progress_foundation', $project->progress_foundation ?? 0) }}"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand"/>
                            </div>
                            <div>
                                <label class="block text-[11px] font-heading font-semibold text-muted uppercase mb-1">Casting</label>
                                <input type="number" name="progress_casting" min="0" max="100" value="{{ old('progress_casting', $project->progress_casting ?? 0) }}"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand"/>
                            </div>
                            <div>
                                <label class="block text-[11px] font-heading font-semibold text-muted uppercase mb-1">Finishing</label>
                                <input type="number" name="progress_finishing" min="0" max="100" value="{{ old('progress_finishing', $project->progress_finishing ?? 0) }}"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand"/>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Short Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="3" required placeholder="Brief project description for listing cards..."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand resize-none">{{ old('description', $project->description ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Full Details / Body Content</label>
                        <textarea name="body" rows="6" id="body-editor" placeholder="Full project details, features, developer story..."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand resize-none">{{ old('body', $project->body ?? '') }}</textarea>
                        <p class="text-muted text-xs mt-1">Supports basic HTML. For rich editing, integrate a WYSIWYG editor (e.g. TinyMCE or Quill).</p>
                    </div>
                </div>
            </div>

            {{-- Location & Specs --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-heading font-bold text-dark text-base mb-5">Location & Specifications</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Location Area <span class="text-red-500">*</span></label>
                        <select name="location" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand bg-white">
                            <option value="">Select Location</option>
                            @foreach(['Dhanmondi','Gulshan','Uttara','Mirpur','Bashundhara','Mohammadpur','Banani','Baridhara'] as $loc)
                            <option value="{{ $loc }}" {{ old('location', $project->location ?? '') === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Full Address</label>
                        <input type="text" name="address" value="{{ old('address', $project->address ?? '') }}" placeholder="House, Road, Area, Dhaka"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Plot Size</label>
                        <input type="text" name="plot_size" value="{{ old('plot_size', $project->plot_size ?? '') }}" placeholder="e.g. 18 Katha"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Number of Floors</label>
                        <input type="number" name="floors" value="{{ old('floors', $project->floors ?? '') }}" placeholder="e.g. 28"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Total Units</label>
                        <input type="number" name="units" value="{{ old('units', $project->units ?? '') }}" placeholder="e.g. 112"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Apartment Size Range</label>
                        <input type="text" name="size_range" value="{{ old('size_range', $project->size_range ?? '') }}" placeholder="e.g. 1400–2800 sqft"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Price Range</label>
                        <input type="text" name="price_range" value="{{ old('price_range', $project->price_range ?? '') }}" placeholder="e.g. Tk. 1.8Cr – 4.2Cr"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Expected Handover Date</label>
                        <input type="date" name="handover_date" value="{{ old('handover_date', isset($project->handover_date) ? \Carbon\Carbon::parse($project->handover_date)->format('Y-m-d') : '') }}"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand bg-white"/>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">RAJUK Approval Number</label>
                        <input type="text" name="rajuk_no" value="{{ old('rajuk_no', $project->rajuk_no ?? '') }}" placeholder="e.g. B/1235/2024"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand"/>
                    </div>
                </div>
            </div>

            {{-- Amenities --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-heading font-bold text-dark text-base mb-5">Features & Amenities</h3>
                <div id="amenities-list" class="space-y-2 mb-3">
                    @php
                        $savedAmenities = old('amenities', (isset($project->amenities) && is_array($project->amenities)) ? $project->amenities : (json_decode($project->amenities ?? '[]', true) ?: ['High-Speed Passenger Lifts','100 KVA Generator','Rooftop Lounge']));
                    @endphp
                    @foreach($savedAmenities as $amenity)
                    <div class="flex items-center gap-2">
                        <input type="text" name="amenities[]" value="{{ $amenity }}"
                            class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand"/>
                        <button type="button" onclick="this.parentElement.remove()" class="w-8 h-8 flex items-center justify-center text-red-400 hover:bg-red-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    @endforeach
                </div>
                <button type="button" onclick="addAmenity()" class="flex items-center gap-2 text-brand font-semibold text-sm hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Add Amenity
                </button>
            </div>
        </div>

        {{-- Sidebar Fields --}}
        <div class="space-y-5">

            {{-- Settings Box --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-heading font-bold text-dark text-base mb-4">Settings</h3>
                <div class="mb-4">
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Visibility</label>
                    <select name="visibility" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-dark focus:outline-none focus:border-brand bg-white">
                        <option value="public" {{ old('visibility', $project->visibility ?? 'public') === 'public' ? 'selected' : '' }}>Public</option>
                        <option value="draft" {{ old('visibility', $project->visibility ?? 'public') === 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Featured Project?</label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }} class="w-4 h-4 rounded accent-brand"/>
                        <span class="text-sm text-dark">Show in Featured Showcase</span>
                    </label>
                </div>
            </div>

            {{-- Cover Image --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-heading font-bold text-dark text-base mb-4">Cover Image</h3>
                <div class="mb-3">
                    <img id="cover-preview" src="{{ (isset($project) && $project->cover_image) ? asset('storage/'.$project->cover_image) : '' }}" class="w-full h-36 object-cover rounded-xl {{ (isset($project) && $project->cover_image) ? '' : 'hidden' }}"/>
                </div>
                <label class="block w-full border-2 border-dashed border-gray-200 rounded-xl p-6 text-center cursor-pointer hover:border-brand transition-colors">
                    <svg class="w-8 h-8 text-muted mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-sm text-muted">Click to upload cover image</span>
                    <span class="block text-xs text-muted/70 mt-1">PNG, JPG, WEBP up to 5MB</span>
                    <input type="file" name="cover_image" accept="image/*" class="hidden" onchange="previewSingleImage(this, 'cover-preview')"/>
                </label>
            </div>

            {{-- Gallery --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-heading font-bold text-dark text-base mb-4">Project Gallery</h3>
                
                <div id="gallery-preview-container" class="grid grid-cols-3 gap-2 mb-3">
                    @if(isset($project) && $project->gallery)
                        @php
                            $galleryImages = is_array($project->gallery) ? $project->gallery : (json_decode($project->gallery, true) ?: []);
                        @endphp
                        @foreach($galleryImages as $img)
                            <img src="{{ asset('storage/'.$img) }}" class="w-full h-16 object-cover rounded-md border border-gray-100" />
                        @endforeach
                    @endif
                </div>

                <label class="block w-full border-2 border-dashed border-gray-200 rounded-xl p-5 text-center cursor-pointer hover:border-brand transition-colors">
                    <svg class="w-7 h-7 text-muted mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-xs text-muted">Upload multiple images</span>
                    <input type="file" name="gallery[]" id="gallery-input" accept="image/*" multiple class="hidden" onchange="previewMultipleImages(this, 'gallery-preview-container')"/>
                </label>
            </div>

            {{-- SEO --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-heading font-bold text-dark text-base mb-4">SEO Settings</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">URL Slug</label>
                        <input type="text" name="slug" id="slug-field" value="{{ old('slug', $project->slug ?? '') }}" placeholder="mbuild-tower-dhanmondi"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand font-mono"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $project->meta_title ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Meta Description</label>
                        <textarea name="meta_description" rows="2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand resize-none">{{ old('meta_description', $project->meta_description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 pt-5 border-t border-gray-100 flex items-center justify-end gap-3">
        <a href="{{ route('admin.projects.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-200 text-sm font-semibold text-dark hover:bg-gray-50 transition-colors">
            Cancel Action
        </a>
        <button type="submit" class="px-8 py-2.5 rounded-xl bg-brand hover:bg-brand-dark text-white text-sm font-heading font-bold shadow-md shadow-brand/10 transition-colors">
            {{ isset($project) ? 'Save Project Changes' : 'Publish New Project' }}
        </button>
    </div>
</form>

@push('scripts')
<script>
function addAmenity() {
    const div = document.createElement('div');
    div.className = 'flex items-center gap-2';
    div.innerHTML = `<input type="text" name="amenities[]" placeholder="e.g. Swimming Pool"
        class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand"/>
        <button type="button" onclick="this.parentElement.remove()" class="w-8 h-8 flex items-center justify-center text-red-400 hover:bg-red-50 rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>`;
    document.getElementById('amenities-list').appendChild(div);
    div.querySelector('input').focus();
}

function previewSingleImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { 
            preview.src = e.target.result; 
            preview.classList.remove('hidden'); 
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewMultipleImages(input, containerId) {
    const container = document.getElementById(containerId);
    container.innerHTML = ""; 

    if (input.files) {
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = "w-full h-16 object-cover rounded-md border border-gray-100 shadow-sm";
                container.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    }
}

// Auto-generate slug from name
document.querySelector('input[name="name"]')?.addEventListener('input', function() {
    const slugField = document.getElementById('slug-field');
    if (slugField && !slugField.dataset.manual) {
        slugField.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    }
});
document.getElementById('slug-field')?.addEventListener('input', function() {
    this.dataset.manual = 'true';
});
</script>
@endpush
@endsection