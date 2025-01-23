<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\IndexArticlesRequest;
use App\Http\Requests\StoreArticlesRequest;

interface ArticlesRepositoryInterface
{
    public function store(StoreArticlesRequest $request): Article;

    public function update(Request $request, int $id): void;

    public function destroy(int $id): void;

    public function index(IndexArticlesRequest $request): \Illuminate\Pagination\LengthAwarePaginator;
}
