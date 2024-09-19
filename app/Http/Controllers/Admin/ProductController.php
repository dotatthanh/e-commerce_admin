<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use App\Models\Variant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Product::query();
        if ($request->search) {
            $data = $data->where('name', 'like', '%'.$request->search.'%');
        }
        $data = $data->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
        ];

        return view('admin.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $data = [
            'suppliers' => $suppliers,
            'categories' => $categories,
        ];

        return view('admin.product.create', $data);
    }

    public function uploadImageDetails(Request $request)
    {
        $data = [];
        foreach ($request->file as $file) {
            $data[] = $this->uploadImage($file, 'product/detail');
        }

        return $this->responseSuccess(Response::HTTP_OK, $data, 'ngon');
    }

    private function uploadImage(UploadedFile $file, $dirPath)
    {
        $name = time().'_'.$file->getClientOriginalName();
        Storage::disk('public_uploads')->putFileAs($dirPath, $file, $name);

        return 'uploads/'.$dirPath.'/'.$name;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $params = $request->all();
            $params['file_path'] = $this->uploadImage($request->file_path, 'product');
            $product = Product::create($params);

            // product category
            $product->categories()->attach($request->categories);

            // product image
            $this->createProductImage($request->product_images, $product->id);

            // variants
            $this->syncVariantsWithProduct($product, $request->variants);

            DB::commit();

            return redirect()->route('products.index')->with('alert-success', 'Thêm sản phẩm thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Thêm sản phẩm thất bại!');
        }
    }

    private function createProductImage($productImages, $productId)
    {
        foreach ($productImages as $filePath) {
            ProductImage::create([
                'file_path' => $filePath,
                'product_id' => $productId,
            ]);
        }
    }

    private function syncVariantsWithProduct($product, $variants)
    {
        foreach ($variants as $item) {
            $item['size'] = strtoupper($item['size']);
            $variant = Variant::where($item)->first();

            if (is_null($variant)) {
                $variant = Variant::create($item);
            }

            // tạo quan hệ product - variant
            $product->variants()->attach($variant->id);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            $product->delete();

            DB::commit();

            return redirect()->route('products.index')->with('alert-success', 'Xóa sản phẩm thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Xóa sản phẩm thất bại!');
        }
    }
}
