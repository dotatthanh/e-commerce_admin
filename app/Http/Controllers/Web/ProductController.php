<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail(Category $category, Product $product)
    {
        $data = [
            'product' => $product,
            'category' => $category,
        ];

        return view('web.page.product-detail', $data);
    }
}
