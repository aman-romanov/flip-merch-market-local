<?php

namespace App\Http\Resources;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => Number::currency($this->price, 'KZT'),
            'sub_category' => SubCategory::findOrFail($this->sub_category->id)->first()->name,
            'colors' => ColorResource::collection($this->whenLoaded('colors')),
            'sizes' => SizeResource::collection($this->whenLoaded('sizes')),
            'images' => ImageResource::collection($this->whenLoaded('images'))
        ];
    }
}
