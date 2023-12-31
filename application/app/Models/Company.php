<?php

namespace App\Models;

use App\Models\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory, Filterable;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'uuid', 'name', 'address'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'positions',
            'company_id',
            'user_id',
            'uuid',
            'uuid'
        )->withPivot('company_id', 'user_id', 'name');
    }
}
