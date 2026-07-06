@extends('admin.layouts.app')
@section('title', ($faq ?? null)?->exists ? 'Edit FAQ' : 'Add New FAQ')
@section('page-title', ($faq ?? null)?->exists ? 'Edit FAQ' : 'Add New FAQ')
@section('breadcrumb', 'Admin / FAQs / ' . (($faq ?? null)?->exists ? 'Edit' : 'Create'))

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
<form action="{{ ($faq ?? null)?->exists ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}" method="POST">
    @csrf
    @if(($faq ?? null)?->exists) 
        @method('PUT') 
    @endif

    {{-- ফর্ম গ্রিড কন্টেইনার --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- Main Fields --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- FAQ Information --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-heading font-bold text-dark text-base mb-5">FAQ Information</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Question <span class="text-red-500">*</span></label>
                        <input type="text" name="question" value="{{ old('question', $faq->question ?? '') }}" required placeholder="e.g. What is the expected handover date?"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 @error('question') border-red-400 @enderror"/>
                        @error('question')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Answer <span class="text-red-500">*</span></label>
                        <textarea name="answer" rows="6" required placeholder="Provide a detailed answer to the question..."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-dark focus:outline-none focus:border-brand resize-none @error('answer') border-red-400 @enderror">{{ old('answer', $faq->answer ?? '') }}</textarea>
                        @error('answer')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
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
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Category <span class="text-red-500">*</span></label>
                    <input type="text" name="category" value="{{ old('category', $faq->category ?? '') }}" required placeholder="e.g. General, Payment, Project"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-dark focus:outline-none focus:border-brand @error('category') border-red-400 @enderror"/>
                    @error('category')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Sort Order</label>
                    <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $faq->sort_order ?? 0) }}" placeholder="0"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-dark focus:outline-none focus:border-brand"/>
                </div>
                <div class="mb-2">
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Active Status</label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active ?? false) ? 'checked' : '' }} class="w-4 h-4 rounded accent-brand"/>
                        <span class="text-sm text-dark">Show this FAQ on the website</span>
                    </label>
                </div>
            </div>

            {{-- Metadata Box --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-heading font-bold text-dark text-base mb-4">Metadata</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Created</label>
                        <p class="text-sm text-muted">{{ ($faq ?? null)?->exists ? \Carbon\Carbon::parse($faq->created_at)->format('M d, Y h:i A') : 'Will be created upon save' }}</p>
                    </div>
                    @if(($faq ?? null)?->exists && $faq->updated_at)
                    <div>
                        <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Last Updated</label>
                        <p class="text-sm text-muted">{{ \Carbon\Carbon::parse($faq->updated_at)->format('M d, Y h:i A') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 pt-5 border-t border-gray-100 flex items-center justify-end gap-3">
        <a href="{{ route('admin.faqs.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-200 text-sm font-semibold text-dark hover:bg-gray-50 transition-colors">
            Cancel Action
        </a>
        <button type="submit" class="px-8 py-2.5 rounded-xl bg-brand hover:bg-brand-dark text-white text-sm font-heading font-bold shadow-md shadow-brand/10 transition-colors">
            {{ ($faq ?? null)?->exists ? 'Update FAQ' : 'Create New FAQ' }}
        </button>
    </div>
</form>
@endsection