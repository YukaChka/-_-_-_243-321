<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    // Модерация — только для модератора (читатель получит отказ)
    public function moderate(User $user): Response
    {
        return Response::deny('Только модератор может управлять комментариями.');
    }
}
