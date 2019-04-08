<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stock' => $this->stock == 0 ? "Out of Stock" : $this->stock,
            'discount' => $this->discount,
            'total_price' => $this->discount > 0 ? round($this->price-($this->price*($this->discount/100)),2) : $this->price,
            // Same thing in a Different Way
            //'totalprice' => $this->discount > 0 ? round((1-($this->discount/100)) * $this->price,2) : $this->price,
            'average_rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No Ratings Available',
            'href' => [
                'reviews' => route('reviews.index', $this->id)
            ]
        ];
    }
}
