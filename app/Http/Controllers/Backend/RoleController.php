<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Phân quyền';
        $subtitle = 'Danh sách';
        $roles = Role::query()->latest('id')->get();

        return view('backend.role.index', compact([
            'title', 'subtitle', 'roles'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:1,0',
        ]);

        try {
            Role::create($request->all());

            Log::info('Role created sucessfully', [
                'name' => $request->name,
                'status' => $request->status
            ]);

            return redirect()->back()->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            Log::error('Error create role', [
                'exception_message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::query()->latest('id')->get();

        $role = Role::query()->findOrFail($id);
        $title = 'Phân quyền';
        $subtitle = 'Cập nhât: ' . $role->name;

        return view('backend.role.edit', compact([
            'title', 'subtitle', 'role', 'roles'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::query()->findOrFail($id);

        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'status' => 'required|in:1,0',
        ]);

        try {
            $role->update($request->all());

            Log::info('Role update sucessfully', [
                'name' => $request->name,
                'status' => $request->status
            ]);

            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Error update role', [
                'exception_message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

}
