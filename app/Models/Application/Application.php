<?php

namespace App\Models\Application;

use App\Models\Opportunity\Opportunity;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'opportunity_id',
        'user_id',
        'salary_expectation',
        'earliest_possible_start_date',
        'application_status',
        'next_step_status',
        'notes',
        'prescreen_date',
        'short_list_date',
        'first_interview_date',
        'second_interview_date',
        'third_interview_date',
        'fourth_interview_date',
        'offer_date',
        'offer_accept_status',
        'offer_accept_date',
        'offer_reject_date',
        'joining_date',
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }

}
