<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{

    //Se usa cuando se quiere devolver una colección de recursos y los nombre entre ResourceCollection y Resource no son iguales
    //public $collects = ArticlesResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => route('api.v1.articles.index')
            ]
        ];
    }
}
