@extends('layouts.app')

@section('content')
    @if($item)
        <a href="{{ url('/') }}" style="color: #2c3e50; font-size: 14px; text-decoration: underline;">&larr; Назад к новостям</a>

        <h2 style="margin-top: 16px;">{{ $item['title'] }}</h2>

        <div style="margin-top: 20px;">
            <img
                src="{{ asset($item['full_image']) }}"
                alt="{{ $item['title'] }}"
                style="max-width: 100%; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); background: #bdc3c7; min-height: 200px; display: block;"
                onerror="this.style.background='#bdc3c7'; this.removeAttribute('src');"
            >
        </div>

        <p style="margin-top: 20px; font-size: 16px; line-height: 1.7; color: #444;">
            {{ $item['description'] }}
        </p>
    @else
        <p>Новость не найдена.</p>
        <a href="{{ url('/') }}" style="color: #2c3e50;">&larr; На главную</a>
    @endif
@endsection
