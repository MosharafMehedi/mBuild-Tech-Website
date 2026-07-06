<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('is_active', true)
                   ->orderBy('sort_order', 'asc')
                   ->get();

        return view('home', compact('faqs'));
    }
}