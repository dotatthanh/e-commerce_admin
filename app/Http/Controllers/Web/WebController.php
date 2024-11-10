<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    {
        $newProducts = Product::orderBy('id', 'desc')->limit(4)->get();
        $bestSellingProducts = Product::select('products.*', DB::raw('SUM(order_details.quantity) as best_selling'))
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('order_details', 'product_variants.id', '=', 'order_details.product_variant_id')
            ->groupBy('products.id')
            ->orderByDesc('best_selling')
            ->take(4)
            ->get();

        $suggestedProducts = $this->getSuggestedProducts();

        $data = [
            'newProducts' => $newProducts,
            'bestSellingProducts' => $bestSellingProducts,
            'suggestedProducts' => $suggestedProducts,
        ];

        return view('web.page.home', $data);
    }

    private function getSuggestedProducts()
    {
        $suggestedProducts = Product::query();

        if (auth()->guard('web')->check()) {
            $search = Search::firstWhere('customer_id', auth()->guard('web')->id());
            if ($search) {
                $suggestedProducts = $suggestedProducts->whereIn('name', $search->key_search);
            } else {
                $suggestedProducts = $suggestedProducts->inRandomOrder();
            }
        } else {
            $suggestedProducts = $suggestedProducts->inRandomOrder();
        }

        return $suggestedProducts->take(4)->get();
    }

    public function search(Request $request)
    {
        if (auth()->guard('web')->check()) {
            $search = Search::firstWhere('customer_id', auth()->guard('web')->id());
            if ($search) {
                $keySearch = $search->key_search;

                if (! in_array($request->search, $keySearch)) {
                    $keySearch[] = $request->search;

                    $search->update(['key_search' => $keySearch]);
                }
            } else {
                Search::create([
                    'key_search' => [$request->search],
                    'customer_id' => auth()->guard('web')->id(),
                ]);
            }
        }

        $data = Product::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(12)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
        ];

        return view('web.page.search', $data);
    }

    public function privacyPolicy()
    {
        return view('web.page.privacy-policy');
    }

    public function purchasePolicy()
    {
        return view('web.page.purchase-policy');
    }
}
