<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_create_article()
    {
        //$this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Nuevo articulo',
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del nuevo articulo'
                ]
            ]
        ]);

        //$response->assertCreated();

        $article = Article::first();

        //$response->assertHeader('Location', route('api.v1.articles.show', $article));

        $response->assertJson([
            'data' => [
                'type' => 'articles',
                'id' => $article->getRouteKey(),
                'attributes' => [
                    'title' => 'Nuevo articulo',
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del nuevo articulo'
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $article)
                ]
            ],
        ])->dump();
    }

    /** @test */
    public function title_is_required(){
        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del nuevo articulo'
                ]
            ]
        ]);

        $response->assertJsonValidationErrorFor('data.attributes.title');
    }
}
