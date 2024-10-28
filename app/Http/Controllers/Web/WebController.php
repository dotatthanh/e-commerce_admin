<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function search(Request $request)
    {
        $data = Product::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(12)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
        ];

        return view('web.page.search', $data);
    }
}
