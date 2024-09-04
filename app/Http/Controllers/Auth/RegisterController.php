<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showFormRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:255',
            'password_confirmation' => 'required|same:password',
        ]);

        try {
            $data = $request->all();
            $data['verification_token'] = Str::random(60);
            $user = User::create($data);

            if (!empty($user)) {
                $user->roles()->attach(Role::query()->where('name', 'member')
                    ->first());
            }

//            Auth::login($user); // tự login sau khi đăng ký thành công
//
//            $request->session()->regenerate();  // tự lưu session

            \Mail::to($user->email)->send(new \App\Mail\UserRegistered($user));

            Log::info('Register Success', [
                'request' => $request->all(),
            ]);

            return redirect()->route('auth.login')->with('success', 'Đăng ký tài khoản thành công!');

        } catch (\Exception $e) {
            Log::error('Error Register', [
                'exception-message' => $e->getMessage(),
                'request' => $request->all(),
            ]);

            return redirect()->back()->with(['error' => 'Đăng ký tài khoản thất bại, vui lòng thử lại']);
        }
    }

    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();

        try {
            $user->update([
                'email_verified_at' => now(),
                'verification_token' => null,
                'status' => 1
            ]);

            Log::info('Verify Email Success', [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);

            return redirect()->route('auth.login')
                ->with('success', 'Kích hoạt tài khoản thành công!');
        } catch (\Exception $e) {
            Log::error('Error Verify Email', [
                'exception-message' => $e->getMessage(),
                'user_id' => $user->id,
                'email' => $user->email,
            ]);

            return redirect()->route('auth.login')
                ->with(['error' => 'Kích hoạt tài khoản thất bại, vui lòng thử lại']);
        }
    }


}
