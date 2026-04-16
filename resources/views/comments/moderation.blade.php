@extends('layouts.app')

@section('content')
    <h2>Модерация комментариев</h2>

    @if(session('success'))
        <div style="background: #eafaf1; border: 1px solid #27ae60; border-radius: 6px; padding: 12px; margin-top: 16px; color: #1e8449;">
            {{ session('success') }}
        </div>
    @endif

    @if($comments->isEmpty())
        <p style="margin-top: 24px; color: #666;">Нет комментариев, ожидающих модерации.</p>
    @else
        <p style="margin-top: 8px; color: #888; font-size: 14px;">Комментариев на проверке: {{ $comments->count() }}</p>

        @foreach($comments as $comment)
            <div style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-top: 16px;">
                <div style="font-size: 13px; color: #999; margin-bottom: 8px;">
                    <strong>{{ $comment->user->name }}</strong>
                    &mdash;
                    статья: <a href="{{ route('articles.show', $comment->article) }}" style="color: #2980b9;">{{ $comment->article->title }}</a>
                    &mdash;
                    {{ $comment->created_at->format('d.m.Y H:i') }}
                </div>

                <p style="font-size: 15px; color: #333; margin-bottom: 16px;">{{ $comment->body }}</p>

                <div style="display: flex; gap: 10px;">
                    <form action="{{ route('comments.approve', $comment) }}" method="POST">
                        @csrf
                        <button type="submit"
                                style="background: #27ae60; color: #fff; border: none; padding: 8px 18px; border-radius: 6px; font-size: 14px; cursor: pointer;">
                            Принять
                        </button>
                    </form>

                    <form action="{{ route('comments.reject', $comment) }}" method="POST"
                          onsubmit="return confirm('Отклонить и удалить комментарий?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="background: #e74c3c; color: #fff; border: none; padding: 8px 18px; border-radius: 6px; font-size: 14px; cursor: pointer;">
                            Отклонить
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@endsection
