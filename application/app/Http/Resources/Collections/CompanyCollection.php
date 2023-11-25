<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\CompanyResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanyCollection extends ResourceCollection
{
    public $collects = CompanyResource::class;
}
