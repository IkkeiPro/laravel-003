<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specification extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'description',
    ];

    public function specificationsMeisai(): HasMany
    {
        return $this->hasMany(SpecificationMeisai::class);
    }

    public function basePlanSpecifications(): HasMany
    {
        return $this->hasMany(BasePlanSpecification::class);
    }
}
