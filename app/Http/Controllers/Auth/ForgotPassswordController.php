<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ForgotPassswordController extends Controller
{
    public function showFormForgotPassword()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.forgot-password');
    }

    public function handleForgotPassword(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            $user = User::where('email', $request->email)->first();
            $user->verification_token = Str::random(60);
            $user->save();

            \Mail::to($user->email)->send(new \App\Mail\UserForgotPassword($user));

            return redirect()->back()
                ->with('success', 'Yêu cầu thay đổi mật khẩu thành công, vui lòng kiểm tra email!');
        } catch (\Exception $e) {
            Log::error('Error Forgot Password', [
                'exception-message' => $e->getMessage(),
                'request' => $request->all(),
            ]);
        }
    }

    public function showFormResetPassword($token)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $token = User::query()->where('verification_token', $token)->first();

        if (!$token) {
            abort(404);
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    public function handleResetPassword(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|max:255',
            'confirmPassword' => 'required|same:password',
        ]);

        try {
            $user = User::query()->where('verification_token', $request->token)->first();
            $user->verification_token = null;
            $user->password = bcrypt($request->password);
            $user->save();

            Log::info('Reset Password Success', [
                'user' => $user,
                'data_request' => $request->all(),
            ]);

            return redirect()->route('auth.login')
                ->with('success', 'Thay đổi mật khẩu thành công!');
        } catch (\Exception $e) {
            Log::error('Error Reset Password', [
                'exception-message' => $e->getMessage(),
                'request' => $request->all(),
            ]);

            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }
}
