<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'position',
        'organization_name',
        'country',
        'type'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
