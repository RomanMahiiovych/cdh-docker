<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public $collects = UserResource::class;
}
