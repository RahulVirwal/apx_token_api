<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerriesStructure extends Model
{
    use HasFactory;
    protected $fillable = [
        'description', 'berry_type', 'farm_code', 'batch_id', 'harvest_date',
        'quantity_grams', 'certifications', 'carbon_offset_kg', 'grower',
        'traceability_qr', 'current_owner', 'utility_tags'
    ];

    protected $casts = [
        'certifications' => 'array',
        'utility_tags' => 'array',
    ];
}
