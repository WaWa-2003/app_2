<?php

namespace App\Models\Opportunity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'opportunity_id',
        'employer_question'
    ];

    public function opportunity(){
        return $this->belongsTo(Opportunity::Class);
    }
}
