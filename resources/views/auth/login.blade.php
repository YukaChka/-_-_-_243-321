@extends('layouts.app')

@section('content')
    <h2>Вход в аккаунт</h2>

    @if(session('success'))
        <div style="background: #eafaf1; border: 1px solid #27ae60; border-radius: 6px; padding: 12px; margin-top: 16px; color: #1e8449;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: #fdecea; border: 1px solid #e74c3c; border-radius: 6px; padding: 12px; margin-top: 16px;">
            <ul style="margin: 0; padding-left: 20px; color: #c0392b;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST"
          style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 24px; margin-top: 20px; max-width: 480px;">

        @csrf

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-size: 14px; margin-bottom: 6px; font-weight: bold;">Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Введите email"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;"
            >
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-size: 14px; margin-bottom: 6px; font-weight: bold;">Пароль</label>
            <input
                type="password"
                name="password"
                placeholder="Введите пароль"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;"
            >
        </div>

        <button type="submit"
                style="width: 100%; padding: 12px; background: #2c3e50; color: #fff; border: none; border-radius: 6px; font-size: 15px; cursor: pointer;">
            Войти
        </button>

        <p style="margin-top: 16px; font-size: 14px; text-align: center;">
            Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a>
        </p>
    </form>
@endsection
