<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use Illuminate\Http\Request;

class MetricController extends Controller
{
    public function index()
    {
        $metrics = Metric::orderBy('sort_order')->get();
        return view('admin.metrics.index', compact('metrics'));
    }

    public function create()
    {
        return view('admin.metrics.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label'      => 'required|string|max:255',
            'value'      => 'required|string|max:50',
            'suffix'     => 'required|string|max:10',
            'icon'       => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        Metric::create($validated);

        return redirect()->route('admin.metrics.index')->with('success', 'Metric created successfully!');
    }

    public function edit($id)
    {
        $metric = Metric::findOrFail($id);
        return view('admin.metrics.form', compact('metric'));
    }

    public function update(Request $request, $id)
    {
        $metric = Metric::findOrFail($id);

        $validated = $request->validate([
            'label'      => 'required|string|max:255',
            'value'      => 'required|string|max:50',
            'suffix'     => 'required|string|max:10',
            'icon'       => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        $metric->update($validated);

        return redirect()->route('admin.metrics.index')->with('success', 'Metric updated successfully!');
    }

    public function destroy($id)
    {
        $metric = Metric::findOrFail($id);
        $metric->delete();

        return back()->with('success', 'Metric deleted successfully!');
    }
}
