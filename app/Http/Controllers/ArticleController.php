<?php

namespace App\Http\Controllers;

use App\Mail\ArticleCreated;
use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Article::class);

        $articles = Article::latest()->paginate(5);

        return view('articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        $this->authorize('create', Article::class);

        return view('articles.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $validated = $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10',
            'image'       => 'nullable|url|max:500',
        ]);

        $article = Article::create($validated);

        // Уведомляем всех модераторов по email
        $moderatorRole = Role::where('name', 'moderator')->first();
        if ($moderatorRole) {
            $moderators = User::where('role_id', $moderatorRole->id)->get();
            foreach ($moderators as $moderator) {
                Mail::to($moderator->email)->send(new ArticleCreated($article));
            }
        }

        return redirect()->route('articles.index')->with('success', 'Статья успешно создана!');
    }

    public function show(Article $article)
    {
        $this->authorize('view', $article);

        $article->load('comments.user');

        return view('articles.show', ['article' => $article]);
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.edit', ['article' => $article]);
    }

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10',
            'image'       => 'nullable|url|max:500',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Статья успешно обновлена!');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Статья удалена.');
    }
}
