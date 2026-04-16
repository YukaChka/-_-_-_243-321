<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
        .wrapper { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 8px; overflow: hidden; border: 1px solid #ddd; }
        .header { background: #2c3e50; color: #fff; padding: 24px 32px; }
        .header h1 { margin: 0; font-size: 20px; }
        .body { padding: 32px; color: #333; }
        .body h2 { font-size: 22px; margin-bottom: 12px; }
        .body p { font-size: 15px; line-height: 1.7; color: #555; }
        .meta { font-size: 13px; color: #999; margin-top: 16px; }
        .btn { display: inline-block; margin-top: 24px; padding: 12px 24px; background: #2c3e50; color: #fff; text-decoration: none; border-radius: 6px; font-size: 14px; }
        .footer { background: #f5f5f5; padding: 16px 32px; font-size: 12px; color: #aaa; text-align: center; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Новостной сайт — новая статья</h1>
        </div>
        <div class="body">
            <h2>{{ $article->title }}</h2>
            <p>{{ \Illuminate\Support\Str::limit($article->description, 300) }}</p>
            <p class="meta">Опубликовано: {{ $article->created_at->format('d.m.Y H:i') }}</p>
            <a class="btn" href="{{ url('/articles/' . $article->id) }}">Читать статью</a>
        </div>
        <div class="footer">
            Это автоматическое уведомление. Шуфер Максим Александрович &mdash; группа 243-321
        </div>
    </div>
</body>
</html>
