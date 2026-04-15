@extends('layouts.app')

@section('content')
    <h2>Статьи</h2>

    <div style="margin-top: 24px;">
        @forelse($articles as $article)
            <div style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 16px; display: flex; gap: 20px; align-items: flex-start;">
                @if($article->image)
                    <img
                        src="{{ $article->image }}"
                        alt="{{ $article->title }}"
                        style="width: 160px; height: 110px; object-fit: cover; border-radius: 6px; flex-shrink: 0;"
                    >
                @endif
                <div>
                    <h3 style="font-size: 18px; margin-bottom: 8px;">{{ $article->title }}</h3>
                    <p style="font-size: 14px; color: #555; line-height: 1.6;">{{ $article->description }}</p>
                    <p style="font-size: 12px; color: #999; margin-top: 8px;">{{ $article->created_at->format('d.m.Y') }}</p>
                </div>
            </div>
        @empty
            <p>Статей пока нет.</p>
        @endforelse
    </div>
@endsection
