<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class categoryResource extends JsonResource
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
            'id' => (integer)$this->id,
            'name' => (string)$this->name,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'products' => ProductResource::collection($this->whenLoaded( 'products'))
           
        ];
    }
}
