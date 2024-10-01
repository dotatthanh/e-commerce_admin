<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use App\Models\Product;

class ImportOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = ImportOrder::paginate(10);

        if ($request->code) {
            $data = ImportOrder::where('code', $request->code)->paginate(10);
        }

        $data = [
            'data' => $data,
            'request' => $request,
        ]; 

        return view('admin.import-order.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();

        $data = [
            'products' => $products,
            'suppliers' => $suppliers,
            // 'authors' => Author::all(),
            // 'types' => Type::all(),
            // 'categories' => Category::all(),
        ]; 

        return view('admin.import-order.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        DB::beginTransaction();
        try {
            // tạo đơn nhập hàng
            $import_order = ImportOrder::create([
                'code' => 'PN',
                'user_id' => Auth::id(),
                'supplier_id' => $request->supplier_id,
                'total_money' => 0,
            ]);

            $import_order->update([
                'code' => 'PN'.str_pad($import_order->id, 6, '0', STR_PAD_LEFT)
            ]);

            $total_money = 0;
            // tạo chi tiết đơn nhập hàng
            foreach ($request->book_id as $key => $book_id) {
                ImportOrderDetail::create([
                    'import_order_id' => $import_order->id,
                    'book_id' => $book_id,
                    'amount' => $request->amount[$key],
                    'price' => $request->price[$key],
                ]);

                $book = Product::findOrFail($book_id);
                $book->update([
                    'amount' => $book->amount + $request->amount[$key],
                ]);

                $total = $request->amount[$key] * $request->price[$key];
                $total_money += $total;
            }

            $import_order->update([
                'total_money' => $total_money
            ]);

            DB::commit();
            return redirect()->route('warehouses.index')->with('alert-success', 'Nhập hàng thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Nhập hàng thất bại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $import_order_details = ImportOrderDetail::where('import_order_id', $id)->paginate(10);

        $data = [
            'import_order_details' => $import_order_details
        ];

        return view('admin.import-order.import_order_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImportOrder $importOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImportOrder $importOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImportOrder $importOrder)
    {
        //
    }
}
