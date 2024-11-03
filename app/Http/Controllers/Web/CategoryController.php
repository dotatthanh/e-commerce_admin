<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function detail(Category $category)
    {
        $products = $category->products->with('productVariants');

        $data = [
            'category' => $category,
            'data' => $products,
        ];

        return view('web.page.category', $data);
    }
}
