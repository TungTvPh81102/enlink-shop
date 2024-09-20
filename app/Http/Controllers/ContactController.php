<?php

namespace App\Http\Controllers;

use App\Mail\ContactRequestMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class ContactController extends Controller
{
    public function showFormContact()
    {
        $title = 'Liên hệ';
        return view('contact.page', compact('title'));
    }

    public function handleContact(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        try {
            $userId = Auth::check() ? Auth::user()->id : null;

            $data = [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'message' => $request->message,
                'user_id' => $userId
            ];

            if (empty($data)) {
                throw  new Exception('Có lỗi xảy ra, vui lòng thử lại');
            }

            Contact::create($data);

            \Mail::to($data['email'])->send(new ContactRequestMail($data));

            return redirect()->back()->with('success', 'Gửi yêu cầu thành công');
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'error_exception' => $e->getMessage(),
                'request-data' => $request->all()
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
