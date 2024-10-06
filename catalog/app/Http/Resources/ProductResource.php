<?php

namespace App\Http\Resources;

use App\Models\Category;
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
            'price' => $this->price,
            'previousPrice' => $this->previousPrice,
            'sub_category' => $this->sub_category->name,
            'category' => CategoryResource::collection($this->categories),
            'colors' => ColorResource::collection($this->whenLoaded('colors')),
            'sizes' => SizeResource::collection($this->whenLoaded('sizes')),
            'gender' => GenderResource::collection($this->whenLoaded('genders')),
            'images' => ImageResource::collection($this->whenLoaded('images'))
        ];
    }
}
