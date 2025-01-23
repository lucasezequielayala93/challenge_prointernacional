<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Repositories\ArticlesRepository;
use App\Http\Requests\IndexArticlesRequest;
use App\Http\Requests\StoreArticlesRequest;
use App\Http\Resources\ArticlesResource;
use App\Http\Resources\ArticlesResourceCollection;

final class ArticlesService implements Contracts\ArticlesServiceInterface
{
    public function __construct(protected ArticlesRepository $repository) {}

    public function store(StoreArticlesRequest $request): ArticlesResource
    {
        return new ArticlesResource($this->repository->store($request));
    }

    public function update(Request $request, int $id): void
    {
        $this->repository->update($request, $id);
    }

    public function destroy(Request $request, int $id): void
    {
        $this->repository->destroy($id);
    }

    public function index(IndexArticlesRequest $request): ArticlesResourceCollection
    {
        return new ArticlesResourceCollection($this->repository->index($request));
    }
}
