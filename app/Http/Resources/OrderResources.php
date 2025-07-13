<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [

            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'order_status' => $this->order_status,
            'price' => $this->price, 
            "product_name"=> $this->product->name,
            "user_name"=> $this->user->name,
             "image" =>url( $this->product->image),             
            'created_at' => $this->created_at->format("d-m-y"),


        ];
    }
}
