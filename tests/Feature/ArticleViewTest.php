<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Article;
use App\Models\Category;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleViewTest extends TestCase
{
    use RefreshDatabase;
    
    #[Test]
    public function it_validates_invalid_categories_in_product_listing(): void
    {
        Category::factory()->create(['name' => 'Electronics']);
        Category::factory()->create(['name' => 'Clothing']);

        $response = $this->getJson(route('articles.index', ['categories' => ['Electronics', 'InvalidCategory']]));
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['categories.1']);
        $response->assertJsonFragment(['The selected category is invalid.']);
    }

    #[Test]
    public function it_validates_the_structure_of_the_pagination_in_product_listing(): void
    {
        Category::factory()->create(['name' => 'Sports & Outdoors']);
        Category::factory()->create(['name' => 'Books']);
        Category::factory()->create(['name' => 'Automotive']);
        Category::factory()->create(['name' => 'Fashion']);

        Article::factory()->create([
            'name' => 'DC Shoes',
            'stock' => 45,
            'category_id' => Category::where('name', 'Sports & Outdoors')->first()->id,
            'price_unit' => 19.99,
        ]);

        Article::factory()->create([
            'name' => 'Lord of the Rings',
            'stock' => 0,
            'category_id' => Category::where('name', 'Books')->first()->id,
            'price_unit' => 25.5,
        ]);

        Article::factory()->create([
            'name' => 'Fiat Punto',
            'stock' => 5,
            'category_id' => Category::where('name', 'Automotive')->first()->id,
            'price_unit' => 150,
        ]);

        Article::factory()->create([
            'name' => 'Lord of the Rings',
            'stock' => 1,
            'category_id' => Category::where('name', 'Fashion')->first()->id,
            'price_unit' => 0,
        ]);

        $response = $this->get(route('articles.index', ['categories' => ['Sports & Outdoors', 'Books']]));
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'articles' => [
                '*' => [
                    'id',
                    'name',
                    'stock',
                    'categoryId',
                    'category' => [
                        'id',
                        'name',
                    ],
                    'priceUnit',
                ]
            ],
            'pagination' => [
                'total',
                'count',
                'perPage',
                'currentPage',
                'totalPages',
            ],
        ]);
    }
}
