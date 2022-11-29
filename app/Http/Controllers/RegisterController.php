<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => ['required', 'max:225'],
            'email'    => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:5', 'max:225', 'confirmed'],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return to_route('login')->with('success', 'You have successfully registered.');
    }
}
