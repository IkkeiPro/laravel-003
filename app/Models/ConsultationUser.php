<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultationUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'phone_number',
        'email',
        'zip_code',
        'address1',
        'address2',
        'address3',
        'contact_method',
        'build_schedule',
        'has_build_location',
        'selected_plan_id',
        'total_price',
    ];

    protected $casts = [
        'has_build_location' => 'boolean',
    ];

    public function selectedPlan(): BelongsTo
    {
        return $this->belongsTo(BasePlan::class, 'selected_plan_id');
    }
}
