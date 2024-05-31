<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant\Education;
use App\Models\Applicant\Job;
use App\Models\Applicant\Other;

class ProfessionalInformationController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $educations = Education::where('user_id', $user_id)->get();
        $jobs = Job::where('user_id', $user_id)->get();
        $others = Other::where('user_id', $user_id)->get();

        return view('applicant.index', compact('educations', 'jobs', 'others'));
    }
}
