<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexCompanyRequest;
use App\Http\Resources\Collections\CompanyCollection;
use App\Models\Company;
use App\Models\Filters\CompanyFilters;

class CompaniesApiController extends Controller
{

    public function index(IndexCompanyRequest $request, CompanyFilters $filters): CompanyCollection
    {
        $companies = Company::with(['users:uuid,first_name,last_name,email'])
            ->filter($filters)
            ->paginate(5);

        return new CompanyCollection($companies);
    }
}
