@extends('admin.layouts.app')
@section('title', ($metric ?? null)?->exists ? 'Edit Metric' : 'Add New Metric')
@section('page-title', ($metric ?? null)?->exists ? 'Edit Metric' : 'Add New Metric')
@section('breadcrumb', 'Admin / Metrics / ' . (($metric ?? null)?->exists ? 'Edit' : 'Create'))

@section('content')

<div class="min-h-screen bg-light">

    <!-- Content -->
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <form action="{{ isset($metric) ? route('admin.metrics.update', $metric->id) : route('admin.metrics.store') }}" method="POST">
                @csrf
                @if(isset($metric))
                    @method('PUT')
                @endif

                <!-- Label -->
                <div class="mb-6">
                    <label class="block text-sm font-heading font-semibold text-muted uppercase tracking-wider mb-2">
                        Label <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="label" required placeholder="e.g., Years of Excellence"
                        value="{{ old('label', $metric->label ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 @error('label') border-red-400 @enderror">
                    @error('label')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Value -->
                <div class="mb-6">
                    <label class="block text-sm font-heading font-semibold text-muted uppercase tracking-wider mb-2">
                        Value <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="value" required placeholder="e.g., 15"
                        value="{{ old('value', $metric->value ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 @error('value') border-red-400 @enderror">
                    @error('value')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Suffix -->
                <div class="mb-6">
                    <label class="block text-sm font-heading font-semibold text-muted uppercase tracking-wider mb-2">
                        Suffix <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="suffix" required placeholder="e.g., +, %, M+"
                        value="{{ old('suffix', $metric->suffix ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 @error('suffix') border-red-400 @enderror">
                    @error('suffix')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon SVG Path -->
                <div class="mb-6">
                    <label class="block text-sm font-heading font-semibold text-muted uppercase tracking-wider mb-2">
                        Icon SVG Path <span class="text-red-500">*</span>
                    </label>
                    <textarea name="icon" required rows="4" placeholder="Paste SVG path here (from: https://heroicons.com/)"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 font-mono resize-none @error('icon') border-red-400 @enderror">{{ old('icon', $metric->icon ?? '') }}</textarea>
                    <p class="text-muted text-xs mt-2">Get SVG paths from <a href="https://heroicons.com/" target="_blank" class="text-brand hover:underline">Heroicons.com</a></p>
                    @error('icon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div class="mb-6">
                    <label class="block text-sm font-heading font-semibold text-muted uppercase tracking-wider mb-2">
                        Sort Order
                    </label>
                    <input type="number" name="sort_order" placeholder="0" min="0"
                        value="{{ old('sort_order', $metric->sort_order ?? 0) }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20">
                </div>

                <!-- Preview -->
                @if($metric ?? null)
                <div class="mb-8 p-6 bg-light rounded-lg border border-brand/20">
                    <p class="text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-3">Preview</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-brand/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $metric->icon }}"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-muted text-sm">{{ $metric->label }}</p>
                            <p class="font-heading font-black text-3xl text-brand">{{ $metric->value }}{{ $metric->suffix }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.metrics.index') }}" class="text-muted hover:text-dark font-semibold">
                        ← Back to Metrics
                    </a>
                    <button type="submit" class="bg-brand hover:bg-brand-dark text-white font-heading font-semibold px-8 py-3 rounded-lg transition-colors">
                        {{ isset($metric) ? 'Update Metric' : 'Create Metric' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
