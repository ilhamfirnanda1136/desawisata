<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('auth.profile', [
            'user' => User::with('pusat')->findOrFail(auth()->user()->id),
        ]);
    }

    public function store(Request $request)
    {
        $body = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
        User::where('id', auth()->user()->id)->update($body);
        return redirect()
            ->route('profile.index')
            ->with('message', 'Profile berhasil diperbarui');
    }

    public function show()
    {
        return response()->json(
            User::with('roles')
                ->where('id', auth()->user()->id)
                ->firstOrFail()
        );
    }

    public function changePassword()
    {
        return view('modules.auth.change_password');
    }

    public function storeChangePassword(Request $request)
    {
        $userSession = auth()->user();
        $validator = Validator::make($request->all(), [
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use ($userSession) {
                    if (!Hash::check($value, $userSession->password)) {
                        $fail('Password Lama Tidak Cocok');
                    }
                },
            ],
            'new_password' => 'required|same:password_confirmation',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Masukkan Data Dengan Benar',
            ]);
        } else {
            User::where('id', $userSession->id)->update([
                'password' => Hash::make($request->new_password),
            ]);
            return response()->json([
                'success' => $request->all(),
                'message' => 'Data berhasil dimasukkan',
            ]);
        }
    }
}
