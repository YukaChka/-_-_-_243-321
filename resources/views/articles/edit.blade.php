@extends('layouts.app')

@section('content')
    <h2>Редактировать статью</h2>

    @if($errors->any())
        <div style="background: #fdecea; border: 1px solid #e74c3c; border-radius: 6px; padding: 12px; margin-top: 16px; color: #c0392b;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article) }}" method="POST"
          style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 24px; margin-top: 20px; max-width: 640px;">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-size: 14px; margin-bottom: 6px; font-weight: bold;">Заголовок</label>
            <input type="text" name="title" value="{{ old('title', $article->title) }}" placeholder="Введите заголовок"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-size: 14px; margin-bottom: 6px; font-weight: bold;">Описание</label>
            <textarea name="description" rows="5" placeholder="Введите описание статьи"
                      style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; resize: vertical;">{{ old('description', $article->description) }}</textarea>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-size: 14px; margin-bottom: 6px; font-weight: bold;">Ссылка на изображение (необязательно)</label>
            <input type="text" name="image" value="{{ old('image', $article->image) }}" placeholder="https://..."
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
        </div>

        <div style="display: flex; gap: 12px;">
            <button type="submit"
                    style="background: #2c3e50; color: #fff; padding: 11px 24px; border: none; border-radius: 6px; font-size: 14px; cursor: pointer;">
                Обновить
            </button>
            <a href="{{ route('articles.index') }}"
               style="padding: 11px 24px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; text-decoration: none; color: #555;">
                Отмена
            </a>
        </div>
    </form>
@endsection
