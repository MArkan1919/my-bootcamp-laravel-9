<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {
        return view('auth.password');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'min:5', 'max:225', 'confirmed'],
        ]);

        if (!Hash::check($validatedData['old_password'], auth()->user()->password)) {
            return back()->with('danger', 'Old password does not match.');
        }

        User::find(auth()->user()->id)->update([
            'password' => Hash::make($validatedData['new_password'])
        ]);

        return back()->with('success', 'Change password successfully.');
    }
}
