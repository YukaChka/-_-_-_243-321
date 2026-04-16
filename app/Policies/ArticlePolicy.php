<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    // Просмотр списка статей — разрешён всем авторизованным
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Просмотр одной статьи — разрешён всем авторизованным
    public function view(User $user, Article $article): bool
    {
        return true;
    }

    // Создание — только модератор (читатель получит отказ)
    public function create(User $user): Response
    {
        return Response::deny('Только модератор может создавать статьи.');
    }

    // Редактирование — только модератор
    public function update(User $user, Article $article): Response
    {
        return Response::deny('Только модератор может редактировать статьи.');
    }

    // Удаление — только модератор
    public function delete(User $user, Article $article): Response
    {
        return Response::deny('Только модератор может удалять статьи.');
    }
}
