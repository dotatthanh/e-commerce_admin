<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $roles,
        ];

        return view('admin.permission.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        $data = [
            'role' => $role,
            'permissions' => $permissions,
        ];

        return view('admin.permission.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        $data = [
            'role' => $role,
            'permissions' => $permissions,
        ];

        return view('admin.permission.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $role = Role::findOrFail($id);

            $role->permissions()->detach();

            if (! empty($request->permissions)) {
                foreach ($request->permissions as $key => $value) {
                    $role->givePermissionTo($key);
                }
            }

            DB::commit();

            return redirect()->route('permissions.index')->with('alert-success', 'Cập nhật quyền thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Cập nhật quyền thất bại!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
