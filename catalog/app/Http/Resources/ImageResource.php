<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'path' => $this->path,
            'product_id' => $this->product_id,
            'color_id' => $this->color_id
        ];
    }
}
