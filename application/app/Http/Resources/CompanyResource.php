<?php

namespace App\Http\Resources;

use App\Http\Resources\Collections\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->uuid,
            'name'    => $this->name,
            'address' => $this->address,
            'users'   => UserCollection::make($this->users),
        ];
    }
}
