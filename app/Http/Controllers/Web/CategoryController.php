<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function detail(Request $request, Category $category)
    {
        $data = $category->products()
            ->when($request->from, function ($query, $from) {
                return $query->where('price', '>=', $from);
            })
            ->when($request->to, function ($query, $to) {
                return $query->where('price', '<=', $to);
            })
            ->when($request->order, function ($query, $order) {
                return $query->orderBy('price', $order);
            })
            ->paginate(4)->appends([
                'from' => $request->from,
                'to' => $request->to,
            ]);

        $data = [
            'category' => $category,
            'data' => $data,
        ];

        return view('web.page.category', $data);
    }
}
