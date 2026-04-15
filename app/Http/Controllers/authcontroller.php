<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class authcontroller extends Controller
{
    public function create()
    {
        return view('auth.signin');
    }

    public function registration(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|min:2|max:100',
            'email'    => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Регистрация прошла успешно',
            'data'    => [
                'name'  => $validated['name'],
                'email' => $validated['email'],
            ],
        ], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }
}
