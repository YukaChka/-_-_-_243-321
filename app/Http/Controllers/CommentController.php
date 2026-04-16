<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Список комментариев на модерации (только для модератора)
    public function moderation()
    {
        $this->authorize('moderate', Comment::class);

        $comments = Comment::with(['article', 'user'])
            ->where('approved', false)
            ->latest()
            ->get();

        return view('comments.moderation', ['comments' => $comments]);
    }

    // Добавление нового комментария
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'body' => 'required|string|min:2|max:1000',
        ]);

        Comment::create([
            'article_id' => $article->id,
            'user_id'    => Auth::id(),
            'body'       => $request->body,
            'approved'   => false,
        ]);

        return back()->with('comment_pending', 'Ваш комментарий отправлен и ожидает модерации.');
    }

    // Принять комментарий
    public function approve(Comment $comment)
    {
        $this->authorize('moderate', Comment::class);

        $comment->update(['approved' => true]);

        return back()->with('success', 'Комментарий одобрен.');
    }

    // Отклонить (удалить) комментарий
    public function reject(Comment $comment)
    {
        $this->authorize('moderate', Comment::class);

        $comment->delete();

        return back()->with('success', 'Комментарий отклонён и удалён.');
    }
}
