<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecificationMeisai extends Model
{
    use HasFactory;

    protected $table = 'specifications_meisai';

    protected $fillable = [
        'specification_id',
        'line_no',
        'name',
        'price',
        'is_enabled',
        'is_default',
    ];

    public function specification(): BelongsTo
    {
        return $this->belongsTo(Specification::class);
    }
}
