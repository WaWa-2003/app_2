<?php

namespace App\Models\Opportunity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'opportunity_id',
        'requirement',
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}
