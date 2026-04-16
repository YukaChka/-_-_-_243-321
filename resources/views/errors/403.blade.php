@extends('layouts.app')

@section('content')
    <div style="text-align: center; padding: 60px 0;">
        <h2 style="font-size: 64px; color: #e74c3c; margin-bottom: 16px;">403</h2>
        <h3 style="font-size: 22px; margin-bottom: 12px;">Доступ запрещён</h3>
        <p style="font-size: 16px; color: #666; margin-bottom: 32px;">{{ $message }}</p>
        <a href="{{ url('/') }}"
           style="background: #2c3e50; color: #fff; padding: 10px 24px; border-radius: 6px; text-decoration: none; font-size: 14px;">
            На главную
        </a>
    </div>
@endsection
