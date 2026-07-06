<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('question', 'like', '%' . $request->search . '%')
                  ->orWhere('answer', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $faqs = $query->orderBy('sort_order')->paginate(15);
        $categories = Faq::distinct()->pluck('category')->filter();
        
        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    public function publicIndex(Request $request)
    {
        $query = Faq::where('is_active', true)->orderBy('sort_order');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $faqs = $query->get();
        $categories = Faq::where('is_active', true)->distinct()->pluck('category')->filter();
        
        return view('faq.index', compact('faqs', 'categories'));
    }

    public function create()
    {
        $faq = new Faq();
        return view('admin.faqs.form', compact('faq'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question'   => 'required|string|max:500',
            'answer'     => 'required|string',
            'category'   => 'required|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        
        if (empty($validated['sort_order'])) {
            $validated['sort_order'] = Faq::max('sort_order') + 1;
        }

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully!');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.form', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $validated = $request->validate([
            'question'   => 'required|string|max:500',
            'answer'     => 'required|string',
            'category'   => 'required|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully!');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return back()->with('success', 'FAQ deleted successfully!');
    }

public function toggle($id)
{
    $faq = Faq::findOrFail($id);
    
    $faq->update([
        'is_active' => !$faq->is_active
    ]);

    return back()->with('success', 'FAQ status updated successfully!');
}
}