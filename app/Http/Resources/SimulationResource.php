<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SimulationResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "user_id" => $this->user_id,
            "frogs" => $this->frogs,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];

    }
}
