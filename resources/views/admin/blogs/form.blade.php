@extends('admin.layouts.app')
@section('title', ($blog ?? null)?->exists ? 'Edit Blog' : 'Add New Blog')
@section('page-title', ($blog ?? null)?->exists ? 'Edit Blog' : 'Add New Blog')
@section('breadcrumb', 'Admin / Blogs / ' . (($blog ?? null)?->exists ? 'Edit' : 'Create'))

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

{{-- dynamic resource form route action fix --}}
<form action="{{ ($blog ?? null)?->exists ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(($blog ?? null)?->exists) 
        @method('PUT') 
    @endif

    {{-- ফর্ম গ্রিড কন্টেইনার --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- Main Fields --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Basic Info --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-heading font-bold text-dark text-base mb-5">Basic Information</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Blog Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $blog->title ?? '') }}" required placeholder="e.g. Top 10 Real Estate Trends in 2026"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 @error('title') border-red-400 @enderror"/>
                        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Category <span class="text-red-500">*</span></label>
                            <input type="text" name="category" value="{{ old('category', $blog->category ?? '') }}" required placeholder="e.g. Construction, Real Estate"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 @error('category') border-red-400 @enderror"/>
                        </div>
                        <div>
                            <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Author <span class="text-red-500">*</span></label>
                            <input type="text" name="author" value="{{ old('author', $blog->author ?? auth()->user()->name) }}" required placeholder="Author name"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 @error('author') border-red-400 @enderror"/>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Excerpt / Short Description <span class="text-red-500">*</span></label>
                        <textarea name="excerpt" rows="3" required placeholder="Brief summary of the blog post for listing cards..."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand resize-none">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Full Blog Content <span class="text-red-500">*</span></label>
                        <textarea name="content" rows="8" id="content-editor" placeholder="Write your full blog content here. Supports HTML tags."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand resize-none">{{ old('content', $blog->content ?? '') }}</textarea>
                        <p class="text-muted text-xs mt-1">Supports basic HTML. For rich editing, integrate a WYSIWYG editor (e.g. TinyMCE or Quill).</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Fields --}}
        <div class="space-y-5">

            {{-- Settings Box --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-heading font-bold text-dark text-base mb-4">Settings</h3>
                <div class="mb-4">
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-dark focus:outline-none focus:border-brand bg-white">
                        <option value="Published" {{ old('status', $blog->status ?? 'Published') === 'Published' ? 'selected' : '' }}>Published</option>
                        <option value="Draft" {{ old('status', $blog->status ?? 'Published') === 'Draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Featured Post?</label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $blog->is_featured ?? false) ? 'checked' : '' }} class="w-4 h-4 rounded accent-brand"/>
                        <span class="text-sm text-dark">Pin to Featured Section</span>
                    </label>
                </div>
            </div>

            {{-- Featured Image --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-heading font-bold text-dark text-base mb-4">Featured Image</h3>
                <div class="mb-3">
                    <img id="featured-preview" src="{{ (($blog ?? null)?->exists && $blog->featured_image) ? asset('storage/'.$blog->featured_image) : '' }}" class="w-full h-36 object-cover rounded-xl {{ (($blog ?? null)?->exists && $blog->featured_image) ? '' : 'hidden' }}"/>
                </div>
                <label class="block w-full border-2 border-dashed border-gray-200 rounded-xl p-6 text-center cursor-pointer hover:border-brand transition-colors">
                    <svg class="w-8 h-8 text-muted mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-sm text-muted">Click to upload featured image</span>
                    <span class="block text-xs text-muted/70 mt-1">PNG, JPG, WEBP up to 5MB</span>
                    <input type="file" name="featured_image" accept="image/*" class="hidden" onchange="previewSingleImage(this, 'featured-preview')"/>
                </label>
            </div>

            {{-- SEO --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-heading font-bold text-dark text-base mb-4">SEO Settings</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">URL Slug <span class="text-red-500">*</span></label>
                        <input type="text" name="slug" id="slug-field" value="{{ old('slug', $blog->slug ?? '') }}" required placeholder="top-10-real-estate-trends"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand font-mono"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $blog->meta_title ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand"/>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Meta Description</label>
                        <textarea name="meta_description" rows="2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand resize-none">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Published Date --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-heading font-bold text-dark text-base mb-4">Publish Date</h3>
                <div>
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Published Date <span class="text-red-500">*</span></label>
                    <input type="date" name="published_at" required
                        value="{{ old('published_at', (isset($blog->published_at) && $blog->published_at) ? \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d') : now()->format('Y-m-d')) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand bg-white"/>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 pt-5 border-t border-gray-100 flex items-center justify-end gap-3">
        <a href="{{ route('admin.blogs.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-200 text-sm font-semibold text-dark hover:bg-gray-50 transition-colors">
            Cancel Action
        </a>
        <button type="submit" class="px-8 py-2.5 rounded-xl bg-brand hover:bg-brand-dark text-white text-sm font-heading font-bold shadow-md shadow-brand/10 transition-colors">
            {{ ($blog ?? null)?->exists ? 'Save Blog Changes' : 'Publish New Blog' }}
        </button>
    </div>
</form>

@push('scripts')
<script>
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

// Auto-generate slug from title
document.querySelector('input[name="title"]')?.addEventListener('input', function() {
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