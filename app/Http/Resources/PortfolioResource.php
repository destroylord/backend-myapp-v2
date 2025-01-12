<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PortfolioResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'thumbnail' => $item->thumbnail,
                'description' => $item->description,
                'repository' => $item->repository,
                'website' => $item->website,
                'tag' => $item->tag
            ];
        })->toArray();
    }
}
