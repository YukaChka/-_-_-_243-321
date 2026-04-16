<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новостной сайт</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f5f5f5;
            color: #333;
        }

        header {
            background-color: #2c3e50;
            color: #fff;
            padding: 16px 32px;
        }

        header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        nav a {
            color: #ecf0f1;
            text-decoration: none;
            margin-right: 20px;
            font-size: 16px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            flex: 1;
            padding: 32px;
            max-width: 960px;
            margin: 0 auto;
            width: 100%;
        }

        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 16px 32px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<header>
    <h1>Новостной сайт</h1>
    <nav>
        <a href="{{ url('/') }}">Главная</a>
        <a href="{{ url('/about') }}">О нас</a>
        <a href="{{ url('/contacts') }}">Контакты</a>
        <a href="{{ url('/articles') }}">Статьи</a>
        @can('create', App\Models\Article::class)
            <a href="{{ route('articles.create') }}">Создать статью</a>
        @endcan
        @auth
            <span style="color: #bdc3c7; font-size: 14px;">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit"
                        style="background: none; border: none; color: #ecf0f1; font-size: 16px; cursor: pointer; padding: 0; margin-left: 16px;">
                    Выйти
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">Войти</a>
            <a href="{{ route('register') }}">Регистрация</a>
        @endauth
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <p>Шуфер Максим Александрович &mdash; группа 243-321</p>
</footer>

</body>
</html>
