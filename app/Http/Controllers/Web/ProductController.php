<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function detail(Category $category, Product $product)
    {
        $otherProducts = Product::where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        $data = [
            'product' => $product->load('variants'),
            'category' => $category,
            'otherProducts' => $otherProducts,
        ];

        return view('web.page.product-detail', $data);
    }

    public function getVariantsByColorCode(Request $request)
    {
        $data = ProductVariant::with('variant')
            ->where('product_id', $request->product_id)
            ->whereHas('variant', function ($query) use ($request) {
                $query->where('color_code', $request->color_code);
            })
            ->select('id', 'product_id', 'variant_id', 'quantity')
            ->get();

        return $this->responseSuccess(Response::HTTP_OK, $data);
    }
}
