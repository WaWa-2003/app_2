<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'subject',
        'institution',
        'country',
        'type'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
