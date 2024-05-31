<?php

namespace App\Http\Controllers\Applicant;

use App\Models\Applicant\Job;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $jobs = Job::where('user_id', $user_id)->get();

        return view('applicant.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('applicant.index');
    }

    public function store(Request $request)
    {

        // dd($request->all());


        $validated = $request->validate([
            'user_id.*' => 'required|exists:users,id',
            'start_date.*' => 'required|date',
            'end_date.*' => 'required|date',
            'position.*' => 'required|string',
            'company_name.*' => 'required|string',
            'country.*' => 'required|string',
            'responsibility.*' => 'nullable|string',
            'resign_reason.*' => 'nullable|string',
            'salary.*' => 'required|integer',
            'type.*' => 'nullable|string',
        ]);

        foreach ($request->user_id as $index => $userId) {
            Job::create([
                'user_id' => $userId,
                'start_date' => $request->start_date[$index],
                'end_date' => $request->end_date[$index],
                'position' => $request->position[$index],
                'company_name' => $request->company_name[$index],
                'country' => $request->country[$index],
                'responsibility' => $request->responsibility[$index],
                'resign_reason' => $request->resign_reason[$index],
                'salary' => $request->salary[$index],
                'type' => $request->type[$index],
            ]);
        }

        return redirect()->route('applicant.index')->with('success', 'Job record(s) created successfully.');
    }

    public function show($id)
    {
        $user_id = auth()->user()->id;
        $jobs = Job::where('user_id', $user_id)->get();

        return view('applicant.index', [
            'jobs' => $jobs
        ]);
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);

        return view('applicant.index', [
            'job' => $job
        ]);
    }

    public function update(Request $request, Job $job)
    {
        // dd($request->user_id);

        return redirect()->route('applicant.index')->with('success', 'Job record(s) updated successfully.');

        $validated = $request->validate([
            'user_id.*' => 'required|exists:users,id',
            'start_date.*' => 'required|date',
            'end_date.*' => 'required|date',
            'position.*' => 'required|string',
            'company_name.*' => 'required|string',
            'country.*' => 'required|string',
            'responsibility.*' => 'nullable|string',
            'resign_reason.*' => 'nullable|string',
            'salary.*' => 'required|integer',
            'type.*' => 'nullable|string',
        ]);

        $user_id = auth()->user()->id;
        $jobs = Job::where('user_id', $user_id)->get();

        foreach ($jobs as $job) {
            $job->delete();
        }

        if($request->user_id !== NULL ){

            foreach ($request->user_id as $index => $userId) {
                Job::create([
                    'user_id' => $userId,
                    'start_date' => $request->start_date[$index],
                    'end_date' => $request->end_date[$index],
                    'position' => $request->position[$index],
                    'company_name' => $request->company_name[$index],
                    'country' => $request->country[$index],
                    'responsibility' => $request->responsibility[$index],
                    'resign_reason' => $request->resign_reason[$index],
                    'salary' => $request->salary[$index],
                    'type' => $request->type[$index],
                ]);
            }
        }

        return redirect()->route('applicant.index')->with('success', 'Job record(s) updated successfully.');
    }

}
