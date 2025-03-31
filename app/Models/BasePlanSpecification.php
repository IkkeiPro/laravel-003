<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BasePlanSpecification extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'base_plan_id',
        'specification_id',
    ];

    public function basePlan(): BelongsTo
    {
        return $this->belongsTo(BasePlan::class);
    }

    public function specification(): BelongsTo
    {
        return $this->belongsTo(Specification::class);
    }
}
