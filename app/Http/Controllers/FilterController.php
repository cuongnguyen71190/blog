<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        $results = Post::search([
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'status' => $request->status,
            'only_date' => $request->only_date
        ])->get();

        return view('filter.index', compact('results'));
    }
}
