@extends('layouts.app')

@section('content')
    <a href="{{ route('articles.index') }}"
       style="color: #2c3e50; font-size: 14px; text-decoration: underline;">&larr; Назад к списку</a>

    <div style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 24px; margin-top: 20px;">
        <h2 style="font-size: 24px; margin-bottom: 16px;">{{ $article->title }}</h2>

        @if($article->image)
            <img src="{{ $article->image }}"
                 alt="{{ $article->title }}"
                 style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 8px; margin-bottom: 20px;">
        @endif

        <p style="font-size: 16px; line-height: 1.8; color: #444;">{{ $article->description }}</p>

        <p style="font-size: 12px; color: #999; margin-top: 20px;">
            Опубликовано: {{ $article->created_at->format('d.m.Y H:i') }}
        </p>

        <div style="margin-top: 20px; display: flex; gap: 12px;">
            <a href="{{ route('articles.edit', $article) }}"
               style="color: #f39c12; border: 1px solid #f39c12; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px;">
                Редактировать
            </a>
            <form action="{{ route('articles.destroy', $article) }}" method="POST"
                  onsubmit="return confirm('Удалить статью?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        style="color: #e74c3c; border: 1px solid #e74c3c; background: none; padding: 8px 16px; border-radius: 6px; font-size: 14px; cursor: pointer;">
                    Удалить
                </button>
            </form>
        </div>
    </div>
@endsection
