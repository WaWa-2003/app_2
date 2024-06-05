<?php

namespace App\Models\Opportunity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'experience_level',
        'department',
        'salary_min',
        'salary_max',
        'salary_currency',
        'job_type',
        'location',
        'description',
        'jobClosingDate',
        'availableStatus',
        'createdByWho',
        'hashtagKeyWords',
        'openToGender'
    ];

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }

    public function employer_questions()
    {
        return $this->hasMany(EmployerQuestion::class);
    }

    public function applications(){
        return $this->hasMany(Appication::class);
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }

}
