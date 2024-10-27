<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class WebController extends Controller
{
    public function search(Request $request)
    {
        $data = Product::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(1)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
        ];

        return view('web.page.search', $data);
    }
}
