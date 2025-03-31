<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BasePlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_standard',
        'comment',
        'floor_area_1f',
        'floor_area_2f',
        'image_url_1f',
        'image_url_2f',
    ];

    public function basePlanSpecifications(): HasMany
    {
        return $this->hasMany(BasePlanSpecification::class);
    }

    public function consultationUsers(): HasMany
    {
        return $this->hasMany(ConsultationUser::class, 'selected_plan_id');
    }
}
