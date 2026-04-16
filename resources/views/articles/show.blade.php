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

        @can('update', $article)
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
        @endcan
    </div>

    {{-- Комментарии --}}
    <div style="margin-top: 40px;">
        <h3 style="font-size: 20px; margin-bottom: 16px;">Комментарии</h3>

        {{-- Сообщение об ожидании модерации --}}
        @if(session('comment_pending'))
            <div style="background: #fff8e1; border: 1px solid #f39c12; border-radius: 6px; padding: 12px; margin-bottom: 16px; color: #7d5500;">
                {{ session('comment_pending') }}
            </div>
        @endif

        {{-- Одобренные комментарии --}}
        @forelse($article->comments->where('approved', true) as $comment)
            <div style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 16px; margin-bottom: 12px;">
                <div style="font-size: 13px; color: #999; margin-bottom: 6px;">
                    <strong>{{ $comment->user->name }}</strong> &mdash; {{ $comment->created_at->format('d.m.Y H:i') }}
                </div>
                <p style="font-size: 15px; color: #333; margin: 0;">{{ $comment->body }}</p>
            </div>
        @empty
            <p style="color: #888; font-size: 14px;">Комментариев пока нет.</p>
        @endforelse

        {{-- Форма добавления комментария --}}
        <div style="margin-top: 24px;">
            <h4 style="font-size: 16px; margin-bottom: 12px;">Оставить комментарий</h4>

            @if($errors->has('body'))
                <div style="background: #fdecea; border: 1px solid #e74c3c; border-radius: 6px; padding: 10px; margin-bottom: 12px; color: #c0392b;">
                    {{ $errors->first('body') }}
                </div>
            @endif

            <form action="{{ route('comments.store', $article) }}" method="POST">
                @csrf
                <textarea
                    name="body"
                    rows="4"
                    placeholder="Напишите комментарий..."
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; resize: vertical;">{{ old('body') }}</textarea>
                <button type="submit"
                        style="margin-top: 10px; padding: 10px 24px; background: #2c3e50; color: #fff; border: none; border-radius: 6px; font-size: 14px; cursor: pointer;">
                    Отправить
                </button>
            </form>
        </div>
    </div>
@endsection
