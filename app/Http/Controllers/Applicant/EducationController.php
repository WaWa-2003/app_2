<?php

namespace App\Http\Controllers\Applicant;

use App\Models\Applicant\Education;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $educations = Education::where('user_id', $user_id)->get();

        return view('applicant.index', [
            'educations' => $educations
        ]);
    }

    public function create()
    {
        return view('applicant.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id.*' => 'required|exists:users,id',
            'start_date.*' => 'required|date',
            'end_date.*' => 'required|date',
            'subject.*' => 'required|string',
            'institution.*' => 'required|string',
            'country.*' => 'required|string',
            'type.*' => 'required|string',
        ]);

        foreach ($request->user_id as $index => $userId) {
            Education::create([
                'user_id' => $userId,
                'start_date' => $request->start_date[$index],
                'end_date' => $request->end_date[$index],
                'subject' => $request->subject[$index],
                'institution' => $request->institution[$index],
                'country' => $request->country[$index],
                'type' => $request->type[$index],
            ]);
        }

        return redirect()->route('applicant.index')->with('success', 'Education record(s) created successfully.');
    }

    public function show($id)
    {
        $user_id = auth()->user()->id;
        $educations = Education::where('user_id', $user_id)->get();

        return view('applicant.index', [
            'educations' => $educations
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'user_id.*' => 'required|exists:users,id',
            'start_date.*' => 'required|date',
            'end_date.*' => 'required|date',
            'subject.*' => 'required|string',
            'institution.*' => 'required|string',
            'country.*' => 'required|string',
            'type.*' => 'required|string',
        ]);

        $user_id = auth()->user()->id;
        $educations = Education::where('user_id', $user_id)->get();

        foreach ($educations as $education) {
            $education->delete();
        }

        if($request->user_id !== NULL ){
            foreach ($request->user_id as $index => $userId) {
                Education::create([
                    'user_id' => $userId,
                    'start_date' => $request->start_date[$index],
                    'end_date' => $request->end_date[$index],
                    'subject' => $request->subject[$index],
                    'institution' => $request->institution[$index],
                    'country' => $request->country[$index],
                    'type' => $request->type[$index],
                ]);
            }
        }
        return redirect()->route('applicant.index')->with('success', 'Education record(s) updated successfully.');
    }
}
