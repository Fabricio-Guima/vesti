<?php

namespace App\Http\Resources;

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
            'id' => (integer)$this->id,
            'code' => (string)$this->code,
            'name' => (string)$this->name,
            'price' => (float)$this->price,
            'composition' => (string)$this->composition,
            'created_at' => (string)$this->created_at,
            'update_at' => (string)$this->update_at
        ];
    }
}
