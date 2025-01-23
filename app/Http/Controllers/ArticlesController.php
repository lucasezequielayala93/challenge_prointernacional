<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticlesService;
use App\Http\Requests\IndexArticlesRequest;
use App\Http\Requests\StoreArticlesRequest;
use Illuminate\Http\JsonResponse;

class ArticlesController extends Controller
{
    public function __construct(protected ArticlesService $service) {}

    public function store(StoreArticlesRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request), status: 200);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $this->service->update($request, $id);
        return response()->json(status: 204);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $this->service->destroy($request, $id);
        return response()->json(status: 204);
    }

    public function index(IndexArticlesRequest $request): JsonResponse
    {
        return response()->json($this->service->index($request), status: 200);
    }
}
