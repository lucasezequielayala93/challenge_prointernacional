<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'stock' => $this->stock,
            'categoryId' => $this->category_id,
            'category' => new CategoryResource($this->category),
            'priceUnit' => $this->price_unit
        ];
    }
}
