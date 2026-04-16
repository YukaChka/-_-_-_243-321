@extends('layouts.app')

@section('content')
    <h2>Регистрация</h2>

    @if($errors->any())
        <div style="background: #fdecea; border: 1px solid #e74c3c; border-radius: 6px; padding: 12px; margin-top: 16px;">
            <ul style="margin: 0; padding-left: 20px; color: #c0392b;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/register') }}" method="POST"
          style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 24px; margin-top: 20px; max-width: 480px;">

        @csrf

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-size: 14px; margin-bottom: 6px; font-weight: bold;">Имя</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="Введите имя"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;"
            >
        </div>

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

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-size: 14px; margin-bottom: 6px; font-weight: bold;">Пароль</label>
            <input
                type="password"
                name="password"
                placeholder="Минимум 6 символов"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;"
            >
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-size: 14px; margin-bottom: 6px; font-weight: bold;">Подтверждение пароля</label>
            <input
                type="password"
                name="password_confirmation"
                placeholder="Повторите пароль"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;"
            >
        </div>

        <button type="submit"
                style="width: 100%; padding: 12px; background: #2c3e50; color: #fff; border: none; border-radius: 6px; font-size: 15px; cursor: pointer;">
            Зарегистрироваться
        </button>

        <p style="margin-top: 16px; font-size: 14px; text-align: center;">
            Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
        </p>
    </form>
@endsection
