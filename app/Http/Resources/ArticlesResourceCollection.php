<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticlesResourceCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return [
            'articles' => $this->collection->map(function ($article) {
                return new ArticlesResource($article);
            }),
            'pagination' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'perPage' => $this->perPage(),
                'currentPage' => $this->currentPage(),
                'totalPages' => $this->lastPage(),
            ],
        ];
    }
}
