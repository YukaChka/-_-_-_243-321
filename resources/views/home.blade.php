@extends('layouts.app')

@section('content')
    <h2>Последние новости</h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 24px;">
        @foreach($news as $item)
            <div style="background: #fff; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.07);">
                <a href="{{ url('/gallery/' . $item['id']) }}">
                    <img
                        src="{{ asset($item['preview_image']) }}"
                        alt="{{ $item['title'] }}"
                        style="width: 100%; height: 180px; object-fit: cover; display: block; background: #ccc;"
                        onerror="this.style.background='#bdc3c7'; this.removeAttribute('src');"
                    >
                </a>
                <div style="padding: 16px;">
                    <h3 style="font-size: 16px; margin-bottom: 8px;">{{ $item['title'] }}</h3>
                    <p style="font-size: 14px; color: #666; line-height: 1.5;">{{ $item['description'] }}</p>
                    <a href="{{ url('/gallery/' . $item['id']) }}" style="display: inline-block; margin-top: 12px; color: #2c3e50; font-size: 14px; text-decoration: underline;">
                        Подробнее &rarr;
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
