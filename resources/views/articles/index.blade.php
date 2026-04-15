@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>Статьи</h2>
        <a href="{{ route('articles.create') }}"
           style="background: #2c3e50; color: #fff; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-size: 14px;">
            + Добавить статью
        </a>
    </div>

    @if(session('success'))
        <div style="background: #eafaf1; border: 1px solid #27ae60; border-radius: 6px; padding: 12px; margin-bottom: 20px; color: #1e8449;">
            {{ session('success') }}
        </div>
    @endif

    @forelse($articles as $article)
        <div style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 16px; display: flex; gap: 20px; align-items: flex-start;">
            @if($article->image)
                <img src="{{ $article->image }}"
                     alt="{{ $article->title }}"
                     style="width: 140px; height: 100px; object-fit: cover; border-radius: 6px; flex-shrink: 0;">
            @endif
            <div style="flex: 1;">
                <h3 style="font-size: 17px; margin-bottom: 8px;">{{ $article->title }}</h3>
                <p style="font-size: 14px; color: #555; line-height: 1.6;">{{ Str::limit($article->description, 150) }}</p>
                <p style="font-size: 12px; color: #999; margin-top: 8px;">{{ $article->created_at->format('d.m.Y') }}</p>

                <div style="margin-top: 12px; display: flex; gap: 10px;">
                    <a href="{{ route('articles.show', $article) }}"
                       style="color: #2980b9; font-size: 13px; text-decoration: none; border: 1px solid #2980b9; padding: 5px 12px; border-radius: 4px;">
                        Читать
                    </a>
                    <a href="{{ route('articles.edit', $article) }}"
                       style="color: #f39c12; font-size: 13px; text-decoration: none; border: 1px solid #f39c12; padding: 5px 12px; border-radius: 4px;">
                        Редактировать
                    </a>
                    <form action="{{ route('articles.destroy', $article) }}" method="POST"
                          onsubmit="return confirm('Удалить статью?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="color: #e74c3c; font-size: 13px; background: none; border: 1px solid #e74c3c; padding: 5px 12px; border-radius: 4px; cursor: pointer;">
                            Удалить
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p>Статей пока нет.</p>
    @endforelse

    <div style="margin-top: 24px;">
        {{ $articles->links() }}
    </div>
@endsection
