<?php

namespace App\Models\Opportunity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'opportunity_id',
        'qualification',
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}
