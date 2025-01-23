<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\IndexArticlesRequest;
use App\Http\Requests\StoreArticlesRequest;

final class ArticlesRepository implements Contracts\ArticlesRepositoryInterface
{
    public function __construct(protected Article $model) {}

    public function store(StoreArticlesRequest $request): Article
    {
        $newArticle = $this->model->create($request->all());
        $article = $this->model->findOrFail($newArticle->id);
        return $article;
    }

    public function update(Request $request, int $id): void
    {
        $article = $this->model->findOrFail($id);
        $article->update(['stock' => $request->stock]);
    }

    public function destroy(int $id): void
    {
        $article = $this->model->findOrFail($id);
        $article->delete();
    }

    public function index(IndexArticlesRequest $request): \Illuminate\Pagination\LengthAwarePaginator
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;
        
        return $this->model->when($request->name, function ($query, $name) {
            $query->where('name', 'like', "%$name%");
        })
            ->when($request->categories, function ($query, $categories) {
                $query->whereHas('category', function ($query) use ($categories) {
                    $query->whereIn('name', $categories);
                });
            })
            ->paginate($perPage, ['*'], 'page', $page);
    }
}
