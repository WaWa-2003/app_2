<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'position',
        'company_name',
        'country',
        'responsibility',
        'resign_reason',
        'salary',
        'type',

    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
