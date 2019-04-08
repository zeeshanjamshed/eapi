<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'name' => $this->name,
            'total_price' => $this->discount > 0 ? round($this->price-($this->price*($this->discount/100)),2) : $this->price,
            'discount' => $this->discount,
            'average_rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No Ratings Available',
            'href' => [
                'link' => route('products.show', $this->id)
            ]
        ];
    }
}

