<?php

namespace App\Models\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CompanyFilters extends QueryFilters
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    /**
     * For filter name
     *
     * @param $term
     * @return Builder
     */
    public function name($term): Builder
    {
        return $this->builder->where('name', 'LIKE', "%$term%");
    }

    /**
     * For filter address
     *
     * @param $term
     * @return Builder
     */
    public function address($term): Builder
    {
        return $this->builder->where('address', 'LIKE', "%$term%");
    }

    /**
     * For both filter: name and address
     *
     * @param $term
     * @return Builder
     */
    public function search($term): Builder
    {
        return $this->builder->where(function ($query) use ($term) {
            $query->where('name', 'LIKE', "%$term%")
                ->orWhere('address', 'LIKE', "%$term%");
        });
    }

}
