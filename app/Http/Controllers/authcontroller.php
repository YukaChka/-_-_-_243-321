<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authcontroller extends Controller
{
    // Форма регистрации
    public function showRegister()
    {
        return view('auth.register');
    }

    // Сохранение нового пользователя
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|min:2|max:100',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('success', 'Регистрация прошла успешно! Войдите в аккаунт.');
    }

    // Форма авторизации
    public function showLogin()
    {
        return view('auth.login');
    }

    // Аутентификация с выдачей токена Sanctum
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Неверный email или пароль.'])->withInput();
        }

        $request->session()->regenerate();

        // Присваиваем токен аутентификации пользователю
        $token = Auth::user()->createToken('web-token')->plainTextToken;
        $request->session()->put('auth_token', $token);

        return redirect('/');
    }

    // Выход с удалением токена, инвалидацией сессии, обновлением CSRF
    public function logout(Request $request)
    {
        // Удаляем все токены пользователя
        Auth::user()->tokens()->delete();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
