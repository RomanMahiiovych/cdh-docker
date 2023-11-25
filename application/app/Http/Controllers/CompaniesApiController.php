<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\CompanyCollection;
use App\Models\Company;

class CompaniesApiController extends Controller
{

    public function index(): CompanyCollection
    {
        $companies = Company::with(['users:uuid,first_name,last_name,email'])
            ->paginate();

        return new CompanyCollection($companies);
    }
}
