<?php

namespace App\Http\Controllers;

use App\Jobs\VeryLongJob;
use App\Models\Article;
use Illuminate\Http\Request;

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

        // Помещаем отправку письма в очередь
        VeryLongJob::dispatch($article);

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
