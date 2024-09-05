<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        try {

            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                // Check user role
                $user = Auth::user();

                if ($user->email_verified_at && $user->status === 1) {
                    // Log successful login
                    Log::info('Login success', [
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'request_data' => $request->all()
                    ]);

                    if ($user->roles->contains('name', 'admin')) {
                        return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
                    }

                    return redirect()->route('home');
                }

                Auth::logout();
                return redirect()->back()->with('error', 'Tài khoản chưa được kích hoạt, vui lòng thử lại');
            }

            return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng');

        } catch (\Exception $e) {
            Log::error('Error login', [
                'exception_message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function logOut()
    {
        if (Auth::check()) {
            Log::info('Logout success', [
                'user_id' => Auth::user()->id,
                'email' => Auth::user()->email
            ]);

            Auth::logout();

            request()->session()->invalidate();

            return redirect()->route('auth.login')->with('success', 'Đăng xuất thành công');
        }

    }
}
