<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleDeleteTest extends TestCase
{
    use RefreshDatabase;
    
    #[Test]
    public function only_admin_can_delete_an_article(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
            ->delete(route('articles.destroy', $article->id))
            ->assertForbidden();

        $this->assertDatabaseHas('articles', ['id' => $article->id]);
    }

    #[Test]
    public function admin_can_delete_an_article(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create(['is_admin' => true]);

        $this->actingAs($user)
            ->delete(route('articles.destroy', $article->id))
            ->assertNoContent();

        $this->assertSoftDeleted($article);
    }
}
