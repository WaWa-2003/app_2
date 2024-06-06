<?php

namespace App\Http\Controllers;

use App\Models\Opportunity\Opportunity;
use App\Models\Opportunity\Requirement;
use App\Models\Opportunity\Qualification;
use App\Models\Opportunity\EmployerQuestion;
use App\Models\Applicant\Wishlist;
use App\Models\Applicant\Application;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    public function dashboard()
    {
        $opportunities = Opportunity::all();
        return view('dashboard', compact('opportunities'));
    }

    public function index()
    {
        $opportunities = Opportunity::all();
        return view('opportunity.index', compact('opportunities'));
    }

    public function create()
    {
        return view('opportunity.create');
    }

    public function store(Request $request)
    {
        $opportunityData = $request->validate([
            'name' => 'required',
            'experience_level' => 'required',
            'department' => 'required',
            'salary_min' => 'required|integer',
            'salary_max' => 'required|integer',
            'salary_currency' => 'required',
            'job_type' => 'required',
            'location' => 'required',
            'description' => 'required',
            'availableStatus' => 'required',
            'createdByWho' => 'required',

            'jobClosingDate' => 'required',
            'hashtagKeyWords' => 'required',
            'openToGender' => 'required',
        ]);

        $opportunity = Opportunity::create($opportunityData);

        $requirementData = $request->validate([
            'requirements' => 'required|array',
        ]);

        foreach ($requirementData['requirements'] as $requirement) {
            Requirement::create([
                'opportunity_id' => $opportunity->id,
                'requirement' => $requirement
            ]);
        }

        $qualificationData = $request->validate([
            'qualifications' => 'required|array',
        ]);

        foreach ($qualificationData['qualifications'] as $qualification) {
            Qualification   ::create([
                'opportunity_id' => $opportunity->id,
                'qualification' => $qualification
            ]);
        }

        $employer_questionData = $request->validate([
            'employer_questions' => 'required|array',
        ]);

        foreach ($employer_questionData['employer_questions'] as $employer_question) {
            EmployerQuestion   ::create([
                'opportunity_id' => $opportunity->id,
                'employer_question' => $employer_question
            ]);
        }

        return redirect()->route('opportunity.index')
                         ->with('success', 'Opportunity created successfully.');
    }

    public function show(Opportunity $opportunity)
    {
        $user_id = auth()->user()->id;
        $opportunity_id = $opportunity->id;
        $wishlist = Wishlist::where([
            ['user_id', $user_id],
            ['opportunity_id', $opportunity_id]
        ])->get();
        $application = Application::where([
            ['user_id', $user_id],
            ['opportunity_id', $opportunity_id]
        ])->get();

        $opportunities = Opportunity::all();

        $requirements = Requirement::where('opportunity_id', $opportunity_id)->get();
        $qualifications = Qualification::where('opportunity_id', $opportunity_id)->get();
        $employer_questions = EmployerQuestion::where('opportunity_id', $opportunity_id)->get();

        return view('opportunity.show', [
            'opportunity' => $opportunity,
            'opportunities' => $opportunities,
            'requirements' => $requirements,
            'qualifications' => $qualifications,
            'employer_questions' => $employer_questions,
            'wishlist' => $wishlist,
            'application' => $application
        ]);
    }

    public function edit(Opportunity $opportunity)
    {
        $opportunities = Opportunity::all();

        $requirements = Requirement::where('opportunity_id', $opportunity->id)->get();
        $qualifications = Qualification::where('opportunity_id', $opportunity->id)->get();
        $employer_questions = EmployerQuestion::where('opportunity_id', $opportunity->id)->get();

        return view('opportunity.edit', [
            'opportunity' => $opportunity,
            'opportunities' => $opportunities,
            'requirements' => $requirements,
            'qualifications' => $qualifications,
            'employer_questions' => $employer_questions
        ]);
        // return view('opportunity.edit', compact('opportunity'));
    }

    public function update(Request $request, Opportunity $opportunity)
    {
        $opportunityData = $request->validate([
            'name' => 'required',
            'experience_level' => 'required',
            'department' => 'required',
            'salary_min' => 'required|integer',
            'salary_max' => 'required|integer',
            'salary_currency' => 'required',
            'job_type' => 'required',
            'location' => 'required',
            'description' => 'required',

            'availableStatus' => 'required',
            'createdByWho' => 'required',

            'jobClosingDate' => 'required',
            'hashtagKeyWords' => 'required',
            'openToGender' => 'required',
        ]);

        $opportunity->update($opportunityData);

        $requirementData = $request->validate([
            'requirements' => 'required|array',
            'requirements.*' => 'required|string',
        ]);

        $opportunity->requirements()->delete();

        foreach ($request->requirements as $requirement) {
            Requirement::create([
                'opportunity_id' => $opportunity->id,
                'requirement' => $requirement
            ]);
        }

        $qualificationData = $request->validate([
            'qualifications' => 'required|array',
        ]);

        $opportunity->qualifications()->delete();

        foreach ($request->qualifications as $qualification) {
            Qualification::create([
                'opportunity_id' => $opportunity->id,
                'qualification' => $qualification
            ]);
        }

        $employer_questionData = $request->validate([
            'employer_questions' => 'required|array',
        ]);

        $opportunity->employer_questions()->delete();

        foreach ($request->employer_questions as $employer_question) {
            EmployerQuestion::create([
                'opportunity_id' => $opportunity->id,
                'employer_question' => $employer_question
            ]);
        }

        return redirect()->route('opportunity.index')
                         ->with('success', 'Opportunity updated successfully.');
    }

    public function destroy(Opportunity $opportunity)
    {
        $opportunity->delete();

        return redirect()->route('opportunity.index')
                         ->with('success', 'Opportunity deleted successfully.');
    }


}
