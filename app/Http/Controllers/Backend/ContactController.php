<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý liên hệ';
        $subtitle = 'Danh sách';

        $contacts = Contact::query()->latest('id')->get();

        return view('backend.contact.index', compact('title', 'subtitle', 'contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::query()->findOrFail($id);
        $title = 'Quản lý liên hệ';
        $subtitle = 'Liên hệ khách hàng: ' . $contact->full_name;

        return view('backend.contact.edit', compact('title', 'subtitle', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = Contact::query()->findOrFail($id);

        $request->validate([
            'response' => 'required',
            'response_status' => 'required',
            'status' => 'required',
        ]);
        try {
            $data = $request->all();
            $data['response_at'] = date('Y-m-d H:i:s');
            $contact->update($data);

            if (empty($data)) {
                throw new \Exception('Có lỗi xảy ra, vui lòng thử lại');
            }

            \Mail::to($contact->email)->send(new \App\Mail\ContactRequestMail($contact));

            return redirect()->back()->with('success', 'Phản hồi thành công');
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
                'request-data' => $request->all(),
            ]);

            return redirect()->back()->with('error' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::query()->findOrFail($id);

        try {
            $contact->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Xoá dữ liệu thành công'
            ]);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
