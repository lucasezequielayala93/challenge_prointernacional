<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use SoftDeletes,
        HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'id',
        'name',
        'stock',
        'category_id',
        'price_unit'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
