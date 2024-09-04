<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const PATH_UPLOAD = 'users';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý người dùng';
        $subtitle = 'Danh sách';
        $users = User::with('roles')->latest('id')->get();
        return view('backend.user.index', compact([
            'title', 'subtitle', 'users'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lý người dùng';
        $subtitle = 'Thêm mới';
        $roles = Role::query()->where('status', 1)->get();

        return view('backend.user.create', compact([
            'title', 'subtitle', 'roles'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|min:10|max:11|unique:users',
            'avatar' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'role_id' => 'required|in:' . implode(',', Role::pluck('id')->toArray()),
            'status' => 'required|in:1,0',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->except('avatar');

            if (!empty($request->hasFile('avatar'))) {
                $data['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));
            }

            $data['email_verified_at'] = now();

            $user = User::query()->create($data);

            if (!empty($data['role_id'])) {
                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => $data['role_id']
                ]);
            }

            DB::commit();

            Log::info('User created sucessfully', [
                'request_data' => $request->all()
            ]);

            return redirect()->route('admin.users.index')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            DB::rollBack();

            if (!empty($data['avatar']) && Storage::exists($data['avatar'])) {
                Storage::delete($data['avatar']);
            }

            Log::error('Error create user', [
                'exception_message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::query()->findOrFail($id);
        $title = 'Quản lý người dùng';
        $subtitle = 'Cập nhật người dùng: ' . $user->name;
        $roles = Role::query()->where('status', 1)->get();

        return view('backend.user.edit', compact([
            'user', 'title', 'subtitle', 'roles'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::query()->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'phone' => 'required|string|min:10|max:11|unique:users,phone,' . $id,
            'avatar' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'role_id' => 'required|in:' . implode(',', Role::pluck('id')->toArray()),
            'status' => 'required|in:1,0',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->except('avatar');

            if (!empty($request->hasFile('avatar'))) {
                if (!empty($user['avatar']) && Storage::exists($user['avatar'])) {
                    Storage::delete($user['avatar']);
                }
                $data['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));
            } else {
                $data['avatar'] = $user->avatar;
            }

            $data['password'] = !empty($request->password) ? bcrypt($request->password) : $user->password;

            $user->update($data);

            if (!empty($data['role_id'])) {
                UserRole::query()->where('user_id', $user->id)->delete();
                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => $data['role_id']
                ]);
            }

            DB::commit();

            Log::info('User update sucessfully', [
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            DB::rollBack();

            if (!empty($data['avatar']) && Storage::exists($data['avatar'])) {
                Storage::delete($data['avatar']);
            }

            Log::error('Error update user', [
                'exception_message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
