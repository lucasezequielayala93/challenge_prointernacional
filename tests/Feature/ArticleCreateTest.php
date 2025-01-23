<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Article;
use App\Models\Category;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleCreateTest extends TestCase
{    
    use RefreshDatabase;
    
    #[Test]
    public function it_does_not_allow_duplicate_articles_in_the_same_category(): void
    {
        $category = Category::factory()->create();

        Article::factory()->create([
            'name' => 'Artículo 1',
            'category_id' => $category->id,
        ]);

        try {
            Article::factory()->create([
                'name' => 'Artículo 1',
                'category_id' => $category->id,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            $this->assertStringContainsString('UNIQUE constraint failed', $e->getMessage());
            return;
        }

        $this->fail('Expected QueryException not thrown.');
    }
}
