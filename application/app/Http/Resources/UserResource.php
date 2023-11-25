<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->uuid,
            'name_last'  => $this->last_name,
            'name_first' => $this->first_name,
            'email'      => $this->email,
            'position'   => $this->pivot?->name
        ];
    }
}
