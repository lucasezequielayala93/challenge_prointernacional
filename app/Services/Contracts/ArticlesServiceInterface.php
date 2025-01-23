<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use Illuminate\Http\Request;
use App\Http\Resources\ArticlesResource;
use App\Http\Requests\IndexArticlesRequest;
use App\Http\Requests\StoreArticlesRequest;
use App\Http\Resources\ArticlesResourceCollection;

interface ArticlesServiceInterface
{
    public function store(StoreArticlesRequest $request): ArticlesResource;

    public function update(Request $request, int $id): void;

    public function destroy(Request $request, int $id): void;

    public function index(IndexArticlesRequest $request): ArticlesResourceCollection;
}
